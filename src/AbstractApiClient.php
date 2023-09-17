<?php

declare(strict_types=1);

namespace SR;

use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
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

    /**
     * @throws InvalidArgumentException
     * @throws TransportExceptionInterface
     */
    protected function request(string $request, ?int $time = null): ResponseInterface
    {
        if (null === $this->cache) {
            return $this->getResponse($request);
        }
        return $this->cache->get(
            md5($request),
            function (ItemInterface $item) use ($request, $time): ResponseInterface {
                if (is_int($time)) {
                    $item->expiresAfter($time);
                }
                return $this->getResponse($request);
            }
        );
    }

    /** @throws TransportExceptionInterface */
    private function getResponse(string $request): ResponseInterface
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
