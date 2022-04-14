<?php

namespace bubbstore\Iugu\Services;

use bubbstore\Iugu\Contracts\InvoiceInterface;

class Invoice extends BaseRequest implements InvoiceInterface
{

    /**
     * Invoice constructor.
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
     * Cria uma nova fatura.
     *
     * @param array $params
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'invoices');

        return $this->fetchResponse();
    }

    /**
     * capture
     *
     * Captura uma fatura.
     *
     * @param  int $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function capture($id)
    {
        $this->sendApiRequest('POST', sprintf('invoices/%s/capture', $id));

        return $this->fetchResponse();
    }

    /**
     * find
     *
     * Procura uma fatura
     *
     * @param  int $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function find($id)
    {
        $this->sendApiRequest('GET', sprintf('invoices/%s', $id));

        return $this->fetchResponse();
    }

    /**
     * refund
     *
     * Exclui uma fatura
     *
     * @param  int $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function refund($id)
    {
        $this->sendApiRequest('POST', sprintf('invoices/%s/refund', $id));

        return $this->fetchResponse();
    }

    /**
     * cancel
     *
     * Cancela uma fatura
     *
     * @param  int $id
     * @return array
     * @throws \bubbstore\Iugu\Exceptions\IuguException
     * @throws \bubbstore\Iugu\Exceptions\IuguValidationException
     */
    public function cancel($id)
    {
        $this->sendApiRequest('PUT', sprintf('invoices/%s/cancel', $id));

        return $this->fetchResponse();
    }
}
