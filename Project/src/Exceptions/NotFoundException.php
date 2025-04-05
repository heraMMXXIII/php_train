<?php
namespace src\Exceptions;  

class NotFoundException extends \RuntimeException
{
    public function __construct(string $message = "Страница не найдена", int $code = 404)
    {
        parent::__construct($message, $code);
    }
}