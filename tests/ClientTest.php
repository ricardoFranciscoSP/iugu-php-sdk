<?php

namespace bubbstore\Iugu;

use bubbstore\Iugu\Contracts\CustomerInterface;
use Mockery;

class ClientTest extends TestCase
{
    /**
     * @var \bubbstore\Iugu\Iugu
     */
    protected $iugu;

    public function setUp(): void
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