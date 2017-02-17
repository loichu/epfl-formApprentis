<?php
$subject = 'Votre candidature pour une place d\'apprentissage';

$message = "Nous venons d'enregistrer votre candidature et vous remercions de votre intérêt pour la "."\n".
"formation professionnelle à l’Ecole polytechnique fédérale de Lausanne."."\n\n".
"Nous allons étudier votre dossier avec la plus grande attention et nous ne manquerons "."\n".
"pas de vous contacter si votre profil répond à nos attentes."."\n\n";

if($job == "informaticien"){
    $message .= "Afin de faire plus ample connaissance avec vous, nous vous remercions de bien vouloir remplir le questionnaire suivant (~15 minutes) : https://goo.gl/forms/TECDZRA87pR4YskY2" . "\r\n" .
    "Les questions sont ouvertes et nous permettront de mieux vous connaître dans l’éventuelle possibilité de vous proposer un entretien, il n’y a pas de bonnes ou mauvaises réponses." . "\r\n\n";
}

$message .= "Avec nos meilleures salutations."."\n\n".
"Formation Apprentis EPFL";

$headers = 'From: formulaireApprentis@epfl.ch' . "\r\n" .
'Reply-To: formulaireApprentis@epfl.ch' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
?>