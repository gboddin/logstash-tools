<?php
class HttpJsonClient {
  static function GET($url,$body=null) {
    return self::request('GET',$url,$body);
  }
  static function PUT($url,$body=null) {
    return self::request('PUT',$url,$body);
  }
  static function DELETE($url,$body=null) {
    return self::request('DELETE',$url,$body);
  
  }
  static function POST($url,$body=null) {
    return self::request('POST',$url,$body);
  }
  static private function request($method,$url,$body) {
    putenv('http_proxy');
    if(is_array($body))
      $body = json_encode($body);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    if(!is_null($body)) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $body); 
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($body))                                                                       
      );                                                                                                                   
    }
    $data = trim(curl_exec($ch));
    return json_decode($data,true);
  }
}
