package sdktest

import (
	"encoding/json"
	"os"
	"path/filepath"
	"runtime"
	"strings"
	"testing"
	"time"

	sdk "github.com/voxgig-sdk/temporary-email-service-sdk"
	"github.com/voxgig-sdk/temporary-email-service-sdk/core"

	vs "github.com/voxgig/struct"
)

func TestTemporaryEmailEntity(t *testing.T) {
	t.Run("instance", func(t *testing.T) {
		testsdk := sdk.TestSDK(nil, nil)
		ent := testsdk.TemporaryEmail(nil)
		if ent == nil {
			t.Fatal("expected non-nil TemporaryEmailEntity")
		}
	})

	t.Run("basic", func(t *testing.T) {
		setup := temporary_emailBasicSetup(nil)
		// Per-op sdk-test-control.json skip — basic test exercises a flow
		// with multiple ops; skipping any op skips the whole flow.
		_mode := "unit"
		if setup.live {
			_mode = "live"
		}
		for _, _op := range []string{"load"} {
			if _shouldSkip, _reason := isControlSkipped("entityOp", "temporary_email." + _op, _mode); _shouldSkip {
				if _reason == "" {
					_reason = "skipped via sdk-test-control.json"
				}
				t.Skip(_reason)
				return
			}
		}
		// The basic flow consumes synthetic IDs from the fixture. In live mode
		// without an *_ENTID env override, those IDs hit the live API and 4xx.
		if setup.syntheticOnly {
			t.Skip("live entity test uses synthetic IDs from fixture — set TEMPORARYEMAILSERVICE_TEST_TEMPORARY_EMAIL_ENTID JSON to run live")
			return
		}
		client := setup.client

		// Bootstrap entity data from existing test data (no create step in flow).
		temporaryEmailRef01DataRaw := vs.Items(core.ToMapAny(vs.GetPath("existing.temporary_email", setup.data)))
		var temporaryEmailRef01Data map[string]any
		if len(temporaryEmailRef01DataRaw) > 0 {
			temporaryEmailRef01Data = core.ToMapAny(temporaryEmailRef01DataRaw[0][1])
		}
		// Discard guards against Go's unused-var check when the flow's steps
		// happen not to consume the bootstrap data (e.g. list-only flows).
		_ = temporaryEmailRef01Data

		// LOAD
		temporaryEmailRef01Ent := client.TemporaryEmail(nil)
		temporaryEmailRef01MatchDt0 := map[string]any{}
		temporaryEmailRef01DataDt0Loaded, err := temporaryEmailRef01Ent.Load(temporaryEmailRef01MatchDt0, nil)
		if err != nil {
			t.Fatalf("load failed: %v", err)
		}
		if temporaryEmailRef01DataDt0Loaded == nil {
			t.Fatal("expected load result to be non-nil")
		}

	})
}

func temporary_emailBasicSetup(extra map[string]any) *entityTestSetup {
	loadEnvLocal()

	_, filename, _, _ := runtime.Caller(0)
	dir := filepath.Dir(filename)

	entityDataFile := filepath.Join(dir, "..", "..", ".sdk", "test", "entity", "temporary_email", "TemporaryEmailTestData.json")

	entityDataSource, err := os.ReadFile(entityDataFile)
	if err != nil {
		panic("failed to read temporary_email test data: " + err.Error())
	}

	var entityData map[string]any
	if err := json.Unmarshal(entityDataSource, &entityData); err != nil {
		panic("failed to parse temporary_email test data: " + err.Error())
	}

	options := map[string]any{}
	options["entity"] = entityData["existing"]

	client := sdk.TestSDK(options, extra)

	// Generate idmap via transform, matching TS pattern.
	idmap := vs.Transform(
		[]any{"temporary_email01", "temporary_email02", "temporary_email03"},
		map[string]any{
			"`$PACK`": []any{"", map[string]any{
				"`$KEY`": "`$COPY`",
				"`$VAL`": []any{"`$FORMAT`", "upper", "`$COPY`"},
			}},
		},
	)

	// Detect ENTID env override before envOverride consumes it. When live
	// mode is on without a real override, the basic test runs against synthetic
	// IDs from the fixture and 4xx's. Surface this so the test can skip.
	entidEnvRaw := os.Getenv("TEMPORARYEMAILSERVICE_TEST_TEMPORARY_EMAIL_ENTID")
	idmapOverridden := entidEnvRaw != "" && strings.HasPrefix(strings.TrimSpace(entidEnvRaw), "{")

	env := envOverride(map[string]any{
		"TEMPORARYEMAILSERVICE_TEST_TEMPORARY_EMAIL_ENTID": idmap,
		"TEMPORARYEMAILSERVICE_TEST_LIVE":      "FALSE",
		"TEMPORARYEMAILSERVICE_TEST_EXPLAIN":   "FALSE",
		"TEMPORARYEMAILSERVICE_APIKEY":         "NONE",
	})

	idmapResolved := core.ToMapAny(env["TEMPORARYEMAILSERVICE_TEST_TEMPORARY_EMAIL_ENTID"])
	if idmapResolved == nil {
		idmapResolved = core.ToMapAny(idmap)
	}

	if env["TEMPORARYEMAILSERVICE_TEST_LIVE"] == "TRUE" {
		mergedOpts := vs.Merge([]any{
			map[string]any{
				"apikey": env["TEMPORARYEMAILSERVICE_APIKEY"],
			},
			extra,
		})
		client = sdk.NewTemporaryEmailServiceSDK(core.ToMapAny(mergedOpts))
	}

	live := env["TEMPORARYEMAILSERVICE_TEST_LIVE"] == "TRUE"
	return &entityTestSetup{
		client:        client,
		data:          entityData,
		idmap:         idmapResolved,
		env:           env,
		explain:       env["TEMPORARYEMAILSERVICE_TEST_EXPLAIN"] == "TRUE",
		live:          live,
		syntheticOnly: live && !idmapOverridden,
		now:           time.Now().UnixMilli(),
	}
}
