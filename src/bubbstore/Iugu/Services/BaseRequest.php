<?php

namespace store\Iugu\Services;

use store\Iugu\Exceptions\IuguException;
use store\Iugu\Exceptions\IuguValidationException;
use store\Iugu\Iugu;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

class BaseRequest
{
    /**
     * Cliente HTTP
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $http;

    /**
     * Iugu
     *
     * @var \store\Iugu\Iugu
     */
    protected $iugu;

    /**
     * Parâmetros do cliente
     *
     * @var array
     */
    protected $params;

    /**
     * Response da chamada da API
     *
     * @var array
     */
    protected $response;

    public function __construct(ClientInterface $http, Iugu $iugu)
    {
        $this->http = $http;
        $this->iugu = $iugu;
    }

    /**
     * setParams
     *
     * @param array $value
     * @return self
     */
    protected function setParams($value)
    {
        $this->params = $value;
        return $this;
    }

    /**
     * fetchResponse
     *
     * Modifica o payload de retorno.
     *
     * @return array
     */
    protected function fetchResponse()
    {
        return $this->response;
    }

    /**
     * sendApiRequest
     *
     * @return void
     */
    protected function sendApiRequest($method, $path)
    {
        try {
            $requestParams = [];

            if (in_array($method, ['PUT', 'POST'])) {
                $requestParams = [
                    'json' => $this->params,
                ];
            }

            $request = $this->http->$method($path, $requestParams);
            
            $this->response = json_decode($request->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getCode() == 422) {
                $response = json_decode($e->getResponse()->getBody()->getContents(), true);
                throw new IuguValidationException($e->getMessage(), $e->getCode(), $response['errors']);
            }

            throw new IuguException($e->getMessage(), $e->getCode());
        }
    }
}
