<!DOCTYPE html>
<html class="no-js">
        <?php
        include "_head.php";
        ?>
    <body>
        <?php
        include "_header.php";
        ?>
        <main>
            <div class="container">
                <div class="text">
                <?php
                // echo '<h1>';
                // echo $docunt']['title'];
                // echo '</h1>';
                // echo $docunt']['content'];
                // echo $docunt']['others'];
                echo $main['others'];
                ?>
                </div>
            </div>
        </main>
        <?php
        include "_ending.php";
        include "_footer.php";
        ?>
    </body>
</html>
<script src="<?$start_dir_path?>mdweb/view/js/pop.min.js"></script>
<script src="<?$start_dir_path?>mdweb/view/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>