<?php

function getData($data) {
  $OUT = array();
  $f = explode('&', $data);
  foreach($f as $line) {
    $out = explode('=',$line);
    $OUT[$out[0]] = $out[1]; 
  }
  return $OUT;
}

function getLetter($addr, $main) {
  $urll = "https://bitmixer.io/lettertxt.php?addr=".$addr;
  $var  = fetch($urll, array('cookiefile' => './.cookie/'.$main.'.txt' ));
  return $var; 
}

function fetch( $url, $z=null ) {
  $ch =  curl_init();

  $useragent = isset($z['useragent']) ? $z['useragent'] : 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:10.0.2) Gecko/20100101 Firefox/10.0.2';

  curl_setopt( $ch, CURLOPT_URL, $url );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt( $ch, CURLOPT_POST, isset($z['post']) );

  if( isset($z['post']) )         curl_setopt( $ch, CURLOPT_POSTFIELDS, $z['post'] );
  if( isset($z['refer']) )        curl_setopt( $ch, CURLOPT_REFERER, $z['refer'] );

  curl_setopt( $ch, CURLOPT_USERAGENT, $useragent );
  curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, ( isset($z['timeout']) ? $z['timeout'] : 5 ) );
  curl_setopt( $ch, CURLOPT_COOKIEJAR,  $z['cookiefile'] );
  curl_setopt( $ch, CURLOPT_COOKIEFILE, $z['cookiefile'] );

  $result = curl_exec( $ch );
  curl_close( $ch );
  return $result;
}
