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

    public function createFormula1Client(string $version = 'v2'): Formula1ApiClientInterface
    {
        /** @var Formula1ApiClientInterface $apiClient */
        $apiClient = match ($version) {
            'v1' => throw new Exception('TODO exception'),
            'v2' => $this->create(
                apiClientFQCN: Formula1V2ApiClient::class,
                apiClientConfig: new ApiClientConfig(apiKey: $this->apiKey, version: 'v2'),
            ),
            default => throw new Exception('TODO exception'),
        };
        return $apiClient;
    }

    private function create(
        string $apiClientFQCN,
        ?ApiClientConfigInterface $apiClientConfig = null,
    ): ApiClientInterface {
        if (!class_exists($apiClientFQCN)) {
            throw new Exception('TODO exception');
        }
        /** @var ApiClientInterface $apiClient */
        $apiClient = new $apiClientFQCN(
            httpClient: HttpClient::create(),
            apiClientConfig: $apiClientConfig ?? new ApiClientConfig(apiKey: $this->apiKey),
        );
        return $apiClient;
    }
}
