
<!-- ----- debut ControllerStock -->
<?php
require_once '../model/ModelStock.php';

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
 public static function StockReadAll() {
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
 public static function StockReadId($args) {
     if(DEBUG)echo ("controllerStock:vinReadId:begin</br>");
  $results = ModelStock::getAllId();
  
$target = $args['target'];
  if(DEBUG) echo("ControlerStock:ReadId : target = $target</br>");
  
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewId.php';
  require ($vue);
 }

 // Affiche un Stock particulier (id)
 public static function StockReadOne() {
  $Stock_id = $_GET['id'];
  $results = ModelStock::getOne($Stock_id);

  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewAll.php';
  require ($vue);
 }

 // Affiche le formulaire de creation d'un Stock
 public static function StockCreate() {
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewInsert.php';
  require ($vue);
 }

 // Affiche un formulaire pour récupérer les informations d'un nouveau Stock.
 // La clé est gérée par le systeme et pas par l'internaute
 public static function StockCreated() {
  // ajouter une validation des informations du formulaire
  $results = ModelStock::insert(
      htmlspecialchars($_GET['label']), htmlspecialchars($_GET['adresse'])
  );
  // ----- Construction chemin de la vue
  include 'config.php';
  $vue = $root . '/app/view/stock/viewInserted.php';
  require ($vue);
 }
 
 public static function StockDistinctRegion(){
  $results = ModelStock::getDistinctRegion();
   include 'config.php';
  $vue = $root . '/app/view/stock/viewDistinctRegion.php';
  require ($vue);  
 }
 public static function StockRegionStock(){
  $results = ModelStock::getRegionStock();
   include 'config.php';
  $vue = $root . '/app/view/stock/viewRegionStock.php';
  require ($vue);  
 }
 public static function StockDeleted() {
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


