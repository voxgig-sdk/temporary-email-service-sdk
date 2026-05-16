package = "voxgig-sdk-temporary-email-service"
version = "0.0-1"
source = {
  url = "git://github.com/voxgig-sdk/temporary-email-service-sdk.git"
}
description = {
  summary = "TemporaryEmailService SDK for Lua",
  license = "MIT"
}
dependencies = {
  "lua >= 5.3",
  "dkjson >= 2.5",
  "dkjson >= 2.5",
}
build = {
  type = "builtin",
  modules = {
    ["temporary-email-service_sdk"] = "temporary-email-service_sdk.lua",
    ["config"] = "config.lua",
    ["features"] = "features.lua",
  }
}
