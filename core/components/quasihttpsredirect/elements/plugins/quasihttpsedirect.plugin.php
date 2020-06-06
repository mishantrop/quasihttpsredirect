<?php
/**
 * @author <https://quasi-art.ru>
 * @version 1.1
 * 2017
 */

$debug = false;
$contexts = [ 'web' ];

switch ($modx->event->name) {
  case 'OnHandleRequest':
    if (!in_array($modx->context->key, $contexts)) {
      break;
    }
    $uri = $modx->getOption('REQUEST_URI', $_SERVER, '/');
    $host = $modx->getOption('HTTP_HOST', $_SERVER, '');
    $https = $modx->getOption('HTTPS', $_SERVER);
    $scheme = $modx->getOption('REQUEST_SCHEME', $_SERVER, 'http');
    $httpsUri = "https://$host$uri";
    if ($scheme === 'http' && !$https) {
      if ($debug) {
        $modx->log(xPDO::LOG_LEVEL_ERROR, "Redirecting to $httpsUri");
      }
      $modx->sendRedirect($httpsUri, [ 'responseCode' => 'HTTP/1.1 301 Moved Permanently' ]);
    }
  break;
  default:
    break;
}
