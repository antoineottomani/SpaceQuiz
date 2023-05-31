<?php

namespace App\Model\Entity;

// Cette classe retranscrit les informations de la table 'user' de la bdd

class User
{

    private int $id;
    private string $login;
    private string $hash_password;
    private string $role;
    private \DateTime $createdAt;
    private \DateTime $updatedAt;

    // Le constructeur va renvoyer un tableau avec les propriétés définies au dessus
    public function __construct(?array $userProperties = [])
    {
        if (isset($userProperties['id']))
            $this->id = $userProperties['id'];
        if (isset($userProperties['login']))
            $this->login = $userProperties['login'];
        if (isset($userProperties['hash_password']))
            $this->hash_password = $userProperties['hash_password'];
        if (isset($userProperties['role']))
            $this->role = $userProperties['role'];
        if (isset($userProperties['created_at']))
            $this->createdAt = new \DateTime($userProperties['created_at']);
        if (isset($userProperties['updated_at']))
            $this->updatedAt = new \DateTime($userProperties['updated_at']);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getHash_password(): string
    {
        return $this->hash_password;
    }

    public function setHash_password(string $hash_password): void
    {
        $this->hash_password = $hash_password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getCreatedAt(): \Datetime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\Datetime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \Datetime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\Datetime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}