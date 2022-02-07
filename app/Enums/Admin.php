<?php

namespace App\Enums;

/**
 * @enum Admin
 */
enum Admin: int
{
    case Basic = 1;
    case Admin = 10;
    case Root = 20;
}
