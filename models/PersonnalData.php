<?php
require_once(__DIR__ . '/../helpers.php');

class PersonnalData {
    private $postedData;
    private $formations = array(
    "polyMecanicien" => "Polymecaniciens",
    "informaticien" => "Informaticiens",
    "logisticien" => "Logisticiens",
    "planificateurElectricien" => "PlanificateurElectriciens",
    "employeCommerce" => "EmployesCommerce",
    "gardienAnimaux" => "GardiensAnimaux",
    "electronicien" => "Electroniciens",
    "interactiveMediaDesigner" => "InteractiveMediaDesigners"
    );
    private $dateNow;
    private $rootpath = '\\\\scxdata\\apprentis$\\candidatures\\nouvelles\\';
    public $formation = "";
    public $filiere = "";
    public $maturite = "false";
    public $genreApprenti = "";
    public $nomApprenti = "";
    public $prenomApprenti  = "";
    public $addresseApprentiComplete = [];
    public $telFixeApprenti = "";
    public $telMobileApprenti = "";
    public $mailApprenti = "";
    public $dateNaissanceApprenti = "";
    public $origineApprenti = "";
    public $nationaliteApprenti = "";
    public $permisEtranger = "";
    public $langueMaternelleApprenti = "";
    public $connaissancesLinguistiques = "";
    public $majeur = "false";
    public $representants = [];
    public $scolarite = [];
    public $anneeFinScolarite;
    public $activitesProfessionnelles = [];
    public $stages = [];
    public $dejaCandidat = "false";
    public $anneeCandidature = "";
    public $datePostulation = "";
    public $fichiers = [];
    
    public function __construct($postedData){
        $this->dateNow = date('Y-m-d_H-i-s');
        //Rempli les infos;
        $this->postedData = $postedData;
        $this->formation = $postedData['job'];
        if($this->formation =="informaticien"){
            $this->filiere = $postedData['filInfo'];
        }
        $this->maturite = $postedData['mpt'];
        $this->genreApprenti = $postedData['genreApp'];
        $this->nomApprenti = $postedData['nameApp'];
        $this->prenomApprenti = $postedData['surnameApp'];
        $this->addresseApprentiComplete = array("rue"=>$postedData['adrApp'],"NPA"=>$postedData['NPAApp']);
        $this->telFixeApprenti  = $postedData['telApp'];
        $this->telMobileApprenti  = $postedData['phoneApp'];
        $this->mailApprenti = $postedData['mailApp'];
        $this->dateNaissanceApprenti = $postedData['birthApp'];
        $this->origineApprenti = $postedData['originApp'];
        $this->nationaliteApprenti = $postedData['nationApp'];
        $this->permisEtranger = $postedData['permisEtrangerApp'];
        $this->langueMaternelleApprenti = $postedData['langApp'];
        $this->setLanguages($postedData['languesApp']);
        $this->majeur = $postedData['maj'];
        if($this->majeur == "false"){
            $this->setRepresentants();
        }
        $this->setScolarite();
        $this->setActivitesPro();
        $this->setStages();
        $this->setDejacand();
        $this->anneeFinScolarite = $postedData['anneeFin'];
        $this->datePostulation = date('j-n-o--'.'h:i:s');
    }
    
    private function setRepresentants(){
        $rep1 = array("genre"=>$this->postedData['genreRep1'],"nom"=>$this->postedData['nameRep1'],"prenom"=>$this->postedData['surnameRep1'],"addresse"=> array("rue"=>$this->postedData['adrRep1'],"NPA"=>$this->postedData['NPARep1']),"telephone"=>$this->postedData['telRep1']);
        $rep2 = array("genre"=>$this->postedData['genreRep2'],"nom"=>$this->postedData['nameRep2'],"prenom"=>$this->postedData['surnameRep2'],"addresse"=> array("rue"=>$this->postedData['adrRep2'],"NPA"=>$this->postedData['NPARep2']),"telephone"=>$this->postedData['telRep2']);
        $this->representants = array($rep1, $rep2);
    }
    private function setScolarite(){
        for ($i = 1; $i <= 5; $i++) {
            if(array_key_exists('ecole'.$i, $this->postedData)){
                array_push($this->scolarite, array("ecole"=>$this->postedData['ecole'.$i],"lieu"=>$this->postedData['lieuEcole'.$i],"niveau"=>$this->postedData['niveauEcole'.$i],"annees"=>$this->postedData['anneesEcole'.$i]));
            }
        }
    }
    private function setActivitesPro(){
        for ($i = 1; $i <= 3; $i++) {
            if(array_key_exists('employeurPro'.$i, $this->postedData)){
                array_push($this->activitesProfessionnelles,array("employeur"=>$this->postedData['employeurPro'.$i],"lieu"=>$this->postedData['lieuPro'.$i],"activite"=>$this->postedData['activitePro'.$i],"annees"=>$this->postedData['anneesPro'.$i]));
            }
        }
    }
    private function setStages(){
        for ($i = 1; $i <= 4; $i++) {
            if(array_key_exists('activiteStage'.$i, $this->postedData)){
                array_push($this->stages,array("metier"=>$this->postedData['activiteStage'.$i],"employeur"=>$this->postedData['entrepriseStage'.$i]));
            }
        }
    }
    private function setDejacand(){
        $this->dejaCandidat = $this->postedData['dejaCand'];
        if($this->postedData['dejaCand'] == "true"){
            $this->anneeCandidature = $this->postedData['dejaCandAnnee'];
        }
    }
    public function setLanguages($languages){
        if(isset($languages) && is_array($languages)){
            $this->connaissancesLinguistiques = $languages;
        } else {
            $this->connaissancesLinguistiques = [];
        }
    }
    
    public function getPaths(){
        $folderName = $this->dateNow."_".$this->mailApprenti;
        $path = $this->rootpath.$this->formations[$this->formation].'/'.$folderName.'/';
        $pathInfos = $path."informations/";
        $pathAnnexes = $path."annexes/";
        return ["pathInfos"=>$pathInfos, "pathAnnexes"=>$pathAnnexes, "path"=> $path];
    }
    public function getFormations(){
        return $this->formations;
    }
}
?>