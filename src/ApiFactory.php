<?php

declare(strict_types=1);

namespace SR;

use Exception;
use Symfony\Component\HttpClient\HttpClient;

final class ApiFactory
{
    public function __construct(
        private readonly string $apiKey,
    ) {
    }

    public function createFormula1Client(string $version = 'v2', ?string $apiKey = null): Formula1ApiClientInterface
    {
        /** @var Formula1ApiClientInterface $apiClient */
        $apiClient = match ($version) {
            'v1' => throw new Exception('TODO exception'),
            'v2' => $this->create(Formula1V2ApiClient::class, $version, $apiKey),
            default => throw new Exception('TODO exception'),
        };
        return $apiClient;
    }

    private function create(string $apiClientFQCN, string $version, ?string $apiKey = null): ApiClientInterface
    {
        if (!class_exists($apiClientFQCN)) {
            throw new Exception('TODO exception');
        }
        /** @var ApiClientInterface $apiClient */
        $apiClient = new $apiClientFQCN(
            httpClient: HttpClient::create(),
            apiKey: $apiKey ?? $this->apiKey,
            version: $version,
        );
        return $apiClient;
    }
}
