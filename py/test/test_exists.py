# ProjectName SDK exists test

import pytest
from temporaryemailservice_sdk import TemporaryEmailServiceSDK


class TestExists:

    def test_should_create_test_sdk(self):
        testsdk = TemporaryEmailServiceSDK.test(None, None)
        assert testsdk is not None
