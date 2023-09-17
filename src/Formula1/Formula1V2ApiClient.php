<?php

declare(strict_types=1);

namespace SR\Formula1;

use SR\AbstractApiClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class Formula1V2ApiClient extends AbstractApiClient implements Formula1ApiClientInterface
{
    public const SERVICE = 'formula1';

    public function competitorMergeMappings(): ResponseInterface
    {
        return $this->request('competitors/merge_mappings');
    }

    public function competitorProfile(string $competitorId): ResponseInterface
    {
        return $this->request(sprintf('competitors/%s/profile', $competitorId));
    }

    public function deletedStages(string $stageId): ResponseInterface
    {
        return $this->request(sprintf('seasons/%s/deleted_stages', $stageId));
    }

    public function seasons(): ResponseInterface
    {
        return $this->request('seasons');
    }

    public function stageProbabilities(string $stageId): ResponseInterface
    {
        return $this->request(sprintf('sport_events/%s/probabilities', $stageId));
    }

    public function stageSchedule(string $stageId): ResponseInterface
    {
        return $this->request(sprintf('sport_events/%s/schedule', $stageId));
    }

    public function stageSummary(string $stageId): ResponseInterface
    {
        return $this->request(sprintf('sport_events/%s/summary', $stageId));
    }
}
