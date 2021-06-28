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
        <input type="hidden" name='action' value='<?php echo($target);?>'>
        <label for='centre'>Centre dans lequel on veut ajouter un vaccin : </label>
        <select class="form-control" name='centre' style="width: 200px">
            <?php
                foreach ($centre as $value) {
                    echo ("<option>$value</option>");
                }
            ?>
        </select>
        <br>
        <label for='vaccin'>Vaccin à ajouter : </label>
        <select class="form-control" name='vaccin' style="width: 200px">
            <?php
                foreach ($vaccin as $value) {
                    echo ("<option>$value</option>");
                }
            ?>
        </select>
        <br>
        <label for='quantite'>Quantité du vaccin : </label><br>
        <input type="number" name="quantite" value="0">
      </div>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
  </div>

  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>
  <!-- ----- fin viewInsert -->