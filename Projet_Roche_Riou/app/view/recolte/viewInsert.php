
<!-- ----- début viewInsert -->
 
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
        <input type="hidden" name='action' value='recolteCreated'>        
        
        <label for="id">Selectionner un vin : </label> <select class="form-control" vin='vin' name='vin' style="width: 300">
           
            <?php            
            foreach ($resultat[0] as $valeurs) {
              echo"<option>";
              foreach($valeurs as $cle => $val){
                  
                  if(is_numeric($cle)){
                      
                    echo ( "$val : ");
                  }
              }
              echo"</option>";
          }
            ?>
        </select>
            <label for="id">Selectionner un producteur : </label> <select class="form-control" producteur='producteur' name='producteur' style="width: 300px">
           
            <?php            
            foreach ($resultat[1] as $valeurs) {
              echo"<option>";
              foreach($valeurs as $cle => $val){
                  
                  if(is_numeric($cle)){
                      
                    echo ( "$val : ");
                  }
              }
              echo"</option>";
          }
            ?>
            </select>
            <label for="id">quantité : </label><br><input type="number" name='quantite'  value='10'>          
      </div>
        
      <p/>
      <button class="btn btn-primary" type="submit">Go</button>
    </form>
    <p/>
  </div>
  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewInsert -->



