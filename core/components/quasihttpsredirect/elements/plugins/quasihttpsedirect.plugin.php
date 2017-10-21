<?php
/**
 * @author <https://quasi-art.ru>
 * @version 1.0
 * 2017
 */

$debug = false;
if ($debug) {
	$modx->log(xPDO::LOG_LEVEL_ERROR, 'Event: '.$modx->event->name);
}
switch ($modx->event->name) {
    case 'OnHandleRequest':
        // $modx->setDebug(E_ALL & ~E_NOTICE);
        // $modx->setLogLevel(modX::LOG_LEVEL_DEBUG);
        if ($modx->context->key == 'web') {
            $uri = $modx->getOption('REQUEST_URI', $_SERVER, '/');
            $host = $modx->getOption('HTTP_HOST', $_SERVER, '');
            $https = $modx->getOption('HTTPS', $_SERVER, '');
            $scheme = $modx->getOption('REQUEST_SCHEME', $_SERVER, 'http');
            $httpsRequestUri = 'https://'.$host.$uri;
            if ($debug) {
        		$modx->log(xPDO::LOG_LEVEL_ERROR, 'Redirect to '.$httpsRequestUri);
            }
            if ($scheme == 'http' && $https == '') {
                $modx->sendRedirect($httpsRequestUri, array('responseCode' => 'HTTP/1.1 301 Moved Permanently'));
            }
        }
        break;
    default:
        break;
}