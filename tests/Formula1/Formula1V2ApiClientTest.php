<?php

declare(strict_types=1);

namespace SR\Tests\Formula1;

use SR\ApiClientConfig;
use SR\ApiClientFactory;
use SR\Formula1\Formula1V2ApiClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpClient\MockHttpClient;

use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertSame;

class Formula1V2ApiClientTest extends TestCase
{
    private Formula1V2ApiClient $apiClient;

    protected function setUp(): void
    {
        parent::setUp();
        $this->apiClient = new Formula1V2ApiClient(
            new MockHttpClient(),
            new ApiClientConfig(apiKey: 'api-key', version: 'v2'),
            new FilesystemAdapter(namespace: Formula1V2ApiClient::SERVICE),
        );
    }

    public function testFactory()
    {
        $apiClientFactory = new ApiClientFactory(
            apiKey: 'api-key',
            cache: new FilesystemAdapter(namespace: Formula1V2ApiClient::SERVICE),
        );
        $apiClient = $apiClientFactory->createFormula1Client();
        assertInstanceOf(Formula1V2ApiClient::class, $apiClient);
        assertSame('api-key', $this->apiClient->getConfig()->getApiKey());
        assertSame('v2', $this->apiClient->getConfig()->getVersion());
    }

    public function testCompetitorMergeMappings()
    {
        $response = $this->apiClient->competitorMergeMappings();
        assertSame(200, $response->getStatusCode());
    }

    public function testCompetitorProfile()
    {
        $response = $this->apiClient->competitorProfile('sr:competitor:178318');
        assertSame(200, $response->getStatusCode());
    }

    public function testDeletedStages()
    {
        $response = $this->apiClient->deletedStages('sr:stage:1031201');
        assertSame(200, $response->getStatusCode());
    }

    public function testSeasons()
    {
        $response = $this->apiClient->seasons();
        assertSame(200, $response->getStatusCode());
    }

    public function testStageProbabilities()
    {
        $response = $this->apiClient->stageProbabilities('sr:stage:1031201');
        assertSame(200, $response->getStatusCode());
    }

    public function testStageSchedule()
    {
        $response = $this->apiClient->stageSchedule('sr:stage:1031201');
        assertSame(200, $response->getStatusCode());
    }

    public function testStageSummary()
    {
        $response = $this->apiClient->stageSummary('sr:stage:1031201');
        assertSame(200, $response->getStatusCode());
    }
}
