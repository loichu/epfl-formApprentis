<!doctype html>
<html lang="fr">
    <head>
         <?php
            include("templates/head.php");
            include('templates/isPostulationOpen.php');
            require_once("helpers.php");
            require_once("models/PersonnalData.php");
            require_once("models/PersonnalDataValidator.php");
         ?>
         <title>Confirmation</title>
    </head>
    <body>
    <div class="page-style">
        <?php
            include('templates/header.php');
            //Init personnalData with postedData
            $candidateData = new PersonnalData($_POST);
            debuglog("personnalData initiallised");
            //Init dataValidator
            $validator = new PersonnalDataValidator($candidateData);
            debuglog("PersonnalDataValitor initiallised");

            if($validator->isValid()){
                debuglog("validator->isValid");
                //Create folders
                createCandidateFolders($candidateData);
                //Upload files
                $candidateData = uploadAllFiles($candidateData->getPaths()["pathAnnexes"], $_FILES, $candidateData);
                //Create JSON file and upload it
                $encodedJson = (json_encode($candidateData,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
                file_put_contents($candidateData->getPaths()["pathInfos"].'/informations.json', $encodedJson);
                //Send mails
                mailToResp($candidateData->prenomApprenti, $candidateData->nomApprenti, $candidateData->formation);
                mailToApprenti($candidateData->mailApprenti, $candidateData->formation);
                // kill session
                $_SESSION['formError'] = false;
                //unset($_SESSION['postedForm']);
                include("templates/confirmationText.php");
            }else{
                $_SESSION['formError'] = true;
                $_SESSION['postedForm'] = $_POST;
                $_SESSION['files'] = $_FILES;
                debuglog("!validator->isValid");
                include("templates/errorText.php");
            }
        ?>
        </div>
    </body>
</html>