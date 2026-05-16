<?php
declare(strict_types=1);

// TemporaryEmailService SDK utility: feature_add

class TemporaryEmailServiceFeatureAdd
{
    public static function call(TemporaryEmailServiceContext $ctx, mixed $f): void
    {
        $ctx->client->features[] = $f;
    }
}
