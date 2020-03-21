<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $Id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=6)
     * @ORM\Column(type="string", length=255)
     */
    private $Username;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=6)
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=6)
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $LastName;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
    private $Phone;

    /**
     * @Assert\NotBlank
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.")
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="Customer", orphanRemoval=true)
     */
    private $CustomerReservationRelation;

    public function __construct()
    {
        $this->CustomerReservationRelation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->Id;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): self
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getCustomerReservationRelation(): Collection
    {
        return $this->CustomerReservationRelation;
    }

    public function addCustomerReservationRelation(Reservation $customerReservationRelation): self
    {
        if (!$this->CustomerReservationRelation->contains($customerReservationRelation)) {
            $this->CustomerReservationRelation[] = $customerReservationRelation;
            $customerReservationRelation->setCustomer($this);
        }

        return $this;
    }

    public function removeCustomerReservationRelation(Reservation $customerReservationRelation): self
    {
        if ($this->CustomerReservationRelation->contains($customerReservationRelation)) {
            $this->CustomerReservationRelation->removeElement($customerReservationRelation);
            // set the owning side to null (unless already changed)
            if ($customerReservationRelation->getCustomer() === $this) {
                $customerReservationRelation->setCustomer(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->FirstName . " " . $this->LastName . "   Phone: " . $this->Phone . "   Email: " . $this->Address;
    }
}
