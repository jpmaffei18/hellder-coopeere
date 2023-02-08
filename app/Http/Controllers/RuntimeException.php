<?php

namespace App\Http\Controllers;

class RuntimeException extends Exception {
    /* Inherited properties */
    protected string $message;
    protected int $code;
    protected string $file;
    protected int $line;
    /* Inherited methods */
    public Exception::__construct(string $message = "", int $code = 0, Throwable|null $previous = null)
    final public Exception::getMessage(): string
    final public Exception::getPrevious(): Throwable|null
    final public Exception::getCode(): int
    final public Exception::getFile(): string
    final public Exception::getLine(): int
    final public Exception::getTrace(): array
    final public Exception::getTraceAsString(): string
    public Exception::__toString(): string
    final private Exception::__clone(): void
}

?>