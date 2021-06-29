
<!-- ----- debut Controller -->
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

    public static function documentation($args) {
        // ----- Construction chemin de la vue
        include 'config.php';
        switch ($args['target']) {
            case 1 :
                $vue = $root . '/public/documentation/documentation1.php';
            break;
            case 2 :
                $vue = $root . '/public/documentation/documentation2.php';
            break;
            case 3 :
                $vue = $root . '/public/documentation/documentation3.php';
            break;
            default:
                $vue = $root . '/app/view/viewCaveAccueil.php';
            break;
        }
        require ($vue);
    }
    
    public static function PointDeVue() {
        include 'config.php';
        $vue = $root . '/app/view/Documentation/PointDeVue.php';

        if (DEBUG)
            echo ("ControllerCave : mes propositions : vue = $vue");
        require ($vue);
    }
}
?>
<!-- ----- fin Controller -->


