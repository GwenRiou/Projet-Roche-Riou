
<!-- ----- debut ControllerStock -->
<?php
require_once '../model/ModelStock.php';
require_once '../model/ModelCentre.php';

class ControllerStock {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerStock : caveAccueil : vue = $vue");
  require ($vue);
 }

 // --- Liste des Stocks
 public static function stockReadAll() {
  $results = ModelStock::getAll();
  $centre = ModelCentre::getAll();
  $vaccin = ModelVaccin::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewAll.php';
  if (DEBUG)
   echo ("ControllerStock : StockReadAll : vue = $vue");
  require ($vue);
 }
 public static function stockReadTotal(){
  $results = ModelStock::getTotal();
  $centre = ModelCentre::getAll();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewTotal.php';
  if (DEBUG)
   echo ("ControllerStock : StockReadTotal : vue = $vue");
  require ($vue);
 }

 // Affiche un formulaire pour sélectionner un id qui existe
 public static function stockReadId($args) {
     if(DEBUG)echo ("controllerStock:stockReadId:begin</br>");
  $results = ModelStock::getAllId();
  
$target = $args['target'];
  if(DEBUG) echo("ControlerStock:ReadId : target = $target</br>");
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewId.php';
  require ($vue);
 }

 // Affiche un Stock particulier (label)
 public static function stockReadOne($args) {
  $label = $_GET['label'];
  $results = ModelStock::getOne($label);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewUpdate.php';
  require ($vue);
 }

 public static function stockSelect($args) {
  if(DEBUG) echo("controllerStock:stockReadSelect:begin</br>");
  $results = ModelCentre::getAllLabel();
  
  $target = $args['target'];
  if(DEBUG) echo("ControlerStock:ReadSelect : target = $target</br>");
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewCentre.php';
  require ($vue);
 }
 
 // Affiche le formulaire de creation d'un Stock
 public static function stockCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau Stock.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function stockCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelStock::insert(
      htmlspecialchars($_GET['label']), htmlspecialchars($_GET['adresse'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewInserted.php';
  require ($vue);
 }
 
 public static function stockUpdate() {
  // ajouter une validation des informations du formulaire
  $results = ModelStock::update();
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewUpdated.php';
  require ($vue);
 }
 
 public static function stockDistinctRegion(){
  $results = ModelStock::getDistinctRegion();
   include 'config.php';
  $vue = $root . '/app/view/stock/viewDistinctRegion.php';
  require ($vue);  
 }
 public static function stockRegionStock(){
  $results = ModelStock::getRegionStock();
   include 'config.php';
  $vue = $root . '/app/view/stock/viewRegionStock.php';
  require ($vue);  
 }
 public static function stockDeleted() {
  // ajouter une validation des informations du formulaire
  $id = $_GET['id'];
  echo $id;
  $results = ModelStock::delete($id);
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewDelete.php';
  require ($vue);
 }
}
?>
<!-- ----- fin ControllerStock -->


