
<!-- ----- début viewSelectCentre -->
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
        <label for="centre">Choisissez le centre à supprimer (seuls les centres n'ayant plus aucune dose peuvent être supprimés) : </label>
        <select class="form-control" id='centre' name='centre' style="width: 200px">
            <?php
            foreach ($results as $value) {
             echo ("<option>$value</option>");
            }
            ?>
        </select>
      </div>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
  </div>

  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewSelectCentre -->