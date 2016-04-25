<?php

namespace Steve\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 */
class Log
{
    /**
     * @var string
     */
    private $subject;

    /**
     * @var integer
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    /**
     * @var boolean
     */
    private $read;

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set subject
     *
     * @param string $subject
     * @return Log
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set code
     *
     * @param integer $code
     * @return Log
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Log
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set read
     *
     * @param boolean $read
     * @return Log
     */
    public function setRead($read)
    {
        $this->read = $read;

        return $this;
    }

    /**
     * Get read
     *
     * @return boolean 
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Log
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
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
     * @var \DateTime
     */
    private $inserttimestamp;


    /**
     * Set inserttimestamp
     *
     * @param \DateTime $inserttimestamp
     * @return Log
     */
    public function setInserttimestamp($inserttimestamp)
    {
        $this->inserttimestamp = $inserttimestamp;

        return $this;
    }

    /**
     * Get inserttimestamp
     *
     * @return \DateTime 
     */
    public function getInserttimestamp()
    {
        return $this->inserttimestamp;
    }
    /**
     * @var boolean
     */
    private $isread;


    /**
     * Set isread
     *
     * @param boolean $isread
     * @return Log
     */
    public function setIsread($isread)
    {
        $this->isread = $isread;

        return $this;
    }

    /**
     * Get isread
     *
     * @return boolean 
     */
    public function getIsread()
    {
        return $this->isread;
    }
}
