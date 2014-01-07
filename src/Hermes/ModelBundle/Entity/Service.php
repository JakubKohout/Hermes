<?php

namespace Hermes\ModelBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Service
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Trip", inversedBy="Service")
     * @ORM\JoinColumn(name="trip_id", referencedColumnName="id", nullable=false)
     */
    private $trip;

    /**
     * @ORM\ManyToOne(targetEntity="Participant", inversedBy="Service")
     * @ORM\JoinColumn(name="participant_id", referencedColumnName="id", nullable=false)
     */
    private $participant;

    /**
     * @ORM\ManyToOne(targetEntity="Catering", inversedBy="Service")
     * @ORM\JoinColumn(name="catering_id", referencedColumnName="id", nullable=false)
     */
    private $catering;

    /**
     * @ORM\ManyToOne(targetEntity="Transport", inversedBy="Service")
     * @ORM\JoinColumn(name="transports_id", referencedColumnName="id", nullable=false)
     */
    private $transport;

    /**
     * @ORM\ManyToOne(targetEntity="Accommodation", inversedBy="Service")
     * @ORM\JoinColumn(name="accommodations_id", referencedColumnName="id", nullable=false)
     */
    private $accommodation;

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
     * Set trip
     *
     * @param \Hermes\ModelBundle\Entity\Trip $trip
     * @return Service
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
     * Set participant
     *
     * @param \Hermes\ModelBundle\Entity\Participant $participant
     * @return Service
     */
    public function setParticipant(\Hermes\ModelBundle\Entity\Participant $participant)
    {
        $this->participant = $participant;

        return $this;
    }

    /**
     * Get participant
     *
     * @return \Hermes\ModelBundle\Entity\Participant 
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set catering
     *
     * @param \Hermes\ModelBundle\Entity\Catering $catering
     * @return Service
     */
    public function setCatering(\Hermes\ModelBundle\Entity\Catering $catering)
    {
        $this->catering = $catering;

        return $this;
    }

    /**
     * Get catering
     *
     * @return \Hermes\ModelBundle\Entity\Catering 
     */
    public function getCatering()
    {
        return $this->catering;
    }

    /**
     * Set transport
     *
     * @param \Hermes\ModelBundle\Entity\Transport $transport
     * @return Service
     */
    public function setTransport(\Hermes\ModelBundle\Entity\Transport $transport)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return \Hermes\ModelBundle\Entity\Transport 
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * Set accommodation
     *
     * @param \Hermes\ModelBundle\Entity\Accommodation $accommodation
     * @return Service
     */
    public function setAccommodation(\Hermes\ModelBundle\Entity\Accommodation $accommodation)
    {
        $this->accommodation = $accommodation;

        return $this;
    }

    /**
     * Get accommodation
     *
     * @return \Hermes\ModelBundle\Entity\Accommodation 
     */
    public function getAccommodation()
    {
        return $this->accommodation;
    }
}
