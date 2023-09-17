<?php

declare(strict_types=1);

namespace SR\Formula1;

use SR\ApiClientInterface;
use SR\Exception\CacheException;
use SR\Exception\HttpClientException;
use Symfony\Contracts\HttpClient\ResponseInterface;

interface Formula1ApiClientInterface extends ApiClientInterface
{
    /**
     * @throws HttpClientException
     * @throws CacheException
     */
    public function competitorMergeMappings(): ResponseInterface;

    /**
     * @throws HttpClientException
     * @throws CacheException
     */
    public function competitorProfile(string $competitorId): ResponseInterface;

    /**
     * @throws HttpClientException
     * @throws CacheException
     */
    public function deletedStages(string $stageId): ResponseInterface;

    /**
     * @throws HttpClientException
     * @throws CacheException
     */
    public function seasons(): ResponseInterface;

    /**
     * @throws HttpClientException
     * @throws CacheException
     */
    public function stageProbabilities(string $stageId): ResponseInterface;

    /**
     * @throws HttpClientException
     * @throws CacheException
     */
    public function stageSchedule(string $stageId): ResponseInterface;

    /**
     * @throws HttpClientException
     * @throws CacheException
     */
    public function stageSummary(string $stageId): ResponseInterface;
}
