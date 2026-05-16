-- TemporaryEmailService SDK error

local TemporaryEmailServiceError = {}
TemporaryEmailServiceError.__index = TemporaryEmailServiceError


function TemporaryEmailServiceError.new(code, msg, ctx)
  local self = setmetatable({}, TemporaryEmailServiceError)
  self.is_sdk_error = true
  self.sdk = "TemporaryEmailService"
  self.code = code or ""
  self.msg = msg or ""
  self.ctx = ctx
  self.result = nil
  self.spec = nil
  return self
end


function TemporaryEmailServiceError:error()
  return self.msg
end


function TemporaryEmailServiceError:__tostring()
  return self.msg
end


return TemporaryEmailServiceError
