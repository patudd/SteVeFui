<?php

namespace Steve\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConnectorStatus
 *
 * @ORM\Table(name="connector_status", indexes={@ORM\Index(name="FK_cs_pk_idx", columns={"connector_pk"})})
 * @ORM\Entity
 */
class ConnectorStatus
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="statusTimestamp", type="datetime", nullable=true)
     */
    private $statustimestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=25, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="errorCode", type="string", length=25, nullable=true)
     */
    private $errorcode;

    /**
     * @var string
     *
     * @ORM\Column(name="errorInfo", type="string", length=50, nullable=true)
     */
    private $errorinfo;

    /**
     * @var string
     *
     * @ORM\Column(name="vendorId", type="string", length=255, nullable=true)
     */
    private $vendorid;

    /**
     * @var string
     *
     * @ORM\Column(name="vendorErrorCode", type="string", length=50, nullable=true)
     */
    private $vendorerrorcode;

    /**
     * @var \Steve\FrontendBundle\Entity\Connector
     *
     * @ORM\ManyToOne(targetEntity="Steve\FrontendBundle\Entity\Connector")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="connector_pk", referencedColumnName="connector_pk")
     * })
     */
    private $connectorPk;



    /**
     * Set statustimestamp
     *
     * @param \DateTime $statustimestamp
     * @return ConnectorStatus
     */
    public function setStatustimestamp($statustimestamp)
    {
        $this->statustimestamp = $statustimestamp;

        return $this;
    }

    /**
     * Get statustimestamp
     *
     * @return \DateTime 
     */
    public function getStatustimestamp()
    {
        return $this->statustimestamp;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ConnectorStatus
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set errorcode
     *
     * @param string $errorcode
     * @return ConnectorStatus
     */
    public function setErrorcode($errorcode)
    {
        $this->errorcode = $errorcode;

        return $this;
    }

    /**
     * Get errorcode
     *
     * @return string 
     */
    public function getErrorcode()
    {
        return $this->errorcode;
    }

    /**
     * Set errorinfo
     *
     * @param string $errorinfo
     * @return ConnectorStatus
     */
    public function setErrorinfo($errorinfo)
    {
        $this->errorinfo = $errorinfo;

        return $this;
    }

    /**
     * Get errorinfo
     *
     * @return string 
     */
    public function getErrorinfo()
    {
        return $this->errorinfo;
    }

    /**
     * Set vendorid
     *
     * @param string $vendorid
     * @return ConnectorStatus
     */
    public function setVendorid($vendorid)
    {
        $this->vendorid = $vendorid;

        return $this;
    }

    /**
     * Get vendorid
     *
     * @return string 
     */
    public function getVendorid()
    {
        return $this->vendorid;
    }

    /**
     * Set vendorerrorcode
     *
     * @param string $vendorerrorcode
     * @return ConnectorStatus
     */
    public function setVendorerrorcode($vendorerrorcode)
    {
        $this->vendorerrorcode = $vendorerrorcode;

        return $this;
    }

    /**
     * Get vendorerrorcode
     *
     * @return string 
     */
    public function getVendorerrorcode()
    {
        return $this->vendorerrorcode;
    }

    /**
     * Set connectorPk
     *
     * @param \Steve\FrontendBundle\Entity\Connector $connectorPk
     * @return ConnectorStatus
     */
    public function setConnectorPk(\Steve\FrontendBundle\Entity\Connector $connectorPk = null)
    {
        $this->connectorPk = $connectorPk;

        return $this;
    }

    /**
     * Get connectorPk
     *
     * @return \Steve\FrontendBundle\Entity\Connector 
     */
    public function getConnectorPk()
    {
        return $this->connectorPk;
    }
}
