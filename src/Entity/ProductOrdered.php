<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * ProductOrdered
 *
 * @ApiResource()
 * @ORM\Table(name="product_ordered", indexes={@ORM\Index(name="order_ID", columns={"commande_ID"}), @ORM\Index(name="product_ID", columns={"product_ID"})})
 * @ORM\Entity
 */
class ProductOrdered
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDPo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpo;

    /**
     * @var int
     *
     * @ORM\Column(name="ShoesSize", type="integer", nullable=false)
     */
    private $shoessize;

    /**
     * @var string
     *
     * @ORM\Column(name="Size", type="string", length=1, nullable=false, options={"fixed"=true})
     */
    private $size;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \Commande
     *
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="commande_ID", referencedColumnName="IDCommande")
     * })
     */
    private $commande;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_ID", referencedColumnName="IDProduit")
     * })
     */
    private $product;

    public function getIdpo(): ?int
    {
        return $this->idpo;
    }

    public function getShoessize(): ?int
    {
        return $this->shoessize;
    }

    public function setShoessize(int $shoessize): self
    {
        $this->shoessize = $shoessize;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }


}
