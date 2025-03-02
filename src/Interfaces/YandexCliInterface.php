<?php

namespace App\Interfaces;

interface YandexCliInterface 
{
    public static function init();
    public static function test();
    public static function info();
    public static function ask(string $question, ?string $context);
}