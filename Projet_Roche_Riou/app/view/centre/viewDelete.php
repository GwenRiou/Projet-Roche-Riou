
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
    if ($results!=-1) {
     echo ("<h3>Le centre a été supprimé </h3>");
     echo("<ul>");
     echo ("<li>id = " . $results . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème de supprésion du producteur</h3>");
     echo ("id = " . $results);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    