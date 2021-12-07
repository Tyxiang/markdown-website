<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="Keywords" Content="<?=@$config['keywords'] . " " . @$meta['keywords']?>">
        <base href="<?=$work_dir_path?>">
        <link rel="shortcut icon" href="<?=$start_dir_path . $config_dir_path?>view/icon/fav.ico" >
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/normalize.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/basic.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/color.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/layout.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/small-screen.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/text.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/ucp.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/animate.min.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/pop.min.css" type="text/css">
        <title><?=@$main['h1'][0]['title'] . ' - ' . @$config['website-name']?></title>
    </head>
    <body>
        <?php
        include "_header.php";
        ?>
        <main>
            <div class="container">
                <div class="ucp">
<?php
if (isset($main['h1'][0])) {
    echo $main['h1'][0]['content'];
    if (isset($main['h1'][0]['h2'])) {
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
    }
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
<script src="<?=$start_dir_path . $app_dir_path?>view/js/pop.min.js"></script>
<script src="<?=$start_dir_path . $app_dir_path?>view/js/wow.min.js"></script>
<script> new WOW().init(); </script> 