<?php

namespace App\Library\HTTP\Response;

class JsonResponse
{
    const STATUS_SUCCESS_STR = 'success';
    const STATUS_SUCCESS_CODE = 200;
    const STATUS_ERROR_STR = 'error';
    const STATUS_ERROR_CODE = 403;

    const ERROR_INVALID_TOKEN = 'Invalid Token';
    const ERROR_INVALID_REQUEST = 'Invalid Request';

    private $headers = ['Content-type:application/json'];
    private $response;
    private $status;
    private $code;

    public function success(array $data): self
    {
        $this->status = self::STATUS_SUCCESS_STR;
        $this->code = self::STATUS_SUCCESS_CODE;

        $this->response = [
            'data' => $data,
        ];

        return $this;
    }

    public function error(string $message): self
    {
        $this->status = self::STATUS_ERROR_STR;
        $this->code = self::STATUS_ERROR_CODE;

        $this->response = [
            'message' => $message,
        ];

        return $this;
    }

    public function getResponse(): string
    {
        $this->response['status'] = $this->status;
        $this->response['code'] = $this->code;
        return json_encode($this->response);
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
