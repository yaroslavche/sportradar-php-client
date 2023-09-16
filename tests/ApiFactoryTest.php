<?php

declare(strict_types=1);

namespace SR\Tests;

use SR\ApiFactory;
use PHPUnit\Framework\TestCase;
use SR\Formula1V2ApiClient;

class ApiFactoryTest extends TestCase
{
    public function testCreateFormula1Client(): void
    {
        $apiFactory = new ApiFactory('');
        $formula1Client = $apiFactory->createFormula1Client();
        self::assertInstanceOf(Formula1V2ApiClient::class, $formula1Client);
    }
}
