<?php

namespace Steve\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", uniqueConstraints={@ORM\UniqueConstraint(name="reservation_pk_UNIQUE", columns={"reservation_pk"}), @ORM\UniqueConstraint(name="transaction_pk_UNIQUE", columns={"transaction_pk"})}, indexes={@ORM\Index(name="FK_idTag_r_idx", columns={"idTag"}), @ORM\Index(name="FK_chargeBoxId_r_idx", columns={"chargeBoxId"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDatetime", type="datetime", nullable=true)
     */
    private $startdatetime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiryDatetime", type="datetime", nullable=true)
     */
    private $expirydatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=15, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="reservation_pk", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reservationPk;

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
     * @var \Steve\FrontendBundle\Entity\Chargebox
     *
     * @ORM\ManyToOne(targetEntity="Steve\FrontendBundle\Entity\Chargebox")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chargeBoxId", referencedColumnName="chargeBoxId")
     * })
     */
    private $chargeboxid;

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
     * Set startdatetime
     *
     * @param \DateTime $startdatetime
     * @return Reservation
     */
    public function setStartdatetime($startdatetime)
    {
        $this->startdatetime = $startdatetime;

        return $this;
    }

    /**
     * Get startdatetime
     *
     * @return \DateTime 
     */
    public function getStartdatetime()
    {
        return $this->startdatetime;
    }

    /**
     * Set expirydatetime
     *
     * @param \DateTime $expirydatetime
     * @return Reservation
     */
    public function setExpirydatetime($expirydatetime)
    {
        $this->expirydatetime = $expirydatetime;

        return $this;
    }

    /**
     * Get expirydatetime
     *
     * @return \DateTime 
     */
    public function getExpirydatetime()
    {
        return $this->expirydatetime;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Reservation
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
     * Get reservationPk
     *
     * @return integer 
     */
    public function getReservationPk()
    {
        return $this->reservationPk;
    }

    /**
     * Set idtag
     *
     * @param \Steve\FrontendBundle\Entity\User $idtag
     * @return Reservation
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
     * Set chargeboxid
     *
     * @param \Steve\FrontendBundle\Entity\Chargebox $chargeboxid
     * @return Reservation
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
     * Set transactionPk
     *
     * @param \Steve\FrontendBundle\Entity\Transaction $transactionPk
     * @return Reservation
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
}
