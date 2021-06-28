
<!-- ----- début viewCentreDeleted -->
<?php
require ($root . '/app/view/fragment/fragmentCaveHeader.html');
?>

<body>
  <div class="container">
    <?php
    include $root . '/app/view/fragment/fragmentCaveMenu.html';
    include $root . '/app/view/fragment/fragmentCaveJumbotron.html';
    ?>
    <!-- ===================================================== -->
    <?php
    if (empty($results)) {
        echo ("<h3>Le centre " . $_GET['centre'] . " a été supprimé.</h3>");
    } else {
    ?>
    <h3>Le centre <?php echo($_GET['centre']); ?> n'a pas pu être supprimé car il reste des doses :</h3>
    <table class="table table-striped table-bordered">
        <th>Vaccin</th>
        <th>Quantité</th>
        <?php
        foreach($results as $key => $value) {
            echo("<tr><td>".$value['label']."</td><td>".$value['quantite']."</td></tr>");
        }
        ?>
    </table>
    <?php
    }

    echo("</div>");
    
    include $root . '/app/view/fragment/fragmentCaveFooter.html';
    ?>
    <!-- ----- fin viewCentreDeleted -->    
