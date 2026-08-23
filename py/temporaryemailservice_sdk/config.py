# TemporaryEmailService SDK configuration


_shared_config = None


def shared_config():
    """Return the process-wide config, built once on first use.

    The SDK reads the config on every request and never writes to it, so one
    instance is shared by every client rather than rebuilt per client.

    The returned dict is shared: treat it as read-only. Callers that need to
    mutate should use make_config, which always returns a fresh copy.
    """
    global _shared_config
    if _shared_config is None:
        _shared_config = make_config()
    return _shared_config


def make_config():
    """Build a fresh, fully materialised config dict.

    Every call rebuilds the whole structure, so prefer shared_config unless
    you need a private copy you intend to mutate.
    """
    return {
        "main": {
            "name": "TemporaryEmailService",
            "slug": "temporary-email-service",
            "version": "0.0.1",
            "target": "py",
        },
        "feature": {
            "test": {
        "options": {
          "active": False,
        },
      },
        },
        "options": {
            "base": "https://hub.juheapi.com",
            "auth": {
                "prefix": "",
            },
            "headers": {
        "content-type": "application/json",
      },
            "entity": {
                "temporary_email": {},
            },
        },
        "entity": {
      "temporary_email": {
        "fields": [
          {
            "name": "email",
            "short": "Generated temporary email address",
            "type": "`$STRING`",
          },
          {
            "name": "expiresAt",
            "short": "Expiration timestamp of the temporary email",
            "type": "`$STRING`",
          },
          {
            "name": "token",
            "short": "Token for accessing the mailbox",
            "type": "`$STRING`",
          },
        ],
        "name": "temporary_email",
        "op": {
          "load": {
            "input": "data",
            "name": "load",
            "points": [
              {
                "args": {
                  "query": [
                    {
                      "example": "434306d581f376e3aa290e7c7df966fc",
                      "kind": "query",
                      "name": "apikey",
                      "orig": "apikey",
                      "reqd": True,
                      "type": "`$STRING`",
                    },
                  ],
                },
                "kind": "http",
                "method": "GET",
                "orig": "/temp-mail/v1/create",
                "parts": [
                  "temp-mail",
                  "v1",
                  "create",
                ],
                "select": {
                  "exist": [
                    "apikey",
                  ],
                },
                "transform": {
                  "req": "`reqdata`",
                  "res": "`body.data`",
                },
              },
            ],
          },
        },
        "relations": {
          "ancestors": [],
        },
      },
    },
    }
