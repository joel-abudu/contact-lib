<?php
namespace Contactually;
use Guzzle\Http;
class Client
{
    const USER_AGENT = 'contactually-php/0.9.0';
    protected $baseURI  = 'https:
    protected $apiKey   = '';
    protected $client   = null;
    protected $request  = null;
    public $response = null;
    public $statusCode = null;
    public $detail   = null;
    public function __construct($key, $httpClient = null)
    {
        $this->apiKey = $key;
        $this->client = (is_null($httpClient)) ? new Http\Client($this->baseURI) : $httpClient;
        $this->client->setUserAgent($this::USER_AGENT . '/' . PHP_VERSION);
    }
    public function get() { }
    public function put() { }
    public function post() { }
    public function delete() { }
}
