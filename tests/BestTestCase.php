<?php


namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

class BestTestCase extends  ApiTestCase
{
    protected function createTestClient(array $headerOptions = []): Client
    {
        return self::createClient([], [
            'headers' => array_merge(
                [
                    'accept' => 'application/json',
                ],
                $headerOptions
            ),
        ]);
    }
}