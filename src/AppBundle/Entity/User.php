<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    public function __construct()
    {
        parent::__construct();

    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->username = $name;
    }

    public function getName()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Get All
     *
     * @return array
     */
    public function getAll()
    {
        return array(
            "id" => $this->id,
            "name" => $this->username,
            "password" => $this->password,

        );
    }
}

