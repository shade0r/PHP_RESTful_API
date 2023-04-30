<?php
class ErrorHandler
{
    public static function handleException(Throwable $exception) :void
    {
        http_response_code(500);
        echo json_encode([
            "code" => $exception->getCode(),
            "message" => $exception->getMessage(),
            "file" => $exception->getFile(),
            "line" => $exception->getLine()
        ]);
    }
    public static function handleErrors($severity, $message, $file, $line) :bool
    {
        throw new ErrorException($message, 0 ,$severity, $file, $line);
    }
}