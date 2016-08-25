<!doctype html>
<html lang="fr">
    <head>  
         <?php include('templates/head.php');?>
         <title>Confirmation</title>
    </head>
    <body>
    <div class="form-style-5">
       <?php
        //Tri des apprentis par métier
        $name = $_POST['nameApp'];
        $surname = $_POST['surnameApp'];
        $job = $_POST['job'];
        $rootpath = '../candidatures/';

            if($job=="polyM") {
                //echo "Polymec"; 
                $path = $rootpath.'Polymecaniciens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }else if($job=="info"){
                //echo "informaticien";
                $apprentiInfos[1] =  $_POST['filInfo'];
                $path = $rootpath.'Informaticiens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }else if($job=="logi"){
                //echo "Logisticiens";
                $path = $rootpath.'Logisticiens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }else if($job=="planElec"){
                //echo "Planif Elec";
                $path = $rootpath.'PlanificateurElectriciens/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }else if($job=="empCom"){
                //echo "EmployesCommerce";
                $path = $rootpath.'EmployesCommerce/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }else if($job=="gardAn"){
                //echo "GardiensAnimaux";
                $path = $rootpath.'GardiensAnimaux/'."new-".$name.$surname.'/';
                createThings($path,$name,$surname,$apprentiInfos);
            }   
            
            function createThings($path,$name,$surname,$apprentiInfos){
                //create apprenti's folders
                    $pathInfos = $path."informations/";
                    $pathAnnexes = $path."annexes/";

                    if (!mkdir($path, 0777, true)){
                         die('Echec lors de la création du dossier candidat');
                          $noError = false;
                    }
                    if (!mkdir($pathInfos, 0777, true)){
                        die('Echec lors de la création du dossier informations');
                        $noError = false;
                    }
                    if (!mkdir($pathAnnexes, 0777, true)){
                        die('Echec lors de la création du dossier annexes');
                    }else{
                        echo "Dossiers crées";
                        $noError = true;
                    }
                    
                    //JSON
                    require_once("json/jsonClass.php");
                    $doc = new Doc();
                    $doc->formation = $_POST['job'];
                    if($_POST['job'] == "info"){
                        $doc->filiere = $_POST['filInfo'];
                    }else{}

                    $doc->maturite = $_POST['mpt'];
                    $doc->genreApp  = $_POST['genreApp'];
                    $doc->nomApp  = $_POST['nameApp'];
                    $doc->prenomApp  = $_POST['surnameApp'];
                    $doc->addresseAppComplete = array("rue"=>$_POST['adrApp'],"NPA"=>$_POST['NPAApp']);             
                    $doc->telFixeApp  = $_POST['telApp'];
                    $doc->telMobileApp  = $_POST['phoneApp'];
                    $doc->mailApp  = $_POST['mailApp'];
                    $doc->dateNaissanceApp  = $_POST['birthApp'];
                    $doc->origineApp  = $_POST['originApp'];
                    $doc->nationaliteApp  = $_POST['nationApp'];
                    $doc->langueMaternelleApp  = $_POST['langApp'];
                    //GET CHECKBOXES
                    //$doc->connaissanceFrançais = $_POST['langApp'];
                    $doc->langueMaternelleApp  = $_POST['langApp'];
                    $doc->majeur = $_POST['maj'];
                    if($_POST['maj'] == "maj-non"){
                        $doc->rep1  = array("genre"=>$_POST['genreRep1'],"nom"=>$_POST['nameRep1'],"prenom"=>$_POST['surnameRep1'],"addresse"=> array("rue"=>$_POST['adrRep1'],"NPA"=>$_POST['NPARep1']),"telephone"=>$_POST['telRep1']);    
                        $doc->rep2  = array("genre"=>$_POST['genreRep2'],"nom"=>$_POST['nameRep1'],"prenom"=>$_POST['surnameRep2'],"addresse"=> array("rue"=>$_POST['adrRep2'],"NPA"=>$_POST['NPARep2']),"telephone"=>$_POST['telRep2']);           
                    }else{}
                    $doc->scolarite1 = array("ecole"=>$_POST['ecole1'],"lieu"=>$_POST['lieuEcole1'],"niveau"=>$_POST['niveauEcole1'],"annees"=>$_POST['anneesEcole1']);
                    $doc->scolarite2 = array("ecole"=>$_POST['ecole2'],"lieu"=>$_POST['lieuEcole2'],"niveau"=>$_POST['niveauEcole2'],"annees"=>$_POST['anneesEcole2']);
                    $doc->scolarite3 = array("ecole"=>$_POST['ecole3'],"lieu"=>$_POST['lieuEcole3'],"niveau"=>$_POST['niveauEcole3'],"annees"=>$_POST['anneesEcole3']);
                    $doc->scolarite4 = array("ecole"=>$_POST['ecole4'],"lieu"=>$_POST['lieuEcole4'],"niveau"=>$_POST['niveauEcole4'],"annees"=>$_POST['anneesEcole4']);
                    $doc->scolarite5 = array("ecole"=>$_POST['ecole5'],"lieu"=>$_POST['lieuEcole5'],"niveau"=>$_POST['niveauEcole5'],"annees"=>$_POST['anneesEcole5']);
                    $doc->anneeFinScolarite = $_POST['anneeFin'];
                    $doc->activiteProfessionelle1 = array("employeur"=>$_POST['employeurPro1'],"lieu"=>$_POST['lieuPro1'],"activite"=>$_POST['activitePro1'],"annees"=>$_POST['anneesPro1']);
                    $doc->activiteProfessionelle2 = array("employeur"=>$_POST['employeurPro2'],"lieu"=>$_POST['lieuPro2'],"activite"=>$_POST['activitePro2'],"annees"=>$_POST['anneesPro2']);
                    $doc->activiteProfessionelle3 = array("employeur"=>$_POST['employeurPro3'],"lieu"=>$_POST['lieuPro3'],"activite"=>$_POST['activitePro3'],"annees"=>$_POST['anneesPro3']);
                    $doc->activiteProfessionelle4 = array("employeur"=>$_POST['employeurPro4'],"lieu"=>$_POST['lieuPro4'],"activite"=>$_POST['activitePro4'],"annees"=>$_POST['anneesPro4']);
                    $doc->stage1 = array("metier"=>$_POST['activiteStage1'],"employeur"=>$_POST['entrepriseStage1']);
                    $doc->stage2 = array("metier"=>$_POST['activiteStage2'],"employeur"=>$_POST['entrepriseStage2']);
                    $doc->stage3 = array("metier"=>$_POST['activiteStage3'],"employeur"=>$_POST['entrepriseStage3']);
                    $doc->dejaCandidat = $_POST['dejaCand'];
                    if($_POST['dejaCand'] == "dejaCand-oui"){
                        $doc->anneeCandidature = $_POST['dejaCandAnnee'];
                    }else{}

                    //$doc->nowDate = new DateTime();
                    
                    $encodedJson = (json_encode($doc));
                    file_put_contents('informations.json', $encodedJson); //change path here

                    //Photo upload
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['photo']['name']);
                    $extensions = array('.jpg','.jpeg','.png','.pdf');
                    $extension = strrchr($_FILES['photo']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type JPG/JPEG, PNG ou PDF';
                        //$noError = false;
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                            $noError = true;
                            
                        }
                        else{
                            echo 'Echec de l\'upload photo!';
                            $noError = false;
                        }
                    }
                    else{
                        echo $erreur;
                    }
                    
                    //CV upload  
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['cv']['name']);
                    $extensions = array('.pdf');
                    $extension = strrchr($_FILES['cv']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type PDF';
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['cv']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                            $noError = true;
                        }
                        else{
                            echo 'Echec de l\'upload CV!';
                            $noError = false;
                        }
                    }
                    else{
                        echo $erreur;
                    }

                    // Lettre upload
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['lettre']['name']);
                    $extensions = array('.pdf');
                    $extension = strrchr($_FILES['lettre']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type PDF';
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['lettre']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                            $noError = true;
                        }
                        else{
                            echo 'Echec de l\'upload Lettre de motivation!';
                            $noError = false;
                        }
                    }
                    else{
                        echo $erreur;
                    }

                    // ID card upload
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['idCard']['name']);
                    $extensions = array('.jpg','.jpeg','.png','.pdf');
                    $extension = strrchr($_FILES['idCard']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type JPG/JPEG ou PNG';
                        //$noError = false;
                    }
                    //
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['idCard']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                            $noError = true;
                        }
                        else{
                            echo 'Echec de l\'upload idCard!';
                            $noError = false;
                        }
                    }
                    else{
                        echo $erreur;
                    }


                    //GIM-CH upload
                    $dossier = $pathAnnexes;
                    $fichier = basename($_FILES['photo']['name']);
                    $extensions = array('.jpg','.jpeg','.png','.pdf');
                    $extension = strrchr($_FILES['photo']['name'], '.'); 
                    
                    if(!in_array($extension, $extensions)){
                        $erreur = 'Vous devez uploader un fichier de type JPG/JPEG ou PNG';
                        //$noError = false;
                    }
                    if(!isset($erreur)){
                        $fichier = strtr($fichier, 
                            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                        
                        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier))
                        {
                            echo 'Upload réussi';
                            $noError = true;
                        }
                        else{
                            echo 'Echec de l\'upload gim-ch!';
                            $noError = false;
                        }
                    }
                    else{
                        echo $erreur;
                    }
                    
                    // mail send
                    $to  = 'nicolas.crausaz@epfl.ch';
                    $subject = 'Nouvelle demande de place d\'apprentissage';
                    $message = $name." ".$surname ." ". " a fait une demande de place d'apprentissage.";
                    $headers = 'From: formapprentis@epfl.ch' . "\r\n" .
                                'Reply-To: formapprentis@epfl.ch' . "\r\n" .
                                'X-Mailer: PHP/' . phpversion();

                    if($noError == true){
                        if (mail($to, $subject, $message, $headers)){
                                echo "Mail envoyé";
                            }
                            else{
                                echo "Mail non envoyé";
                            }
                    }
            }
        ?>
        </div>
    </body>
</html>