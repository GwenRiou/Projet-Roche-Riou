
<!-- ----- debut ControllerVin -->
<?php

class ControllerCave {
 // --- page d'acceuil
 public static function caveAccueil() {
  include 'config.php';
  $vue = $root . '/app/view/viewCaveAccueil.php';
  if (DEBUG)
   echo ("ControllerCase : caveAccueil : vue = $vue");
  require ($vue);
 }

 public static function mesPropositions(){
  include 'config.php';
  $vue = $root . '/app/view/propositions/propositions.php';
  
  if (DEBUG)
   echo ("ControllerCave : mes propositions : vue = $vue");
  require ($vue);
    
} 
}
?>
<!-- ----- fin ControllerVin -->


