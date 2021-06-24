
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

            <?php
            
            foreach ($results as $valeur){
            
              foreach($valeur as $cle => $val){
                  
                  if(is_numeric($cle)){}
                  else{
                    echo($cle." = ".$val."   ");
                  }                  
              }
              echo"<br>";
            }          
            ?>  

    </div>
<?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

    <!-- ----- fin viewAll -->


