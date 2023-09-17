<?php

declare(strict_types=1);

namespace SR;

class ApiClientConfig implements ApiClientConfigInterface
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $baseUrl = 'https://api.sportradar.com',
        private readonly string $accessLevel = 'trial',
        private readonly string $languageCode = 'en',
        private readonly string $version = 'v1',
        private readonly string $format = 'json',
    ) {
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getAccessLevel(): string
    {
        return $this->accessLevel;
    }

    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function getFormat(): string
    {
        return $this->format;
    }
}
