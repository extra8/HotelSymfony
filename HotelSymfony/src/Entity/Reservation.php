<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $Id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $StartDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $EndDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="CustomerReservationRelation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Customer;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Feedback", inversedBy="Reservation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $FeedbackId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Room", inversedBy="RoomReservationRelation")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Room;

    public function getId(): ?int
    {
        return $this->Id;
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

    public function getCustomer(): ?Customer
    {
        return $this->Customer;
    }

    public function setCustomer(?Customer $Customer): self
    {
        $this->Customer = $Customer;

        return $this;
    }

    public function getFeedbackId(): ?Feedback
    {
        return $this->FeedbackId;
    }

    public function setFeedbackId(Feedback $FeedbackId): self
    {
        $this->FeedbackId = $FeedbackId;

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->Room;
    }

    public function setRoom(?Room $Room): self
    {
        $this->Room = $Room;

        return $this;
    }

    public function __toString()
    {
        return $this->Id . " " . $this->Customer . " " . $this->Room;
    }

    /**
    * @Assert\IsTrue(message="Date de venire/plecare invalide")
    */
    public function isReservationOk()
    {
        return $this->EndDate > $this->StartDate;
    }
}
