<?php

declare(strict_types=1);

namespace SR;

use SR\Exception\NotFoundException;
use SR\Exception\NotImplementedException;
use SR\Formula1\Formula1ApiClientInterface;
use SR\Formula1\Formula1V2ApiClient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\Cache\CacheInterface;

final class ApiClientFactory
{
    public function __construct(
        private readonly string $apiKey,
        private readonly ?CacheInterface $cache = null,
    ) {
    }

    /**
     * @throws NotImplementedException
     * @throws NotFoundException
     */
    public function createFormula1Client(string $version = 'v2'): Formula1ApiClientInterface
    {
        /** @var Formula1ApiClientInterface $apiClient */
        $apiClient = match ($version) {
            'v2' => $this->create(
                apiClientFQCN: Formula1V2ApiClient::class,
                apiClientConfig: new ApiClientConfig(apiKey: $this->apiKey, version: $version),
            ),
            default => throw new NotImplementedException(sprintf(
                '%s: %s',
                Formula1ApiClientInterface::class,
                $version,
            )),
        };
        return $apiClient;
    }

    /** @throws NotFoundException */
    private function create(
        string $apiClientFQCN,
        ?ApiClientConfigInterface $apiClientConfig = null,
    ): ApiClientInterface {
        if (!class_exists($apiClientFQCN)) {
            throw new NotFoundException($apiClientFQCN);
        }
        /** @var ApiClientInterface $apiClient */
        $apiClient = new $apiClientFQCN(
            httpClient: HttpClient::create(),
            apiClientConfig: $apiClientConfig ?? new ApiClientConfig(apiKey: $this->apiKey),
            cache: $this->cache,
        );
        return $apiClient;
    }
}
