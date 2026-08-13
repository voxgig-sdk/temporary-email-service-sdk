# TemporaryEmailService SDK utility: make_context

from temporaryemailservice_sdk.core.context import TemporaryEmailServiceContext


def make_context_util(ctxmap, basectx):
    return TemporaryEmailServiceContext(ctxmap, basectx)
