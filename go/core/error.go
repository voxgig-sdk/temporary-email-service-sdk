package core

type TemporaryEmailServiceError struct {
	IsTemporaryEmailServiceError bool
	Sdk              string
	Code             string
	Msg              string
	Ctx              *Context
	Result           any
	Spec             any
}

func NewTemporaryEmailServiceError(code string, msg string, ctx *Context) *TemporaryEmailServiceError {
	return &TemporaryEmailServiceError{
		IsTemporaryEmailServiceError: true,
		Sdk:              "TemporaryEmailService",
		Code:             code,
		Msg:              msg,
		Ctx:              ctx,
	}
}

func (e *TemporaryEmailServiceError) Error() string {
	return e.Msg
}
