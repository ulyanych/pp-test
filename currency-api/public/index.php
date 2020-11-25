<?php

use App\Api\V1\Api;
use App\Library\HTTP\Response\JsonResponse;
use App\Library\HTTP\Response\RespondSender;

require dirname(__DIR__) . '/vendor/autoload.php';

$get_params = $_GET;
$post_params = $_POST;


if (empty($get_params['method']))
{
    RespondSender::send((new JsonResponse())->error(JsonResponse::ERROR_INVALID_REQUEST));
}

// default response
$response = (new JsonResponse())->error(JsonResponse::ERROR_INVALID_REQUEST);

switch ($get_params['method']) {
    case 'rates':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $response = (new Api)->rates($get_params['currency'] ?? null);
        }
    break;
    case 'convert':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $post_params['currency_from'] && $post_params['currency_to'] && $post_params['value']) {
            $response = (new Api)->convert($post_params['currency_from'], $post_params['currency_to'], $post_params['value']);
        }
    break;
}

RespondSender::send($response);
