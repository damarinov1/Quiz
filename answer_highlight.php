<?php

/**
 * 
 * @global type $previousAnswer
 * @param type $isTrue
 */
function previousAns($isTrue, $previousAnswer)
{

    $color = "red";

    if ($isTrue) {
        $color = "green";
    }

    echo "<strong><span style='color:{$color}'>" . $previousAnswer . "</span></strong>";
}
