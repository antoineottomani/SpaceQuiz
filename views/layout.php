<!DOCTYPE html>

<!-- SQUELETTE HTML COMMUN À TOUTES LES VUES -->

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($data['title'])) echo $data['title'] . " - "; ?>SpaceQuiz</title>

    <!-- CSS -->
    <link rel="stylesheet" href="./public/css/style.css" type="text/css" />

    <!-- JAVASCRIPT -->
    <script src="./public/js/main.js" defer></script>

    <!-- FONTAWESOME -->
    <script src="https://kit.fontawesome.com/285a02fe9d.js" crossorigin="anonymous"></script>

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="./public/img/main/logo.png" />
</head>

<body>

    <!-- INCLUSION DU HEADER -->
    <?php require_once './views/partials/_header.php'; ?>


    <!-- INCLUSION DU CONTENU DES PAGES CHARGÉES -->
    <main>
        <?php require $templatePath; ?>
    </main>


    <!-- INCLUSION DU FOOTER -->
    <?php require_once './views/partials/_footer.php'; ?>


</body>

</html>