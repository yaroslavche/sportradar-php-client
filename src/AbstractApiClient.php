<?php

declare(strict_types=1);

namespace SR;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractApiClient implements ApiClientInterface
{
    final public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly string $apiKey,
        private readonly string $baseUrl = 'https://api.sportradar.com',
        private readonly string $accessLevel = 'trial',
        private readonly string $languageCode = 'en',
        private readonly string $version = 'v1',
        private readonly string $format = 'json',
    ) {
    }

    protected function request(string $request): ResponseInterface
    {
        $url = sprintf(
            '%s/%s/%s/%s/%s/%s.%s?api_key=%s',
            $this->baseUrl,
            static::SERVICE,
            $this->accessLevel,
            $this->version,
            $this->languageCode,
            $request,
            $this->format,
            $this->apiKey,
        );
        return $this->httpClient->request('GET', $url);
    }
}
