# TemporaryEmailService SDK feature factory

from feature.base_feature import TemporaryEmailServiceBaseFeature
from feature.test_feature import TemporaryEmailServiceTestFeature


def _make_feature(name):
    features = {
        "base": lambda: TemporaryEmailServiceBaseFeature(),
        "test": lambda: TemporaryEmailServiceTestFeature(),
    }
    factory = features.get(name)
    if factory is not None:
        return factory()
    return features["base"]()
