<?php

namespace App\DTOs;
use App\Enums\AvailableMethods;

class CommandDTO
{
    public AvailableMethods $method;
    public ?string $argument;

    public function __construct(array $argv) {
        if (php_sapi_name() !== 'cli') {
            exit("Этот скрипт должен запускаться из командной строки.\n");
        }

        if (!isset($argv[1])) {
            exit("Ошибка: необходимо указать метод");
        }
        
        $method = AvailableMethods::tryFrom($argv[1]);
        $argument = isset($argv[2]) ? $argv[2] : null;

        if($method === null) {
            exit("Ошибка: указанный метод не поддерживается, для просмотра доступных методов используйте info \n");
        }

        $this->method = $method;
        $this->argument = $argument;
    }
}