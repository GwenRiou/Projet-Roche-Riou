
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
                <input type="hidden" name='action' value='rendezvousInjection'> 

                <label for="id">Selectionner un centre : </label>
                <?php
                echo('<input type="hidden" name="patient_id"  value='.$patient_id.'>');
                echo('<input type="hidden" name="injection"  value='.$injection.'>');
                echo('<input type="hidden" name="vaccin_id"  value='.$vaccin_id.'>');
                ?>
                <select class="form-control" centre='centre' name='centre' style="width:300">
                    <?php
                    // La liste des centres est dans une variable $centre             
                    foreach ($centre as $element) {
                        echo"<option>";
                        printf("%d : %s",$element['id'],$element['label']);
                        echo"</option>";
                    }
                    ?>
                </select>
            </div>
            <button class = "btn btn-primary" type = "submit">Go</button>
        </form>
    </div>
<?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

<!-- ----- fin viewAll -->



