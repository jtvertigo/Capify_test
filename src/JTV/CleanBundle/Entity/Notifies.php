<?php

namespace JTV\CleanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * JTV\CleanBundle\Entity\Notifies
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="JTV\CleanBundle\Repository\NotifiesRepository")
 */
class Notifies
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $organization
     *
     * @ORM\Column(name="organization", type="string", length=255)
     */
    private $organization;

    /**
     * @var datetime $dt
     *
     * @ORM\Column(name="dt", type="datetime")
     */
    private $dt;

    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;


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
     * Set organization
     *
     * @param string $organization
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    /**
     * Get organization
     *
     * @return string 
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set dt
     *
     * @param datetime $dt
     */
    public function setDt($dt)
    {
        $this->dt = $dt;
    }

    /**
     * Get dt
     *
     * @return datetime 
     */
    public function getDt()
    {
        return $this->dt;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}
