<section class="users-section">

    <div class="back-btn">
        <a title="Bouton pour revenir en arrière" class="return" href="?page=admin_panel"><i
                class="fa-solid fa-chevron-left"></i></a>
    </div>

    <div class="content">

        <h1>Gestion des utilisateurs</h1>

        <?php if (isset($data['message']) && $data['message'] != "") { ?>
        <blockquote><?= $data['message']; ?></blockquote>
        <?php } ?>

        <div class="users-list">

            <form action="" method="post">

                <table>

                    <thead>
                        <tr>
                            <th>Login</th>
                            <th>Rôle</th>
                            <th>Dernière connexion</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($data['userList'] as $user) { ?>
                        <tr>
                            <td><?= $user->getLogin(); ?></td>
                            <td>
                                <label for="admin">Admin</label>
                                <input type="radio" name="role<?= $user->getId(); ?>" id="admin" value="admin"
                                    <?php if ($user->getRole() == 'admin') echo "checked"; ?>>

                                <label for="user">Utilisateur</label>
                                <input type="radio" name="role<?= $user->getId(); ?>" id="user" value="user"
                                    <?php if ($user->getRole() == 'user') echo "checked"; ?>>
                            </td>
                            <td><?php print_r($user->getUpdatedAt()->format("d/m/Y à H:i:s")); ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>

                    <tfoot></tfoot>

                </table>

                <button type="submit" class="edit-users">Modifier</button>

            </form>

        </div>

    </div>


</section>