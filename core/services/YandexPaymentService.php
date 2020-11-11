<?php
namespace app\core\services;

use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;

class YandexPaymentService implements PaymentServiceInterface
{
    private string $url;
    private Client $httpClient;

    /**
     * YandexPaymentService constructor.
     * @param string $url
     */
    public function __construct(
        string $url
    ) {

        $this->url = $url;
        $this->httpClient = new Client();
    }

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function pay(): bool
    {
        $response = $this->httpClient->createRequest()
            ->setUrl($this->url)
            ->send();

        return $response->isOk;
    }
}