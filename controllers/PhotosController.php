<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-04-11
 * Time: 18:03
 */

if (!isset($_SESSION)) {
    session_start();
}

include '../models/UsersModel2.php';

if (isset($_POST['hidden_data'])) {
    $upload_dir = "../upload/";
    $img = $_POST['hidden_data'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    $_SESSION['nbr'] = 0;
    $_SESSION['photo'] = '../upload/' . $collage . '.png';
    unset($_POST['hidden_data']);
}

if (isset($_POST['hidden_data1'])) {
    $upload_dir = "../upload/";
    $img = $_POST['hidden_data1'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    $_SESSION['nbr'] = 1;
    $_SESSION['photo'] = '../upload/' . $collage . '.png';
    unset($_POST['hidden_data1']);
}

if (isset($_POST['hidden_data2'])) {
    $upload_dir = "../upload/";
    $img = $_POST['hidden_data2'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    $_SESSION['nbr'] = 2;
    $_SESSION['photo'] = '../upload/' . $collage . '.png';
    unset($_POST['hidden_data2']);
}

if (isset($_POST['hidden_data3'])) {
    $upload_dir = "../upload/";
    $img = $_POST['hidden_data3'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    $_SESSION['nbr'] = 3;
    $_SESSION['photo'] = '../upload/' . $collage . '.png';
    unset($_POST['hidden_data3']);
}

if (isset($_POST['hidden_data4'])) {
    $upload_dir = "../upload/";
    $img = $_POST['hidden_data4'];
    $img = str_replace('data:image/png;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    $file = $upload_dir . date('Y-m-d_g:i:s') . ".png";
    $collage = date('Y-m-d_g:i:s');
    $success = file_put_contents($file, $data);
    $_SESSION['nbr'] = 4;
    $_SESSION['photo'] = '../upload/' . $collage . '.png';
    unset($_POST['hidden_data4']);
}

