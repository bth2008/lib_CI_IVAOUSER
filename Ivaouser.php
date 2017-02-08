<?php
/**
 * Created by PhpStorm.
 * User: BTH
 * Date: 08.02.17
 * Time: 22:45
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Ivaouser
{
    private $ivaotoken;
    private $config;
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->config = $this->CI->config->config;
        $this->session = $this->CI->session;
    }

    public function getToken()
    {
        return $this->ivaotoken;
    }
    public function setToken($token){
        $this->ivaotoken = $token;
    }
    public function checkLoggedIn()
    {
        return null !== $this->CI->session->ivaodata;
    }

    public function login()
    {
        $data = file_get_contents('http://login.ivao.aero/api.php?type=json&token='.$this->getToken());
        $response = json_decode($data);
        $this->session->ivaodata = $response;
        return $this->session->ivaodata->result;
    }

    public function generateLoginUrl($route)
    {
        return "https://login.ivao.aero/index.php?url=".$this->config['base_url'].$route;
    }
}
