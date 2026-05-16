# TemporaryEmailService SDK utility: make_context
require_relative '../core/context'
module TemporaryEmailServiceUtilities
  MakeContext = ->(ctxmap, basectx) {
    TemporaryEmailServiceContext.new(ctxmap, basectx)
  }
end
