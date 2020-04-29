<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass="App\Repository\PhoneRepository")
 * @UniqueEntity(
 *      fields={"internalReference"}),
 *      message="The internal reference number already exists !"
 * )
 */
class Phone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $memory;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2)
     */
    private $network;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $internalReference;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getMemory(): ?string
    {
        return $this->memory;
    }

    public function setMemory(string $memory): self
    {
        $this->memory = $memory;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getNetwork(): ?string
    {
        return $this->network;
    }

    public function setNetwork(string $network): self
    {
        $this->network = $network;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getInternalReference(): ?string
    {
        return $this->internalReference;
    }

    public function setInternalReference(string $internalReference): self
    {
        $this->internalReference = $internalReference;

        return $this;
    }
}
