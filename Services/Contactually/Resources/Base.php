<?php
abstract class Services_Contactually_Resources_Base
{
    const USER_AGENT = 'contactually-php/0.0.1';
    protected $cookie_path = '';
    protected function _get($uri, $params = array())
    {
        $uri .= (count($params)) ? '?'.http_build_query($params) : '';
        $curl_opts = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $uri,
            CURLOPT_COOKIEFILE => $this->cookie_path,
        );
        return $this->_execute($curl_opts);
    }
    protected function _post($uri, $params = array())
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
    protected function _execute($curl_params = array())
    {
        $connection = curl_init();
        foreach($curl_params as $option => $value) {
            curl_setopt($connection, $option, $value);
        }
curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, false);
        $this->_json = curl_exec($connection);
        $this->_obj  = json_decode($this->_json);
        $this->status = curl_getinfo($connection, CURLINFO_HTTP_CODE);
        curl_close($connection);
        return $this;
    }
}
