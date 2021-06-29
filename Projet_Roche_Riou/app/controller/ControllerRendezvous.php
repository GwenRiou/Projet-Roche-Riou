
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

    public static function RendezvousSelection() {
        $patient = $_GET['patient'];
        $patient_id = substr($patient, 0, 1); // on recupère l'id du patient
        $results = ModelRendezvous::getOne($patient_id);
        // affiche info 
        if (empty($results[0])) {// Si le resultat est vide, c'est la première injection
            // affiche la liste des centres 
            // première injection
            $injection = 1;
            $vaccin_id = 0;
            echo "première injection";
            $centre = ModelCentre::getAllLabelId();
            include 'config.php';
            $vue = $root . '/app/view/rendezvous/viewCentre.php';
            if (DEBUG)
                echo ("ControllerRendezvous : RendezvousReadAll : vue = $vue");
            require ($vue);
        } else if (empty($results[1]) && $results[0]['vaccin_id'] != 4) {
            //deuxième injection
            $injection = 2;
            $vaccin_id = $results[0]['vaccin_id'];
            echo "deuxième injection";
            $centre = ModelCentre::getIdLabelVaccin($results[0]['vaccin_id']);
            include 'config.php';
            $vue = $root . '/app/view/rendezvous/viewCentre.php';
            if (DEBUG)
                echo ("ControllerRendezvous : RendezvousReadAll : vue = $vue");
            require ($vue);
            // affiche la liste des centres en fonction des vaccins dispponibles
            // + demander l'untilisateur de choisir un centre
        } else {
            //afficher les infos du patient
            $patient_nom = ModelPatient::getNomPrenom($results[0]['patient_id']);
            $vaccin_label = ModelVaccin::getLabelfromId($results[0]['vaccin_id']);
            $centre_1 = ModelCentre::getLabelfromId($results[0]['centre_id']);
            if(!empty($results[1])){$centre_2 = ModelCentre::getLabelfromId($results[1]['centre_id']);}
            include 'config.php';
            $vue = $root . '/app/view/rendezvous/viewInfos.php';
            if (DEBUG)
                echo ("ControllerRendezvous : RendezvousReadAll : vue = $vue");
            require ($vue);
        }
        // ----- Construction chemin de la vue
    }

    public static function RendezvousInjection() {
        $patient_id = $_GET['patient_id'];
        $centre = substr($_GET['centre'], 0, 1);
        $injection = $_GET['injection'];
        echo $injection;
        $vaccin_id = $_GET['vaccin_id'];
        ModelRendezvous::Creation($patient_id, $centre, $injection, $vaccin_id);
        $results = ModelRendezvous::getOne($patient_id);

        $patient_nom = ModelPatient::getNomPrenom($results[0]['patient_id']);
        $vaccin_label = ModelVaccin::getLabelfromId($results[0]['vaccin_id']);
        $centre_1 = ModelCentre::getLabelfromId($results[0]['centre_id']);
        $centre_2 = ModelCentre::getLabelfromId($results[1]['centre_id']);

        include 'config.php';
        $vue = $root . '/app/view/rendezvous/viewInfos.php';
        if (DEBUG)
            echo ("ControllerRendezvous : RendezvousReadAll : vue = $vue");
        require ($vue);
    }

    // Affiche un formulaire pour sélectionner un id qui existe
    public static function RendezvousReadId($args) {
        if (DEBUG)
            echo ("controllerRendezvous:vinReadId:begin</br>");
        $results = ModelRendezvous::getAllId();

        
        $target = $args['target'];
        if (DEBUG)
            echo("ControlerRendezvous:ReadId : target = $target</br>");

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
   
}
?>
<!-- ----- fin ControllerRendezvous -->


