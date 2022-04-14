<?php

namespace bubbstore\Iugu\Services;

use bubbstore\Iugu\Contracts\CustomerInterface;

class Customer extends BaseRequest implements CustomerInterface
{

    /**
     * Customer constructor.
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
     * Cria um novo cliente.
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'customers');

        return $this->fetchResponse();
    }

    /**
     * update
     *
     * Atualizar um cliente.
     *
     * @param int $id
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function update($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', sprintf('customers/%s', $id));

        return $this->fetchResponse();
    }

    /**
     * find
     *
     * Procura um cliente
     *
     * @param  int $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function find($id)
    {
        $this->sendApiRequest('GET', sprintf('customers/%s', $id));

        return $this->fetchResponse();
    }

    /**
     * delete
     *
     * Exclui um cliente
     *
     * @param  int $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function delete($id)
    {
        $this->sendApiRequest('DELETE', sprintf('customers/%s', $id));

        return $this->fetchResponse();
    }

    /**
     * list payment methods
     *
     * @param string $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function listPaymentMethods($id)
    {
        $this->sendApiRequest('GET', sprintf('customers/%s/payment_methods', $id));

        return $this->fetchResponse();
    }
}
