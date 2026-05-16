<?php
declare(strict_types=1);

// TemporaryEmailService SDK feature factory

require_once __DIR__ . '/feature/BaseFeature.php';
require_once __DIR__ . '/feature/TestFeature.php';


class TemporaryEmailServiceFeatures
{
    public static function make_feature(string $name)
    {
        switch ($name) {
            case "base":
                return new TemporaryEmailServiceBaseFeature();
            case "test":
                return new TemporaryEmailServiceTestFeature();
            default:
                return new TemporaryEmailServiceBaseFeature();
        }
    }
}
