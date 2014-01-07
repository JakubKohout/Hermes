<?php

namespace Hermes\ModelBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Role
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /** 
     * @ORM\ManyToMany(targetEntity="Employee", mappedBy="Role")
     */
    private $employees;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->employees = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Role
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
     * Add employees
     *
     * @param \Hermes\ModelBundle\Entity\Employee $employees
     * @return Role
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
}
