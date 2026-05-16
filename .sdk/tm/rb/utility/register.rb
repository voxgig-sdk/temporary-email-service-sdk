# TemporaryEmailService SDK utility registration
require_relative '../core/utility_type'
require_relative 'clean'
require_relative 'done'
require_relative 'make_error'
require_relative 'feature_add'
require_relative 'feature_hook'
require_relative 'feature_init'
require_relative 'fetcher'
require_relative 'make_fetch_def'
require_relative 'make_context'
require_relative 'make_options'
require_relative 'make_request'
require_relative 'make_response'
require_relative 'make_result'
require_relative 'make_point'
require_relative 'make_spec'
require_relative 'make_url'
require_relative 'param'
require_relative 'prepare_auth'
require_relative 'prepare_body'
require_relative 'prepare_headers'
require_relative 'prepare_method'
require_relative 'prepare_params'
require_relative 'prepare_path'
require_relative 'prepare_query'
require_relative 'result_basic'
require_relative 'result_body'
require_relative 'result_headers'
require_relative 'transform_request'
require_relative 'transform_response'

TemporaryEmailServiceUtility.registrar = ->(u) {
  u.clean = TemporaryEmailServiceUtilities::Clean
  u.done = TemporaryEmailServiceUtilities::Done
  u.make_error = TemporaryEmailServiceUtilities::MakeError
  u.feature_add = TemporaryEmailServiceUtilities::FeatureAdd
  u.feature_hook = TemporaryEmailServiceUtilities::FeatureHook
  u.feature_init = TemporaryEmailServiceUtilities::FeatureInit
  u.fetcher = TemporaryEmailServiceUtilities::Fetcher
  u.make_fetch_def = TemporaryEmailServiceUtilities::MakeFetchDef
  u.make_context = TemporaryEmailServiceUtilities::MakeContext
  u.make_options = TemporaryEmailServiceUtilities::MakeOptions
  u.make_request = TemporaryEmailServiceUtilities::MakeRequest
  u.make_response = TemporaryEmailServiceUtilities::MakeResponse
  u.make_result = TemporaryEmailServiceUtilities::MakeResult
  u.make_point = TemporaryEmailServiceUtilities::MakePoint
  u.make_spec = TemporaryEmailServiceUtilities::MakeSpec
  u.make_url = TemporaryEmailServiceUtilities::MakeUrl
  u.param = TemporaryEmailServiceUtilities::Param
  u.prepare_auth = TemporaryEmailServiceUtilities::PrepareAuth
  u.prepare_body = TemporaryEmailServiceUtilities::PrepareBody
  u.prepare_headers = TemporaryEmailServiceUtilities::PrepareHeaders
  u.prepare_method = TemporaryEmailServiceUtilities::PrepareMethod
  u.prepare_params = TemporaryEmailServiceUtilities::PrepareParams
  u.prepare_path = TemporaryEmailServiceUtilities::PreparePath
  u.prepare_query = TemporaryEmailServiceUtilities::PrepareQuery
  u.result_basic = TemporaryEmailServiceUtilities::ResultBasic
  u.result_body = TemporaryEmailServiceUtilities::ResultBody
  u.result_headers = TemporaryEmailServiceUtilities::ResultHeaders
  u.transform_request = TemporaryEmailServiceUtilities::TransformRequest
  u.transform_response = TemporaryEmailServiceUtilities::TransformResponse
}
