<?php

namespace bubbstore\Iugu;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Mockery;
use PHPUnit\Framework\TestCase as BaseTest;

abstract class TestCase extends BaseTest
{
    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * Mocks Guzzle HTTP client.
     *
     * @param string|null $responseBodyFile
     * @param int $httpCode
     *
     * @return \GuzzleHttp\Client
     */
    protected function mockHttpClient($responseBodyFile = null, $httpCode = 200)
    {
        $mock = new MockHandler;

        if ($responseBodyFile) {
            $mock->append(new Response($httpCode, [], file_get_contents(realpath($responseBodyFile))));
        }

        return new Client([
            'handler' => HandlerStack::create($mock),
        ]);
    }
}