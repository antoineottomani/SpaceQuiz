<?php

// Cette classe retranscrit les informations de la table 'question' de la bdd

namespace App\Model\Entity;

class Question
{

    private int $id;
    private string $title;
    private string $illustration;
    private string $illustrationTitle;
    private int $idCategory;

    // Le constructeur va renvoyer un tableau avec les propriétés définies au dessus
    public function __construct(?array $questionProperties = [])
    {
        if (isset($questionProperties['id']))
            $this->id = (int) $questionProperties['id'];

        if (isset($questionProperties['title']))
            $this->title = (string) $questionProperties['title'];

        if (isset($questionProperties['illustration']))
            $this->illustration = (string) $questionProperties['illustration'];

        if (isset($questionProperties['illustration_title']))
            $this->illustrationTitle = (string) $questionProperties['illustration_title'];

        if (isset($questionProperties['id_category']))
            $this->idCategory = (int) $questionProperties['id_category'];
    }



    // Méthodes de la classe Question 


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getIllustration(): string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): void
    {
        $this->illustration = $illustration;
    }

    public function getIllustrationTitle(): string
    {
        return $this->illustrationTitle;
    }

    public function setIllustrationTitle(string $illustrationTitle): void
    {
        $this->illustrationTitle = $illustrationTitle;
    }

    public function getIdCategory(): int
    {
        return $this->idCategory;
    }

    public function setIdCategory(int $idCategory): void
    {
        $this->idCategory = $idCategory;
    }
}