<?php
if ($ending) {
    echo '<ending>';
    echo '<div class="container">';
    if ($ending['left-1']) {
        echo '<div class="left-1">';
        echo $ending['left-1'];
        echo '</div>';
    }
    if ($ending['left-2']) {
        echo '<div class="left-2">';
        echo $ending['left-2'];
        echo '</div>';
    }
    if ($ending['left-3']) {
        echo '<div class="left-3">';
        echo $ending['left-3'];
        echo '</div>';
    }
    if ($ending['left-4']) {
        echo '<div class="left-4">';
        echo $ending['left-4'];
        echo '</div>';
    }
    if ($ending['right']) {
        echo '<div class="right">';
        echo $ending['right'];
        echo '</div>';
    }
    echo '</div>';
    echo '</ending>';
}