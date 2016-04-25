<?php

namespace Steve\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Crontask
 * @ORM\Entity
 * @UniqueEntity("name")
 */
class Crontask
{
    /**
     * @var string
     */
    private $name;
    
    /**
     * @ORM\Column(type="array")
     */
    private $commands;
    /**
     * @ORM\Column(name="`interval`", type="integer")
     */
    private $interval;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastrun;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set name
     *
     * @param string $name
     * @return Crontask
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set commands
     *
     * @return Crontask
     */
    public function setCommands($commands)
    {
        $this->commands = $commands;

        return $this;
    }

    /**
     * Get commands
     *
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * Set interval
     *
     * @param string $interval
     * @return Crontask
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * Get interval
     *
     * @return string 
     */
    public function getInterval()
    {
        return $this->interval;
    }

    /**
     * Set lastrun
     *
     * @param \DateTime $lastrun
     * @return Crontask
     */
    public function setLastrun($lastrun)
    {
        $this->lastrun = $lastrun;

        return $this;
    }

    /**
     * Get lastrun
     *
     * @return \DateTime 
     */
    public function getLastrun()
    {
        return $this->lastrun;
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
}
