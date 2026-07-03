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
              "active" => true,
              "name" => "code",
              "req" => false,
              "type" => "`$STRING`",
              "index$" => 0,
            },
            {
              "active" => true,
              "name" => "data",
              "req" => false,
              "type" => "`$OBJECT`",
              "index$" => 1,
            },
            {
              "active" => true,
              "name" => "msg",
              "req" => false,
              "type" => "`$STRING`",
              "index$" => 2,
            },
          ],
          "name" => "temporary_email",
          "op" => {
            "load" => {
              "input" => "data",
              "name" => "load",
              "points" => [
                {
                  "active" => true,
                  "args" => {
                    "query" => [
                      {
                        "active" => true,
                        "example" => "434306d581f376e3aa290e7c7df966fc",
                        "kind" => "query",
                        "name" => "apikey",
                        "orig" => "apikey",
                        "reqd" => true,
                        "type" => "`$STRING`",
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
                  "index$" => 0,
                },
              ],
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
