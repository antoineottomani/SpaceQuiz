<?php

// Cette class contient les informations de la table 'answer' de la bdd

namespace App\Model\Entity;

class Answer
{
    private ?int $id;
    private ?string $text;
    private ?int $id_question;
    private ?int $is_correct;


    // Le constructeur va renvoyer un tableau avec les propriétés définies au dessus
    public function __construct(array $answerProperties)
    {
        if (isset($answerProperties['id']))
            $this->id = (int) $answerProperties['id'];
        if (isset($answerProperties['text']))
            $this->text = (string) $answerProperties['text'];
        if (isset($answerProperties['id_question']))
            $this->id_question = (int) $answerProperties['id_question'];
        if (isset($answerProperties['is_correct']))
            $this->is_correct = (int) $answerProperties['is_correct'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function getIdQuestion(): ?int
    {
        return $this->id_question;
    }

    public function setIdQuestion(int $id_question): void
    {
        $this->id_question = $id_question;
    }

    public function getIsCorrect(): ?int
    {
        return $this->is_correct;
    }

    public function setIsCorrect(int $is_correct): void
    {
        $this->is_correct = $is_correct;
    }
}