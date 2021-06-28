<!-- ----- début viewUpdate -->
<?php 
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
    <div class="container">
        <?php
            include $root . '/app/view/fragment/fragmentCaveMenu.html';
            include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
            // $results contient un tableau avec la liste des clés.
        ?>

        <?php
            if ($results == -1) {
                echo ("<h3>Problème de mise à jour des stocks</h3>");
                echo ("code d'erreur : " . $results);
                
            } else if ($results == -2) {
                echo ("<h3>Nombre de stock nul, aucun changement dans la table</h3>");
            } else {
               echo ("<h3>Les stocks ont été mise à jour </h3>");
            }
            echo("</div>");
            include $root . '/app/view/fragment/fragmentCaveFooter.html';
        ?>
  <!-- ----- fin viewUpdate -->