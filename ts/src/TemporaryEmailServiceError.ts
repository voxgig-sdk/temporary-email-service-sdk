
import { Context } from './Context'


class TemporaryEmailServiceError extends Error {

  isTemporaryEmailServiceError = true

  sdk = 'TemporaryEmailService'

  code: string
  ctx: Context

  constructor(code: string, msg: string, ctx: Context) {
    super(msg)
    this.code = code
    this.ctx = ctx
  }

}

export {
  TemporaryEmailServiceError
}

