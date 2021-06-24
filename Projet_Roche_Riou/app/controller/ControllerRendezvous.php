
<!-- ----- debut ControllerRendezvous -->
<?php
require_once '../model/ModelRendezvous.php';

class ControllerRendezvous {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerRendezvous : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des Rendezvous
 public static function RendezvousReadAll() {
  $results = ModelPatient::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewAll.php';
  if (DEBUG)
   echo ("ControllerRendezvous : RendezvousReadAll : vue = $vue");
  require ($vue);
 }
 
public static function RendezvousSelection(){
    $patient = $_GET['patient'];
    $id=substr($patient,0,1); // on recupère l'id du patient
    
    $results = ModelRendezvous::getOne($id);
    // affiche info 
    
    //test 
   if ($results===""){
        //création du patient dans la bases de donnés rendezvous
        // affiche la liste des centres 
        
    }
    else if($results[1]!="" && $results[0]['vaccin_id']!=4){
        // affiche la liste des centres en fonction des vaccins dispponibles
        // + demander l'untilisateur de choisir un centre
    }
    else{
        //afficher les infos du patient 
        include 'config.php';
        $vue = $root . '/app/view/rendezvous/viewInfos.php';
        if (DEBUG)
         echo ("ControllerRendezvous : RendezvousReadAll : vue = $vue");
        require ($vue);
    }
    // ----- Construction chemin de la vue
  
}
 // Affiche un formulaire pour sélectionner un id qui existe
 public static function RendezvousReadId($args) {
     if(DEBUG)echo ("controllerRendezvous:vinReadId:begin</br>");
  $results = ModelRendezvous::getAllId();
  
$target = $args['target'];
  if(DEBUG) echo("ControlerRendezvous:ReadId : target = $target</br>");
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewId.php';
  require ($vue);
 }

 // Affiche un Rendezvous particulier (id)
 public static function RendezvousReadOne() {
  $Rendezvous_id = $_GET['id'];
  $results = ModelRendezvous::getOne($Rendezvous_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un Rendezvous
 public static function RendezvousCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau Rendezvous.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function RendezvousCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelRendezvous::insert(
      htmlspecialchars($_GET['nom']),htmlspecialchars($_GET['prenom']), htmlspecialchars($_GET['adresse'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewInserted.php';
  require ($vue);
 }
 
 public static function RendezvousDistinctRegion(){
  $results = ModelRendezvous::getDistinctRegion();
   include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewDistinctRegion.php';
  require ($vue);  
 }
 public static function RendezvousRegionRendezvous(){
  $results = ModelRendezvous::getRegionRendezvous();
   include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewRegionRendezvous.php';
  require ($vue);  
 }
 public static function RendezvousDeleted() {
  // ajouter une validation des informations du formulaire
  $id = $_GET['id'];
  $results = ModelRendezvous::delete($id);
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/rendezvous/viewDelete.php';
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerRendezvous -->


