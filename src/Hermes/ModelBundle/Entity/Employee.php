<?php

namespace Hermes\ModelBundle\Entity;


use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Employee
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


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
     *     name="EmployeeRole",
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
        return $this->roles;
    }
}
