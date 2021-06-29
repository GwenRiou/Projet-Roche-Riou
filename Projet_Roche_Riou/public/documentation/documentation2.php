 
<!-- ----- debut de la page documentation 2 -->
<?php require ($root. '/app/view/fragment/fragmentCaveHeader.html'); ?>
  <div class="container">
    <?php
    include $root. '/app/view/fragment/fragmentCaveMenu.html';
    include $root.'/app/view/fragment/fragmentCaveJumbotron.html';
    ?>  
        <h3>Innovation 2 : Réapprovisionnement des stocks</h3>
        <p>
            Cette innovation permet d'afficher les vaccins des centres ayant une quantité inférieure à un nombre donné par l'utilisateur.<br>
            L'utilisateur entre une valeur, admettons 10, puis nous allons rechercher tous les vaccins ayant moins de 10 doses (quantité), nous allons alors afficher dans un tableau le nom des vaccins pour chaque centre avec une quantité inférieure à 10 (dans notre cas).<br>
            Nous avons déjà une requête permettant l'ajout de doses, cependant nous avons pensé qu'il serait utile de pouvoir observer quels sont les vaccins n'ayant plus assez de doses (et nous laissons l'utilisateur définir la limite).
        </p>
    </div>
  <?php
  include $root. '/app/view/fragment/fragmentCaveFooter.html';
  ?>
  <!-- ----- fin de la page documentation 2 -->