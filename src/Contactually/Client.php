<?php
namespace Contactually;
use Guzzle\Http;
use Contactually\Exceptions\InvalidResourceException;
class Client
{
    const USER_AGENT = 'contactually-php/0.9.0';
    protected $baseURI  = 'https:
    protected $apikey   = '';
    protected $client   = null;
    protected $request  = null;
    public $response = null;
    public $statusCode = null;
    public $detail   = null;
    public function __construct($apikey, $httpClient = null)
    {
        $this->apikey = $apikey;
        $this->client = (is_null($httpClient)) ? new Http\Client($this->baseURI) : $httpClient;
        $this->client->setUserAgent($this::USER_AGENT . '/' . PHP_VERSION);
    }
    public function get($url, $params = array())
    {
        $params['api_key'] = $this->apikey;
        $request = $this->client->get($url, array(), array('exceptions' => false));
        foreach($params as $key => $value) {
            $request->getQuery()->set($key, $value);
        }
        $this->response = $request->send();
        $this->statusCode = $this->response->getStatusCode();
        return $this->response->json();
    }
    public function put($url, $params = array())
    {
    }
    public function post($url, $params = array())
    {
    }
    public function delete($url)
    {
    }
    public function __get($name)
    {
        $classname = ucwords(str_replace("_", " ", $name));
        $fullclass = "Contactually\\" . str_replace(' ', '', $classname);
        if (class_exists($fullclass)) {
            return new $fullclass($this);
        } else {
            throw new \Contactually\Exceptions\InvalidResourceException('Not supported');
        }
    }
}
