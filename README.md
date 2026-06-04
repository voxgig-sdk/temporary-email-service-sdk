# TemporaryEmailService SDK

Generate disposable email addresses for anonymous sign-ups and one-off verifications

> TypeScript, Python, PHP, Golang, Ruby, Lua SDKs, a CLI, an interactive REPL, and an MCP server for AI agents — all generated from one OpenAPI spec by [@voxgig/sdkgen](https://github.com/voxgig/sdkgen).

## About Temporary Email Service

[Temporary Email Service](https://hub.juheapi.com) is a hosted endpoint on [JuheAPI Hub](https://hub.juheapi.com) that mints throwaway email addresses you can hand out to web forms, trial sign-ups, and verification flows without exposing a personal mailbox.

What you get from the API:

- An HTTP endpoint that returns a freshly generated temporary email address
- Useful for anonymous registration, short-lived verification, and scraping/automation pipelines that need disposable inboxes

The API is fronted by JuheAPI Hub and is called over HTTPS at `https://hub.juheapi.com`. An API key is required and is passed as the `apikey` query parameter. The catalogue listing on freepublicapis.com lists CORS as disabled, so calls are expected to originate from server-side code rather than browser front-ends.

## Try it

**TypeScript**
```bash
npm install temporary-email-service
```

**Python**
```bash
pip install temporary-email-service-sdk
```

**PHP**
```bash
composer require voxgig/temporary-email-service-sdk
```

**Golang**
```bash
go get github.com/voxgig-sdk/temporary-email-service-sdk/go
```

**Ruby**
```bash
gem install temporary-email-service-sdk
```

**Lua**
```bash
luarocks install temporary-email-service-sdk
```

## 30-second quickstart

### TypeScript

```ts
import { TemporaryEmailServiceSDK } from 'temporary-email-service'

const client = new TemporaryEmailServiceSDK({})

```

See the [TypeScript README](ts/README.md) for the
full guide, or scroll down for the same example in other languages.

## What's in the box

| Surface | Use it for | Path |
| --- | --- | --- |
| **SDK** (TypeScript, Python, PHP, Golang, Ruby, Lua) | App integration | `ts/` `py/` `php/` `go/` `rb/` `lua/` |
| **CLI** | Scripts, CI, ops, one-off API calls | `go-cli/` |
| **MCP server** | AI agents (Claude, Cursor, Cline) | `go-mcp/` |

## Use it from an AI agent (MCP)

The generated MCP server exposes every operation in this SDK as an
[MCP](https://modelcontextprotocol.io) tool that Claude, Cursor or Cline
can call directly. Build and register it:

```bash
cd go-mcp && go build -o temporary-email-service-mcp .
```

Then add it to your agent's MCP config (Claude Desktop, Cursor, etc.):

```json
{
  "mcpServers": {
    "temporary-email-service": {
      "command": "/abs/path/to/temporary-email-service-mcp"
    }
  }
}
```

## Entities

The API exposes one entity:

| Entity | Description | API path |
| --- | --- | --- |
| **TemporaryEmail** | A disposable email address resource minted on demand, created via `GET /temp-mail/v1/create`. | `/temp-mail/v1/create` |

Each entity supports the following operations where available: **load**,
**list**, **create**, **update**, and **remove**.

## Quickstart in other languages

### Python

```python
from temporaryemailservice_sdk import TemporaryEmailServiceSDK

client = TemporaryEmailServiceSDK({})


# Load a specific temporaryemail
temporaryemail, err = client.TemporaryEmail(None).load(
    {"id": "example_id"}, None
)
```

### PHP

```php
<?php
require_once 'temporaryemailservice_sdk.php';

$client = new TemporaryEmailServiceSDK([]);


// Load a specific temporaryemail
[$temporaryemail, $err] = $client->TemporaryEmail(null)->load(
    ["id" => "example_id"], null
);
```

### Golang

```go
import sdk "github.com/voxgig-sdk/temporary-email-service-sdk/go"

client := sdk.NewTemporaryEmailServiceSDK(map[string]any{})

```

### Ruby

```ruby
require_relative "TemporaryEmailService_sdk"

client = TemporaryEmailServiceSDK.new({})


# Load a specific temporaryemail
temporaryemail, err = client.TemporaryEmail(nil).load(
  { "id" => "example_id" }, nil
)
```

### Lua

```lua
local sdk = require("temporary-email-service_sdk")

local client = sdk.new({})


-- Load a specific temporaryemail
local temporaryemail, err = client:TemporaryEmail(nil):load(
  { id = "example_id" }, nil
)
```

## Unit testing in offline mode

Every SDK ships a test mode that swaps the HTTP transport for an
in-memory mock, so unit tests run offline.

### TypeScript

```ts
const client = TemporaryEmailServiceSDK.test()
const result = await client.TemporaryEmail().load({ id: 'test01' })
// result.ok === true, result.data contains mock data
```

### Python

```python
client = TemporaryEmailServiceSDK.test(None, None)
result, err = client.TemporaryEmail(None).load(
    {"id": "test01"}, None
)
```

### PHP

```php
$client = TemporaryEmailServiceSDK::test(null, null);
[$result, $err] = $client->TemporaryEmail(null)->load(
    ["id" => "test01"], null
);
```

### Golang

```go
client := sdk.TestSDK(nil, nil)
result, err := client.TemporaryEmail(nil).Load(
    map[string]any{"id": "test01"}, nil,
)
```

### Ruby

```ruby
client = TemporaryEmailServiceSDK.test(nil, nil)
result, err = client.TemporaryEmail(nil).load(
  { "id" => "test01" }, nil
)
```

### Lua

```lua
local client = sdk.test(nil, nil)
local result, err = client:TemporaryEmail(nil):load(
  { id = "test01" }, nil
)
```

## How it works

Every SDK call runs the same five-stage pipeline:

1. **Point** — resolve the API endpoint from the operation definition.
2. **Spec** — build the HTTP specification (URL, method, headers, body).
3. **Request** — send the HTTP request.
4. **Response** — receive and parse the response.
5. **Result** — extract the result data for the caller.

A feature hook fires at each stage (e.g. `PrePoint`, `PreSpec`,
`PreRequest`), so features can inspect or modify the pipeline without
forking the SDK.

### Features

| Feature | Purpose |
| --- | --- |
| **TestFeature** | In-memory mock transport for testing without a live server |

Pass custom features via the `extend` option at construction time.

### Direct and Prepare

For endpoints the entity model doesn't cover, use the low-level methods:

- **`direct(fetchargs)`** — build and send an HTTP request in one step.
- **`prepare(fetchargs)`** — build the request without sending it.

Both accept a map with `path`, `method`, `params`, `query`,
`headers`, and `body`. See the [How-to guides](#how-to-guides) below.

## How-to guides

### Make a direct API call

When the entity interface does not cover an endpoint, use `direct`:

**TypeScript:**
```ts
const result = await client.direct({
  path: '/api/resource/{id}',
  method: 'GET',
  params: { id: 'example' },
})
console.log(result.data)
```

**Python:**
```python
result, err = client.direct({
    "path": "/api/resource/{id}",
    "method": "GET",
    "params": {"id": "example"},
})
```

**PHP:**
```php
[$result, $err] = $client->direct([
    "path" => "/api/resource/{id}",
    "method" => "GET",
    "params" => ["id" => "example"],
]);
```

**Go:**
```go
result, err := client.Direct(map[string]any{
    "path":   "/api/resource/{id}",
    "method": "GET",
    "params": map[string]any{"id": "example"},
})
```

**Ruby:**
```ruby
result, err = client.direct({
  "path" => "/api/resource/{id}",
  "method" => "GET",
  "params" => { "id" => "example" },
})
```

**Lua:**
```lua
local result, err = client:direct({
  path = "/api/resource/{id}",
  method = "GET",
  params = { id = "example" },
})
```

## Per-language documentation

- [TypeScript](ts/README.md)
- [Python](py/README.md)
- [PHP](php/README.md)
- [Golang](go/README.md)
- [Ruby](rb/README.md)
- [Lua](lua/README.md)

## Using the Temporary Email Service

- Upstream: [https://hub.juheapi.com](https://hub.juheapi.com)

---

Generated from the Temporary Email Service OpenAPI spec by [@voxgig/sdkgen](https://github.com/voxgig/sdkgen).
