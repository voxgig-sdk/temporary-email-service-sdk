<?php
declare(strict_types=1);

// TemporaryEmailService SDK utility: make_context

require_once __DIR__ . '/../core/Context.php';

class TemporaryEmailServiceMakeContext
{
    public static function call(array $ctxmap, ?TemporaryEmailServiceContext $basectx): TemporaryEmailServiceContext
    {
        return new TemporaryEmailServiceContext($ctxmap, $basectx);
    }
}
