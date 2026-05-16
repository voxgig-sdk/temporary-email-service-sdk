<?php
declare(strict_types=1);

// TemporaryEmailService SDK utility: result_headers

class TemporaryEmailServiceResultHeaders
{
    public static function call(TemporaryEmailServiceContext $ctx): ?TemporaryEmailServiceResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result) {
            if ($response && is_array($response->headers)) {
                $result->headers = $response->headers;
            } else {
                $result->headers = [];
            }
        }
        return $result;
    }
}
