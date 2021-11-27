<?php
function Services_Contactually_autoload($className) {
    $library_name = 'Services_Contactually';
    if (substr($className, 0, strlen($library_name)) != $library_name) {
        return false;
    }
    $file = str_replace('_', '/', $className);
    $file = str_replace('Services/', '', $file);
    return include dirname(__FILE__) . "/$file.php";
}
spl_autoload_register('Services_Contactually_autoload');
class Services_Contactually extends Services_Contactually_Resources_Base
{
    const USER_AGENT = 'contactually-php/0.8.0';
    protected $_baseUri = 'https:
    protected $_successCodes = array(200 => 'OK', 201 => 'Created', 202 => 'Accepted');
    protected $_api_key = null;
    public $response_obj  = null;
    public $response_code = null;
    public $response_json = null;
    protected $resources = array(
                    'accounts' => 'Accounts',
                    'buckets' => 'Buckets',
                    'contact_histories' => 'ContactHistories',
                    'contacts' => 'Contacts',
                    'followups' => 'Followups',
                    'notes' => 'Notes',
                    'tasks' => 'Tasks',
                    'users' => 'Users'
                );
    public function __construct($params)
    {
        $this->cookie_path = getcwd() . '/cookie.txt';
        if (isset($params['api_key'])) {
            $this->_api_key = $params['api_key'];
        } elseif (isset($params['email']) && isset($params['password'])) {
            trigger_error("The usernmae/password authentication method has been deprecated.", E_USER_NOTICE);
            $params["user['email']"] = $params['email'];
            $params["user['password']"] = $params['password'];
            return $this->_authenticate($params);
        } else {
            throw new Services_Contactually_Exceptions_Authentication(
                    "To authenticate, you must include either an API Key or an email and password");
        }
        return false;
    }
    public function __get($name)
    {
        $object = null;
        if (isset($this->resources[$name])) {
            $classname = 'Services_Contactually_'.$this->resources[$name];
            $object = new $classname($this);
        }
        return $object;
    }
    protected function _authenticate($params)
    {
        $auth_url = $this->_baseUri . 'users/sign_in.json';
        $this->post($auth_url, $params);
        if (!isset($this->_successCodes[$this->response_code])) {
            return false;
        }
        return true;
    }
    public function get($uri, $params = array())
    {
        if (!is_null($this->_api_key)) {
            $params['api_key'] = $this->_api_key;
        }
        $uri .= (count($params)) ? '?'.http_build_query($params) : '';
        $curl_opts = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $uri,
            CURLOPT_COOKIEFILE => $this->cookie_path,
        );
        return $this->_execute($curl_opts);
    }
    public function delete($uri, $params = array())
    {
        if (!is_null($this->_api_key)) {
            $params['api_key'] = $this->_api_key;
        }
        $curl_opts = array(
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $uri,
            CURLOPT_POST => count($params),
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_COOKIEJAR => $this->cookie_path,
            CURLOPT_COOKIEFILE => $this->cookie_path, 
        );
        return $this->_execute($curl_opts);
    }
    public function post($uri, $params = array())
    {
        if (!is_null($this->_api_key)) {
            $params['api_key'] = $this->_api_key;
        }
        $curl_opts = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => true,
            CURLOPT_URL => $uri,
            CURLOPT_POST => count($params),
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_COOKIEJAR => $this->cookie_path,
            CURLOPT_COOKIEFILE => $this->cookie_path, 
        );
        return $this->_execute($curl_opts);
    }
    protected function _execute($curl_params = array())
    {
        $connection = curl_init();
        $curl_params[CURLOPT_USERAGENT] = self::USER_AGENT;
        foreach($curl_params as $option => $value) {
            curl_setopt($connection, $option, $value);
        }
curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($connection);
        $this->response_code = curl_getinfo($connection, CURLINFO_HTTP_CODE);
        switch($this->response_code)
        {
            case '201':
                $headers = explode("\r\n\r\n", $response);
                preg_match("/Location:\s\S+/", $headers[1], $matches);
                $location = substr($matches[0], strpos($matches[0], 'http'));
                $response = '{"location": "' . $location . '", "status": "201"}';
                break;
            case '406':
                $headers = explode("\r\n\r\n", $response);
                $tmp_object = json_decode($headers[2]);
                $response = '{"error": "' . $tmp_object->error . '", "status": "406"}';
            default:
        }
        $this->response_json = $response;
        $this->response_obj  = json_decode($this->response_json);
        curl_close($connection);
    }
    public function getUri()
    {
        return $this->_baseUri;
    }
}
