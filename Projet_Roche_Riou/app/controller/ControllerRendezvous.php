
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
        //test 
        if (empty($results)) {// Si le resultat est vide, c'est la première injection
            // affiche la liste des centres 
            // première injection
            $injection = 1;
            $centre = ModelCentre::getAllLabelId();
            include 'config.php';
            $vue = $root . '/app/view/rendezvous/viewCentre.php';
            if (DEBUG)
                echo ("ControllerRendezvous : RendezvousReadAll : vue = $vue");
            require ($vue);
        } else if (!empty($results[0])&& $results[0]['vaccin_id']!=3) {
            //deuxième injection
            $injection = 2;
            $centre = ModelCentre::getAllLabelId();
            include 'config.php';
            $vue = $root . '/app/view/rendezvous/viewCentre.php';
            if (DEBUG)
                echo ("ControllerRendezvous : RendezvousReadAll : vue = $vue");
            require ($vue);
            // affiche la liste des centres en fonction des vaccins dispponibles
            // + demander l'untilisateur de choisir un centre
        } else {
            //afficher les infos du patient
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
        ModelRendezvous::Creation($patient_id, $centre, $injection);
        $results = ModelRendezvous::getOne($patient_id);

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

    // Affiche un formulaire pour récupérer les informations d'un nouveau Rendezvous.
    // La clé est gérée par le systeme et pas par l'internaute
    public static function RendezvousCreated() {
        // ajouter une validation des informations du formulaire
        $results = ModelRendezvous::insert(
                        htmlspecialchars($_GET['nom']), htmlspecialchars($_GET['prenom']), htmlspecialchars($_GET['adresse'])
        );
        // ----- Construction chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/rendezvous/viewInserted.php';
        require ($vue);
    }

    public static function RendezvousDistinctRegion() {
        $results = ModelRendezvous::getDistinctRegion();
        include 'config.php';
        $vue = $root . '/app/view/rendezvous/viewDistinctRegion.php';
        require ($vue);
    }

    public static function RendezvousRegionRendezvous() {
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


