# TemporaryEmailService SDK exists test

require "minitest/autorun"
require_relative "../TemporaryEmailService_sdk"

class ExistsTest < Minitest::Test
  def test_create_test_sdk
    testsdk = TemporaryEmailServiceSDK.test(nil, nil)
    assert !testsdk.nil?
  end
end
