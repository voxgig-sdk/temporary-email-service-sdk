-- Typed models for the TemporaryEmailService SDK (LuaLS annotations).
--
-- GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
-- params (op.<name>.points[].args.params[]). Field/param types come from the
-- canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
-- @voxgig/apidef VALID_CANON). Annotations only — no runtime effect. Do not
-- edit by hand.

---@class TemporaryEmail
---@field email? string
---@field expiresAt? string
---@field token? string

---@class TemporaryEmailLoadMatch
---@field apikey string

local M = {}

return M
