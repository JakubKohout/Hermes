<?php

namespace Hermes\ModelBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Contract
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /** 
     * @ORM\ManyToOne(targetEntity="Office", inversedBy="Contract")
     * @ORM\JoinColumn(name="office_id", referencedColumnName="id", nullable=false)
     */
    private $office;

    /**
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="Contract")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id", nullable=false)
     */
    private $employee;

    /**
     * @ORM\ManyToOne(targetEntity="Trip", inversedBy="Contract")
     * @ORM\JoinColumn(name="trip_id", referencedColumnName="id", nullable=false)
     */
    private $trip;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="Contract")
     * @ORM\JoinColumn(name="customers_id", referencedColumnName="id", nullable=false)
     */
    private $customer;

    /**
     * @ORM\ManyToMany(targetEntity="Participant", inversedBy="Contract")
     * @ORM\JoinTable(
     *     name="ContractParticipant",
     *     joinColumns={@ORM\JoinColumn(name="contracts_id", referencedColumnName="id", nullable=false)},
     *     inverseJoinColumns={@ORM\JoinColumn(name="participants_id", referencedColumnName="id", nullable=false)}
     * )
     */
    private $participants;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Contract
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
     * Set office
     *
     * @param \Hermes\ModelBundle\Entity\Office $office
     * @return Contract
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
     * Set employee
     *
     * @param \Hermes\ModelBundle\Entity\Employee $employee
     * @return Contract
     */
    public function setEmployee(\Hermes\ModelBundle\Entity\Employee $employee)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get employee
     *
     * @return \Hermes\ModelBundle\Entity\Employee 
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Set trip
     *
     * @param \Hermes\ModelBundle\Entity\Trip $trip
     * @return Contract
     */
    public function setTrip(\Hermes\ModelBundle\Entity\Trip $trip)
    {
        $this->trip = $trip;

        return $this;
    }

    /**
     * Get trip
     *
     * @return \Hermes\ModelBundle\Entity\Trip 
     */
    public function getTrip()
    {
        return $this->trip;
    }

    /**
     * Set customer
     *
     * @param \Hermes\ModelBundle\Entity\Customer $customer
     * @return Contract
     */
    public function setCustomer(\Hermes\ModelBundle\Entity\Customer $customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Hermes\ModelBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Add participants
     *
     * @param \Hermes\ModelBundle\Entity\Participant $participants
     * @return Contract
     */
    public function addParticipant(\Hermes\ModelBundle\Entity\Participant $participants)
    {
        $this->participants[] = $participants;

        return $this;
    }

    /**
     * Remove participants
     *
     * @param \Hermes\ModelBundle\Entity\Participant $participants
     */
    public function removeParticipant(\Hermes\ModelBundle\Entity\Participant $participants)
    {
        $this->participants->removeElement($participants);
    }

    /**
     * Get participants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParticipants()
    {
        return $this->participants;
    }
}
