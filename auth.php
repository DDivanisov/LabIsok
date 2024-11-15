<?php
session_start();
function logedIn(){
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    return true;
}
?>
