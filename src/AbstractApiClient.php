<?php

declare(strict_types=1);

namespace SR;

use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractApiClient implements ApiClientInterface
{
    final public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly ApiClientConfigInterface $apiClientConfig,
        private readonly ?CacheInterface $cache = null,
    ) {
    }

    protected function request(string $request, ?int $time = null): ResponseInterface
    {
        return $this->cache?->get(
            md5($request),
            function (ItemInterface $item) use ($request, $time): ResponseInterface {
                is_int($time) && $item->expiresAfter($time);
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
        );
    }
}
