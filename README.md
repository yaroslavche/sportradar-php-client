> Sportradar’s APIs are B2B (Business-to-Business) and are not intended to be called directly from a client application. The expectation is that you pull from our APIs, store the data, and then serve it directly to your customers.
[Link](https://developer.sportradar.com/docs/read/Home#faqs)

### Dependencies
    php >=8.1
    symfony/http-client ^6.3
    symfony/cache ^6.3

### API Client
 [ ] Formula 1 V1
 [X] Formula 1 V2

### Example

```php
use SR\ApiClientFactory;
use SR\Exception\ApiClientExceptionInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\HttpClient\ResponseInterface;

$apiClientFactory = new ApiClientFactory(apiKey: 'your-api-key', cache: new FilesystemAdapter());
try {
    $formula1V2Client = $apiClientFactory->createFormula1Client();
    /** @var ResponseInterface $response */
    $response = $formula1V2Client->competitorMergeMappings();
    $response = $formula1V2Client->competitorProfile(competitorId: 'sr:competitor:178318');
    $response = $formula1V2Client->deletedStages(stageId: 'sr:stage:1031201');
    $response = $formula1V2Client->seasons();
    $response = $formula1V2Client->stageProbabilities(stageId: 'sr:stage:1031201');
    $response = $formula1V2Client->stageSchedule(stageId: 'sr:stage:1031201');
    $response = $formula1V2Client->stageSummary(stageId: 'sr:stage:1031201');
} catch (ApiClientExceptionInterface $exception) {
}
```