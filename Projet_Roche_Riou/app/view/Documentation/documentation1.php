 
<!-- ----- debut de la page cave_acceuil -->
<?php require ($root . '/app/view/fragment/fragmentCaveHeader.html'); ?>
<body>
  <div class="container">
    <?php
    include $root. '/app/view/fragment/fragmentCaveMenu.html';
    include $root.'/app/view/fragment/fragmentCaveJumbotron.html';
    
    include $root.'/public/documentation/documentation1.php';
    ?>
  </div>   
  
  
  <?php
  include $root. '/app/view/fragment/fragmentCaveFooter.html';
  ?>

  <!-- ----- fin de la page cave_acceuil -->

</body>
</html>


