<?php

namespace bubbstore\Iugu\Services;

use bubbstore\Iugu\Contracts\ChargeInterface;

class Charge extends BaseRequest implements ChargeInterface
{

    /**
     * Charge constructor.
     * @param $http
     * @param $iugu
     */
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * create
     *
     * Cria uma nova cobrança.
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'charge');

        return $this->fetchResponse();
    }
}
