<?php

function render($template, $data = array(), $code = 200){
  if($code != 200){
    switch($code){
      case 404:
        header("HTTP/1.0 404 Not Found");
        break;
      case 401:
        header("HTTP/1.0 401 Unauthorized");
        break;
      case 503:
        header("HTTP/1.0 503 Service Unavailable");
        break;
    }
  }
  $loader = new Twig_Loader_Filesystem('views');
  $opts = array();

  //$opts['debug'] = true;
  $opts['cache'] = dirname(__FILE__).'/cache';
  $twig = new Twig_Environment($loader, $opts);

  //$twig->addExtension(new Twig_Extension_Debug());

  return $twig->render($template, $data);
}