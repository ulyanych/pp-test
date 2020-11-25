<?php

namespace App\Library;

use App\Config\Config;

class Authorization
{
    public static function authBearer(): bool
    {
        foreach (getallheaders() as $header) {
            if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
                return $matches[1] == Config::AUTH_TOKEN;
            }
        }
        return false;
    }
}
