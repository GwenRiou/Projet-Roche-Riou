
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?>
    <!-- ===================================================== -->
    <?php
    if ($results == 0) {
        echo ("<h3>Le vaccin a été ajouté au centre</h3>");
        echo("<ul>");
        echo ("<li>centre = " . $_GET['centre']. "</li>");
        echo ("<li>vaccin = " . $_GET['vaccin'] . "</li>");
        echo ("<li>quantite = " . $_GET['quantite'] . "</li>");
        echo("</ul>");
    } else if ($results == -1) {
        echo ("<h3>Problème d'insertion du vaccin</h3>");
    } else {
        echo ("Le vaccin " . $_GET['vaccin'] . " est déjà associé au centre " . $_GET['centre'] .".");
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    