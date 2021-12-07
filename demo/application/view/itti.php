<?php
include "header.php";
echo '<main>';
echo '<div class="container">';

if (!$data['config']['mode']) {
    $data['config']['mode'] = 'text';
}
if ($data['config']['mode'] == 'text') {
    echo '<div class="text">';
    echo '<h1>';
    echo $data['docu']['title'];
    echo '</h1>';
    echo $data['docu']['content'];
    echo $data['docu']['others'];
    echo '</div>';
} 
if ($data['config']['mode'] == 'ucp') {
    echo '<div class="ucp">';
    echo $data['docu']['content'];
    foreach ($data['docu']['h2'] as $i => $h2) {
        echo '<div id="' . $h2['title'] . '" class="unit">';
        echo '<h2 class="wow animate__animated animate__bounceIn">';
        echo $h2['title'];
        echo '</h2>';
        echo '<div class="wow animate__animated animate__zoomInDown">';
        echo $h2['content'];
        echo '</div>';
        echo '<div class="cards">';
        if (is_array($h2['h3'])) {
            $n = count($h2['h3']);
            foreach ($h2['h3'] as $h3) {
                echo '<div class="card o' . $n . ' wow animate__animated animate__lightSpeedInRight">';
                echo '<h3>' . $h3['title'] . '</h3>';
                echo $h3['content'];
                echo '<p>';
                foreach ($h3['h4'] as $h4) {
                    $h4_json = json_encode($h4);
                    echo "<a href ='javascript:void(0);' onclick ='pop.open(" . $h4_json . ");'>";
                    echo $h4['title'] . '&nbsp;';
                    echo "</a>";
                }
                echo '</p>';
                echo '</div>';
            }
        }
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
}
if ($data['config']['mode'] == 'itti') {
    echo '<div class="itti">';
    echo $data['docu']['content'];
    foreach ($data['docu']['h2'] as $i => $h2) {
        echo '<div id="' . $h2['title'] . '" class="unit">';
        echo '<h2 class="wow animate__animated animate__bounceIn">';
        echo $h2['title'];
        echo '</h2>';
        echo '<div class="wow animate__animated animate__zoomInDown">';
        echo $h2['content'];
        echo '</div>';
        echo '<div class="cards">';
        if (is_array($h2['h3'])) {
            $n = count($h2['h3']);
            foreach ($h2['h3'] as $h3) {
                echo '<div class="card o' . $n . ' wow animate__animated animate__lightSpeedInRight">';
                echo '<h3>' . $h3['title'] . '</h3>';
                echo $h3['content'];
                echo '<p>';
                foreach ($h3['h4'] as $h4) {
                    $h4_json = json_encode($h4);
                    echo "<a href ='javascript:void(0);' onclick ='pop.open(" . $h4_json . ");'>";
                    echo $h4['title'] . '&nbsp;';
                    echo "</a>";
                }
                echo '</p>';
                echo '</div>';
            }
        }
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
}
?>
</div>
        </main>