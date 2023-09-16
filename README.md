```php
use SR\ApiFactory;

$apiFactory = new ApiFactory(apiKey: 'your-api-key');
$client = $apiFactory->createFormula1Client();
/** @var \Symfony\Contracts\HttpClient\ResponseInterface $response */
$response = $client->competitorMergeMappings();
$response = $client->competitorProfile('sr:competitor:178318');
$response = $client->deletedStages('sr:stage:1031201');
$response = $client->seasons();
$response = $client->stageProbabilities('sr:stage:1031201');
$response = $client->stageSchedule('sr:stage:1031201');
$response = $client->stageSummary('sr:stage:1031201');
```