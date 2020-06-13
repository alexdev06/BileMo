<?php

namespace App\Entity;

use Swagger\Annotations as SWG;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 *  Represents a customer of the client application
 * 
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * @UniqueEntity(
 *      fields={"email"}),
 *      message="The email is unavailable!"
 * )
 * 
 * @ORM\HasLifecycleCallbacks
 * 
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "customer_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = "list")
 * )
 * 
 * @Hateoas\Relation(
 *      "add",
 *      href = @Hateoas\Route(
 *          "customer_add",
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"list", "detail"})
 * )
 * 
 * @Hateoas\Relation(
 *      "delete",
 *      href = @Hateoas\Route(
 *          "customer_delete",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      ),
 *      exclusion = @Hateoas\Exclusion(groups = {"list", "detail"})
 * )
 * 
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"detail", "list"})
     * @SWG\Property(description="The identifier of a customer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(groups={"add"})
     * @Serializer\Groups({"detail", "list", "add"})
     * @SWG\Property(description="The firstname of a customer")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(groups={"add"})
     * @Serializer\Groups({"detail", "list", "add"})
     * @SWG\Property(description="The lastname of a customer")
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message = "The email value is not a valid email !", groups={"add"})
     * @Serializer\Groups({"detail", "list", "add"})
     * @SWG\Property(description="The email address of a customer")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(groups={"add"})
     * @Serializer\Groups("add")
     * @SWG\Property(description="The hashed password of the customer")
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     * @Serializer\Groups({"detail"})
     * @SWG\Property(description="The registration date of a customer")
     */
    private $registeredAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="customers")
     * @ORM\JoinColumn(nullable=false)
     * @SWG\Property(description="The client owner of a customer")
     * 
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRegisteredAt(): ?\DateTimeInterface
    {
        return $this->registeredAt;
    }

    public function setRegisteredAt(\DateTimeInterface $registeredAt): self
    {
        $this->registeredAt = $registeredAt;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /** 
     * Add date to the registeredAt attribut when a customer is created
     * 
     * @ORM\PrePersist
    */
    public function registrationDate()
    {
        if (empty($this->registeredAt)) {
            $this->registeredAt = new \DateTime();
        }
    }
}
