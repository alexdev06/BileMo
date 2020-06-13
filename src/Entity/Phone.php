<?php

namespace App\Entity;

use Hateoas\Configuration\Annotation as Hateoas;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as Serializer;
use Swagger\Annotations as SWG;


/**
 *  Represents a phone product listed in API database
 * 
 * @ORM\Entity(repositoryClass="App\Repository\PhoneRepository")
 * @UniqueEntity(
 *      fields={"internalReference"}),
 *      message="The internal reference number already exists !"
 * )
 * 
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "phone_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = "list")
 * )
 */
class Phone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"detail", "list"})
     * @SWG\Property(description="The identifier of a phone")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Groups({"detail", "list"})
     * @SWG\Property(description="The model name of a phone")
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Groups({"detail", "list"})
     * @SWG\Property(description="The internal memory size of a phone")
     */
    private $memory;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Serializer\Groups({"detail", "list"})
     * @SWG\Property(description="The color of a phone")
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2)
     * @Serializer\Groups({"detail"})
     * @SWG\Property(description="The network bands of a phone")
     */
    private $network;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10)
     * @Serializer\Groups({"detail"})
     * @SWG\Property(description="The description of a phone")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     * @Serializer\Groups({"detail", "list"})
     * @SWG\Property(description="The Euro price of a phone")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Serializer\Groups({"detail", "list"})
     * @SWG\Property(description="The internal reference of a phone")
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
