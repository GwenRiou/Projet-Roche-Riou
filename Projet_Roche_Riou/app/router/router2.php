
<!-- ----- debut Router2 -->
<?php
require ('../controller/ControllerVaccin.php');
require ('../controller/ControllerCentre.php');
require ('../controller/ControllerPatient.php');
require ('../controller/ControllerCave.php');
require ('../controller/ControllerRendezvous.php');
require ('../controller/ControllerStocks.php');
// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// Modification du routeur pour prendre en compte l'ensemble des parametres 
$action = $param['action'];

// --- On supprime l'élément action de la structure
unset($param['action']);

// --- Tout ce qui reste sont des arguments 
$args = $param;

// --- Liste des méthodes autorisées
switch ($action) {
    case "vaccinReadAll" :
    case "vaccinReadOne" :
    case "vaccinReadId" :
    case "vaccinReadLabel" :
    case "vaccinCreate" :
    case "vaccinCreated" :
    case "vaccinDeleted":
    case "vaccinUpdate":
        ControllerVaccin::$action($args);
        break;

    case "centreReadAll" :
    case "centreReadOne" :
    case "centreReadId" :
    case "centreReadLabel" :
    case "centreCreate" :
    case "centreCreated" :
    case "centreDistinctRegion" :
    case "centreRegionCentre" :
    case "centreDeleted" :
    case "associationVaccin" :
        ControllerCentre::$action($args);
        break;
    
    case "patientReadAll" :    
    case "patientCreate" :
    case "patientCreated" :    
        ControllerPatient::$action($args);
        break;
    
    case "stockReadAll" :  
    case "stockReadTotal" :
    case "stockSelect" :
    case "stockReadOne" :
    case "stockUpdate" :
    case "reapprovisionnement" :
    case "getCentreAndVaccin" :
    case "insertVaccinToStock" :
        ControllerStock::$action($args);
        break;
    
    case "rendezvousReadAll" :  
    case "rendezvousSelection" :
    case "rendezvousInjection" :
        ControllerRendezvous::$action($args);
        break;
    

    
    case "chooseLimit" :    
    case "reaprovisionnement" :
        ControllerStock::$action($args);
        break;
    
    case "Documentation" :
    case "PointDeVue" : 
        ControllerCave::$action($args);
        break;
    // Tache par défaut
    default:
        $action = "caveAccueil";
        ControllerCave::$action($args);
}
?>
<!-- ----- Fin Router2 -->

