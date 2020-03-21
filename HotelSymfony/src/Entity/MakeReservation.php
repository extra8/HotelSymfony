<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MakeReservationRepository")
 */
class MakeReservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

     /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     * @Assert\Length(min=3)
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
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
    private $Email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $StartDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $EndDate;

     /**
     * @Assert\NotBlank
     * @Assert\Type(type="integer")
     * @Assert\GreaterThan(value = 0)
     * @ORM\Column(type="integer")
     */
    private $Guests;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->StartDate;
    }

    public function setStartDate(\DateTimeInterface $StartDate): self
    {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->EndDate;
    }

    public function setEndDate(\DateTimeInterface $EndDate): self
    {
        $this->EndDate = $EndDate;

        return $this;
    }

    public function getGuests(): ?int
    {
        return $this->Guests;
    }

    public function setGuests(int $guests): self
    {
        $this->Guests = $guests;

        return $this;
    }

    /**
    * @Assert\IsTrue(message="Date de venire/plecare invalide")
    */
    public function isReservationOk()
    {
        return $this->EndDate > $this->StartDate;
    }
}
