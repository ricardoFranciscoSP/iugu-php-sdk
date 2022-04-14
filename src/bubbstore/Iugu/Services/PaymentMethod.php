<?php

namespace bubbstore\Iugu\Services;

use bubbstore\Iugu\Contracts\PaymentMethodInterface;

class PaymentMethod extends BaseRequest implements PaymentMethodInterface
{

    /**
     * PaymentMethod constructor.
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
     * Cria um novo método de pagamento.
     *
     * @param int $customerId
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function create($customerId, array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', sprintf('customers/%s/payment_methods', $customerId));

        return $this->fetchResponse();
    }

    /**
     * update
     *
     * Atualizar um método de pagamento.
     *
     * @param $customerId
     * @param int $id
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function update($customerId, $id, array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', sprintf('customers/%s/payment_methods/%s', $customerId, $id));

        return $this->fetchResponse();
    }

    /**
     * find
     *
     * Procura um método de pagamento
     *
     * @param string $customerId
     * @param string $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function find($customerId, $id)
    {
        $this->sendApiRequest('GET', sprintf('customers/%s/payment_methods/%s', $customerId, $id));

        return $this->fetchResponse();
    }

    /**
     * delete
     *
     * Exclui um método de pagamento
     *
     * @param string $customerId
     * @param string $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function delete($customerId, $id)
    {
        $this->sendApiRequest('DELETE', sprintf('customers/%s/payment_methods/%s', $customerId, $id));

        return $this->fetchResponse();
    }
}
