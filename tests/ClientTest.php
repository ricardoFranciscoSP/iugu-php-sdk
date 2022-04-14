<?php

namespace store\Iugu;

use Mockery;
use GuzzleHttp\ClientInterface;
use store\Iugu\Services\Customer;
use store\Iugu\Contracts\CustomerInterface;

class ClientTest extends TestCase
{
    /**
     * @var \store\Iugu\Iugu
     */
    protected $iugu;

    public function setUp()
    {
        parent::setUp();

        $this->iugu = new Iugu(
            'TOKEN',
            Mockery::mock(CustomerInterface::class)
        );
    }

    public function testCustomerService()
    {
        $this->assertInstanceOf(CustomerInterface::class, $this->iugu->customer());
    }
}