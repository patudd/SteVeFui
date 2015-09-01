<?php

namespace Steve\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chargebox
 *
 * @ORM\Table(name="chargebox", uniqueConstraints={@ORM\UniqueConstraint(name="chargeBoxId_UNIQUE", columns={"chargeBoxId"})})
 * @ORM\Entity
 */
class Chargebox
{
    /**
     * @var string
     *
     * @ORM\Column(name="endpoint_address", type="string", length=45, nullable=true)
     */
    private $endpointAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="ocppVersion", type="string", length=3, nullable=true)
     */
    private $ocppversion;

    /**
     * @var string
     *
     * @ORM\Column(name="chargePointVendor", type="string", length=20, nullable=true)
     */
    private $chargepointvendor;

    /**
     * @var string
     *
     * @ORM\Column(name="chargePointModel", type="string", length=20, nullable=true)
     */
    private $chargepointmodel;

    /**
     * @var string
     *
     * @ORM\Column(name="chargePointSerialNumber", type="string", length=25, nullable=true)
     */
    private $chargepointserialnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="chargeBoxSerialNumber", type="string", length=25, nullable=true)
     */
    private $chargeboxserialnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="fwVersion", type="string", length=20, nullable=true)
     */
    private $fwversion;

    /**
     * @var string
     *
     * @ORM\Column(name="fwUpdateStatus", type="string", length=25, nullable=true)
     */
    private $fwupdatestatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fwUpdateTimestamp", type="datetime", nullable=true)
     */
    private $fwupdatetimestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="iccid", type="string", length=20, nullable=true)
     */
    private $iccid;

    /**
     * @var string
     *
     * @ORM\Column(name="imsi", type="string", length=20, nullable=true)
     */
    private $imsi;

    /**
     * @var string
     *
     * @ORM\Column(name="meterType", type="string", length=25, nullable=true)
     */
    private $metertype;

    /**
     * @var string
     *
     * @ORM\Column(name="meterSerialNumber", type="string", length=25, nullable=true)
     */
    private $meterserialnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="diagnosticsStatus", type="string", length=20, nullable=true)
     */
    private $diagnosticsstatus;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="diagnosticsTimestamp", type="datetime", nullable=true)
     */
    private $diagnosticstimestamp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastHeartbeatTimestamp", type="datetime", nullable=true)
     */
    private $lastheartbeattimestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="chargeBoxId", type="string", length=30)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $chargeboxid;



    /**
     * Set endpointAddress
     *
     * @param string $endpointAddress
     * @return Chargebox
     */
    public function setEndpointAddress($endpointAddress)
    {
        $this->endpointAddress = $endpointAddress;

        return $this;
    }

    /**
     * Get endpointAddress
     *
     * @return string 
     */
    public function getEndpointAddress()
    {
        return $this->endpointAddress;
    }

    /**
     * Set ocppversion
     *
     * @param string $ocppversion
     * @return Chargebox
     */
    public function setOcppversion($ocppversion)
    {
        $this->ocppversion = $ocppversion;

        return $this;
    }

    /**
     * Get ocppversion
     *
     * @return string 
     */
    public function getOcppversion()
    {
        return $this->ocppversion;
    }

    /**
     * Set chargepointvendor
     *
     * @param string $chargepointvendor
     * @return Chargebox
     */
    public function setChargepointvendor($chargepointvendor)
    {
        $this->chargepointvendor = $chargepointvendor;

        return $this;
    }

    /**
     * Get chargepointvendor
     *
     * @return string 
     */
    public function getChargepointvendor()
    {
        return $this->chargepointvendor;
    }

    /**
     * Set chargepointmodel
     *
     * @param string $chargepointmodel
     * @return Chargebox
     */
    public function setChargepointmodel($chargepointmodel)
    {
        $this->chargepointmodel = $chargepointmodel;

        return $this;
    }

    /**
     * Get chargepointmodel
     *
     * @return string 
     */
    public function getChargepointmodel()
    {
        return $this->chargepointmodel;
    }

    /**
     * Set chargepointserialnumber
     *
     * @param string $chargepointserialnumber
     * @return Chargebox
     */
    public function setChargepointserialnumber($chargepointserialnumber)
    {
        $this->chargepointserialnumber = $chargepointserialnumber;

        return $this;
    }

    /**
     * Get chargepointserialnumber
     *
     * @return string 
     */
    public function getChargepointserialnumber()
    {
        return $this->chargepointserialnumber;
    }

    /**
     * Set chargeboxserialnumber
     *
     * @param string $chargeboxserialnumber
     * @return Chargebox
     */
    public function setChargeboxserialnumber($chargeboxserialnumber)
    {
        $this->chargeboxserialnumber = $chargeboxserialnumber;

        return $this;
    }

    /**
     * Get chargeboxserialnumber
     *
     * @return string 
     */
    public function getChargeboxserialnumber()
    {
        return $this->chargeboxserialnumber;
    }

    /**
     * Set fwversion
     *
     * @param string $fwversion
     * @return Chargebox
     */
    public function setFwversion($fwversion)
    {
        $this->fwversion = $fwversion;

        return $this;
    }

    /**
     * Get fwversion
     *
     * @return string 
     */
    public function getFwversion()
    {
        return $this->fwversion;
    }

    /**
     * Set fwupdatestatus
     *
     * @param string $fwupdatestatus
     * @return Chargebox
     */
    public function setFwupdatestatus($fwupdatestatus)
    {
        $this->fwupdatestatus = $fwupdatestatus;

        return $this;
    }

    /**
     * Get fwupdatestatus
     *
     * @return string 
     */
    public function getFwupdatestatus()
    {
        return $this->fwupdatestatus;
    }

    /**
     * Set fwupdatetimestamp
     *
     * @param \DateTime $fwupdatetimestamp
     * @return Chargebox
     */
    public function setFwupdatetimestamp($fwupdatetimestamp)
    {
        $this->fwupdatetimestamp = $fwupdatetimestamp;

        return $this;
    }

    /**
     * Get fwupdatetimestamp
     *
     * @return \DateTime 
     */
    public function getFwupdatetimestamp()
    {
        return $this->fwupdatetimestamp;
    }

    /**
     * Set iccid
     *
     * @param string $iccid
     * @return Chargebox
     */
    public function setIccid($iccid)
    {
        $this->iccid = $iccid;

        return $this;
    }

    /**
     * Get iccid
     *
     * @return string 
     */
    public function getIccid()
    {
        return $this->iccid;
    }

    /**
     * Set imsi
     *
     * @param string $imsi
     * @return Chargebox
     */
    public function setImsi($imsi)
    {
        $this->imsi = $imsi;

        return $this;
    }

    /**
     * Get imsi
     *
     * @return string 
     */
    public function getImsi()
    {
        return $this->imsi;
    }

    /**
     * Set metertype
     *
     * @param string $metertype
     * @return Chargebox
     */
    public function setMetertype($metertype)
    {
        $this->metertype = $metertype;

        return $this;
    }

    /**
     * Get metertype
     *
     * @return string 
     */
    public function getMetertype()
    {
        return $this->metertype;
    }

    /**
     * Set meterserialnumber
     *
     * @param string $meterserialnumber
     * @return Chargebox
     */
    public function setMeterserialnumber($meterserialnumber)
    {
        $this->meterserialnumber = $meterserialnumber;

        return $this;
    }

    /**
     * Get meterserialnumber
     *
     * @return string 
     */
    public function getMeterserialnumber()
    {
        return $this->meterserialnumber;
    }

    /**
     * Set diagnosticsstatus
     *
     * @param string $diagnosticsstatus
     * @return Chargebox
     */
    public function setDiagnosticsstatus($diagnosticsstatus)
    {
        $this->diagnosticsstatus = $diagnosticsstatus;

        return $this;
    }

    /**
     * Get diagnosticsstatus
     *
     * @return string 
     */
    public function getDiagnosticsstatus()
    {
        return $this->diagnosticsstatus;
    }

    /**
     * Set diagnosticstimestamp
     *
     * @param \DateTime $diagnosticstimestamp
     * @return Chargebox
     */
    public function setDiagnosticstimestamp($diagnosticstimestamp)
    {
        $this->diagnosticstimestamp = $diagnosticstimestamp;

        return $this;
    }

    /**
     * Get diagnosticstimestamp
     *
     * @return \DateTime 
     */
    public function getDiagnosticstimestamp()
    {
        return $this->diagnosticstimestamp;
    }

    /**
     * Set lastheartbeattimestamp
     *
     * @param \DateTime $lastheartbeattimestamp
     * @return Chargebox
     */
    public function setLastheartbeattimestamp($lastheartbeattimestamp)
    {
        $this->lastheartbeattimestamp = $lastheartbeattimestamp;

        return $this;
    }

    /**
     * Get lastheartbeattimestamp
     *
     * @return \DateTime 
     */
    public function getLastheartbeattimestamp()
    {
        return $this->lastheartbeattimestamp;
    }

    /**
     * Get chargeboxid
     *
     * @return string 
     */
    public function getChargeboxid()
    {
        return $this->chargeboxid;
    }
}
