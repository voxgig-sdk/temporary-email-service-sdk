<?php
declare(strict_types=1);

// TemporaryEmailService SDK utility: prepare_body

class TemporaryEmailServicePrepareBody
{
    public static function call(TemporaryEmailServiceContext $ctx): mixed
    {
        if ($ctx->op->input === 'data') {
            return ($ctx->utility->transform_request)($ctx);
        }
        return null;
    }
}
