<?php

namespace VestaApi\Entity\OAuth;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="oauth_users", indexes={@ORM\Index(name="email_index", columns={"email"})})
 * @ORM\Entity(repositoryClass="VestaApi\Entity\OAuth\Repository\UserRepository")
 */
class User extends EncryptableFieldEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string")
     */
    private $password;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $this->encryptField($password);

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Verify user's password
     *
     * @param string $password
     * @return Boolean
     */
    public function verifyPassword($password)
    {
        return $this->verifyEncryptedFieldValue($this->getPassword(), $password);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'user_id' => $this->id,
            'scope' => null,
        ];
    }
}
