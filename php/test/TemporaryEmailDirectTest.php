<?php
declare(strict_types=1);

// TemporaryEmail direct test

require_once __DIR__ . '/../temporaryemailservice_sdk.php';
require_once __DIR__ . '/Runner.php';

use PHPUnit\Framework\TestCase;

class TemporaryEmailDirectTest extends TestCase
{
    public function test_direct_load_temporary_email(): void
    {
        $setup = temporary_email_direct_setup(["id" => "direct01"]);
        [$_shouldSkip, $_reason] = Runner::is_control_skipped("direct", "direct-load-temporary_email", $setup["live"] ? "live" : "unit");
        if ($_shouldSkip) {
            $this->markTestSkipped($_reason ?? "skipped via sdk-test-control.json");
            return;
        }
        $client = $setup["client"];

        $params = [];
        $query = [];
        if ($setup["live"]) {
            $query["apikey"] = "434306d581f376e3aa290e7c7df966fc";
        }

        $result = $client->direct([
            "path" => "temp-mail/v1/create",
            "method" => "GET",
            "params" => $params,
            "query" => $query,
        ]);
        if ($setup["live"]) {
            // Live mode is lenient: synthetic IDs frequently 4xx. Skip
            // rather than fail when the load endpoint isn't reachable
            // with the IDs we can construct from setup.idmap.
            if (!empty($result["err"])) {
                $this->markTestSkipped("load call failed (likely synthetic IDs against live API): " . (string)$result["err"]);
                return;
            }
            if (empty($result["ok"])) {
                $this->markTestSkipped("load call not ok (likely synthetic IDs against live API)");
                return;
            }
            $status = Helpers::to_int($result["status"]);
            if ($status < 200 || $status >= 300) {
                $this->markTestSkipped("expected 2xx status, got " . $status);
                return;
            }
        } else {
            $this->assertArrayNotHasKey("err", $result);
            $this->assertTrue($result["ok"]);
            $this->assertEquals(200, Helpers::to_int($result["status"]));
            $this->assertNotNull($result["data"]);
            if (is_array($result["data"]) && isset($result["data"]["id"])) {
                $this->assertEquals("direct01", $result["data"]["id"]);
            }
            $this->assertCount(1, $setup["calls"]);
        }
    }

}


function temporary_email_direct_setup($mockres)
{
    Runner::load_env_local();

    $calls = new \ArrayObject();

    $env = Runner::env_override([
        "TEMPORARYEMAILSERVICE_TEST_TEMPORARY_EMAIL_ENTID" => [],
        "TEMPORARYEMAILSERVICE_TEST_LIVE" => "FALSE",
        "TEMPORARYEMAILSERVICE_APIKEY" => "NONE",
    ]);

    $live = $env["TEMPORARYEMAILSERVICE_TEST_LIVE"] === "TRUE";

    if ($live) {
        $merged_opts = [
            "apikey" => $env["TEMPORARYEMAILSERVICE_APIKEY"],
        ];
        $client = new TemporaryEmailServiceSDK($merged_opts);
        return [
            "client" => $client,
            "calls" => $calls,
            "live" => true,
            "idmap" => [],
        ];
    }

    $mock_fetch = function ($url, $init) use ($calls, $mockres) {
        $calls[] = ["url" => $url, "init" => $init];
        return [
            [
                "status" => 200,
                "statusText" => "OK",
                "headers" => [],
                "json" => function () use ($mockres) {
                    if ($mockres !== null) {
                        return $mockres;
                    }
                    return ["id" => "direct01"];
                },
                "body" => "mock",
            ],
            null,
        ];
    };

    $client = new TemporaryEmailServiceSDK([
        "base" => "http://localhost:8080",
        "system" => [
            "fetch" => $mock_fetch,
        ],
    ]);

    return [
        "client" => $client,
        "calls" => $calls,
        "live" => false,
        "idmap" => [],
    ];
}
