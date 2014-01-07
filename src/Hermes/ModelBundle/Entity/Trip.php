<?php

namespace Hermes\ModelBundle\Entity;

use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Trip
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /** 
     * @ORM\OneToMany(targetEntity="Contract", mappedBy="Trip")
     */
    private $contracts;

    /**
     * @ORM\OneToMany(targetEntity="Transport", mappedBy="Trip")
     */
    private $transports;

    /**
     * @ORM\OneToMany(targetEntity="Catering", mappedBy="Trip")
     */
    private $caterings;

    /**
     * @ORM\OneToMany(targetEntity="Accommodation", mappedBy="Trip")
     */
    private $accommodations;

    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="Trip")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="Trip")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Country", mappedBy="Trip")
     */
    private $countries;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contracts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->transports = new \Doctrine\Common\Collections\ArrayCollection();
        $this->caterings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->accommodations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->countries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Trip
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
     * @return Trip
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
     * Add transports
     *
     * @param \Hermes\ModelBundle\Entity\Transport $transports
     * @return Trip
     */
    public function addTransport(\Hermes\ModelBundle\Entity\Transport $transports)
    {
        $this->transports[] = $transports;

        return $this;
    }

    /**
     * Remove transports
     *
     * @param \Hermes\ModelBundle\Entity\Transport $transports
     */
    public function removeTransport(\Hermes\ModelBundle\Entity\Transport $transports)
    {
        $this->transports->removeElement($transports);
    }

    /**
     * Get transports
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTransports()
    {
        return $this->transports;
    }

    /**
     * Add caterings
     *
     * @param \Hermes\ModelBundle\Entity\Catering $caterings
     * @return Trip
     */
    public function addCatering(\Hermes\ModelBundle\Entity\Catering $caterings)
    {
        $this->caterings[] = $caterings;

        return $this;
    }

    /**
     * Remove caterings
     *
     * @param \Hermes\ModelBundle\Entity\Catering $caterings
     */
    public function removeCatering(\Hermes\ModelBundle\Entity\Catering $caterings)
    {
        $this->caterings->removeElement($caterings);
    }

    /**
     * Get caterings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCaterings()
    {
        return $this->caterings;
    }

    /**
     * Add accommodations
     *
     * @param \Hermes\ModelBundle\Entity\Accommodation $accommodations
     * @return Trip
     */
    public function addAccommodation(\Hermes\ModelBundle\Entity\Accommodation $accommodations)
    {
        $this->accommodations[] = $accommodations;

        return $this;
    }

    /**
     * Remove accommodations
     *
     * @param \Hermes\ModelBundle\Entity\Accommodation $accommodations
     */
    public function removeAccommodation(\Hermes\ModelBundle\Entity\Accommodation $accommodations)
    {
        $this->accommodations->removeElement($accommodations);
    }

    /**
     * Get accommodations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAccommodations()
    {
        return $this->accommodations;
    }

    /**
     * Set type
     *
     * @param \Hermes\ModelBundle\Entity\Type $type
     * @return Trip
     */
    public function setType(\Hermes\ModelBundle\Entity\Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Hermes\ModelBundle\Entity\Type 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set category
     *
     * @param \Hermes\ModelBundle\Entity\Category $category
     * @return Trip
     */
    public function setCategory(\Hermes\ModelBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Hermes\ModelBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add countries
     *
     * @param \Hermes\ModelBundle\Entity\Country $countries
     * @return Trip
     */
    public function addCountry(\Hermes\ModelBundle\Entity\Country $countries)
    {
        $this->countries[] = $countries;

        return $this;
    }

    /**
     * Remove countries
     *
     * @param \Hermes\ModelBundle\Entity\Country $countries
     */
    public function removeCountry(\Hermes\ModelBundle\Entity\Country $countries)
    {
        $this->countries->removeElement($countries);
    }

    /**
     * Get countries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCountries()
    {
        return $this->countries;
    }
}
