
<!-- ----- debut viewReap -->
<?php require ($root . '/app/view/fragment/fragmentCaveHeader.html'); ?>

  <div class="container">
    <?php
        include $root. '/app/view/fragment/fragmentCaveMenu.html';
        include $root.'/app/view/fragment/fragmentCaveJumbotron.html';

        if (!empty($results)) {
    ?>
        <h3>Liste des centres et leurs vaccins associés à réapprovisionner (quantité inférieure à <?php echo($_GET['limite']);?>).</h3>
        <br>

        <table class="table table-striped table-bordered">
            <th>Centre</th>
            <th>Vaccin</th>
            <th>Quantite</th>
            <?php
                foreach($results as $value) {
                    echo("<tr><td>".$value['centre']."</td><td>".$value['vaccin']."</td><td>".$value['quantite']."</td></tr>");
                }
            ?>
        </table>
    <?php
        } else {
            echo("<h3>Aucun vaccin ne nécessite un réapprovisionnement (Aucune quantité inférieure à ".$_GET["limite"].").</h3>");
        }
    ?>
  </div>   
  
  
  <?php
  include $root. '/app/view/fragment/fragmentCaveFooter.html';
  ?>

  <!-- ----- fin viewReap -->