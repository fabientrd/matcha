<?php
/**
 * Created by PhpStorm.
 * User: ftreand
 * Date: 2019-04-04
 * Time: 15:05
 */
include('../models/UsersModel2.php');
include ('../models/LocationModel.php');
require_once "PopulariteController.php";
require '../vendor/autoload.php';
use GeoIp2\Database\Reader;

if (!isset($_SESSION)) {
    session_start();
}

function find_geoip()
{
    $ip = $_SERVER['REMOTE_ADDR'];
    if (!$reader = new Reader('../GeoLite2-City.mmdb')) throw new Exception();
    else
        return $record = $reader->city($ip);
}

function htmldump($variable, $height = "300px")
{
    echo "<pre style=\"border: 1px solid #000; height: {$height}; overflow: auto; margin: 0.5em;\">";
    var_dump($variable);
    echo "</pre>\n";
}

function lowpassword()
{
    $cl = strlen($_POST['password']);
    $spechar = 5;
    if ($cl < 6)
        return 1;
    else if (!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $_POST['password']))
        return $spechar;
    else
        return 0;
}

function recup_data()
{
    $db_con = new infos($_POST);
    return $db_con->array_data();
}

function recup_inter()
{
    $db_con = new infos($_POST);
    return $db_con->array_inter();
}

function recup_user()
{
    $db_con = new infos([]);
    return $db_con->array_user();
}

function recup_user_id($id)
{
    $db_con = new account(array(
        'id' => $id
    ));
    return $db_con->array_user_id($id);
}

function recup_data_id($id)
{
    $db_con = new infos(array(
        'id' => $id
    ));
    return $db_con->array_data_id($id);
}

function recup_inter_id($id)
{
    $db_con = new infos(array(
        'id' => $id
    ));
    return $db_con->array_inter_id($id);
}

/*LIKE*/

function is_like($id_usr, $id_usr_l){
    $db_con = new like(array(
        'id_usr' => $id_usr,
        'id_usr_l' => $id_usr_l
    ));
    $res = $db_con->if_like();
    return $res;
}

function is_like_user($id_usr, $id_usr_l){
    $db_con = new like(array(
        'id_usr' => $id_usr,
        'id_usr_l' => $id_usr_l
    ));
    $res = $db_con->if_like_user();
    return $res;
}

function is_match($id_usr, $id_usr_l){
    $db_con = new like(array(
        'id_usr' => $id_usr,
        'id_usr_l' => $id_usr_l
    ));
    $res = $db_con->if_match();
    return $res;
}

function get_like($id){
    $db_con = new like(array(
        'id_usr' => $id
    ));
    $res = $db_con->fetch_my_like();
    return $res;
}

function get_like2($id){
    $db_con = new like(array(
        'id_usr' => $id
    ));
    $res = $db_con->fetch_my_like2();
    return $res;
}


if (isset($_POST['like']) && $_POST['like'] === 'add'){
    $db_con = new like(array(
        'id_usr' => $_POST['id_usr'],
        'id_usr_l' => $_POST['id_usr_l'],
    ));
    $db_con->add_like();
    add_popularite($_POST['id_usr_l'], 100);
    $res = is_match($_POST['id_usr'], $_POST['id_usr_l']);
    if ($res == 1){
        $_SESSION['match'] = 1;
        add_popularite($_POST['id_usr_l'], 200);
        add_popularite($_POST['id_usr'], 200);
    }

    header('Location: ../view/profile.php?id=' . $_POST['id']);
}

if (isset($_POST['like']) && $_POST['like'] === 'del'){
    $db_con = new like(array(
        'id_usr' => $_POST['id_usr'],
        'id_usr_l' => $_POST['id_usr_l'],
    ));
    $db_con->del_like();
    add_popularite($_POST['id_usr_l'], -100);
    if (isset($_POST['likepage']))
        header('Location: ../view/like.php');
    else
        header('Location: ../view/profile.php?id=' . $_POST['id']);
}

/*MESSAGE*/

if (isset($_POST['send']) && $_POST['send'] === 'ok'){
    $message = $_POST['message'];
    if ($message != htmlspecialchars($_POST['message'])){
        $_SESSION['error'] = 5;
        header('Location: ../view/message.php?id=' . $_POST['id_usr_l']);
        exit;
    }
    $db_con = new discussion(array(
        'id_usr' => $_POST['id_usr'],
        'id_usr_l' => $_POST['id_usr_l'],
        'message' => htmlspecialchars($_POST['message'])
    ));
    $db_con->add_message();
    header('Location: ../view/message.php?id=' . $_POST['id_usr_l']);
}

function get_message($id_usr, $id_usr_l){
    $db_con = new discussion(array(
        'id_usr' => $id_usr,
        'id_usr_l' => $id_usr_l
    ));
    $res = $db_con->fetch_message();
    return $res;
}

function get_all_message($id_usr){
    $db_con = new discussion(array(
        'id_usr' => $id_usr,
    ));
    $res = $db_con->fetch_all_message();
    return $res;
}



// MODIF USER

if (isset($_POST['user_modif']) && $_POST['user_modif'] === 'ok' && isset($_POST['login'])
    && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['nom'])
    && isset($_POST['email'])) {
    $db_con = new account(array(
        'login' => $_SESSION['loggued_on_user']
    ));
    $user = $db_con->array_user();
    echo $_SESSION['loggued_on_user'];
    if (htmlspecialchars($_POST['nom']) !== $_POST['nom'] || htmlspecialchars($_POST['login'])
        !== $_POST['login'] || htmlspecialchars($_POST['email']) !== $_POST['email']) {
        $_SESSION['error'] = 5;
        header('Location: ../view/account.php');
        exit();
    }
    if (!empty($_POST['password']) && !empty($_POST['password2'])) {
        if (strlen($_POST['login']) > 25) {
            $_SESSION['error'] = 1;
            header('Location: ../view/account.php');
            exit();
        }
        if ($_POST['password'] !== $_POST['password2']) {
            $_SESSION['error'] = 2;
            header('Location: ../view/account.php');
            exit();
        }
        $spechar = lowpassword();
        if ($spechar == 5) {
            $_SESSION['error'] = 3;
            header('Location: ../view/account.php');
            exit();
        }
        if (lowpassword() == 1) {
            $_SESSION['error'] = 4;
            header('Location: ../view/account.php');
            exit();
        }
        $password = hash('sha256', $_POST['password']);
    } else
        $password = $db_con->user_passwd();
    $info = new infos([]);
    $id = $info->find_id();
    $db_con = new account($_POST);
    $_SESSION['modif'] = 1;
    if ($var = $db_con->ifLoginTaken() === 1 && isset($_SESSION['error']) && $_SESSION['error'] === 6 && $_POST['login'] !== $user['login']){
        header('Location: ../view/account.php');
        unset ($_SESSION['modif']);
        exit();
    }
    else if  (($var = $db_con->ifEmailTaken() === 1) && $_POST['email'] !== $user['email']){
        $_SESSION['error'] = 7;
        unset ($_SESSION['modif']);
        header('Location: ../view/account.php');
        exit();
    }
    else {
        $db = new account(array(
            'login' => $_POST['login'],
            'password' => $password,
            'email' => $_POST['email'],
            'nom' => $_POST['nom']
        ));
        $db->edit_profil($id);
        unset($_SESSION['error']);
        unset ($_SESSION['modif']);
        $_SESSION['success'] = 1;
        $_SESSION['loggued_on_user'] = $_POST['login'];
        header('Location: ../view/account.php');
    }
}

// MODIF DATA ET INTERET

if (isset($_POST['data_modif']) && $_POST['data_modif'] === 'ok' && isset($_POST['age']) && isset($_POST['location'])
&& isset($_POST['sexe']) && isset($_POST['orientation']) && isset($_POST['bio'])) {
    if (htmlspecialchars($_POST['age']) !== $_POST['age'] || htmlspecialchars($_POST['sexe']) !== $_POST['sexe']
    || htmlspecialchars($_POST['location']) !== $_POST['location'] || htmlspecialchars($_POST['bio']) !== $_POST['bio']){
        $_SESSION['error'] = 5;
        header('Location: ../view/account.php');
        exit();
    }
    $db_con = new infos($_POST);
    $db_con->edit_data();
    $inte = $db_con->array_inter();
    unset($inte['id']);
    unset($inte['id_usr']);
    $inter = [];
    foreach ($_POST as $k => $v) {
        if ($v == 101)
            $inter[$k] = $v;
    }
    $db_con->edit_interest($inte, $inter);
    $_SESSION['success'] = 1;
    header('Location: ../view/account.php');
}
// CREATEPROFILE

if (isset($_POST['createprofile']) && $_POST['createprofile'] === 'ok' && isset($_POST['sexe']) && isset($_POST['age'])
    && isset($_POST['location']) && isset($_POST['orientation']) && isset($_POST['bio'])) {
    $arr = [];
    if (($b = htmlspecialchars($_POST['bio'])) !== $_POST['bio'] ||
        ($l = htmlspecialchars($_POST['location'])) !== $_POST['location']) {
        $_SESSION['error'] = 5;
        header('Location: ../view/createprofile.php');
        exit();
    } else {
        $arr['sexe'] = $_POST['sexe'];
        $arr['age'] = $_POST['age'];
        $arr['location'] = $_POST['location'];
        $arr['orientation'] = $_POST['orientation'];
        $arr['bio'] = $_POST['bio'];
        $db_con = new infos($arr);
        $db_con->add_data();
        $inte = [];
        foreach ($_POST as $k => $v) {
            if ($v == 101)
                $inte[$k] = $v;
        }
        $db_con->add_interest($inte);
        $db_con->profile_complete();
        $_SESSION['success'] = 6;
        $_SESSION['loggued_on_user'] = $_SESSION['loggued_but_not_complet'];
        $db = new account(["login" => $_SESSION['loggued_on_user']]);
        $db->set_statut(1);
        try {
            $record = find_geoip();
            $loc = new location([$record->city->name, $record->postal->code, $record->location->latitude, $record->location->longitude, 0]);
            $loc->add_loc($_SESSION['id']);
        }catch (Exception $e) {
            $loc = new location(['Lyon', '69002', '45.7392364', '4.8174527', 2]);
            $loc->add_loc($_SESSION['id']);
        }
        $db_con->new_pic();
        unset($_SESSION['loggued_but_not_complet']);
        header("Location: ../view");
    }
}

// REGISTER

if (isset($_POST['register']) && $_POST['register'] === 'ok' && isset($_POST['login'])
    && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['password'])
    && isset($_POST['password2'])) {
    if (htmlspecialchars($_POST['nom']) !== $_POST['nom'] || htmlspecialchars($_POST['login'])
        !== $_POST['login'] || htmlspecialchars($_POST['email']) !== $_POST['email']) {
        $_SESSION['error'] = 5;
        header('Location: ../view/register.php');
        exit();
    }
    if (strlen($_POST['login']) > 25) {
        $_SESSION['error'] = 1;
        header('Location: ../view/register.php');
        exit();
    }
    if ($_POST['password'] !== $_POST['password2']) {
        $_SESSION['error'] = 2;
        header('Location: ../view/register.php');
        exit();
    }
    $spechar = lowpassword();
    if ($spechar == 5) {
        $_SESSION['error'] = 3;
        header('Location: ../view/register.php');
        exit();
    }
    if (lowpassword() == 1) {
        $_SESSION['error'] = 4;
        header('Location: ../view/register.php');
        exit();
    }
    $password = hash('sha256', $_POST['password']);
    $new_user = new account(array(
        'login' => $_POST['login'],
        'nom' => $_POST['nom'],
        'password' => $password,
        'email' => $_POST['email'],
    ));
    $var = $new_user->add();
    if ($var === 1) {
        header('Location: ../view/register.php');
        exit();
    } else {
        $new_user->sendMail();
        $_SESSION['loggued_but_not_complet'] = $_POST['login'];
        unset ($_SESSION['loggued_but_not_valid']);
        $_SESSION['success'] = 2;
        header('Location: ../');
    }
}

// CONNEXION

if (isset ($_POST['connec']) && $_POST['connec'] === 'ok' && isset($_POST['password'])
    && isset($_POST['login'])) {
    if (htmlspecialchars($_POST['login']) !== $_POST['login']) {
        $_SESSION['error'] = 5;
        header('Location: ../view/login.php');
        exit();
    }
    $password = hash('sha256', $_POST['password']);
    $user = New account(array(
        'password' => $password,
        'login' => $_POST['login']
    ));
    $var = $user->Connect();
    if ($var === 1) {
        $_SESSION['error'] = 8;
        header("Location: ../view/login.php");
        exit();
    }
    if ($var === 2) {
        $_SESSION['error'] = 9;
        header("Location: ../view/login.php");
        exit();
    }
    if ($var === 3) {
        $_SESSION['error'] = 10;
        header("Location: ../view/login.php");
        exit();
    }
    if ($var === 4) {
//        $_SESSION['error'] = 13;
        header("Location: ../view/createprofile.php");
        exit();
    }
    else {
        $_SESSION['success'] = 4;
        $user->set_statut(1);
        header("Location: ../view/");
    }
}


// MDP OUBLIE

if (isset($_POST['forgot']) && $_POST['forgot'] === 'ok' && isset($_POST['login'])) {
    if (htmlspecialchars($_POST['login']) !== $_POST['login']) {
        $_SESSION['error'] = 5;
        header('Location: ../view/reset.php');
        exit();
    }
    $spe = "!#$%+?@";
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $newpass = substr(str_shuffle($chars), 0, 6);
    $newpass .= substr(str_shuffle($spe), 0, 1);
    $password = hash('sha256', $newpass);
    $new_user = new account(array(
        'login' => $_POST['login'],
        'password' => $password
    ));
    $var = $new_user->ifLoginTaken();
    if ($var !== 1) {
        $_SESSION['error'] = 8;
        header('Location: ../view/reset.php');
        exit();
    } else {
        $new_user->passMail($newpass);
        unset($_SESSION['error']);
        $_SESSION['success'] = 3;
        header('Location: ../view/login.php');
    }
}

// DECONNEXION

function unlog(){
    $user = new account(["login" => $_SESSION['loggued_on_user']]);
    $date = date('Y-m-d H:i:s');
    $user->set_statut($date);
}

// DELETE ACCOUNT A FINIR pour toutes les tables

function delete_account(){
    $db_con = new infos([]);
    $db_con->drop($_SESSION['id']);
}

//FAKE ACCOUNT

function manage_fake_account($arr){
    $db_con = new account($arr);
    $db_con->add();
    $db_con->setValid();
    $db_con->setProfile();
    $db = new infos($arr);
    $id = $db->find_id();
    $db->add_data2($arr['location']);
    $db->addPP($arr['picture']);
    $db->addpop($arr['popularite']);
    $loc = new location($arr['location']);
    $loc->add_loc($id);
    $array['sport'] = rand(0,1);
    $array['voyage'] = rand(0,1);
    $array['vegan'] = rand(0,1);
    $array['geek'] = rand(0,1);
    $array['soiree'] = rand(0,1);
    $array['tattoo'] = rand(0,1);
    $array['musique'] = rand(0,1);
    $array['lecture'] = rand(0,1);
    $array['theatre'] = rand(0,1);
    $array['religion'] = rand(0,1);
    $db->add_interest($array);
}