<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $theme = $_POST['theme'];
    $_SESSION['theme'] = $theme;
}
?>
