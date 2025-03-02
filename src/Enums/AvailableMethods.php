<?php

namespace App\Enums;

enum AvailableMethods: string {
    case init = 'init';
    case hello = 'hello';
    case info = 'info';
    case ask = 'ask';
}