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
class Services_Contactually extends Services_Contactually_Resources_Base
{
    const USER_AGENT = 'contactually-php/0.0.1';
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
        if (isset($params['apikey'])) {
        } elseif (isset($params['email']) && isset($params['password'])) {
            foreach($params as $param => $value) {
                unset($params[$param]);
                $params["user[$param]"] = $value;
            }
        } else {
            throw new Services_Contactually_Exception_Authentication(
                    "To authenticate, you must include either an API Key or an email and password");
        }
        $this->_authenticate($params);
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
        $auth_url = 'https:
        $success = array(200 => 'OK', 201 => 'Created', 202 => 'Accepted');
        $this->post($auth_url, $params);
        if (!isset($success[$this->status])) {
            throw new Services_Contactually_Exception_Authentication(
                    "Authentication failed - " . $this->_obj->error);
        }
    }
}
