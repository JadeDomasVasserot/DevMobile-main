<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * Product
 *
 * @ApiResource()
 * @ORM\Table(name="product", indexes={@ORM\Index(name="categorie_ID", columns={"categorie_ID"})})
 * @ORM\Entity
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDProduit", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproduit;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=30, nullable=false)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="unitPrice", type="float", precision=10, scale=0, nullable=false)
     */
    private $unitprice;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=250, nullable=false)
     */
    private $picture;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie_ID", referencedColumnName="IDCat")
     * })
     */
    private $categorie;

    public function getIdproduit(): ?int
    {
        return $this->idproduit;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUnitprice(): ?float
    {
        return $this->unitprice;
    }

    public function setUnitprice(float $unitprice): self
    {
        $this->unitprice = $unitprice;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCategorie(): ?Category
    {
        return $this->categorie;
    }

    public function setCategorie(?Category $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function __toString() {
        return $this->name;
    }


}
