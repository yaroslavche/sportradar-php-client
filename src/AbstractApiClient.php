<?php

declare(strict_types=1);

namespace SR;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractApiClient implements ApiClientInterface
{
    final public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly ApiClientConfigInterface $apiClientConfig,
    ) {
    }

    protected function request(string $request): ResponseInterface
    {
        $url = sprintf(
            '%s/%s/%s/%s/%s/%s.%s?api_key=%s',
            $this->apiClientConfig->getBaseUrl(),
            static::SERVICE,
            $this->apiClientConfig->getAccessLevel(),
            $this->apiClientConfig->getVersion(),
            $this->apiClientConfig->getLanguageCode(),
            $request,
            $this->apiClientConfig->getFormat(),
            $this->apiClientConfig->getApiKey(),
        );
        return $this->httpClient->request('GET', $url);
    }
}
