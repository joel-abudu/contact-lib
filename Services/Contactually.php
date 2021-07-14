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
    protected $auth_url   = 'https:
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
        $fields = '';
        foreach($params as $param => $value) {
            $fields .= "&user[$param]=".urlencode($value);
        }
        $connection = curl_init();
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($connection,CURLOPT_URL, $this->auth_url);
        curl_setopt($connection,CURLOPT_POST, count($params));
curl_setopt($connection, CURLOPT_COOKIEJAR, $this->cookie_path);
curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($connection,CURLOPT_POSTFIELDS, $fields);
        $response = curl_exec($connection);
        curl_close($connection);
    }
    public function getContacts($limit = 10)
    {
        $contacts_url = 'https:
        $contacts_url .= '?limit=' . (int) $limit;
        $connection = curl_init();
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($connection,CURLOPT_URL, $contacts_url);
        curl_setopt($connection, CURLOPT_COOKIEFILE, $this->cookie_path); 
curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($connection);
$status = curl_getinfo($connection, CURLINFO_HTTP_CODE);
echo "x- $status -x \n";
        return json_decode($response);
    }
    public function getAccounts()
    {
        $accounts_url = 'https:
        $connection = curl_init();
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($connection,CURLOPT_URL, $accounts_url);
        curl_setopt($connection, CURLOPT_COOKIEFILE, $this->cookie_path); 
curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($connection);
$status = curl_getinfo($connection, CURLINFO_HTTP_CODE);
echo "x- $status -x \n";
        return json_decode($response);
    }
}
