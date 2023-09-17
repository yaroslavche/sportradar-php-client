<?php

declare(strict_types=1);

namespace SR\Tests;

use PHPUnit\Framework\TestCase;
use SR\ApiClientFactory;
use SR\Formula1\Formula1V2ApiClient;

class ApiClientFactoryTest extends TestCase
{
    public function testCreateFormula1Client(): void
    {
        $apiFactory = new ApiClientFactory('');
        $formula1Client = $apiFactory->createFormula1Client();
        self::assertInstanceOf(Formula1V2ApiClient::class, $formula1Client);
    }
}
