# frozen_string_literal: true

# Typed models for the TemporaryEmailService SDK.
#
# GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
# params (op.<name>.points[].args.params[]). Member types come from the
# canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
# @voxgig/apidef VALID_CANON). Ruby types are unenforced; these YARD
# annotations document the shapes. Do not edit by hand.

# TemporaryEmail entity data model.
#
# @!attribute [rw] code
#   @return [String, nil]
#
# @!attribute [rw] data
#   @return [Hash, nil]
#
# @!attribute [rw] msg
#   @return [String, nil]
TemporaryEmail = Struct.new(
  :code,
  :data,
  :msg,
  keyword_init: true
)

# Request payload for TemporaryEmail#load.
#
# @!attribute [rw] code
#   @return [String, nil]
#
# @!attribute [rw] data
#   @return [Hash, nil]
#
# @!attribute [rw] msg
#   @return [String, nil]
TemporaryEmailLoadMatch = Struct.new(
  :code,
  :data,
  :msg,
  keyword_init: true
)

