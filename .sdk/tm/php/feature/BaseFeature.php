<?php
declare(strict_types=1);

// TemporaryEmailService SDK base feature

class TemporaryEmailServiceBaseFeature
{
    public string $version;
    public string $name;
    public bool $active;

    // Positions this feature when added via the client `extend` option:
    // "__before__" / "__after__" / "__replace__" name an already-added
    // feature (mirrors the ts feature `_options`). Declared so setting it
    // on an extension instance avoids the dynamic-property deprecation.
    public ?array $_options = null;

    public function __construct()
    {
        $this->version = '0.0.1';
        $this->name = 'base';
        $this->active = true;
    }

    public function get_version(): string { return $this->version; }
    public function get_name(): string { return $this->name; }
    public function get_active(): bool { return $this->active; }

    public function init(TemporaryEmailServiceContext $ctx, array $options): void {}
    public function PostConstruct(TemporaryEmailServiceContext $ctx): void {}
    public function PostConstructEntity(TemporaryEmailServiceContext $ctx): void {}
    public function SetData(TemporaryEmailServiceContext $ctx): void {}
    public function GetData(TemporaryEmailServiceContext $ctx): void {}
    public function GetMatch(TemporaryEmailServiceContext $ctx): void {}
    public function SetMatch(TemporaryEmailServiceContext $ctx): void {}
    public function PrePoint(TemporaryEmailServiceContext $ctx): void {}
    public function PreSpec(TemporaryEmailServiceContext $ctx): void {}
    public function PreRequest(TemporaryEmailServiceContext $ctx): void {}
    public function PreResponse(TemporaryEmailServiceContext $ctx): void {}
    public function PreResult(TemporaryEmailServiceContext $ctx): void {}
    public function PreDone(TemporaryEmailServiceContext $ctx): void {}
    public function PreUnexpected(TemporaryEmailServiceContext $ctx): void {}
}
