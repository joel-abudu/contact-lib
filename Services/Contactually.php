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
    public function __construct($params)
    {
        $fields = '';
        foreach($params as $param => $value) {
            $fields .= "&user[$param]=".urlencode($value);
        }
        $connection = curl_init();
        curl_setopt($connection,CURLOPT_URL, $this->auth_url);
        curl_setopt($connection,CURLOPT_POST, count($params));
curl_setopt($connection,CURLOPT_HEADER, true);
curl_setopt($connection, CURLOPT_VERBOSE, true);
        curl_setopt($connection,CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($connection);
print_r($result);
    }
}
