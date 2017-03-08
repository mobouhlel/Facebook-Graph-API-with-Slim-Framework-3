<?php

namespace Tests\Unit;


/**
 * Class FacebookGraphApiTest
 * 
 * The Unit Test class to check Facebook Graph API Service
 * 
 * 
 * @package Controllers
 * @author Maximiliano Dominguez <maxidominguez@outlook.com>
 * @version 1.0
 * 
 */
class FacebookGraphApiTest extends BaseTestCase
{
    /**
     * Test that the index route returns a 404 code
     */
    public function testGetHomepage()
    {
        $response = $this->runApp('get', '/');

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * Test that Get User Profile method without user id returns 404
     */
    public function testGetUserProfileWithoutId()
    {
        $response = $this->runApp('get', '/profile/facebook/');

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * Test that Get User Profile method with no numeric user id returns 500
     */
    public function testGetUserProfileWithoutNumericId()
    {
        $response = $this->runApp('get', '/profile/facebook/123abc');

        $this->assertEquals(500, $response->getStatusCode());
        $this->assertContains('Please provide a number user id', (string)$response->getBody());
    }

    /**
     * Test that Get User Profile method returns 200 with correct params
     */
    public function testGetUserProfile()
    {
        $response = $this->runApp('get', '/profile/facebook/4');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test that Get User Profile method returns all keys with correct params
     * @return void
     */
    public function testGetUserProfileKeys()
    {
        $response = $this->runApp('get', '/profile/facebook/4');
        $data = json_decode($response->getBody(true), true);

        // Check all response keys
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('fullName', $data);
        $this->assertArrayHasKey('firstName', $data);
        $this->assertArrayHasKey('lastName', $data);
        $this->assertArrayHasKey('gender', $data);
        $this->assertArrayHasKey('profileLink', $data);
        $this->assertArrayHasKey('profilePicture', $data);
        $this->assertArrayHasKey('profileCover', $data);

        // Check some response values
        $this->assertEquals(4, $data['id']);
        $this->assertEquals('Mark Zuckerberg', $data['fullName']);
        $this->assertEquals('Mark', $data['firstName']);
        $this->assertEquals('Zuckerberg', $data['lastName']);

    }

    /**
     * Test that Get User Profile method doesn't accept a POST request
     */
    public function testPostUserProfile()
    {
        $response = $this->runApp('POST', '/profile/facebook/4', ['test']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }
}