<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - TP tableaux</title>
    <link rel="stylesheet" href="styles/minimal-table.css">
</head>

<body>
    <?php
    // initialisation du tableau des noms
    $etudiants = [
        "Alice",
        "Bob",
        "Christine",
        "Denis",
        "Eve",
        "Francis",
        "Gisèle",
        "Henri",
        "Isabelle",
        "Jacques"
    ];

    // initialisation du tableau des notes
    $notes = [2, 2, 14, 10, 10, 20, 2, 10, 10, 20];
    /* $notes = [-19, 0, 0, 0, 0, 0, 0, 0, 0, 42]; */

    // on s'assure que les deux tableaux sont de même longueur
    function sontMemeLongueur($tab1, $tab2)
    {
        return count($tab1) == count($tab2);
    }

    if (!sontMemeLongueur($etudiants, $notes)) {
        echo "
        <p>Attention : les deux tableaux ne sont pas de la même longueur !</p>
        ";
    }

    // -------------------------------------------------------------------------

    // affichage du tableau des notes des étudiants
    // grâce à un tableau HTML

    echo "<h1>Tableau des notes</h1>";

    function afficherTableaux($tab1, $tab2)
    {   
        if (!sontMemeLongueur($tab1, $tab2)) {
            return false;
        }

        // en-tête du tableau
        echo "<table>";

        // pour chaque valeur, on crée une ligne dans le tableau
        // et on l'affiche
        for ($i = 0; $i < count($tab1); $i++) {
            echo "
            <tr>
                <td>$tab1[$i]</td>
                <td>$tab2[$i]</td>
            </tr>
            ";
        }
   
        // on ferme le tableau
        echo "</table>";
    }
    
    afficherTableaux($etudiants, $notes);

    // -------------------------------------------------------------------------

    // calcul de la moyenne
    function calculerMoyenne($notes)
    {
        $somme = 0;
        foreach ($notes as $note) {
            $somme += $note;
        }
        return $somme / count($notes);
    }    
    
    $moyenne = calculerMoyenne($notes);

    // affichage d'icelle
    echo "
    <p>La moyenne des notes obtenues est <strong>$moyenne</strong>.</p>
    ";

    // affichage de la ou des personnes qui ont éventuellement obtenu exactement
    // la moyenne

    function trouveEtudiants($etudiants, $notes, $valeur)
    {
        // retourne la liste des étudiants ayant obtenu une note égale à
        //  la valeur recherchée

        // on trouve les index dans le tableau des notes
        $cles = array_keys($notes, $valeur);

        // on trouve les noms correspondants dans le tableau des noms
        // grâce aux index
        $resultats = [];
        foreach ($cles as $cle) {
            array_push($resultats, $etudiants[$cle]);
        }

        return $resultats;
    }
    
    $etudiants_moyenne = trouveEtudiants($etudiants, $notes, $moyenne);
    
    // affichage du résultat

    function afficherSousGroupeParNote($etudiants, $note)
    {
        $message = "";
        if (count($etudiants) == 0) {
            $message .= "Personne n'a";
        } elseif (count($etudiants) == 1) {
            $message .= $etudiants[0] . " a";
        } else {
            $tous_sauf_un = array_slice(
                $etudiants,
                0,
                count($etudiants) - 1
            );
            $dernier = $etudiants[count($etudiants) - 1];
            $message .= implode(", ", $tous_sauf_un) . " et $dernier ont";
        }
        $message .= " obtenu la note $note.";

        echo "<p>$message</p>";
    }
    
    afficherSousGroupeParNote($etudiants_moyenne, $moyenne);

    // -------------------------------------------------------------------------

    // on recherche les notes minimale et maximale

    // minimale
    function trouverMin($tableau)
    {
        $min = $tableau[0];

        for ($i = 1; $i < count($tableau); $i++) {
            if ($tableau[$i] < $min) {
                $min = $tableau[$i];
            }
        }

        return $min;
    }

    $note_min = trouverMin($notes);

    // on va chercher les noms correspondants
    $etudiants_min = trouveEtudiants($etudiants, $notes, $note_min);

    // on affiche les résultats
    echo "<p>La note minimale est <strong>$note_min</strong>.</p>";
    afficherSousGroupeParNote($etudiants_min, $note_min);

    // maximale
    function trouverMax($tableau)
    {
        $max = $tableau[0];

        for ($i = 1; $i < count($tableau); $i++) {
            if ($tableau[$i] > $max) {
                $max = $tableau[$i];
            }
        }

        return $max;
    }

    $note_max = trouverMax($notes);
    
    // on va chercher les noms correspondants
    $etudiants_max = trouveEtudiants($etudiants, $notes, $note_max);

    // on affiche les résultats
    echo "<p>La note maximale est <strong>$note_max</strong>.</p>";
    afficherSousGroupeParNote($etudiants_max, $note_max);
    ?>
</body>

</html>
