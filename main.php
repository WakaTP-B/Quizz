
<?php

$questions = [
    "I- Quelle est la couleur du cheval blanc d'Henri IV?\n1.Blanc\n2.Rouge\n3.Noir\n",
    "II- Date de la prise de la Bastille ?\n1.1750\n2.1789\n3.1800\n",
    "III -Quel est le plus grand océan du monde ?\n1.Océan Atlantique\n2.Océan Indien\n3.Océan Pacifique\n",
    "IV- Qui a écrit Les Misérables ?\n1.Victor Hugo\n2.Emile Zola\n3.Marcel Proust\n",
    "V- Quelle est la capitale de l'Australie ?\n1.Sydney\n2.Melbourne\n3.Canberra\n",
    "VI -La planete Terre est-elle ?\n1.Plate\n2.En forme de triange.\n3.Ronde"
];

$reponses = [1, 2, 3, 1, 3, 3];
$score = 0;
$nb_questions = count($questions);
$scoreMax = $nb_questions * 10;
$save = fopen("save.txt", "a+");


if (filesize("save.txt") === 0) {
    $lastLine = "Aucun score enregistré";
} else {
    $lastScore = file("save.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $lastLine = end($lastScore);
}
echo "Bienvenue au QUIZZ !\n\nTon dernier score est de : $lastLine\n\n";

function askReponse()
{
    do {
        echo "Répondez par 1, 2 ou 3 : ";
        $userAnswer = (int)trim(fgets(STDIN));

        if (in_array($userAnswer, [1, 2, 3])) {
            return $userAnswer;
        } else {
            echo "Réponse invalide. Répondez par 1, 2 ou 3.\n";
        }
    } while (true);
}


for ($i = 0; $i < $nb_questions; $i++) {
    echo $questions[$i] . "\n";
    $userAnswer = askReponse();
    if ((int)$userAnswer == $reponses[$i]) {
        $score += 10;
        echo "\nBien joué !\nVous avez gagné 10 points! Votre score est de : $score\n\n";
    } else {
        echo "\nMauvaise réponse !\nVous n'avez pas gagné de points, votre score est de  : $score\n\n";
    }
}


$scorePercent = ($score / $scoreMax) * 100;

echo "Pourcentage de bonne réponse : $scorePercent %\n";

if ($scorePercent >= 50) {
    echo "Félicitations !!! Vous avez gagné !!!\n";
} else {
    echo "Dommage, vous ferez mieux la prochaine fois\n";
}

fwrite($save, "Score : $score pts\n");
fclose($save);


?>