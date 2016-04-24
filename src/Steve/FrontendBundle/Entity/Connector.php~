<?php

namespace Steve\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Connector
 *
 * @ORM\Entity(repositoryClass="\Steve\FrontendBundle\Entity\ConnectorRepository")
 * @ORM\Table(name="connector", uniqueConstraints={@ORM\UniqueConstraint(name="connector_pk_UNIQUE", columns={"connector_pk"}), @ORM\UniqueConstraint(name="connector_cbid_cid_UNIQUE", columns={"chargeBoxId", "connectorId"})}, indexes={@ORM\Index(name="IDX_148C456EA3346E40", columns={"chargeBoxId"})})
 * @ORM\Entity
 */
class Connector
{
    /**
     * @var integer
     *
     * @ORM\Column(name="connectorId", type="integer", nullable=false)
     */
    private $connectorid;


    
    /**
     * @var \Steve\FrontendBundle\Entity\Chargebox
     *
     * @ORM\ManyToOne(targetEntity="Steve\FrontendBundle\Entity\Chargebox")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chargeBoxId", referencedColumnName="chargeBoxId")
     * })
     */
    private $chargeboxid;
    
    /**
     * Set connectorid
     *
     * @param integer $connectorid
     * @return Connector
     */
    public function setConnectorid($connectorid)
    {
        $this->connectorid = $connectorid;

        return $this;
    }

    /**
     * Get connectorid
     *
     * @return integer 
     */
    public function getConnectorid()
    {
        return $this->connectorid;
    }


    
    /**
     * Set chargeboxid
     *
     * @param \Steve\FrontendBundle\Entity\Chargebox $chargeboxid
     * @return Connector
     */
    public function setChargeboxid(\Steve\FrontendBundle\Entity\Chargebox $chargeboxid = null)
    {
        $this->chargeboxid = $chargeboxid;

        return $this;
    }

    /**
     * Get chargeboxid
     *
     * @return \Steve\FrontendBundle\Entity\Chargebox 
     */
    public function getChargeboxid()
    {
        return $this->chargeboxid;
    }
    
  


    
    /**
     * @var integer
     */
    private $connectorPk;


    /**
     * Get connectorPk
     *
     * @return integer 
     */
    public function getConnectorPk()
    {
        return $this->connectorPk;
    }

}
