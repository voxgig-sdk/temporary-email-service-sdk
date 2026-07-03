# TemporaryEmailService SDK configuration


def make_config():
    return {
        "main": {
            "name": "TemporaryEmailService",
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
                "prefix": "Bearer",
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
            "active": True,
            "name": "code",
            "req": False,
            "type": "`$STRING`",
            "index$": 0,
          },
          {
            "active": True,
            "name": "data",
            "req": False,
            "type": "`$OBJECT`",
            "index$": 1,
          },
          {
            "active": True,
            "name": "msg",
            "req": False,
            "type": "`$STRING`",
            "index$": 2,
          },
        ],
        "name": "temporary_email",
        "op": {
          "load": {
            "input": "data",
            "name": "load",
            "points": [
              {
                "active": True,
                "args": {
                  "query": [
                    {
                      "active": True,
                      "example": "434306d581f376e3aa290e7c7df966fc",
                      "kind": "query",
                      "name": "apikey",
                      "orig": "apikey",
                      "reqd": True,
                      "type": "`$STRING`",
                    },
                  ],
                },
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
                  "res": "`body`",
                },
                "index$": 0,
              },
            ],
            "key$": "load",
          },
        },
        "relations": {
          "ancestors": [],
        },
      },
    },
    }
