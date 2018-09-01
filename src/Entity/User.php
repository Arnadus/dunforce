<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var String
     * @ORM\Column(type="string")
     */
    private $username;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $apiKey;

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getRoles()
    {
        return ['ROLE_API', 'ROLE_USER'];
    }

    public function getPassword()
    {
        return 'dunforce';
    }

    public function getSalt()
    {
        return '';
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
        return;
    }

    /**
     * @param String $username
     */
    public function setUsername(String $username): void
    {
        $this->username = $username;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }


}
