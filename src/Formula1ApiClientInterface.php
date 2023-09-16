<?php

declare(strict_types=1);

namespace SR;

use Symfony\Contracts\HttpClient\ResponseInterface;

interface Formula1ApiClientInterface extends ApiClientInterface
{
    public function competitorMergeMappings(): ResponseInterface;

    public function competitorProfile(string $competitorId): ResponseInterface;

    public function deletedStages(string $stageId): ResponseInterface;

    public function seasons(): ResponseInterface;

    public function stageProbabilities(string $stageId): ResponseInterface;

    public function stageSchedule(string $stageId): ResponseInterface;

    public function stageSummary(string $stageId): ResponseInterface;
}
