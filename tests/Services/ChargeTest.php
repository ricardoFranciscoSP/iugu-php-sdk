<?php

namespace store\Iugu\Services;

use store\Iugu\TestCase;
use store\Iugu\Iugu;
use store\Iugu\Exceptions\IuguException;
use store\Iugu\Exceptions\IuguValidationException;

class ChargeTest extends TestCase
{

    /**
     * @var \store\RDStation\Iugu
     */
    protected $iugu;

    public function setUp()
    {
        parent::setUp();

        $this->iugu = new Iugu(
            'TOKEN'
        );
    }

    public function test_charge_boleto()
    {
        $body = __DIR__.'/../ResponseSamples/Charges/ChargeCreated.json';
        $http = $this->mockHttpClient($body);

        $charge = new Charge($http, $this->iugu);
        $charge = $charge->create([
            'method' => 'bank_slip',
            'email' => 'ri22sp@gmail.comr',
            'order_id' => uniqid(),
            'payer' => [
                'cpf_cnpj' => '65634052076',
                'name' => 'Ricardo Francisco',
                'phone_prefix' => '11',
                'phone' => '11111111',
                'email' => 'ri22sp@gmail.comr',
                'address' => [
                    'street' => 'Foo Bar',
                    'number' => '123',
                    'district' => 'Foo',
                    'city' => 'Foo',
                    'state' => 'SP',
                    'zip_code' => '14940000',
                ],
            ],
            'items' => [
                [
                    'description' => 'Item 1',
                    'quantity' => 1,
                    'price_cents' => 1000
                ],
                [
                    'description' => 'Item 2',
                    'quantity' => 2,
                    'price_cents' => 2000
                ],
            ],
        ]);

        $this->assertTrue($charge['success']);

    }

}