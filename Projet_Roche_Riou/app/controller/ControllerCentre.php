
<!-- ----- debut ControllerCentre -->
<?php
require_once '../model/ModelCentre.php';

class ControllerCentre {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerCentre : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des Centres
 public static function centreReadAll() {
  $results = ModelCentre::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewAll.php';
  if (DEBUG)
   echo ("ControllerCentre : CentreReadAll : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un id qui existe
 public static function centreReadId($args) {
     if(DEBUG)echo ("controllerCentre:vinReadId:begin</br>");
  $results = ModelCentre::getAllId();
  
$target = $args['target'];
  if(DEBUG) echo("ControlerCentre:ReadId : target = $target</br>");
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewId.php';
  require ($vue);
 }
 
 public static function centreReadLabel($args) {
    if(DEBUG)echo ("controllerCentre:centreReadLabel:begin</br>");
    $results = ModelCentre::getAllLabel();
  
    $target = $args['target'];
    if(DEBUG) echo("controllerCentre:centreDeleted : target = $target</br>");
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/innovations/viewSelectCentre.php';
  require ($vue);
 }

 // Affiche un Centre particulier (id)
 public static function centreReadOne() {
  $Centre_id = $_GET['id'];
  $results = ModelCentre::getOne($Centre_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un Centre
 public static function centreCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau Centre.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function centreCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelCentre::insert(
      htmlspecialchars($_GET['label']), htmlspecialchars($_GET['adresse'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/centre/viewInserted.php';
  require ($vue);
 }
 
 public static function associationVaccin() {
  $results = ModelCentre::linkVaccinToCentre();
  include 'config.php';
  $vue = $root . '/app/view/centre/viewDistinctRegion.php';
  require ($vue);  
 }
 
 public static function CentreDistinctRegion(){
  $results = ModelCentre::getDistinctRegion();
   include 'config.php';
  $vue = $root . '/app/view/centre/viewDistinctRegion.php';
  require ($vue);  
 }
 public static function centreRegionCentre(){
  $results = ModelCentre::getRegionCentre();
   include 'config.php';
  $vue = $root . '/app/view/innovations/viewCentreDeleted.php';
  require ($vue);  
 }
 public static function centreDeleted() {
  // ajouter une validation des informations du formulaire
  //$label = $_GET['centre'];

  $results = ModelCentre::delete();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/innovations/viewCentreDeleted.php';
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerCentre -->


