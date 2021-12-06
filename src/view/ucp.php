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
                <div class="ucp">
<?php
echo $main['h1'][0]['content'];
foreach ($main['h1'][0]['h2'] as $i => $h2) {
    echo '<div id="' . $h2['title'] . '" class="unit">';
    echo '<h2 class="wow animate__animated animate__bounceIn">';
    echo $h2['title'];
    echo '</h2>';
    echo '<div class="wow animate__animated animate__zoomInDown">';
    echo $h2['content'];
    echo '</div>';
    echo '<div class="cards">';
    if (isset($h2['h3']) && is_array($h2['h3'])) {
        $n = count($h2['h3']);
        foreach ($h2['h3'] as $h3) {
            echo '<div class="card o' . $n . ' wow animate__animated animate__lightSpeedInRight">';
            echo '<h3>' . $h3['title'] . '</h3>';
            echo $h3['content'];
            echo '<p>';
            if (isset($h3['h4'])) {
                foreach ($h3['h4'] as $h4) {
                    $h4_json = json_encode($h4);
                    echo "<a href ='javascript:void(0);' onclick ='pop.open(" . $h4_json . ");'>";
                    echo $h4['title'] . '&nbsp;';
                    echo "</a>";
                }
            }
            echo '</p>';
            echo '</div>';
        }
    }
    echo '</div>';
    echo '</div>';
}
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
<script src="<?$start_dir_path?>markdown-website/view/js/pop.min.js"></script>
<script src="<?$start_dir_path?>markdown-website/view/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>