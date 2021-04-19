<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 12:03
 */
include ('../controllers/ProfilsController.php');
if (!isset($_SESSION))
    session_start();
unlog();
unset($_SESSION);
session_destroy();
header('Location: ../index.php');
?>