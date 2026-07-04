<?php
declare(strict_types=1);

// TemporaryEmail entity test

require_once __DIR__ . '/../temporaryemailservice_sdk.php';
require_once __DIR__ . '/Runner.php';

use PHPUnit\Framework\TestCase;
use Voxgig\Struct\Struct as Vs;

class TemporaryEmailEntityTest extends TestCase
{
    public function test_create_instance(): void
    {
        $testsdk = TemporaryEmailServiceSDK::test(null, null);
        $ent = $testsdk->TemporaryEmail(null);
        $this->assertNotNull($ent);
    }

    public function test_basic_flow(): void
    {
        $setup = temporary_email_basic_setup(null);
        // Per-op sdk-test-control.json skip.
        $_live = !empty($setup["live"]);
        foreach (["load"] as $_op) {
            [$_shouldSkip, $_reason] = Runner::is_control_skipped("entityOp", "temporary_email." . $_op, $_live ? "live" : "unit");
            if ($_shouldSkip) {
                $this->markTestSkipped($_reason ?? "skipped via sdk-test-control.json");
                return;
            }
        }
        // The basic flow consumes synthetic IDs from the fixture. In live mode
        // without an *_ENTID env override, those IDs hit the live API and 4xx.
        if (!empty($setup["synthetic_only"])) {
            $this->markTestSkipped("live entity test uses synthetic IDs from fixture — set TEMPORARYEMAILSERVICE_TEST_TEMPORARY_EMAIL_ENTID JSON to run live");
            return;
        }
        $client = $setup["client"];

        // Bootstrap entity data from existing test data.
        $temporary_email_ref01_data_raw = Vs::items(Helpers::to_map(
            Vs::getpath($setup["data"], "existing.temporary_email")));
        $temporary_email_ref01_data = null;
        if (count($temporary_email_ref01_data_raw) > 0) {
            $temporary_email_ref01_data = Helpers::to_map($temporary_email_ref01_data_raw[0][1]);
        }

        // LOAD
        $temporary_email_ref01_ent = $client->TemporaryEmail(null);
        $temporary_email_ref01_match_dt0 = [];
        $temporary_email_ref01_data_dt0_loaded = $temporary_email_ref01_ent->load($temporary_email_ref01_match_dt0, null);
        $this->assertNotNull($temporary_email_ref01_data_dt0_loaded);

    }
}

function temporary_email_basic_setup($extra)
{
    Runner::load_env_local();

    $entity_data_file = __DIR__ . '/../../.sdk/test/entity/temporary_email/TemporaryEmailTestData.json';
    $entity_data_source = file_get_contents($entity_data_file);
    $entity_data = json_decode($entity_data_source, true);

    $options = [];
    $options["entity"] = $entity_data["existing"];

    $client = TemporaryEmailServiceSDK::test($options, $extra);

    // Generate idmap.
    $idmap = [];
    foreach (["temporary_email01", "temporary_email02", "temporary_email03"] as $k) {
        $idmap[$k] = strtoupper($k);
    }

    // Detect ENTID env override before envOverride consumes it. When live
    // mode is on without a real override, the basic test runs against synthetic
    // IDs from the fixture and 4xx's. Surface this so the test can skip.
    $entid_env_raw = getenv("TEMPORARYEMAILSERVICE_TEST_TEMPORARY_EMAIL_ENTID");
    $idmap_overridden = $entid_env_raw !== false && str_starts_with(trim($entid_env_raw), "{");

    $env = Runner::env_override([
        "TEMPORARYEMAILSERVICE_TEST_TEMPORARY_EMAIL_ENTID" => $idmap,
        "TEMPORARYEMAILSERVICE_TEST_LIVE" => "FALSE",
        "TEMPORARYEMAILSERVICE_TEST_EXPLAIN" => "FALSE",
        "TEMPORARYEMAILSERVICE_APIKEY" => "NONE",
    ]);

    $idmap_resolved = Helpers::to_map(
        $env["TEMPORARYEMAILSERVICE_TEST_TEMPORARY_EMAIL_ENTID"]);
    if ($idmap_resolved === null) {
        $idmap_resolved = Helpers::to_map($idmap);
    }

    if ($env["TEMPORARYEMAILSERVICE_TEST_LIVE"] === "TRUE") {
        $merged_opts = Vs::merge([
            [
                "apikey" => $env["TEMPORARYEMAILSERVICE_APIKEY"],
            ],
            $extra ?? [],
        ]);
        $client = new TemporaryEmailServiceSDK(Helpers::to_map($merged_opts));
    }

    $live = $env["TEMPORARYEMAILSERVICE_TEST_LIVE"] === "TRUE";
    return [
        "client" => $client,
        "data" => $entity_data,
        "idmap" => $idmap_resolved,
        "env" => $env,
        "explain" => $env["TEMPORARYEMAILSERVICE_TEST_EXPLAIN"] === "TRUE",
        "live" => $live,
        "synthetic_only" => $live && !$idmap_overridden,
        "now" => (int)(microtime(true) * 1000),
    ];
}
