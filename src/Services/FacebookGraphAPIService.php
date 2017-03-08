<?php

namespace Services;


/**
 * Class FacebookGraphAPIService
 * 
 * The service class to consume Facebook Graph API
 * 
 * 
 * @package Services
 * @author Maximiliano Dominguez <maxidominguez@outlook.com>
 * @version 1.0
 * 
 */
class FacebookGraphAPIService 
{

	/**
	 * Facebook SDK Object to consume Facebook Graph API (\Facebook\Facebook)
	 * 
	 * @var object 
	 */
	protected $facebookClient;	

	/**
	 * User fields to use in Facebook User Graph API
	 * 
	 * @var string 
	 */
	protected $userFields;

	/**
	 * User Object with Facebook Profile Info (\Models\UserModel)
	 * 
	 * @var object
	 */
	protected $user;

	/**
	 * Set Facebook SDK settings and initial User Model Object
	 * 
	 * @param array $settings 
	 * @param \Models\UserModel $user 
	 * @return void
	 */
	public function __construct($settings, $user)
	{

		// Set Facebook SDK settings
		$appId = $settings['appId'];
		$secretId = $settings['secretId'];
		$APIVersion = $settings['APIversion'];
		$userFields = $settings['getUserInfo']['userFields'];

		// Create Facebook SDK Client with Credentials
		$this->facebookClient = new \Facebook\Facebook(
			array(
				'app_id' => $appId, 
				'app_secret' => $secretId,
				'default_graph_version' => $APIVersion
			)
		);

		// Set profile fields to get user from Graph Api
		$this->userFields = $userFields;

		// Set User Model object to populate
		$this->user = $user;

		// Set default Access Token to Graph API calls
		$this->facebookClient->setDefaultAccessToken("$appId|$secretId");
	}

	/**
	 * Get user info from Facebook Graph API using Facebook SDK
	 * 
	 * @param integer $id 
	 * @throws Facebook\Exceptions\FacebookResponseException When Facebook Graph API return error
	 * @throws Facebook\Exceptions\FacebookSDKException When Facebook SDK return error
	 * @return \Models\UserModel
	 */
	public function getUserInfoById($id)
	{
		try {
			// If user fields is provided, add it to request
			if($this->userFields)
			{
				$id .= '?fields=' . $this->userFields;
			}
			
			// Get user info from Facebook Graph API
			$response = $this->facebookClient->get($id);

		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			$this->logger->error('Graph returned an error: ' . $e->getMessage());
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$this->logger->error('Facebook SDK returned an error: ' . $e->getMessage());
		}

		$userProfile = $response->getGraphUser();

		// Set user profile info into user model object
		$this->setUserInfo($userProfile);

		return $this->user;
	}

	/**
	 * Fill User Model object with Facebook User Profile info
	 *  
	 * @param array $userProfile 
	 * @return void
	 */
	private function setUserInfo($userProfile)
	{
		if(isset($userProfile['id']))
			$this->user->setId($userProfile['id']);

		if(isset($userProfile['name']))
			$this->user->setFullName($userProfile['name']);
	
		if(isset($userProfile['first_name']))
			$this->user->setFirstName($userProfile['first_name']);
	
		if(isset($userProfile['last_name']))
			$this->user->setLastName($userProfile['last_name']);
	
		if(isset($userProfile['gender']))
			$this->user->setGender($userProfile['gender']);
		
		if(isset($userProfile['link']))
			$this->user->setProfileLink($userProfile['link']);
	
		if(isset($userProfile['picture']['url']))
			$this->user->setProfilePicture($userProfile['picture']['url']);
	
		if(isset($userProfile['cover']['source']))
			$this->user->setProfileCover($userProfile['cover']['source']);
	}
}