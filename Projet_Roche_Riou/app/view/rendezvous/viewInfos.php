
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
            
            if (!empty($results[1])){
            echo ("Injection : ".$results[1]['injection']);
            echo (", Nom : ".$patient_nom[0][0]. " prenom : ".$patient_nom[0][1] );
            echo (", Vaccin : ".$vaccin_label[0]['Label']);
            echo (", Centre : ".$centre_2[0][0]);
            echo"<br>";}
            echo ("Injection : ".$results[0]['injection']);
            echo (", Nom : ".$patient_nom[0][0]. " prenom : ".$patient_nom[0][1] );
            echo (", Vaccin : ".$vaccin_label[0]['Label']);
            echo (", Centre : ".$centre_1[0][0]);
            
            ?>  

    </div>
<?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

    <!-- ----- fin viewAll -->


