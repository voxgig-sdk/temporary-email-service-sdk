
import { BaseFeature } from './feature/base/BaseFeature'
import { TestFeature } from './feature/test/TestFeature'



const FEATURE_CLASS: Record<string, typeof BaseFeature> = {
   test: TestFeature,

}


class Config {

  makeFeature(this: any, fn: string) {
    const fc = FEATURE_CLASS[fn]
    const fi = new fc()
    // TODO: errors etc
    return fi
  }

  // False for a feature added at runtime via options.extend (station's
  // adopt path) - the constructor uses this to skip makeFeature for names
  // no generated class backs.
  hasFeature(this: any, fn: string) {
    return null != FEATURE_CLASS[fn]
  }


  main = {
    name: 'TemporaryEmailService',
        slug: "temporary-email-service",
    version: "0.0.1",
    target: "ts",

  }


  feature = {
     test:     {
      "options": {
        "active": false
      }
    },

  }


  options = {
    base: "https://hub.juheapi.com",

    auth: {
      prefix: '',
    },

    headers: {
      "content-type": "application/json"
    },

    entity: {
      
      temporary_email: {
      },

    }
  }


  entity = {
    "temporary_email": {
      "fields": [
        {
          "name": "email",
          "short": "Generated temporary email address",
          "type": "`$STRING`"
        },
        {
          "name": "expiresAt",
          "short": "Expiration timestamp of the temporary email",
          "type": "`$STRING`"
        },
        {
          "name": "token",
          "short": "Token for accessing the mailbox",
          "type": "`$STRING`"
        }
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
                    "reqd": true,
                    "type": "`$STRING`"
                  }
                ]
              },
              "kind": "http",
              "method": "GET",
              "orig": "/temp-mail/v1/create",
              "parts": [
                "temp-mail",
                "v1",
                "create"
              ],
              "select": {
                "exist": [
                  "apikey"
                ]
              },
              "transform": {
                "req": "`reqdata`",
                "res": "`body.data`"
              }
            }
          ]
        }
      },
      "relations": {
        "ancestors": []
      }
    }
  }
}


const config = new Config()

export {
  config
}

