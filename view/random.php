<?php
require '../vendor/autoload.php';
require '../controllers/ProfilsController.php';
require '../controllers/SuggestController.php';

$faker = Faker\Factory::create('fr_FR');
$login = $_SESSION['loggued_on_user'];
for ($i = 0; $i < 500; $i++) {
    $city = [
        ["Paris", "75001", "48.84495494047618", "2.376084880952381", "1"],
        ["Saint-Ay", "45130", "47.860911", "1.752895", "0"],
        ["Orleans", "45000", "47.903914", "1.902856", "0"],
        ["Orleans", "45000", "47.901519", "1.907513", "0"],
        ["Paris", "75009", "48.878500", "2.348276", "9"],
        ["Paris", "75005", "48.843674", "2.353916", "5"],
        ["Paris", "75017", "48.888758", "2.310995", "17"],
        ["Lyon", "69002", "45.739428", "4.818012", "2"],
        ["Lyon", "69005", "45.751808", "4.811055", "5"],
        ["Lyon", "69401", "45.760756", "4.852178", "0"],
        ["Marseille", "13008", "43.276430", "5.378462", "8"],
        ["Marseille", "13003", "43.309650", "5.384995", "3"],
        ["Toulon", "83000", "43.123331", "5.930767", "0"],
        ["Rennes", "35000", "48.115595", "-1.675276", "0"],
        ["Nancy", "54000", "48.693798", "6.186916", "0"],
        ["Toulouse", "31000", "43.605553", "1.435772", "0"],
        ["Caen", "14000", "49.179240", "-0.373033", "0"],
        ["Nice", "06300", "43.695197", "7.269949", "0"],
        ["Tours", "37000", "47.377760", "0.675022", "0"],
        ["Blois", "41000", "47.590098", "1.321244", "0"],
        ["Giens", "45500", "47.695641", "2.639129", "0"],
        ["Saint-Etienne", "42000", "45.430198", "4.401099", "0"]];
    $num = rand(0, 21);
    $arr['nom'] = $faker->name;
    $arr['login'] = $faker->userName;
    $arr['location'] = $city[$num];
    $arr['email'] = $faker->email;
    $arr['password'] = hash('sha256', 'Fabien69@');
    $arr['bio'] =  $faker->realText($maxNbChars = 255, $indexSize = 2);
    $arr['age'] =  $age = rand(18, 116);
    $arr['orientation'] = $ori = rand(0, 6);
    $arr['sexe'] = $sexe = rand(0,5);
    $int = rand(0, 2047);
    $arr['picture'] =  $faker->imageUrl($width = 420, $height = 420, 'people');
    $arr['interest'] = $base = base_convert($int, 10, 2);
    $arr['popularite'] = rand(0, 10000);
    $_SESSION['loggued_on_user'] = $arr['login'];
    manage_fake_account($arr);
    unset($_SESSION['loggued_on_user']);
}
$_SESSION['loggued_on_user'] = $login;
header("Location: ../index.php");

