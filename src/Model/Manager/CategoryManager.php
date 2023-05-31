<?php

namespace App\Model\Manager;

use SpaceQuiz\Manager;
use App\Model\Entity\Category;

class CategoryManager extends Manager
{

    public function categoryInit(): ?Category
    {
        $category = array();
        return new Category($category);
    }


    // Méthode qui va obtenir une catégorie par son id 
    public function getCategoryById(int $id): ?Category // Prend un id en paramètre
    {

        $sql = "SELECT * FROM category WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $id
        ]);

        $category = $query->fetch();
        if (!$category || empty($category)) {
            return null;
        }
        return new Category($category);
    }

    public function getAllCategories(int $connected = 0, bool $backOffice = false): ?array // Retourne un tableau avec toutes les catégories
    {
        if ($backOffice) {
            $sql = 'SELECT id, theme, cover, description FROM category';
        } else {

            if (!$connected) {
                $sqlCondition = " AND c.user_only = " . $connected;
                $sqlCondition2 = " ORDER BY RAND() LIMIT 0, 4 ";
            } else {
                $sqlCondition = "";
                $sqlCondition2 = " ORDER BY RAND() ";
            }

            $sql = 'SELECT c.id, c.theme, c.cover, c.description FROM category c, question q WHERE q.id_category = c.id' . $sqlCondition  . ' GROUP BY c.id' . $sqlCondition2;
        }

        $query = $this->connection->query($sql);
        $arrayCategories = $query->fetchAll();
        if (!$arrayCategories || empty($arrayCategories)) {
            return array();
        }

        $categoriesObjects = [];
        foreach ($arrayCategories as $element) {
            array_push($categoriesObjects, new Category($element));
        }
        return $categoriesObjects;
    }

    public function deleteCategory(int $id): void
    {
        $sql =  "DELETE FROM category WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->execute([
            'id' => $id
        ]);
    }
}