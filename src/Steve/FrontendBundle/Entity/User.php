<?php

namespace Steve\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="idTag_UNIQUE", columns={"idTag"})}, indexes={@ORM\Index(name="FK_user_parentIdTag", columns={"parentIdTag"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiryDate", type="datetime", nullable=true)
     */
    private $expirydate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="inTransaction", type="boolean", nullable=false)
     */
    private $intransaction;

    /**
     * @var boolean
     *
     * @ORM\Column(name="blocked", type="boolean", nullable=false)
     */
    private $blocked;

    /**
     * @var string
     *
     * @ORM\Column(name="idTag", type="string", length=15)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtag;

    /**
     * @var \Steve\FrontendBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Steve\FrontendBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parentIdTag", referencedColumnName="idTag")
     * })
     */
    private $parentidtag;



    /**
     * Set expirydate
     *
     * @param \DateTime $expirydate
     * @return User
     */
    public function setExpirydate($expirydate)
    {
        $this->expirydate = $expirydate;

        return $this;
    }

    /**
     * Get expirydate
     *
     * @return \DateTime 
     */
    public function getExpirydate()
    {
        return $this->expirydate;
    }

    /**
     * Set intransaction
     *
     * @param boolean $intransaction
     * @return User
     */
    public function setIntransaction($intransaction)
    {
        $this->intransaction = $intransaction;

        return $this;
    }

    /**
     * Get intransaction
     *
     * @return boolean 
     */
    public function getIntransaction()
    {
        return $this->intransaction;
    }

    /**
     * Set blocked
     *
     * @param boolean $blocked
     * @return User
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;

        return $this;
    }

    /**
     * Get blocked
     *
     * @return boolean 
     */
    public function getBlocked()
    {
        return $this->blocked;
    }

    /**
     * Get idtag
     *
     * @return string 
     */
    public function getIdtag()
    {
        return $this->idtag;
    }

    /**
     * Set parentidtag
     *
     * @param \Steve\FrontendBundle\Entity\User $parentidtag
     * @return User
     */
    public function setParentidtag(\Steve\FrontendBundle\Entity\User $parentidtag = null)
    {
        $this->parentidtag = $parentidtag;

        return $this;
    }

    /**
     * Get parentidtag
     *
     * @return \Steve\FrontendBundle\Entity\User 
     */
    public function getParentidtag()
    {
        return $this->parentidtag;
    }
}
