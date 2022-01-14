<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * ProductCategory
 *
 * @ApiResource()
 * @ORM\Table(name="product_category", indexes={@ORM\Index(name="Product_ID", columns={"Product_ID"}), @ORM\Index(name="Cat_ID", columns={"Cat_ID"})})
 * @ORM\Entity
 */
class ProductCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDPc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpc;

    /**
     * @var \Category
     *
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Cat_ID", referencedColumnName="IDCat")
     * })
     */
    private $cat;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Product_ID", referencedColumnName="IDProduit")
     * })
     */
    private $product;

    public function getIdpc(): ?int
    {
        return $this->idpc;
    }

    public function getCat(): ?Category
    {
        return $this->cat;
    }

    public function setCat(?Category $cat): self
    {
        $this->cat = $cat;

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
