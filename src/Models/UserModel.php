<?php

namespace Models;


/**
 * Class UserModel
 * 
 * Model object to map Facebook User Profile
 * 
 * 
 * @package Models
 * @author Maximiliano Dominguez <maxidominguez@outlook.com>
 * @version 1.0
 * 
 */
class UserModel
{
    /**
     * @var integer ID of User Facebook ID
     */
    protected $id;

    /**
     * @var string Full Name of user (firstname + lastname)
     */
    protected $fullName;

    /**
     * @var string First Name of user
     */
    protected $firstName;

    /**
     * @var string Last Name of user
     */
    protected $lastName;

    /**
     * @var string Gender of user
     */
    protected $gender;
    
    /**
     * @var string Link to profile on Facebook
     */
    protected $profileLink;

    /**
     * @var string URL of User Profile Picture
     */
    protected $profilePicture;

    /**
     * @var string URL of User Profile Cover
     */
    protected $profileCover;

    /**
     * Construct
     * @return void
     */
    public function __construct()
    {
        // do stuff
    }

    /**
     * Get ID of Facebook user
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get Full Name of Facebook User
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;   
    }
    
    /**
     * Get First Name of Facebook User
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Get Last Name of Facebook User
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }    

    /**
     * Get Gender of Facebook User
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }
    
    /**
     * Get Link to profile of Facebook User
     * @return string
     */
    public function getProfileLink()
    {
        return $this->profileLink;
    }
    
    /**
     * Get Profile Picture of Facebook User
     * @return string
     */
    public function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * Get Profile Cover of Facebook User
     * @return string
     */
    public function getProfileCover()
    {
        return $this->profileCover;
    }

    /**
     * Set ID of Facebook User
     * @param integer $id 
     * @return void 
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set Full Name of Facebook User
     * @param string $fullname
     * @return void 
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }
    
    /**
     * Set First Name of Facebook User
     * @param string $firstName 
     * @return void
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Set Last Name of Facebook User
     * @param string $lastName 
     * @return void
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }    

    /**
     * Set Gender of Facebook User
     * @param string $gender 
     * @return void
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    
    /**
     * Set Profile Link of Facebook User
     * @param string $profileLink 
     * @return void
     */
    public function setProfileLink($profileLink)
    {
        $this->profileLink = $profileLink;    
    }
    
    /**
     * Set Profile Picture URL of Facebook User
     * @param string $profilePicture 
     * @return void
     */
    public function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;    
    }

    /**
     * Set Profile Cover URL of Facebook User
     * @param string $profileCover 
     * @return void
     */
    public function setProfileCover($profileCover)
    {
        $this->profileCover = $profileCover;
    }

    /**
     * Get object convert to array
     * @return array $arrUser
     */
    public function toArray()
    {
        $arrUser = array(
            'id'                => $this->getId(),
            'fullName'          => $this->getFullName(),
            'firstName'         => $this->getFirstName(),
            'lastName'          => $this->getLastName(),
            'gender'            => $this->getGender(),
            'profileLink'       => $this->getProfileLink(),
            'profilePicture'    => $this->getProfilePicture(),
            'profileCover'      => $this->getProfileCover()
        );

        return $arrUser;
    }

}