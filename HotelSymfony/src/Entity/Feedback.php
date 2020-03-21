<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedbackRepository")
 */
class Feedback
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $Id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=10)
     * @ORM\Column(type="text")
     */
    private $Message;

    /**
     * @Assert\NotBlank
     * @Assert\Type(type="integer")
     * @ORM\Column(type="integer")
     */
    private $Score;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Reservation", mappedBy="FeedbackId", cascade={"persist", "remove"})
     */
    private $Reservation;

    public function getId(): ?int
    {
        return $this->Id;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(string $Message): self
    {
        $this->Message = $Message;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->Score;
    }

    public function setScore(int $Score): self
    {
        $this->Score = $Score;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->Reservation;
    }

    public function setReservation(Reservation $Reservation): self
    {
        $this->Reservation = $Reservation;

        // set the owning side of the relation if necessary
        if ($Reservation->getFeedbackReservationRelation() !== $this) {
            $Reservation->setFeedbackReservationRelation($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Id .  " Score: " . $this->Score;
    }
}
