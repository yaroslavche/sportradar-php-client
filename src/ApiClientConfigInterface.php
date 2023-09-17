<?php

declare(strict_types=1);

namespace SR;

interface ApiClientConfigInterface
{
    public function getApiKey(): string;

    public function getBaseUrl(): string;

    public function getAccessLevel(): string;

    public function getLanguageCode(): string;

    public function getVersion(): string;

    public function getFormat(): string;
}
