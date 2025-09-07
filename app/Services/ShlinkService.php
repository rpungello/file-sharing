<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use Illuminate\Container\Attributes\Singleton;
use Shlinkio\Shlink\SDK\Config\ShlinkConfig;
use Shlinkio\Shlink\SDK\Http\HttpClient;
use Shlinkio\Shlink\SDK\ShortUrls\Model\ShortUrlCreation;
use Shlinkio\Shlink\SDK\ShortUrls\ShortUrlsClient;
use Shlinkio\Shlink\SDK\ShortUrls\ShortUrlsClientInterface;

#[Singleton]
class ShlinkService
{
    protected ShortUrlsClientInterface $client;

    public function __construct()
    {
        $httpFactory = new HttpFactory();
        $httpClient = new HttpClient(
            new Client(),
            $httpFactory,
            $httpFactory,
            ShlinkConfig::fromArray([
                'baseUrl' => config('services.shlink.base_url'),
                'apiKey' => config('services.shlink.api_key'),
                'version' => config('services.shlink.version'),
            ])
        );

        $this->client = new ShortUrlsClient($httpClient);
    }

    public function createShortUrl(string $url): string
    {
        return $this->client->createShortUrl(
            ShortUrlCreation::forLongUrl($url)
        )->shortUrl;
    }
}
