<?php

namespace store\Iugu;

use store\Iugu\Contracts\CustomerInterface;
use store\Iugu\Contracts\PaymentMethodInterface;
use store\Iugu\Contracts\ChargeInterface;
use store\Iugu\Contracts\InvoiceInterface;
use store\Iugu\Services\Customer;
use store\Iugu\Services\PaymentMethod;
use store\Iugu\Services\Charge;
use store\Iugu\Services\Invoice;
use store\Iugu\Exceptions\IuguException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HttpClient;

class Iugu
{

    /**
     * Serviço de Cliente
     *
     * @var \store\Iugu\Contracts\CustomerInterface
     */
    protected $customer;

    /**
     * Serviço de Método de Pagamento
     *
     * @var \store\Iugu\Contracts\PaymentMethodInterface
     */
    protected $paymentMethod;

    /**
     * Serviço de Cobrança
     *
     * @var \store\Iugu\Contracts\ChargeInterface
     */
    protected $charge;

    /**
     * Serviço de Fatura
     *
     * @var \store\Iugu\Contracts\InvoiceInterface
     */
    protected $invoice;

    /**
     * apiKey público
     *
     * @var string
     */
    private $apiKey;

    public function __construct(
        $apiKey,
        CustomerInterface $customer = null,
        PaymentMethodInterface $paymentMethod = null,
        ChargeInterface $charge = null,
        InvoiceInterface $invoice = null,
        ClientInterface $http = null
    ) {
        if (!is_string($apiKey)) {
            throw new IuguException('A API Key precisa ser uma string');
        }
        
        $this->apiKey = $apiKey;
        $this->http = $http ?: new HttpClient([
            'base_uri' => 'https://api.iugu.com/v1/',
            'headers' => [
                'Authorization' => sprintf('Basic %s', base64_encode($apiKey.':'.'')),
            ],
        ]);

        $this->customer = $customer ?: new Customer($this->http, $this);
        $this->paymentMethod = $paymentMethod ?: new PaymentMethod($this->http, $this);
        $this->charge = $charge ?: new Charge($this->http, $this);
        $this->invoice = $invoice ?: new Invoice($this->http, $this);
    }

    /**
     * customer
     *
     * Serviço de Cliente
     *
     * @return \store\Iugu\Services\Customer
     */
    public function customer()
    {
        return $this->customer;
    }

    /**
     * paymentMethod
     *
     * Serviço de Método de Pagamento
     *
     * @return \store\Iugu\Services\PaymentMethod
     */
    public function paymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * charge
     *
     * Serviço de Cliente
     *
     * @return \store\Iugu\Services\Charge
     */
    public function charge()
    {
        return $this->charge;
    }

    /**
     * invoice
     *
     * Serviço de Fatura
     *
     * @return \store\Iugu\Services\Invoice
     */
    public function invoice()
    {
        return $this->invoice;
    }
}
