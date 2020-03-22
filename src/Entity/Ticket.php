<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $contact;

     /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $creationDate;

     /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $assignedDate;

     /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $resolvedDate;
    
    /**
     * @var int
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

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


    public function geCreationDate(): ?User
    {
        return $this->creationDate;
    }

    public function setCreationDate(datetime $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getAssignedDate(): ?User
    {
        return $this->assignedDate;
    }

    public function setAssignedDate(?datetime $assignedDate): self
    {
        $this->assignedDate = $assignedDate;

        return $this;
    }

    public function getResolvedDate(): ?User
    {
        return $this->resolvedDate;
    }

    public function setResolvedDate(?datetime $resolvedDate): self
    {
        $this->resolvedDate = $resolvedDate;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
