# TemporaryEmailService SDK utility: feature_add
module TemporaryEmailServiceUtilities
  FeatureAdd = ->(ctx, f) {
    ctx.client.features << f
  }
end
