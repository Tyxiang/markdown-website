<header>
    <div class="container">
        <div id="logo">
        <a href="default.md">
            <img src="<?=$start_dir_path . $config_dir_path?>logo.png" alt="logo" >
        </a>
        </div>
    </div>
    <div class="container">
        <?php
        if (isset($header['nav'])) {
            echo '<div class="nav">';
            echo $header['nav'];
            echo '</div>';
        }
        ?>
    </div>
</header>
