
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

        <table class = "table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope = "col">centre</th>
                    <th scope = "col">quantite</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($centre as $val) {
                    foreach ($results as $element) {
                        if ($val->getId() === $element[0]) { // on ne prend que les données du centre conserné  

                                    printf("<td>%s</td>", $val->getLabel());
                                    printf("<td>%s</td>", $element[1]);
                            echo "</tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $root . '/app/view/fragment/fragmentCaveFooter.html'; ?>

    <!-- ----- fin viewAll -->



