<?php

namespace App\Services;

use App\Exceptions\SocialAuthException;
use Exception;
use Socialite;
use App\User;
use App\Repositories\UserRepository;

class SocialMediaService
{

	private $user;

	public function __construct(UserRepository $user)
	{
		$this->user = $user;
	}

	public function authenticate($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
 
    public function login($provider)
    {
        try {
            $userSocial = Socialite::driver($provider)->user();

            $user = $this->user->getUserByEmail($userSocial->getEmail());

            if (!$user) {
            	$nameArr = explode(' ', $userSocial->getName());
            	$password = rand(000000,999999);
            	$gender = ($userSocial->user['gender'] == 'male') ? 'm' : 'f';
            	$user = $this->user
            		->setEmail($userSocial->getEmail())
            		->setPassword($password)
            		->setGender($gender)
            		->setFirstName($nameArr[0])
            		->setLastName($nameArr[1])
            		->setSocialMediaType($provider)
            		->setSocialMediaId($userSocial->getId())
            		->setAvatar($userSocial->avatar_original)            		
            		->create();
            }

            $this->user->auth($user);
        
 
        } catch (Exception $e) {
            throw new SocialAuthException($e->getMessage());
        }
    }
}