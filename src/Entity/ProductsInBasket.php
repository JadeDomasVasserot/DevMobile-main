<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * ProductsInBasket
 *
 * @ApiResource()
 * @ORM\Table(name="products_in_basket", indexes={@ORM\Index(name="user_ID", columns={"user_ID"}), @ORM\Index(name="product_ID", columns={"product_ID"})})
 * @ORM\Entity
 */
class ProductsInBasket
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDPib", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpib;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="Size", type="string", length=1, nullable=false, options={"fixed"=true})
     */
    private $size;

    /**
     * @var int
     *
     * @ORM\Column(name="ShoesSize", type="integer", nullable=false)
     */
    private $shoessize;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_ID", referencedColumnName="IDProduit")
     * })
     */
    private $product;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_ID", referencedColumnName="id")
     * })
     */
    private $user;

    public function getIdpib(): ?int
    {
        return $this->idpib;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

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

    public function getShoessize(): ?int
    {
        return $this->shoessize;
    }

    public function setShoessize(int $shoessize): self
    {
        $this->shoessize = $shoessize;

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
