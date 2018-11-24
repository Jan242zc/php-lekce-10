<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Supplier;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Manufacturer", inversedBy="products")
     */
    private $manufacturer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Supplier", inversedBy="products")
     */
    private $Supplier;

    public function __construct()
    {
        $this->Supplier = new ArrayCollection();
    }
    
    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): self
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    /**
     * @return Collection|Supplier[]
     */
    public function getSupplier(): Collection
    {
        return $this->Supplier;
    }

    public function addSupplier(Supplier $supplier): self
    {
        if (!$this->Supplier->contains($supplier)) {
            $this->Supplier[] = $supplier;
        }

        return $this;
    }

    public function removeSupplier(Supplier $supplier): self
    {
        if ($this->Supplier->contains($supplier)) {
            $this->Supplier->removeElement($supplier);
        }

        return $this;
    }
}
