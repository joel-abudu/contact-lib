<?php
function Services_Contactually_autoload($className) {
    if (substr($className, 0, 21) != 'Services_Contactually') {
        return false;
    }
    $file = str_replace('_', '/', $className);
    $file = str_replace('Services/', '', $file);
    return include dirname(__FILE__) . "/$file.php";
}
spl_autoload_register('Services_Contactually_autoload');
class Services_Contactually
{
    protected $cookie_path = '';
    protected $sub_resources = array(
                    'accounts' => 'Account',
                    'buckets' => 'Bucket',
                    'contact_histories' => 'ContactHistory',
                    'contacts' => 'Contact',
                    'followups' => 'Followup',
                    'notes' => 'Note',
                    'tasks' => 'Task',
                    'users' => 'User'
                );
    public function __construct($params)
    {
        $this->cookie_path = getcwd() . '/cookie.txt';
        foreach($params as $param => $value) {
            unset($params[$param]);
            $params["user[$param]"] = $value;
        }
        $auth_url = 'https:
        $this->post($auth_url, $params);
    }
    public function __get($name)
    {
        $this->$name = null;
        if (isset($this->sub_resources[$name])) {
            $class = $this->sub_resources[$name];
            $classname = 'Services_Contactually_'.$class;
            $this->$name = new $classname($this);
        }
        return $this->$name;
    }
    public function post($uri, $params = array())
    {
        $curl_opts = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $uri,
            CURLOPT_POST => count($params),
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_COOKIEJAR => $this->cookie_path,
            CURLOPT_COOKIEFILE => $this->cookie_path, 
        );
        return $this->_execute($curl_opts);
    }
    public function get($uri, $params = array())
    {
        $uri .= (count($params)) ? '?'.http_build_query($params) : '';
        $curl_opts = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $uri,
            CURLOPT_COOKIEFILE => $this->cookie_path,
        );
        return $this->_execute($curl_opts);
    }
    protected function _execute($curl_params = array())
    {
        $connection = curl_init();
        foreach($curl_params as $option => $value) {
            curl_setopt($connection, $option, $value);
        }
curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($connection);
        $this->status = curl_getinfo($connection, CURLINFO_HTTP_CODE);
        curl_close($connection);
        return json_decode($response);
    }
}
