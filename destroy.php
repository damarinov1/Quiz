<?php

function destroySession()
{
    session_start();
    session_destroy();

    header("Location: index.php");
}
destroySession();
