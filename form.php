<?php
    require_once("tequila/tequila.php");
    $oClient = new TequilaClient();
    $oClient->SetApplicationName('Formulaire apprentissage');
    $oClient->SetWantedAttributes(array('uniqueid','firstname','name'));
    $oClient->SetWishedAttributes(array('user'));
    $oClient->SetAllowsFilter('categorie=epfl-guests');
    $oClient->Authenticate();
    $user = $oClient->getValue('user');
    $firstname= $oClient->getValue('firstname');
    $name= $oClient->getValue('name');
    $sKey = $oClient->GetKey();

    include('templates/isPostulationOpen.php');
?>
<!doctype html>
    <html lang="fr">
        <head>
            <title>Formulaire Apprentissage</title>
            <?php include('templates/head.php'); ?>
        </head>
    <body>
        <div class="page-style">
        <?php include('templates/header.php') ?>
        <p class="paracenter">Les champs notés d'un astérisque* doivent être obligatoirement remplis.</p>
        <form method ="post" action="cible.php" enctype="multipart/form-data">
            <fieldset>
                <legend><span class="number">1</span> Apprentissage</legend>
                <label for="job">Je suis intéressé par la formation de*: </label>

                <select name ="job" id="jb" required>
                    <option value="menu" <?php echo (!isset($_SESSION['postedForm']['job'])) ? "selected" : ''; ?> disabled>Choisir une formation...</option>
                    <option value="laborantinBiologie" <?php echo ($_SESSION['postedForm']['job'] == "laborantinBiologie") ? "selected" : ''; ?>>Laborantin-e CFC; option biologie</option>
                    <option value="laborantinChimie" <?php echo ($_SESSION['postedForm']['job'] == "laborantinChimie") ? "selected" : ''; ?>>Laborantin-e CFC; option chimie</option>
                    <option value="laborantinPhysique" <?php echo ($_SESSION['postedForm']['job'] == "laborantinPhysique") ? "selected" : ''; ?>>Laborantin-e CFC; option physique</option>
                    <option value="polyMecanicien" <?php echo ($_SESSION['postedForm']['job'] == "polyMecanicien") ? "selected" : ''; ?>>Polymécanicien-ne CFC</option>
                    <option value="informaticien" <?php echo ($_SESSION['postedForm']['job'] == "informaticien") ? "selected" : ''; ?>>Informaticien-ne CFC</option>
                    <option value="logisticien" <?php echo ($_SESSION['postedForm']['job'] == "logisticien") ? "selected" : ''; ?>>Logisticien-ne CFC</option>
                    <option value="planificateurElectricien" <?php echo ($_SESSION['postedForm']['job'] == "planificateurElectricien") ? "selected" : ''; ?>>Planificateur-trice éléctricien-ne CFC</option>
                    <option value="employeCommerce" <?php echo ($_SESSION['postedForm']['job'] == "employeCommerce") ? "selected" : ''; ?>>Employé-e de commerce CFC</option>
                    <option value="gardienAnimaux" <?php echo ($_SESSION['postedForm']['job'] == "gardienAnimaux") ? "selected" : ''; ?>>Gardien-ne d'animaux CFC</option>
                    <option value="electronicien" <?php echo ($_SESSION['postedForm']['job'] == "electronicien") ? "selected" : ''; ?>>Electronicien-ne CFC</option>
                    <option value="interactiveMediaDesigner" <?php echo ($_SESSION['postedForm']['job'] == "interactiveMediaDesigner") ? "selected" : ''; ?>>Interactive Media Designer CFC</option>
                </select>
            </fieldset>
            <div id="all" style="display: none;">
                <fieldset>
                    <div id="infoOnly">
                        <?php include('templates/filieresinfos.php') ?>
                    </div>
                    <label for="mpt">Je désire m'inscire en maturité professionelle intégrée*:</label><p>
                    <dl class="radio-list-left">
                        <dd>
                            <input type="radio" name="mpt" id="mpt1" value="false" <?php echo (!isset($_SESSION['postedForm']['mpt']) || $_SESSION['postedForm']['mpt'] == "false") ? "checked=\"checked\"" : ''; ?>>
                            <label for="mpt1">Non</label>
                        </dd>
                        <dd>
                            <input type="radio" name="mpt" id="mpt2" value="true" <?php echo ($_SESSION['postedForm']['mpt'] == "true") ? "checked=\"checked\"" : ''; ?>>
                            <label for="mpt2">Oui</label>
                        </dd>
                    </dl>
                </fieldset>
                <fieldset>
                    <legend><span class="number">2</span> Données </legend>
                        <fieldset>
                            <legend><span class="number">2.1</span> Données personnelles</legend>
                            <select name="genreApp" id="genreApp">
                                <option value="notSelected" <?php echo (!isset($_SESSION['postedForm']['genreApp'])) ? "selected" : ''; ?> disabled> Choisissez un genre*</option>
                                <option value="Homme" <?php echo ($_SESSION['postedForm']['genreApp'] == "Homme") ? "selected" : ''; ?>>Homme</option>
                                <option value="Femme" <?php echo ($_SESSION['postedForm']['genreApp'] == "Femme") ? "selected" : ''; ?>>Femme</option>
                            </select>
                            <input type="text" name="nameApp" placeholder="Nom *" value="<?php echo $name;?>" readonly />
                            <input type="text" name="surnameApp" placeholder="Prénom *" value="<?php echo $firstname;?>" readonly />
                            <input type="text" name="adrApp" placeholder="Rue *" <?php echo $_SESSION['postedForm']['adrApp'] != '' ? $_SESSION['postedForm']['adrApp'] : ''; ?> minlength="2" maxlength="40" required/>
                            <input type="text" name="NPAApp" placeholder="NPA\Domicile *" <?php echo $_SESSION['postedForm']['NPAApp'] != '' ? $_SESSION['postedForm']['NPAApp'] : ''; ?>  minlength="2" maxlength="40" required/>
                            <input type="tel" name="telApp" placeholder="Téléphone (+41 21 123 45 67) *" <?php echo $_SESSION['postedForm']['telApp'] != '' ? $_SESSION['postedForm']['telApp'] : ''; ?> minlength="2"  maxlength="20" required/>
                            <input type="tel" name="phoneApp" placeholder="Mobile (+41 79 123 45 67) *" <?php echo $_SESSION['postedForm']['phoneApp'] != '' ? $_SESSION['postedForm']['phoneApp'] : ''; ?> minlength="2" maxlength="20" required/>
                            <input type="email" name="mailApp" id="mailApp" value="<?php echo $user;?>" readonly />
                            <input type="text" name="birthApp" id="birthApp" placeholder="Date de naissance*" <?php echo $_SESSION['postedForm']['birthApp'] != '' ? $_SESSION['postedForm']['birthApp'] : ''; ?> required />
                            <section id="errorMsg"></section>
                            <input type="text" name="originApp" placeholder="Lieu d'origine *" <?php echo $_SESSION['postedForm']['originApp'] != '' ? $_SESSION['postedForm']['originApp'] : ''; ?> minlength="2" maxlength="35" required />
                            <input type="text" name="nationApp" placeholder="Nationalité *" <?php echo $_SESSION['postedForm']['nationApp'] != '' ? $_SESSION['postedForm']['nationApp'] : ''; ?> minlength="2" maxlength="30" required />
                            <input type="text" name="permisEtrangerApp" placeholder="Catégorie de permis pour étrangers "  <?php echo $_SESSION['postedForm']['permisEtrangerApp'] != '' ? $_SESSION['postedForm']['permisEtrangerApp'] : ''; ?> maxlength="1" />
                            <input type="text" name="langApp" placeholder="Langue Maternelle *" <?php echo $_SESSION['postedForm']['langApp'] != '' ? $_SESSION['postedForm']['langApp'] : ''; ?> minlength="2" maxlength="20" required />
                            <label for="languesApp">Connaissance linguistiques*:</label>
                            <p><input type="checkbox" name="languesApp[]" value="fr" id="french" <?php echo (is_int(array_search('fr', $_SESSION['postedForm']['languesApp']))) ? 'checked="checked"' : ''; ?>><label for="french"><span class="ui"></span>Français</label></p>
                            <p><input type="checkbox" name="languesApp[]" value="de" id="german" <?php echo (is_int(array_search('de', $_SESSION['postedForm']['languesApp']))) ? 'checked="checked"' : ''; ?>><label for="german"><span class="ui"></span>Allemand</label></p>
                            <p><input type="checkbox" name="languesApp[]" value="en" id="english" <?php echo (is_int(array_search('en', $_SESSION['postedForm']['languesApp']))) ? 'checked="checked"' : ''; ?>><label for="english"><span class="ui" ></span>Anglais</label></p>
                            <p><input type="checkbox" name="languesApp[]" value="others" id="other" <?php echo (is_int(array_search('others', $_SESSION['postedForm']['languesApp']))) ? 'checked="checked"' : ''; ?>><label for="other"><span class="ui" ></span>Autres</label></p>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">2.2</span> Réprésentants légaux</legend>
                            <label for="maj">Avez vous plus de 18 ans?*</label><p>
                            <dl class="radio-list-left">
                                <dd>
                                    <input type="radio" name="maj" id="maj1" value="false" <?php echo (!isset($_SESSION['postedForm']['maj']) || $_SESSION['postedForm']['maj'] == "false") ? "checked=\"checked\"" : ''; ?>>
                                    <label for="maj1">Non</label>
                                </dd>
                                <dd>
                                    <input type="radio" name="maj" id="maj2" value="true" <?php echo ($_SESSION['postedForm']['maj'] == "true") ? "checked=\"checked\"" : ''; ?>>
                                    <label for="maj2">Oui</label>
                                </dd>
                            </dl>
                            <section id="representants">
                                <p>Réprésentant 1:*</p>
                                <select name="genreRep1" id="genreRep1">
                                    <option <?php echo (!isset($_SESSION['postedForm']['genreRep1'])) ? "selected" : ''; ?> disabled> Choisissez un genre*</option>
                                    <option value="Homme" <?php echo ($_SESSION['postedForm']['genreRep1'] == "Homme") ? "selected" : ''; ?>>Homme</option>
                                    <option value="Femme" <?php echo ($_SESSION['postedForm']['genreRep1'] == "Femme") ? "selected" : ''; ?>>Femme</option>
                                </select>
                                <input type="text" name="nameRep1" id="nameRep1" placeholder="Nom*" <?php echo $_SESSION['postedForm']['nameRep1'] != '' ? $_SESSION['postedForm']['nameRep1'] : ''; ?>/>
                                <input type="text" name="surnameRep1" id="surnameRep1" placeholder="Prénom*" <?php echo $_SESSION['postedForm']['surnameRep1'] != '' ? $_SESSION['postedForm']['surnameRep1'] : ''; ?>/>
                                <input type="text" name="adrRep1" id="adrRep1" placeholder="Rue*" <?php echo $_SESSION['postedForm']['adrRep1'] != '' ? $_SESSION['postedForm']['adrRep1'] : ''; ?>/>
                                <input type="text" name="NPARep1" id="NPARep1" placeholder = "NPA\Domicile*" <?php echo $_SESSION['postedForm']['NPARep1'] != '' ? $_SESSION['postedForm']['NPARep1'] : ''; ?>/>
                                <input type="text" name="telRep1" id="telRep1" placeholder="Téléphone (+41 79 123 45 67)*" <?php echo $_SESSION['postedForm']['telRep1'] != '' ? $_SESSION['postedForm']['telRep1'] : ''; ?>/>
                                <p>Réprésentant 2:</p>
                                <select name="genreRep2" id="genreRep2">
                                    <option <?php echo (!isset($_SESSION['postedForm']['genreRep2'])) ? "selected" : ''; ?> disabled> Choisissez un genre</option>
                                    <option value="Homme"<?php echo ($_SESSION['postedForm']['genreRep2'] == "Homme") ? "selected" : ''; ?>>Homme</option>
                                    <option value="Femme"<?php echo ($_SESSION['postedForm']['genreRep2'] == "Femme") ? "selected" : ''; ?>>Femme</option>
                                </select>
                                <input type="text" name="nameRep2" id="nameRep2" placeholder="Nom" <?php echo $_SESSION['postedForm']['nameRep2'] != '' ? $_SESSION['postedForm']['nameRep2'] : ''; ?>/>
                                <input type="text" name="surnameRep2" id="surnameRep2" placeholder="Prénom" <?php echo $_SESSION['postedForm']['surnameRep2'] != '' ? $_SESSION['postedForm']['surnameRep2'] : ''; ?>/>
                                <input type="text" name="adrRep2" id="adrRep2" placeholder="Rue" <?php echo $_SESSION['postedForm']['adrRep2'] != '' ? $_SESSION['postedForm']['adrRep2'] : ''; ?>/>
                                <input type="text" name="NPARep2" id="NPARep2" placeholder = "NPA\Domicile" <?php echo $_SESSION['postedForm']['NPARep2'] != '' ? $_SESSION['postedForm']['NPARep2'] : ''; ?>/>
                                <input type="text" name="telRep2" id="telRep2" placeholder="Téléphone (+41 79 123 45 67)" <?php echo $_SESSION['postedForm']['telRep2'] != '' ? $_SESSION['postedForm']['telRep2'] : ''; ?>/>
                            </section>
                        </fieldset>
                        <legend><span class="number">3</span> Activités</legend>
                        <fieldset>
                            <legend><span class="number">3.1</span> Scolarité</legend>
                            <table id="scolaire">
                                <tr>
                                    <td><input type="text" name="ecole1" placeholder="Ecole*" <?php echo $_SESSION['postedForm']['ecole1'] != '' ? $_SESSION['postedForm']['ecole1'] : ''; ?> required/></td>
                                    <td><input type="text" name="lieuEcole1" placeholder="Lieu*" <?php echo $_SESSION['postedForm']['lieuEcole1'] != '' ? $_SESSION['postedForm']['lieuEcole1'] : ''; ?> required/></td>
                                    <td><input type="text" name="niveauEcole1" placeholder="Niveau*" <?php echo $_SESSION['postedForm']['niveauEcole1'] != '' ? $_SESSION['postedForm']['niveauEcole1'] : ''; ?> required/></td>
                                    <td><input type="text" name="anneesEcole1" placeholder="de-à (années)*" <?php echo $_SESSION['postedForm']['anneesEcole1'] != '' ? $_SESSION['postedForm']['anneesEcole1'] : ''; ?> required/></td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="ecole2" placeholder="Ecole*" <?php echo $_SESSION['postedForm']['ecole2'] != '' ? $_SESSION['postedForm']['ecole2'] : ''; ?> required/></td>
                                    <td><input type="text" name="lieuEcole2" placeholder="Lieu*" <?php echo $_SESSION['postedForm']['lieuEcole2'] != '' ? $_SESSION['postedForm']['lieuEcole2'] : ''; ?> required/></td>
                                    <td><input type="text" name="niveauEcole2" placeholder="Niveau*" <?php echo $_SESSION['postedForm']['niveauEcole2'] != '' ? $_SESSION['postedForm']['niveauEcole2'] : ''; ?> required/></td>
                                    <td><input type="text" name="anneesEcole2" placeholder="de-à (années)*" <?php echo $_SESSION['postedForm']['anneesEcole2'] != '' ? $_SESSION['postedForm']['anneesEcole2'] : ''; ?> required/></td>
                                </tr>
                                <?php
                                for($i = 3; $i < 6; $i++){
                                    if($_SESSION['postedForm']['ecole'.$i]){
                                ?>
                                <tr>
                                    <td><input type="text" name ="ecole<?php echo $i ?>" placeholder="Ecole" value ="<?php echo $_SESSION['postedForm']['ecole'.$i] ?>"/></td>
                                    <td><input type="text" name="lieuEcole<?php echo $i ?>" placeholder="Lieu" value ="<?php echo $_SESSION['postedForm']['lieuEcole'.$i] ?>" ></td>
                                    <td><input type="text" name="niveauEcole<?php echo $i ?>" placeholder="Niveau" value ="<?php echo $_SESSION['postedForm']['niveauEcole'.$i] ?>"></td>
                                    <td><input type="text" name="anneesEcole<?php echo $i ?>" placeholder="de-à (années)" value ="<?php echo $_SESSION['postedForm']['anneesEcole'.$i] ?>"></td>
                                </tr>
                                <?php }} ?>
                                
                            </table>
                            <input type="text" name="anneeFin" id="anneeFin" placeholder="Année de fin de scolarité*" <?php echo $_SESSION['postedForm']['anneeFin'] != '' ? $_SESSION['postedForm']['anneeFin'] : ''; ?> maxlength="4" required/>
                            <section id="anneeFinError"></section>
                            <button type ="button" id="addSch" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter une ligne
                            </button>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">3.2</span> Activités professionnelles</legend>
                            <p>Formations / apprentissages après la scolarité.</p>
                            <table id="activites">
                                <tr>
                                    <td><input type="text" name="employeurPro1" placeholder="Employeur" <?php echo $_SESSION['postedForm']['employeurPro1'] != '' ? $_SESSION['postedForm']['employeurPro1'] : ''; ?>/></td>
                                    <td><input type="text" name="lieuPro1" placeholder="Lieu" <?php echo $_SESSION['postedForm']['lieuPro1'] != '' ? $_SESSION['postedForm']['lieuPro1'] : ''; ?>/></td>
                                    <td><input type="text" name="activitePro1" placeholder="Activité" <?php echo $_SESSION['postedForm']['activitePro1'] != '' ? $_SESSION['postedForm']['activitePro1'] : ''; ?>/></td>
                                    <td><input type="text" name="anneesPro1" placeholder="de-à (années)" <?php echo $_SESSION['postedForm']['anneesPro1'] != '' ? $_SESSION['postedForm']['anneesPro1'] : ''; ?>/></td>
                                </tr>
                                <?php
                                for($i = 2; $i < 4; $i++){
                                    if($_SESSION['postedForm']['employeurPro'.$i]){
                                ?>
                                <tr>
                                    <td><input type="text" name ="employeurPro<?php echo $i ?>" placeholder="Employeur" value ="<?php echo $_SESSION['postedForm']['employeurPro'.$i] ?>"/></td>
                                    <td><input type="text" name="lieuPro<?php echo $i ?>" placeholder="Lieu" value ="<?php echo $_SESSION['postedForm']['lieuPro'.$i] ?>" ></td>
                                    <td><input type="text" name="activitePro1<?php echo $i ?>" placeholder="Activité" value ="<?php echo $_SESSION['postedForm']['activitePro'.$i] ?>"></td>
                                    <td><input type="text" name="anneesPro1<?php echo $i ?>" placeholder="de-à (années)" value ="<?php echo $_SESSION['postedForm']['anneesPro'.$i] ?>"></td>
                                </tr>
                                <?php }} ?>
                            </table>
                            <button type ="button" id="addPro" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter une ligne
                            </button>
                        </fieldset>
                        <fieldset>
                            <legend><span class="number">3.3</span> Stages</legend>
                            <table id="stages">
                                <tr>
                                    <td><input type="text" name="activiteStage1" placeholder="Métier" <?php echo $_SESSION['postedForm']['activiteStage1'] != '' ? $_SESSION['postedForm']['activiteStage1'] : ''; ?>></td>
                                    <td><input type="text" name="entrepriseStage1" placeholder="Entreprise" <?php echo $_SESSION['postedForm']['entrepriseStage1'] != '' ? $_SESSION['postedForm']['entrepriseStage1'] : ''; ?>></td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="activiteStage2" placeholder="Métier" <?php echo $_SESSION['postedForm']['activiteStage2'] != '' ? $_SESSION['postedForm']['activiteStage2'] : ''; ?>></td>
                                    <td><input type="text" name="entrepriseStage2" placeholder="Entreprise" <?php echo $_SESSION['postedForm']['entrepriseStage2'] != '' ? $_SESSION['postedForm']['entrepriseStage2'] : ''; ?>></td>
                                </tr>
                                <?php
                                for($i = 2; $i < 4; $i++){
                                    if($_SESSION['postedForm']['activiteStage'.$i]){
                                ?>
                                <tr>
                                    <td><input type="text" name ="activiteStage<?php echo $i ?>" placeholder="Métier" value ="<?php echo $_SESSION['postedForm']['activiteStage'.$i] ?>"/></td>
                                    <td><input type="text" name="entrepriseStage<?php echo $i ?>" placeholder="Entreprise" value ="<?php echo $_SESSION['postedForm']['entrepriseStage'.$i] ?>" ></td>
                                </tr>
                                <?php }} ?>
                            </table>
                            <button type ="button" id="addStage" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter une ligne
                            </button>
                            <p>Avez-vous déjà été candidat à l'EPFL?</p>
                            <dl class="radio-list-left">
                                <dd>
                                    <input type="radio" name="dejaCand" id="dejaCand1" value="false" <?php echo (!isset($_SESSION['postedForm']['dejaCand']) || $_SESSION['postedForm']['dejaCand'] == "false") ? "checked=\"checked\"" : ''; ?>>
                                    <label for="dejaCand1">Non</label>
                                </dd>
                                <dd>
                                    <input type="radio" name="dejaCand" id="dejaCand2" value="true" <?php echo ($_SESSION['postedForm']['dejaCand'] == "true") ? "checked=\"checked\"" : ''; ?>/>
                                    <label for="dejaCand2">Oui</label>
                                </dd>
                            </dl>
                            <input type="text" name="dejaCandAnnee" id="dejaCandAnnee" placeholder="Année de candidature*" <?php echo $_SESSION['postedForm']['dejaCandAnnee'] != '' ? $_SESSION['postedForm']['dejaCandAnnee'] : ''; ?> maxlength="4" style="display: none;"/>
                            <section id="dejaCandError"></section>
                        </fieldset>
                        <fieldset id="files">
                            <legend><span class="number">4</span> Annexes </legend>
                            <p>Merci de joindre tous les fichiers demandés, en respectant les formats (si les formats ne sont pas respectés, les fichiers ne seront pas pris en compte).</p>

                            <label for="photo">Photo passeport <strong>couleur:*</strong></label>
                            <div class="tooltip">
                                <label class="file" title="" id="photoLabel">
                                    <input type="file" name="photo" id="photo" onchange="changeTitleFile(this)" required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone1"></section>
                            </div>
                            <label for="idCard">Copie carte d'indentité / passeport:*</label>
                            <div class="tooltip">
                                <label class="file" title="" id="idCardLabel">
                                    <input type="file" name="idCard" id="idCard" onchange="changeTitleFile(this)" required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone2"></section>
                            </div>
                            <label for="cv">Curriculum Vitae:*</label>
                            <div class="tooltip">
                                <label class="file" title="" id="CVLabel" >
                                    <input type="file" name="cv" id="cv" onchange="changeTitleFile(this)" required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone3"></section>
                            </div>
                            <label for="lettre">Lettre de motivation:*</label>
                            <div class="tooltip">
                                <label class="file" title="" id="lettreLabel" >
                                    <input type="file" name="lettre" id="lettre" onchange="changeTitleFile(this)" required/>
                                </label>
                                <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                <p></p>
                                <section id="formatErrorZone4"></section>
                            </div>

                            <label for="certifs1">Certificats, diplômes et bulletins de notes des derniers 3-4 semestres:</label>
                            <table id="newCertifZone">
                                <tr><td>
                                    <div class="tooltip">
                                        <label class="file" title="" id="certifLabel1">
                                            <input type="file" name="certifs1" id="certifs1" onchange="changeTitleFile(this)" />
                                        </label>
                                        <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                        <p></p>
                                        <section id="formatErrorZone7"></section>
                                    </div>
                                </td></tr>
                            </table>
                            <button type ="button" id="addInputFile" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent buttonRight">
                                Ajouter un annexe
                            </button>
                            <div id="polyOnly">
                                <label for="gimch">Attestation de tests d'aptitudes GIM-CH (polymécanicien):</label>
                                <div class="tooltip">
                                    <label class="file" title="" id="gimchLabel" >
                                        <input type="file" name="gimch" id="gimch" onchange="changeTitleFile(this)"/>
                                    </label>
                                    <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                    <p></p>
                                    <section id="formatErrorZone5"></section>
                                </div>
                            </div>
                            <div id="griTest">
                                <label for="griTestInput">Attestation de tests d'aptitudes GRI (informaticien):</label>
                                <div class="tooltip">
                                    <label class="file" title="" id="griTestInputLabel" >
                                        <input type="file" name="griTestInput" id="griTestInput" onchange="changeTitleFile(this)"/>
                                    </label>
                                    <span class="tooltiptext tooltip-right">Formats autorisés: pdf-jpeg-png</span>
                                    <p></p>
                                    <section id="formatErrorZone6"></section>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div id="condDiv">
                                <input type="checkbox" value="conditionsAcc" id="conditions" required />
                                <label for="conditions" id="condLabel"><span class="ui"></span>Accepter les <a href="conditions.php" target="_blank"> conditions*</a></label>
                                <p></p>
                            </div>
                        </fieldset>
                        <input type="submit" value="Terminer"/>
                    </div>
                </fieldset>
            </div>
        </form>
        <?php
            if ($_SESSION['formError']) {
                echo '<script>showOnFormReturn();</script>';
            }
            //require_once('templates/footer.php');
        ?>
    </body>
</html>