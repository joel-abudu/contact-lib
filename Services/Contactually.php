<?php
function Services_Contactually_autoload($className) {
    if (substr($className, 0, 15) != 'Services_Contactually') {
        return false;
    }
    $file = str_replace('_', '/', $className);
    $file = str_replace('Services/', '', $file);
    return include dirname(__FILE__) . "/$file.php";
}
spl_autoload_register('Services_Contactually_autoload');
class Services_Contactually
{
    protected $connection = null;
    protected $cookie_path = '';
    protected $sub_resources = array();
    public function __construct($params)
    {
        $this->cookie_path = getcwd() . '/cookie.txt';
        $this->sub_resources = array(
            'accounts',
            'buckets',
            'contact_histories',
            'contacts',
            'followups',
            'notes',
            'tasks',
            'users'
        );
        foreach($params as $param => $value) {
            unset($params[$param]);
            $params["user[$param]"] = $value;
        }
        $auth_url = 'https:
        $this->execute($auth_url, $params);
    }
    public function execute($uri, $params = array())
    {
        $fields = '';
        foreach($params as $param => $value) {
            $fields .= "&user[$param]=".urlencode($value);
        }
        $connection = curl_init();
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($connection,CURLOPT_URL, $uri);
        curl_setopt($connection,CURLOPT_POST, count($params));
        curl_setopt($connection, CURLOPT_COOKIEJAR, $this->cookie_path);
        curl_setopt($connection, CURLOPT_COOKIEFILE, $this->cookie_path); 
curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($connection);
        $status = curl_getinfo($connection, CURLINFO_HTTP_CODE);
        curl_close($connection);
        return json_decode($response);        
    }
    public function getContacts($limit = 10)
    {
        $contacts_uri = 'https:
        $contacts_uri .= '?limit=' . (int) $limit;
        return $this->execute($contacts_uri);
    }
    public function getAccounts()
    {
        $accounts_url = 'https:
        return $this->execute($accounts_url);
    }
}
