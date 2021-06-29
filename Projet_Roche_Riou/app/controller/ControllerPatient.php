
<!-- ----- debut ControllerPatient -->
<?php
require_once '../model/ModelPatient.php';

class ControllerPatient {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerPatient : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des Patients
 public static function PatientReadAll() {
  $results = ModelPatient::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewAll.php';
  if (DEBUG)
   echo ("ControllerPatient : PatientReadAll : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un id qui existe
 public static function PatientReadId($args) {
     if(DEBUG)echo ("controllerPatient:vinReadId:begin</br>");
  $results = ModelPatient::getAllId();
  
$target = $args['target'];
  if(DEBUG) echo("ControlerPatient:ReadId : target = $target</br>");
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewId.php';
  require ($vue);
 }

 // Affiche un Patient particulier (id)
 public static function PatientReadOne() {
  $Patient_id = $_GET['id'];
  $results = ModelPatient::getOne($Patient_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un Patient
 public static function PatientCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau Patient.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function PatientCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelPatient::insert(
      htmlspecialchars($_GET['nom']),htmlspecialchars($_GET['prenom']), htmlspecialchars($_GET['adresse'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewInserted.php';
  require ($vue);
 }

 public static function PatientDeleted() {
  // ajouter une validation des informations du formulaire
  $id = $_GET['id'];
  echo $id;
  $results = ModelPatient::delete($id);
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/patient/viewDelete.php';
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerPatient -->


