<?php

namespace App\Api\V1;

use App\Config\Config;
use App\Library\Authorization;
use App\Library\HTTP\Response\JsonResponse;
use App\Library\HTTP\Response\RespondSender;

class Api
{
    public function __construct()
    {
        if (!Authorization::authBearer()) {
            RespondSender::send((new JsonResponse())->error(JsonResponse::ERROR_INVALID_TOKEN));
        }
    }

    public function rates(?string $currencies = null): JsonResponse
    {
        $result = [];
        $currencies = explode(',', str_replace(' ', '', $currencies));

        // get rates
        $rates = json_decode(file_get_contents('https://blockchain.info/ticker'), true);
        foreach ($rates as $currency => $rate) {
            if(empty($currencies) || in_array($currency, $currencies)) {
                $result[$currency] = $this->applyCommision($rate['last']);
            }
        }
        asort($result);

        return (new JsonResponse)->success($result);
    }

    public function convert(string $currency_from, string $currency_to, float $value): JsonResponse
    {
        // validate value
        if ($value < 0.01) {
            return (new JsonResponse)->error('Too small value');
        }

        $rates = json_decode(file_get_contents('https://blockchain.info/ticker'), true);
        $rates['BTC'] = ['last' => 1];

        $rate = $this->applyCommision($rates[$currency_to]['last'] / $rates[$currency_from]['last']);
        $converted_value = $value * $rate;

        if ($currency_to === 'BTC') {
            $converted_value = number_format($converted_value, 10, '.', '');
        } else {
            $converted_value = number_format($converted_value, 2, '.', '');
        }

        $result = [
            'currency_from' => $currency_from,
            'currency_to' => $currency_to,
            'value' => $value,
            'rate' => $rate,
            'converted_value' => $converted_value,
        ];
        return (new JsonResponse)->success($result);
    }

    private function applyCommision(float $value): float
    {
        return $value * (1 + Config::CURRENCY_COMMISSION);
    }
}
