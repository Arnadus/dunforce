<?php
/**
 * Created by IntelliJ IDEA.
 * User: arnauddebacker
 * Date: 1/09/18
 * Time: 09:49
 */

namespace App\Security;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiUserProvider implements UserProviderInterface
{

    private $userRepository ;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsernameForApiKey($apiKey)
    {
        $user = $this->userRepository->findOneBy(['apiKey' => $apiKey]);
        if($user){
            return $user->getUsername();
        }
        return null;
    }

    public function loadUserByUsername($username)
    {
        return $this->userRepository->findOneBy(['username' => $username]);
    }

    public function refreshUser(UserInterface $user)
    {
        // this is used for storing authentication in the session
        // but in this example, the token is sent in each request,
        // so authentication can be stateless. Throwing this exception
        // is proper to make things stateless
        return $this->userRepository->findOneBy(['username' => $user->getUsername()]);
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}