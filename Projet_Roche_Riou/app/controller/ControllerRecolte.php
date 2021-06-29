
<!-- ----- debut ControllerRecolte -->
<?php
require_once '../model/ModelRecolte.php';

class ControllerRecolte {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerRecolte : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des recoltes
 public static function recolteReadAll() {
  $results = ModelRecolte::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/recolte/viewAll.php';
  if (DEBUG)
   echo ("ControllerRecolte : recolteReadAll : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un id qui existe
 public static function recolteReadId() {
  $results = ModelRecolte::getAllId();
 
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/recolte/viewId.php';
  require ($vue);
 }

 // Affiche un recolte particulier (id)
 public static function recolteReadOne() {
  $recolte_id = $_GET['id'];
  $results = ModelRecolte::getOne($recolte_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/recolte/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un recolte
 public static function recolteCreate() {
     $resultat=ModelRecolte::getAllId();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/recolte/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau recolte.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function recolteCreated() {
     
     $id_producteur = $_GET['producteur'];
     $vin_id=$_GET['vin'];
     $quantite=$_GET['quantite'];    
     echo $id_producteur,$vin_id,$quantite;
  $results = ModelVin::update($id_producteur,$vin_id,$quantite);
  // ajouter une validation des informations du formulaire
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/recolte/viewInserted.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau recolte.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function recolteDeleted() {
  // ajouter une validation des informations du formulaire
  $id = $_GET['id'];
  $results = ModelRecolte::delete($id);
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/recolte/viewDelete.php';
  require ($vue);
 }
 
}
?>
<!-- ----- fin ControllerRecolte -->


