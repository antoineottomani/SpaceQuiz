<?php

namespace App\Model\Manager;

use SpaceQuiz\Manager;
use App\Model\Entity\User;
use DateTime;

class UserManager extends Manager
{

    // Ajout d'un user en bdd
    public function add(User $user): void
    {
        $sql = 'INSERT INTO user (login, hash_password, created_at, updated_at) VALUES (:login, :hash_password, :created_at, :updated_at)';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'login' => $user->getLogin(),
            'hash_password' => $user->getHash_password(),
            'created_at' => date_format(new \DateTime('NOW'), 'Y-m-d H:i:s'),
            'updated_at' => date_format(new \DateTime('NOW'), 'Y-m-d H:i:s')

        ]);
    }

    // Cherche un user par son id
    public function find(int $id): ?User
    {
        $sql = 'SELECT * FROM user WHERE id = :id';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
        $user = $query->fetch();
        if (!$user || empty($user)) {
            return null;
        }
        return new User($user);
    }

    // Permet de vérifier si un pseudo est déjà associé à un user. 
    public function findByLogin(string $login): ?User
    {
        $sql = 'SELECT * FROM user WHERE user.login = :login';
        $query = $this->connection->prepare($sql);
        $query->execute([
            'login' => $login
        ]);
        $user = $query->fetch();
        if (!$user || empty($user)) {
            return null;
        }
        return new User($user);
    }

    // Permet de modifier un login 
    public function editLogin(User $user): void
    {
        $sql = 'UPDATE 
                    user 
                SET
                    login = :login, 
                    hash_password = :hash_password, 
                    updated_at = :updated_at
                   
                WHERE 
                    id = :id';

        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $user->getId(),
            'login' => $user->getLogin(),
            'hash_password' => $user->getHash_password(),
            'updated_at' => date_format(new \DateTime('NOW'), 'Y-m-d H:i:s')
        ]);
    }
	
	public function getAllUsers(): ?array
	{
		$sql = 'SELECT id, login, role, updated_at FROM user';
        $query = $this->connection->prepare($sql);
        $query->execute();
        $users = $query->fetchAll();
		$userList = [];
        foreach ($users as $user) {
            array_push($userList, new User($user));
        }
        return $userList;
	}
	
	
	// Permet de modifier le role d'un utilisateur 
    public function changeRole(int $userId =0, string $role='user'): void
    {
        $sql = 'UPDATE 
                    user 
                SET
                    role= :role
                   
                WHERE 
                    id = :id';

        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $userId,
            'role' => $role
        ]);
    }
	
	
}