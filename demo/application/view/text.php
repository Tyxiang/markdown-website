<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="description" Content="<?=@$config['description'] . " " . @$meta['description']?>">
        <meta name="Keywords" Content="<?=@$config['keywords'] . " " . @$meta['keywords']?>">
        <base href="<?=$work_dir_path?>">
        <link rel="shortcut icon" href="<?=$start_dir_path . $config_dir_path?>view/icon/fav.ico" >
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/normalize.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/basic.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/color.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/layout.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/small-screen.css" type="text/css">
        <link rel="stylesheet" href="<?=$start_dir_path . $app_dir_path?>view/css/text.css" type="text/css">
        <title><?=@$main['h1'][0]['title'] . ' - ' . @$config['website-name']?></title>
    </head>
    <body>
        <?php
        include "_header.php";
        ?>
        <main>
            <div class="container">
                <div class="text">
                    <?= $main['others']?>
                </div>
            </div>
        </main>
        <?php
        include "_ending.php";
        include "_footer.php";
        ?>
    </body>
</html>
