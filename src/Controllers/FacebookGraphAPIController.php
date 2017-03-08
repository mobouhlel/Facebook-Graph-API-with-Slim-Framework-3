<?php

namespace Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


/**
 * Class FacebookGraphAPIController
 * 
 * The controller class to get info using Facebook Graph API Service
 * 
 * 
 * @package Controllers
 * @author Maximiliano Dominguez <maxidominguez@outlook.com>
 * @version 1.0
 * 
 */
class FacebookGraphAPIController
{

    /**
     * Description
     * @param \Slim\Container $c 
     * @return void
     */
    public function __construct(\Slim\Container $c)
    {
        $this->c = $c;
        $this->logger = $c->logger; 
    }

    /**
     * Return user info from Facedbook via Facebook Graph API Service
     * 
     * @param Request $request 
     * @param Response $response 
     * @param array $args 
     * @throws \Exceptions\IsNotIntegerException When id provided is not a number
     * @return string
     */
    public function getUserInfo(Request $request, Response $response, $args)
    {
        $id = $args['id'];

        // Log method execute
        $this->logger->info("Get Facebook User Profile info", array('id' => $id));

        // Check if id is integer
        if(!is_numeric($id)){
        	throw new \Exceptions\IsNotIntegerException('Please provide a number user id');
        }

        // Get Facebook Service
        $facebookAPI = $this->c->get('facebookGraphAPIService');

        // Get user info from Facebook Graph API
        $arrUserInfo = $facebookAPI->getUserInfoById($id)->toArray();

        $jsonResponse = $response->withJson($arrUserInfo, 200);

        return $jsonResponse;

        // TO-DO 
        // Build json responses using template engine, like twig or similar. 
        // It has good performance and it is maintainable. 
    }
}
