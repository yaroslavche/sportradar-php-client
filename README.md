> Sportradar’s APIs are B2B (Business-to-Business) and are not intended to be called directly from a client application. The expectation is that you pull from our APIs, store the data, and then serve it directly to your customers.
[Link](https://developer.sportradar.com/docs/read/Home#faqs)

```php
use SR\ApiClientFactory;
use SR\Exception\ApiClientExceptionInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\HttpClient\ResponseInterface;

$apiFactory = new ApiClientFactory(apiKey: 'your-api-key', cache: new FilesystemAdapter());
try {
    $client = $apiFactory->createFormula1Client();
    /** @var ResponseInterface $response */
    $response = $client->competitorMergeMappings();
    $response = $client->competitorProfile('sr:competitor:178318');
    $response = $client->deletedStages('sr:stage:1031201');
    $response = $client->seasons();
    $response = $client->stageProbabilities('sr:stage:1031201');
    $response = $client->stageSchedule('sr:stage:1031201');
    $response = $client->stageSummary('sr:stage:1031201');
} catch (ApiClientExceptionInterface $exception) {
}
```