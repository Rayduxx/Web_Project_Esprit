<?php
class logement {
  private int $id;
  private string $bloc;
  private int $numero;
  private string $type;
  private int $nbChambre;
  private int $idLocataire;
  private int $prixLoyer;
  public function __construct($ID, $Bloc, $num, $ty, $nb,$loca,$prixL){
    $this->id = $ID;
    $this->bloc = $Bloc;
    $this->numero = $num;
    $this->type = $ty;
    $this->nbChambre = $nb;
    $this->idLocataire = $loca;
    $this->prixLoyer = $prixL;
  }
  public function getLogementId(){
    return $this->id;
  }
  public function getBloc(){
    return $this->bloc;
  }
  public function getNumeroLogement(){
    return $this->numero;
  }
  public function getTypeLogement(){
    return $this->type;
  }
  public function getNbChambre(){
    return $this->nbChambre;
  }
  public function getPrixLLogement(){
    return $this->prixLoyer;
  }
}

class Location {
  private int $id;
  private int $prix;
  private int $idLocataire;
  private string $remarques;
  private int $idLogement;
  private string $DebutLocation;
  private int $etat;
  public function __construct($ID, $prx, $idloca, $rem, $idLo,$DebLoca,$state){
    $this->id = $ID;
    $this->prix = $prx;
    $this->idLocataire = $idloca;
    $this->remarques = $rem;
    $this->idLogement = $idLo;
    $this->DebutLocation = $DebLoca;
    $this->etat = $state;
  }
  public function getLocationId(){
    return $this->id;
  }
  public function getLocationPrix(){
    return $this->prix;
  }
  public function getRemarquesLocation(){
    return $this->remarques;
  }
  public function getIdLocataireLocation(){
    return $this->idLocataire;
  }
  public function getIdLogementLocation(){
    return $this->idLogement;
  }
  public function getDebLocation(){
    return $this->DebutLocation;
  }
  public function getEtatLocation(){
    return $this->etat;
  }
}

class Entretient {
  private int $id;
  private int $TimeDateEntretient;
  private string $Remarque;
  private string $prix;
  private string $idAgentEntretient;
  private int $idAppartement;
  public function __construct($ID, $TDE, $rem, $prx, $idAE,$idAPP){
    $this->id = $ID;
    $this->TimeDateEntretient = $TDE;
    $this->prix = $prx;
    $this->remarques = $rem;
    $this->idAgentEntretient = $idAE;
    $this->idAppartement = $idAPP;

  }
  public function getEntretientId(){
    return $this->id;
  }
  public function getTimeDateEntretient(){
    return $this->TimeDateEntretient;
  }
  public function getRemarquesEntretient(){
    return $this->remarques;
  }
  public function getPrixEntretient(){
    return $this->prix;
  }
  public function getAgentEntretient(){
    return $this->idAgentEntretient;
  }
  public function getIdAppartementEntretient(){
    return $this->idAppartement;
  }
}


?>
