<!-- ----- début viewUpdate -->
<?php 
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
      <?php
      include $root . '/app/view/fragment/fragmentCaveMenu.html';
      include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
      // $results contient un tableau avec la liste des clés.
      
      $target = "stockUpdate";
      ?>

    <form role="form" method='get' action='router2.php'>
      <div class="form-group">
        <?php echo("Centre : ".$_GET['label']);?>
        <input type="hidden" name='action' value='<?php echo($target);?>'>
        <input type="hidden" name='label' value='<?php echo($_GET["label"])?>'>
        <br>
        <label>Choississez le nombre de doses à ajouter par vaccin (si le nombre entré est négatif, le nombre de doses du vaccin correspondant diminuera de la valeur choisie) : </label>
        <br>
        <?php
            foreach ($results as $key => $value) {
                $label_vaccin = $value["label"];
                $id_vaccin = $value["vaccin_id"];
                echo ("<br>$label_vaccin");
                echo ('<br><label for="doses">doses : </label>');
                echo ("<input name='$id_vaccin' type='number' value='0'>");
            }
            echo ("<br>");
        ?>
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
    <p/>
  </div>

  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewUpdate -->
