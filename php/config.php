<?php
declare(strict_types=1);

// TemporaryEmailService SDK configuration

class TemporaryEmailServiceConfig
{
    /** @var array<string,mixed>|null */
    private static ?array $shared_config = null;

    /**
     * Return the process-wide config, built once on first use. The SDK reads
     * the config on every request and never writes to it, so one instance is
     * shared by every client rather than rebuilt per client.
     *
     * PHP arrays are copy-on-write, so callers that do mutate the result get
     * their own copy and cannot disturb the shared one.
     */
    public static function shared_config(): array
    {
        if (self::$shared_config === null) {
            self::$shared_config = self::make_config();
        }
        return self::$shared_config;
    }

    /**
     * Build a fresh, fully materialised config array. Every call rebuilds the
     * whole structure, so prefer shared_config unless you need a private copy.
     */
    public static function make_config(): array
    {
        return [
            "main" => [
                "name" => "TemporaryEmailService",
            ],
            "feature" => [
                "test" => [
          'options' => [
            'active' => false,
          ],
        ],
            ],
            "options" => [
                "base" => "https://hub.juheapi.com",
                "auth" => [
                    "prefix" => "",
                ],
                "headers" => [
          'content-type' => 'application/json',
        ],
                "entity" => [
                    "temporary_email" => [],
                ],
            ],
            "entity" => [
        'temporary_email' => [
          'fields' => [
            [
              'name' => 'email',
              'type' => '`$STRING`',
            ],
            [
              'name' => 'expiresAt',
              'type' => '`$STRING`',
            ],
            [
              'name' => 'token',
              'type' => '`$STRING`',
            ],
          ],
          'name' => 'temporary_email',
          'op' => [
            'load' => [
              'input' => 'data',
              'name' => 'load',
              'points' => [
                [
                  'args' => [
                    'query' => [
                      [
                        'example' => '434306d581f376e3aa290e7c7df966fc',
                        'kind' => 'query',
                        'name' => 'apikey',
                        'orig' => 'apikey',
                        'reqd' => true,
                        'type' => '`$STRING`',
                      ],
                    ],
                  ],
                  'kind' => 'http',
                  'method' => 'GET',
                  'orig' => '/temp-mail/v1/create',
                  'parts' => [
                    'temp-mail',
                    'v1',
                    'create',
                  ],
                  'select' => [
                    'exist' => [
                      'apikey',
                    ],
                  ],
                  'transform' => [
                    'req' => '`reqdata`',
                    'res' => '`body.data`',
                  ],
                ],
              ],
            ],
          ],
          'relations' => [
            'ancestors' => [],
          ],
        ],
      ],
        ];
    }


    public static function make_feature(string $name)
    {
        require_once __DIR__ . '/features.php';
        return TemporaryEmailServiceFeatures::make_feature($name);
    }
}
