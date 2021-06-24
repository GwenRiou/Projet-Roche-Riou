
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

    <table class = "table table-striped table-bordered">
      <thead>
          
        <tr>
            
          <?php 
                                
          $cols=$results[0];
          foreach($cols as $key => $element){
              if(!is_numeric($key)){
                echo ( "<th scope = 'col'>$key</th>");
               }
          }
          ?>          
        </tr>
      </thead>
      <tbody>
          
         <?php
          
          // La liste des recoltes est dans une variable $results             
          foreach ($results as $valeurs) {
              echo"<tr>";
              foreach($valeurs as $cle => $val){
                  
                  if(is_numeric($cle)){
                      
                    echo ( "<td>" .$val."</td>");
                  }
              }
              echo"</tr>";
          }
          ?>
      </tbody>
    </table>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewAll -->
  
  
  