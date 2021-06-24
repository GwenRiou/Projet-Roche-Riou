
<!-- ----- début viewInserted -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
echo"<pre>";
print_r($results);
echo"</pre>";
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
     echo ("<h3>La nouvelle recolte a été ajouté </h3>");
     echo("<ul>");
     echo ("<li>producteur_id = " . $results[0] . "</li>");
     echo ("<li>vin_id = " . $results[1] . "</li>");
     echo ("<li>quantité = " . $results[2] . "</li>");
     echo("</ul>");
    } else {
     echo ("<h3>Problème d'insertion du Producteur</h3>");
     echo ("id = " . $results);
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewInserted -->    

    
    