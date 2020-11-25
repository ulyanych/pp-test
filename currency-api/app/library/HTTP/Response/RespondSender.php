<?php

namespace App\Library\HTTP\Response;

use App\Library\HTTP\Response\JsonResponse;

class RespondSender
{
    public static function send(JsonResponse $response): void
    {
        header(sprintf('HTTP/%s %d %s',
            '1.1',
            $response->getCode(),
            $response->getStatus()
        ));
        foreach ($response->getHeaders() as $header) {
            header($header);
        }
        echo $response->getResponse();
        exit;
    }
}
