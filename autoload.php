<?php

//Ce fichier utilise une fonction native de php pour importer
// automatiquement une classe dès qu'elle est utilisée

const ALIASES = [
    'SpaceQuiz' => 'lib',
    'App'       => 'src'
];

spl_autoload_register(function (string $class): void {
    $namespaceParts = explode('\\', $class);

    // On compare 2 tableaux, renvoie true ou false si le 1er param se retrouve dans le 2e paramètre
    if (in_array($namespaceParts[0], array_keys(ALIASES))) {
        $namespaceParts[0] = ALIASES[$namespaceParts[0]];
    } else {
        throw new Exception('Invalide namespace "' . $namespaceParts[0] . '". S\'attend à "SpaceQuiz" ou "App"');
    }
    $filepath = implode('/', $namespaceParts) . '.php';
    if (!file_exists($filepath)) {
        throw new Exception("Impossible de trouver le fichier " . $filepath . " pour la classe " . $class . ". Vérifier le chemin du fichier, le nom de la classe ou le namespace.");
    }


    require $filepath;
});