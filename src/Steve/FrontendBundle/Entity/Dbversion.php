<?php

namespace Steve\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dbversion
 *
 * @ORM\Table(name="dbVersion")
 * @ORM\Entity
 */
class Dbversion
{
    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=10, nullable=false)
     */
    private $version;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updateTimestamp", type="datetime", nullable=false)
     */
    private $updatetimestamp;



    /**
     * Set version
     *
     * @param string $version
     * @return Dbversion
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set updatetimestamp
     *
     * @param \DateTime $updatetimestamp
     * @return Dbversion
     */
    public function setUpdatetimestamp($updatetimestamp)
    {
        $this->updatetimestamp = $updatetimestamp;

        return $this;
    }

    /**
     * Get updatetimestamp
     *
     * @return \DateTime 
     */
    public function getUpdatetimestamp()
    {
        return $this->updatetimestamp;
    }
}
