-- TemporaryEmailService SDK configuration

-- Build a fresh, fully materialised config table. Every call rebuilds the
-- whole structure, so prefer require("config_shared") unless you need a
-- private copy you intend to mutate.
local function make_config()
  return {
    main = {
      name = "TemporaryEmailService",
      slug = "temporary-email-service",
      version = "0.0.1",
      target = "lua",
    },
    feature = {
      ["test"] = {
        ["options"] = {
          ["active"] = false,
        },
        ["transport"] = "base",
      },
    },
    options = {
      base = "https://hub.juheapi.com",
      auth = {
        prefix = "",
      },
      headers = {
        ["content-type"] = "application/json",
      },
      entity = {
        ["temporary_email"] = {},
      },
    },
    entity = {
      ["temporary_email"] = {
        ["fields"] = {
          {
            ["name"] = "email",
            ["short"] = "Generated temporary email address",
            ["type"] = "`$STRING`",
          },
          {
            ["name"] = "expiresAt",
            ["short"] = "Expiration timestamp of the temporary email",
            ["type"] = "`$STRING`",
          },
          {
            ["name"] = "token",
            ["short"] = "Token for accessing the mailbox",
            ["type"] = "`$STRING`",
          },
        },
        ["name"] = "temporary_email",
        ["op"] = {
          ["load"] = {
            ["input"] = "data",
            ["name"] = "load",
            ["points"] = {
              {
                ["args"] = {
                  ["query"] = {
                    {
                      ["example"] = "434306d581f376e3aa290e7c7df966fc",
                      ["kind"] = "query",
                      ["name"] = "apikey",
                      ["orig"] = "apikey",
                      ["reqd"] = true,
                      ["type"] = "`$STRING`",
                    },
                  },
                },
                ["kind"] = "http",
                ["method"] = "GET",
                ["orig"] = "/temp-mail/v1/create",
                ["parts"] = {
                  "temp-mail",
                  "v1",
                  "create",
                },
                ["select"] = {
                  ["exist"] = {
                    "apikey",
                  },
                },
                ["transform"] = {
                  ["req"] = "`reqdata`",
                  ["res"] = "`body.data`",
                },
              },
            },
          },
        },
        ["relations"] = {
          ["ancestors"] = {},
        },
      },
    },
  }
end


local function make_feature(name)
  local features = require("features")
  local factory = features[name]
  if factory ~= nil then
    return factory()
  end
  return features.base()
end


-- Attach make_feature to the SDK class
local function setup_sdk(SDK)
  SDK._make_feature = make_feature
end


return make_config
