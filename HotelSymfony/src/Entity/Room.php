<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $Id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="boolean")
     */
    private $isAirConditioned;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="boolean")
     */
    private $HasBalcony;

    /**
     * @Assert\Type(type="integer")
     * @Assert\GreaterThan(value = 0)
     * @ORM\Column(type="integer")
     */
    private $Capacity;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="Room", orphanRemoval=true)
     */
    private $RoomReservationRelation;

    public function __construct()
    {
        $this->RoomReservationRelation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->Id;
    }

    public function getIsAirConditioned(): ?bool
    {
        return $this->isAirConditioned;
    }

    public function setIsAirConditioned(bool $isAirConditioned): self
    {
        $this->isAirConditioned = $isAirConditioned;

        return $this;
    }

    public function getHasBalcony(): ?bool
    {
        return $this->HasBalcony;
    }

    public function setHasBalcony(bool $HasBalcony): self
    {
        $this->HasBalcony = $HasBalcony;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->Capacity;
    }

    public function setCapacity(int $Capacity): self
    {
        $this->Capacity = $Capacity;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getRoomReservationRelation(): Collection
    {
        return $this->RoomReservationRelation;
    }

    public function addRoomReservationRelation(Reservation $roomReservationRelation): self
    {
        if (!$this->RoomReservationRelation->contains($roomReservationRelation)) {
            $this->RoomReservationRelation[] = $roomReservationRelation;
            $roomReservationRelation->setRoom($this);
        }

        return $this;
    }

    public function removeRoomReservationRelation(Reservation $roomReservationRelation): self
    {
        if ($this->RoomReservationRelation->contains($roomReservationRelation)) {
            $this->RoomReservationRelation->removeElement($roomReservationRelation);
            // set the owning side to null (unless already changed)
            if ($roomReservationRelation->getRoom() === $this) {
                $roomReservationRelation->setRoom(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Id . " Capacity: " . $this->Capacity . " Balcony: " . $this->HasBalcony . " Air conditioned: " . $this->isAirConditioned;
    }
}
