<?php

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use App\Interfaces\YandexCliInterface;
use App\Validate\Validator;
use App\DTOs\CommandDTO;
use App\Http\HttpRequest;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// var_dump($_ENV['YANDEX_OAUTH']);



class YandexCli implements YandexCliInterface
{

    public static function test(): void
    {
        var_dump('is test method');
    }

    public static function init()
    {
        if(!isset($_ENV['YANDEX_OAUTH']) || empty($_ENV['YANDEX_OAUTH'])) {
            echo 'В ENV не указан YANDEX_OAUTH токен, получите токен согласно иснструкции
                - https://yandex.cloud/ru/docs/iam/concepts/authorization/oauth-token
            ';
        }

        $response = HttpRequest::sendRequest(
            url: $_ENV['YANDEX_GET_TOKEN_URL'], 
            method: 'POST',
            headers: ['Content-Type: application/json'],
            data: ['yandexPassportOauthToken' => $_ENV['YANDEX_OAUTH']]
        );

        $response = json_decode($response, true);

        if(isset($response['iamToken'])) {
            file_put_contents('iamToken.txt', $response['iamToken']);
            print_r("Success \n");
        } else {
            print_r("Error: " . json_encode($response) . " \n");
        }
    }

    public static function info() :void
    {
        // var_dump(2222);
        print_r("avaible methods:
        - test: for debug
        - init <your_outh_token>
        \n");
    }


    // public static function validateMethods(): void
    // {
    //     $classMethods = get_class_methods(static::class);
    //     foreach (AvailableMethods::cases() as $method) {
    //         var_dump($method->value);
    //         if (!in_array($method->value, $classMethods)) {
    //             throw new RuntimeException("Ошибка: метод '{$method->value}' отсутствует в " . static::class . " \n");
    //         }
    //     }
    // }
}

Validator::validate($argv);
$dto = new CommandDTO($argv);

YandexCli::{$dto->method->value}($dto->argument);