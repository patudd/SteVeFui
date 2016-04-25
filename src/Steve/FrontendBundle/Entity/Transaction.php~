<?php

namespace Steve\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Transaction
 * 
 * @ORM\Entity(repositoryClass="\Steve\FrontendBundle\Entity\TransactionRepository")
 * @ORM\Table(name="transaction", uniqueConstraints={@ORM\UniqueConstraint(name="transaction_pk_UNIQUE", columns={"transaction_pk"})}, indexes={@ORM\Index(name="idTag_idx", columns={"idTag"}), @ORM\Index(name="connector_pk_idx", columns={"connector_pk"})})
 * @ORM\Entity
 */
class Transaction
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startTimestamp", type="datetime", nullable=true)
     */
    private $starttimestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="startValue", type="string", length=45, nullable=true)
     */
    private $startvalue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stopTimestamp", type="datetime", nullable=true)
     */
    private $stoptimestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="stopValue", type="string", length=45, nullable=true)
     */
    private $stopvalue;

    /**
     * @var integer
     *
     * @ORM\Column(name="transaction_pk", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $transactionPk;

    /**
     * @var \Steve\FrontendBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Steve\FrontendBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTag", referencedColumnName="idTag")
     * })
     */
    private $idtag;

    /**
     * @var \Steve\FrontendBundle\Entity\Connector
     *
     * @ORM\ManyToOne(targetEntity="Steve\FrontendBundle\Entity\Connector")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="connectorPK", referencedColumnName="connector_pk")
     * })
     */
    private $connectorPK;



    /**
     * Set starttimestamp
     *
     * @param \DateTime $starttimestamp
     * @return Transaction
     */
    public function setStarttimestamp($starttimestamp)
    {
        $this->starttimestamp = $starttimestamp;

        return $this;
    }

    /**
     * Get starttimestamp
     *
     * @return \DateTime 
     */
    public function getStarttimestamp()
    {
        return $this->starttimestamp;
    }

    /**
     * Set startvalue
     *
     * @param string $startvalue
     * @return Transaction
     */
    public function setStartvalue($startvalue)
    {
        $this->startvalue = $startvalue;

        return $this;
    }

    /**
     * Get startvalue
     *
     * @return string 
     */
    public function getStartvalue()
    {
        return $this->startvalue;
    }

    /**
     * Set stoptimestamp
     *
     * @param \DateTime $stoptimestamp
     * @return Transaction
     */
    public function setStoptimestamp($stoptimestamp)
    {
        $this->stoptimestamp = $stoptimestamp;

        return $this;
    }

    /**
     * Get stoptimestamp
     *
     * @return \DateTime 
     */
    public function getStoptimestamp()
    {
        return $this->stoptimestamp;
    }

    /**
     * Set stopvalue
     *
     * @param string $stopvalue
     * @return Transaction
     */
    public function setStopvalue($stopvalue)
    {
        $this->stopvalue = $stopvalue;

        return $this;
    }

    /**
     * Get stopvalue
     *
     * @return string 
     */
    public function getStopvalue()
    {
        return $this->stopvalue;
    }

    /**
     * Get transactionPk
     *
     * @return integer 
     */
    public function getTransactionPk()
    {
        return $this->transactionPk;
    }

    /**
     * Set idtag
     *
     * @param \Steve\FrontendBundle\Entity\User $idtag
     * @return Transaction
     */
    public function setIdtag(\Steve\FrontendBundle\Entity\User $idtag = null)
    {
        $this->idtag = $idtag;

        return $this;
    }

    /**
     * Get idtag
     *
     * @return \Steve\FrontendBundle\Entity\User 
     */
    public function getIdtag()
    {
        return $this->idtag;
    }

   

    /**
     * @ORM\OneToMany(targetEntity="Connector", mappedBy="transaction")
     */
    protected $connectors;
    
    public function __construct()
    {
    	$this->connectors = new ArrayCollection();
    	
    }
    
    /**
     * @var \Steve\FrontendBundle\Entity\Connector
     */
    private $connector_pk;


    /**
     * @var \Steve\FrontendBundle\Entity\Transaction
     */
    private $transaction;


    /**
     * Set transaction
     *
     * @param \Steve\FrontendBundle\Entity\Transaction $transaction
     * @return Transaction
     */
    public function setTransaction(\Steve\FrontendBundle\Entity\Transaction $transaction = null)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return \Steve\FrontendBundle\Entity\Transaction 
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Set connector_pk
     *
     * @param \Steve\FrontendBundle\Entity\Transaction $connectorPk
     * @return Transaction
     */
    public function setConnectorPk(\Steve\FrontendBundle\Entity\Transaction $connectorPk = null)
    {
        $this->connector_pk = $connectorPk;

        return $this;
    }

    /**
     * Add connector
     *
     * @param \Steve\FrontendBundle\Entity\Connector $connectors
     * @return Transaction
     */
    public function addConnector(\Steve\FrontendBundle\Entity\Connector $connectors)
    {
        $this->connectors[] = $connector;

        return $this;
    }

    /**
     * Remove connectors
     *
     * @param \Steve\FrontendBundle\Entity\Connector $connectors
     */
    public function removeConnector(\Steve\FrontendBundle\Entity\Connector $connectors)
    {
        $this->connectors->removeElement($connector);
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    

    /**
     * Get connectors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConnectors()
    {
        return $this->connectors;
    }
    /**
     * @var \Steve\FrontendBundle\Entity\Connector
     */
    private $connectorPk;


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
