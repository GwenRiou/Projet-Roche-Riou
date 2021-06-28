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
        <label>Choississez le nombre de doses à ajouter par vaccin : </label>
        <br>
        <?php
            foreach ($results as $key1 => $value1) {
                //foreach ($value1 as $key2 => $value2) {
                    //echo ("$key2");
                    //if ($key2 == "label") {
                    $label_vaccin = $value1["label"];
                    $id_vaccin = $value1["vaccin_id"];
                        echo ("<br>$label_vaccin");
                        echo ('<br><label for="doses">doses : </label>');
                        //echo ("<input name='$id_vaccin' type='number' value='0'>");
                        echo ("<input name='$id_vaccin' type='number' value='0'>");
                    //}
                //}
            }
            echo ("<br>");
            //print_r($results);
        ?>
      </div>
      <p/>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
    <p/>
  </div>

  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewUpdate -->