<?php
declare(strict_types=1);

// TemporaryEmailService SDK utility: result_body

class TemporaryEmailServiceResultBody
{
    public static function call(TemporaryEmailServiceContext $ctx): ?TemporaryEmailServiceResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result && $response && $response->json_func && $response->body) {
            $result->body = ($response->json_func)();
        }
        return $result;
    }
}
