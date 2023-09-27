<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    private ?Horse $commentaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?Horse
    {
        return $this->commentaire;
    }

    public function setCommentaire(?Horse $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
