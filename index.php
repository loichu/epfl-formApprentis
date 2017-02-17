<!doctype html>
<html lang="fr">
    <head>
        <title>Accueil</title>
        <?php include('templates/head.php');
        include('templates/isPostulationOpen.php');
        session_unset();
        ?>
    </head>
    <body>
    <div class="page-style">
        <?php include('templates/header.php');?>

        <p class="paracenter">Veuillez suivre les indications suivantes</p>
        <ul>
            <li>Créer un compte pour personnes externes (et valider par email)</li>
            <li>Se connecter avec le compte précédemment créé</li>
            <li>Lorsque la connexion sera effectuée, vous serez redirigé-e vers le formulaire de candidature</li>
        </ul>
        <button id="createAc" class="index-button-style  mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonIndexStyle">
            Créer un compte
        </button>
        <button id="connectB" class="index-button-style  mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonIndexStyle">
            Se connecter
        </button>
    </div>
    </body>
</html>
