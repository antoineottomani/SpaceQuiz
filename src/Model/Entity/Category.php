<?php

// Cette class retranscrit les informations de la table 'category' de la bdd

namespace App\Model\Entity;

class Category
{

    private ?int $id;
    private ?string $theme;
    private ?string $cover;
    private ?string $description;
    private ?int $user_only;

    // Le constructeur va renvoyer un tableau avec les propriétés définies au dessus
    public function __construct(array $categoryProperties)
    {
        if (isset($categoryProperties['id']))
            $this->id = (int) $categoryProperties['id'];

        if (isset($categoryProperties['theme']))
            $this->theme = (string) $categoryProperties['theme'];

        if (isset($categoryProperties['cover']))
            $this->cover = (string) $categoryProperties['cover'];

        if (isset($categoryProperties['description']))
            $this->description = (string) $categoryProperties['description'];

        if (isset($categoryProperties['user_only']))
            $this->user_only = (int) $categoryProperties['user_only'];
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): void
    {
        $this->theme = $theme;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): void
    {
        $this->cover = $cover;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getUserOnly(): ?int
    {
        return $this->user_only;
    }

    public function setUserOnly(?int $user_only): void
    {
        $this->user_only = $user_only;
    }
}