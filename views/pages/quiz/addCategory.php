<section class="add-category">

    <div class="back-btn">
        <a title="Bouton pour revenir en arrière" class="return" href="?page=category_panel"><i
                class="fa-solid fa-chevron-left"></i></a>
    </div>

    <h1>Ajouter une catégorie</h1>

    <form method="post" enctype="multipart/form-data">

        <input type="text" name="theme" placeholder="Thème de la catégorie" />
        <input type="file" name="cover" />
        <input type="text" name="description" placeholder="Description de la catégorie" />

        <div class="choice-one">
            <input type="radio" value="1" name="user_only" checked />
            <p>Catégorie disponible pour l'utilisateur connecté</p>
        </div>

        <div class="choice-two">
            <input type="radio" value="0" name="user_only" />
            <p>Catégorie disponible pour tous</p>
        </div>

        <button type="submit" class="submit-btn">Ajouter</button>

    </form>

</section>