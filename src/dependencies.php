<?php
// DIC configuration

$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Facebook Graph API Service
$container['facebookGraphAPIService'] = function($c) {
	$settings = $c->get('settings')['facebookGraphAPI'];
	$user = new Models\UserModel;
	return new Services\FacebookGraphAPIService($settings, $user);
};

// Error handler to exceptions
$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        // Get error info
        $errorCode = $exception->getCode();
        $errorMessage = $exception->getMessage();

        // Log method error
        $c['logger']->error("$errorMessage ($errorCode)");

        // Make error response
        $arrResponse = array(
    		'errorCode'	=> $errorCode,
    		'errorMessage'	=> $errorMessage
    	);
        return $c['response']->withJson($arrResponse, 500);
    };
};