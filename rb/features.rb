# TemporaryEmailService SDK feature factory

require_relative 'feature/base_feature'
require_relative 'feature/test_feature'


module TemporaryEmailServiceFeatures
  def self.make_feature(name)
    case name
    when "base"
      TemporaryEmailServiceBaseFeature.new
    when "test"
      TemporaryEmailServiceTestFeature.new
    else
      TemporaryEmailServiceBaseFeature.new
    end
  end
end
