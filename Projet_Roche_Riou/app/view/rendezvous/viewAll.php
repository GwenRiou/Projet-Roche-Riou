
<!-- ----- début viewAll -->
<?php

require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentCaveMenu.html';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
      ?>
    <form role="form" method='get' action='router2.php'>
      <div class="form-group">
        <input type="hidden" name='action' value='rendezvousSelection'>        
        
        <label for="id">Selectionner un patient : </label> 
        <select class="form-control" patient='patient' name='patient' style="width: 300">
           
            <?php            
            foreach ($results as $element) {
              echo"<option>";
                  printf("%d :", $element->getId());
                  
                  printf(" %s : %s : %s",$element->getNom(),$element->getPrenom(), $element->getAdresse());
              
              echo"</option>";
            }
            ?>  
        </select>
      </div>
        
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  