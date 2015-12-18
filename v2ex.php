<?php
class V2ex{

    private $signInUrl;
    private $contentUrl;
    private $cookie;
    private $postData;
    
    public function __construct($signInUrl , $contentUrl, $cookie ,$postData){
        $this->signInUrl = $signInUrl;
        $this->contentUrl = $contentUrl;
        $this->cookie = $cookie;
        $this->postData = $postData;
    }
    // login in
    public function login(){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->signInUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->postData));
        curl_exec($curl);
        curl_close($curl);

    }
    // fetch content
    public function getContent(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->contentUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->cookie);
        $rs = curl_exec($ch);
        curl_close($ch);
        return $rs;
    }
}
$signInUrl = 'http://m.oschina.net/action/user/login';
$contentUrl = 'http://m.oschina.net/my';
$cookie = dirname(__FILE__) . '/cookie_v2ex.txt';
$postData = array(
    'email' => 'hizhenghang@sina.com',
    'pwd' => 'zxcvbnm909',
    'goto_page' => '/my',
    'error_page' => '/login',
    'save_login' => '1',
    'submit' => '现在登录',
    //'u' => 'zxcvbnm909',
    //'p' => 'zxcvbnm909',
    //'once' => '92332'
);
$v2ex = new V2ex($signInUrl , $contentUrl, $cookie ,$postData);
$v2ex->login();

$content = $v2ex->getContent();
var_dump($content);

