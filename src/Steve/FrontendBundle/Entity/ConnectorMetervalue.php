<?php

namespace Steve\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConnectorMetervalue
 *
 * @ORM\Table(name="connector_metervalue", indexes={@ORM\Index(name="FK_cm_pk_idx", columns={"connector_pk"}), @ORM\Index(name="FK_tid_cm_idx", columns={"transaction_pk"})})
 * @ORM\Entity
 */
class ConnectorMetervalue
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="valueTimestamp", type="datetime", nullable=true)
     */
    private $valuetimestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=45, nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="readingContext", type="string", length=20, nullable=true)
     */
    private $readingcontext;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=20, nullable=true)
     */
    private $format;

    /**
     * @var string
     *
     * @ORM\Column(name="measurand", type="string", length=40, nullable=true)
     */
    private $measurand;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=10, nullable=true)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=10, nullable=true)
     */
    private $unit;

    /**
     * @var \Steve\FrontendBundle\Entity\Transaction
     *
     * @ORM\ManyToOne(targetEntity="Steve\FrontendBundle\Entity\Transaction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transaction_pk", referencedColumnName="transaction_pk")
     * })
     */
    private $transactionPk;

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
     * Set valuetimestamp
     *
     * @param \DateTime $valuetimestamp
     * @return ConnectorMetervalue
     */
    public function setValuetimestamp($valuetimestamp)
    {
        $this->valuetimestamp = $valuetimestamp;

        return $this;
    }

    /**
     * Get valuetimestamp
     *
     * @return \DateTime 
     */
    public function getValuetimestamp()
    {
        return $this->valuetimestamp;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return ConnectorMetervalue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set readingcontext
     *
     * @param string $readingcontext
     * @return ConnectorMetervalue
     */
    public function setReadingcontext($readingcontext)
    {
        $this->readingcontext = $readingcontext;

        return $this;
    }

    /**
     * Get readingcontext
     *
     * @return string 
     */
    public function getReadingcontext()
    {
        return $this->readingcontext;
    }

    /**
     * Set format
     *
     * @param string $format
     * @return ConnectorMetervalue
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get format
     *
     * @return string 
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set measurand
     *
     * @param string $measurand
     * @return ConnectorMetervalue
     */
    public function setMeasurand($measurand)
    {
        $this->measurand = $measurand;

        return $this;
    }

    /**
     * Get measurand
     *
     * @return string 
     */
    public function getMeasurand()
    {
        return $this->measurand;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return ConnectorMetervalue
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return ConnectorMetervalue
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string 
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set transactionPk
     *
     * @param \Steve\FrontendBundle\Entity\Transaction $transactionPk
     * @return ConnectorMetervalue
     */
    public function setTransactionPk(\Steve\FrontendBundle\Entity\Transaction $transactionPk = null)
    {
        $this->transactionPk = $transactionPk;

        return $this;
    }

    /**
     * Get transactionPk
     *
     * @return \Steve\FrontendBundle\Entity\Transaction 
     */
    public function getTransactionPk()
    {
        return $this->transactionPk;
    }

    /**
     * Set connectorPk
     *
     * @param \Steve\FrontendBundle\Entity\Connector $connectorPk
     * @return ConnectorMetervalue
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
