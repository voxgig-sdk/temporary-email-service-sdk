package voxgigtemporaryemailservicesdk

import (
	"github.com/voxgig-sdk/temporary-email-service-sdk/go/core"
	"github.com/voxgig-sdk/temporary-email-service-sdk/go/entity"
	"github.com/voxgig-sdk/temporary-email-service-sdk/go/feature"
	_ "github.com/voxgig-sdk/temporary-email-service-sdk/go/utility"
)

// Type aliases preserve external API.
type TemporaryEmailServiceSDK = core.TemporaryEmailServiceSDK
type Context = core.Context
type Utility = core.Utility
type Feature = core.Feature
type Entity = core.Entity
type TemporaryEmailServiceEntity = core.TemporaryEmailServiceEntity
type FetcherFunc = core.FetcherFunc
type Spec = core.Spec
type Result = core.Result
type Response = core.Response
type Operation = core.Operation
type Control = core.Control
type TemporaryEmailServiceError = core.TemporaryEmailServiceError

// BaseFeature from feature package.
type BaseFeature = feature.BaseFeature

func init() {
	core.NewBaseFeatureFunc = func() core.Feature {
		return feature.NewBaseFeature()
	}
	core.NewTestFeatureFunc = func() core.Feature {
		return feature.NewTestFeature()
	}
	core.NewTemporaryEmailEntityFunc = func(client *core.TemporaryEmailServiceSDK, entopts map[string]any) core.TemporaryEmailServiceEntity {
		return entity.NewTemporaryEmailEntity(client, entopts)
	}
}

// Constructor re-exports.
var NewTemporaryEmailServiceSDK = core.NewTemporaryEmailServiceSDK
var TestSDK = core.TestSDK
var NewContext = core.NewContext
var NewSpec = core.NewSpec
var NewResult = core.NewResult
var NewResponse = core.NewResponse
var NewOperation = core.NewOperation
var MakeConfig = core.MakeConfig

// No-arg convenience constructors. Go has no default-argument syntax,
// so these aliases let callers write `sdk.New()` / `sdk.Test()`
// instead of `sdk.NewTemporaryEmailServiceSDK(nil)` / `sdk.TestSDK(nil, nil)`
// for the common no-options case.
func New() *TemporaryEmailServiceSDK  { return NewTemporaryEmailServiceSDK(nil) }
func Test() *TemporaryEmailServiceSDK { return TestSDK(nil, nil) }
var NewBaseFeature = feature.NewBaseFeature
var NewTestFeature = feature.NewTestFeature
