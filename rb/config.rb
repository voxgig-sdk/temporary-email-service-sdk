# TemporaryEmailService SDK configuration

module TemporaryEmailServiceConfig
  def self.make_config
    {
      "main" => {
        "name" => "TemporaryEmailService",
      },
      "feature" => {
        "test" => {
          "options" => {
            "active" => false,
          },
        },
      },
      "options" => {
        "base" => "https://hub.juheapi.com",
        "auth" => {
          "prefix" => "Bearer",
        },
        "headers" => {
          "content-type" => "application/json",
        },
        "entity" => {
          "temporary_email" => {},
        },
      },
      "entity" => {
        "temporary_email" => {
          "fields" => [
            {
              "name" => "code",
              "req" => false,
              "type" => "`$STRING`",
              "active" => true,
              "index$" => 0,
            },
            {
              "name" => "data",
              "req" => false,
              "type" => "`$OBJECT`",
              "active" => true,
              "index$" => 1,
            },
            {
              "name" => "msg",
              "req" => false,
              "type" => "`$STRING`",
              "active" => true,
              "index$" => 2,
            },
          ],
          "name" => "temporary_email",
          "op" => {
            "load" => {
              "name" => "load",
              "points" => [
                {
                  "args" => {
                    "query" => [
                      {
                        "example" => "434306d581f376e3aa290e7c7df966fc",
                        "kind" => "query",
                        "name" => "apikey",
                        "orig" => "apikey",
                        "reqd" => true,
                        "type" => "`$STRING`",
                        "active" => true,
                      },
                    ],
                  },
                  "method" => "GET",
                  "orig" => "/temp-mail/v1/create",
                  "parts" => [
                    "temp-mail",
                    "v1",
                    "create",
                  ],
                  "select" => {
                    "exist" => [
                      "apikey",
                    ],
                  },
                  "transform" => {
                    "req" => "`reqdata`",
                    "res" => "`body`",
                  },
                  "active" => true,
                  "index$" => 0,
                },
              ],
              "input" => "data",
              "key$" => "load",
            },
          },
          "relations" => {
            "ancestors" => [],
          },
        },
      },
    }
  end


  def self.make_feature(name)
    require_relative 'features'
    TemporaryEmailServiceFeatures.make_feature(name)
  end
end
