<?php

namespace Hermes\ModelBundle\Entity;


use Doctrine\ORM\Mapping AS ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/** 
 * @ORM\Entity
 */
class Employee implements UserInterface, \Serializable
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $first_name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $last_name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;


    /**
     * @ORM\OneToMany(targetEntity="Contract", mappedBy="Employee")
     */
    private $contracts;

    /**
     * @ORM\ManyToOne(targetEntity="Office", inversedBy="Employee")
     * @ORM\JoinColumn(name="office_id", referencedColumnName="id", nullable=false)
     */
    private $office;

    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="Employee")
     * @ORM\JoinTable(
     *     name="employee_role",
     *     joinColumns={@ORM\JoinColumn(name="employees_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $roles;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contracts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Employee
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Add contracts
     *
     * @param \Hermes\ModelBundle\Entity\Contract $contracts
     * @return Employee
     */
    public function addContract(\Hermes\ModelBundle\Entity\Contract $contracts)
    {
        $this->contracts[] = $contracts;

        return $this;
    }

    /**
     * Remove contracts
     *
     * @param \Hermes\ModelBundle\Entity\Contract $contracts
     */
    public function removeContract(\Hermes\ModelBundle\Entity\Contract $contracts)
    {
        $this->contracts->removeElement($contracts);
    }

    /**
     * Get contracts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContracts()
    {
        return $this->contracts;
    }

    /**
     * Set office
     *
     * @param \Hermes\ModelBundle\Entity\Office $office
     * @return Employee
     */
    public function setOffice(\Hermes\ModelBundle\Entity\Office $office)
    {
        $this->office = $office;

        return $this;
    }

    /**
     * Get office
     *
     * @return \Hermes\ModelBundle\Entity\Office 
     */
    public function getOffice()
    {
        return $this->office;
    }

    /**
     * Add roles
     *
     * @param \Hermes\ModelBundle\Entity\Role $roles
     * @return Employee
     */
    public function addRole(\Hermes\ModelBundle\Entity\Role $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \Hermes\ModelBundle\Entity\Role $roles
     */
    public function removeRole(\Hermes\ModelBundle\Entity\Role $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoles()
    {
        //return $this->roles;

        $out = [];
        foreach($this->roles as $role){
            $out[] = $role->getName();
        }

        return $out;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $options = array('cost' => 15, 'salt' => $this->getSalt());
        $this->password = password_hash($password, PASSWORD_BCRYPT, $options);
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return 'totalSecretSaltASSSSDDDkkerrjrjrjdsFFFFF';
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(array(
            $this->id
        ));
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($serialized)
    {
        list (
            $this->id
            ) = unserialize($serialized);
    }


}
