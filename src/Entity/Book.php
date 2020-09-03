<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Calendar::class, mappedBy="book")
     */
    private $day;

    public function __construct()
    {
        $this->day = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Calendar[]
     */
    public function getDay(): Collection
    {
        return $this->day;
    }

    public function addDay(Calendar $day): self
    {
        if (!$this->day->contains($day)) {
            $this->day[] = $day;
            $day->setBook($this);
        }

        return $this;
    }

    public function removeDay(Calendar $day): self
    {
        if ($this->day->contains($day)) {
            $this->day->removeElement($day);
            // set the owning side to null (unless already changed)
            if ($day->getBook() === $this) {
                $day->setBook(null);
            }
        }

        return $this;
    }
}
