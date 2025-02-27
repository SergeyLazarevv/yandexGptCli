<?php

namespace App\Validate;

use App\Enums\AvailableMethods;

class Validator {

    public static function validate(array $argv): void
    {
        if (php_sapi_name() !== 'cli') {
            exit("Этот скрипт должен запускаться из командной строки.\n");
        }

        if (!isset($argv[1])) {
            exit("Ошибка: необходимо указать метод");
        }
        
        $method = $argv[1];
        //$data = isset($argv[2]) ? $argv[2] : null;

        if(AvailableMethods::tryFrom($method) === null) {
            exit("Ошибка: указанный метод не поддерживается, для просмотра доступных методов используйте info \n");
        }
    }
}