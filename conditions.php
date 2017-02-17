<!doctype html>
<html lang="fr">
    <head>  
        <?php include('templates/head.php');
            include('templates/isPostulationOpen.php');
        ?>
        <title>Conditions</title>
    </head>
    <body>
    <div class="page-style">
        <?php include('templates/header.php') ?>
        <legend><h2>Conditions</h2></legend>
        <label for ="cond">Les annexes doivent inclure:</label>
        <ul id="cond">
            <li>Lettre de motivation</li>
            <li>Curriculum Vitae avec indication des références</li>
            <li>Copie des bulletins scolaires des 3-4 derniers semestres</li>
            <li>Copies des certificats, diplômes obtenus, attestations de stages</li>
            <li>Copie carte d'identité</li>
            <li>Photo passeport couleur</li>
            <li>Pour les apprentissages de polymécanicien-ne, une attestation de test d'aptitudes GIM-CH est <strong>recommandée</strong></li>
            <li>Pour les apprentissages d'informaticien, une attestation de test d'aptitudes GRI est <strong>recommandée</strong></li>
        </ul>
        
        <legend><h3>Renseignements</h3></legend>
        <table>
            <tr>
                <td>Francis Perritaz</td>
            </tr>
            <tr>
                <td>Chef formation apprentis</td>
            </tr>
            <tr>
                <td>Téléphone : 021 693 31 19</td>
            </tr>
            <tr>
                <td>formation.apprentis@epfl.ch</td>
            </tr>
            <tr>
                <td>http://apprentis.epfl.ch</td>
            </tr>
        </table>
       <p id="incomplet"> Tout dossier incomplet ou non conforme ne sera pas pris en considération ! </p>
    </div>
    </body>
</html>