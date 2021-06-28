
<!-- ----- début viewId -->
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
        <label for="limite">Choisissez la quantité en deça de laquelle il faut faire un réapprovisionnement : </label>
        <br><input type="number" name="limite" value="1">
      </div>
      <button class="btn btn-primary" type="submit">Submit form</button>
    </form>
  </div>

  <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

  <!-- ----- fin viewId -->