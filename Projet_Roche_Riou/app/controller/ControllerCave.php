
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

    public static function Documentation1() {
        include 'config.php';
        $vue = $root . '/app/view/Documentation/documentation1.php';

        if (DEBUG)
            echo ("ControllerCave : mes propositions : vue = $vue");
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
<!-- ----- fin ControllerVin -->


