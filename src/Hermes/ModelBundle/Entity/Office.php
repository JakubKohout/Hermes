<?php

namespace Hermes\ModelBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Office
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;


    /**
     * @ORM\Column(type="string")
     */
    private $city;


    /** 
     * @ORM\OneToMany(targetEntity="Contract", mappedBy="Office")
     */
    private $contracts;

    /**
     * @ORM\OneToMany(targetEntity="Employee", mappedBy="Office")
     */
    private $employees;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contracts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->employees = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Office
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
     * @return Office
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
     * Add employees
     *
     * @param \Hermes\ModelBundle\Entity\Employee $employees
     * @return Office
     */
    public function addEmployee(\Hermes\ModelBundle\Entity\Employee $employees)
    {
        $this->employees[] = $employees;

        return $this;
    }

    /**
     * Remove employees
     *
     * @param \Hermes\ModelBundle\Entity\Employee $employees
     */
    public function removeEmployee(\Hermes\ModelBundle\Entity\Employee $employees)
    {
        $this->employees->removeElement($employees);
    }

    /**
     * Get employees
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }





}
