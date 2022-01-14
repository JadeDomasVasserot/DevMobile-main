<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Commande
 *
 * @ApiResource()
 * @ORM\Table(name="commande", indexes={@ORM\Index(name="user_ID", columns={"user_ID"})})
 * @ORM\Entity
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDCommande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcommande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var float
     *
     * @ORM\Column(name="amountOutMargin", type="float", precision=10, scale=0, nullable=false)
     */
    private $amountoutmargin;

    /**
     * @var float
     *
     * @ORM\Column(name="comMargin", type="float", precision=10, scale=0, nullable=false)
     */
    private $commargin;

    /**
     * @var float
     *
     * @ORM\Column(name="totalAmount", type="float", precision=10, scale=0, nullable=false)
     */
    private $totalamount;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_ID", referencedColumnName="id")
     * })
     */
    private $user;

    public function getIdcommande(): ?int
    {
        return $this->idcommande;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getAmountoutmargin(): ?float
    {
        return $this->amountoutmargin;
    }

    public function setAmountoutmargin(float $amountoutmargin): self
    {
        $this->amountoutmargin = $amountoutmargin;

        return $this;
    }

    public function getCommargin(): ?float
    {
        return $this->commargin;
    }

    public function setCommargin(float $commargin): self
    {
        $this->commargin = $commargin;

        return $this;
    }

    public function getTotalamount(): ?float
    {
        return $this->totalamount;
    }

    public function setTotalamount(float $totalamount): self
    {
        $this->totalamount = $totalamount;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
