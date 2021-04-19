<?php

session_start();
if (isset($_SESSION['loggued_but_not_complet']))
    header("Location: createprofile.php");

if (!isset($_SESSION['loggued_on_user']))
    header("Location: ../index.php");

include('header_connect.php');
?>

<body>
<div id="background"></div>

<div class="container fade-in two">
    <div class="user_like">
        <div class="row">
            <div class="title_account2">
                <img class="image_title_account" src="assets/images/heart.svg">
                <h2 style="margin-left: 10px; text-align: left;" class="title-form-alt title-form-alt2">Mes <br><span
                            class="title-form">Likes</span></h2>
            </div>
        </div>
        <table class="striped">
            <thead>
            <tr>
                <th><i class="material-icons left">account_circle</i>Utilisateur</th>
                <th><i class="material-icons left">favorite</i>Match</th>
                <th><i class="material-icons left">build</i>Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            /*       $db2 = new infos([]);*/
            $res = get_like2($_SESSION['id']);
            if (!empty($res)) {
                $db_con = new account([]);
                foreach ($res as $key => $value) {
                    $id_usr = $_SESSION['id'];
                    $id_usr_l = $value['id_usr'];
                    $match = is_match($_SESSION['id'], $id_usr_l);
                    if ($match == 1) {
                        $style_match = 'color: #f50057';
                        $match = 'You Match !';
                    } else {
                        $match = 'You haven\'t match yet';
                        $style_match = '';
                    }
                    $nom = $db_con->select_nom($value['id_usr']);
                    $login = $db_con->select_login($value['id_usr']);
                    $profil_btn = "<a href='profile.php?id=$id_usr_l'><button class='btn_like_page waves-effect waves-light btn blue' name='profil'><i class=\"fas fa-user left\"></i>PROFIL</button></a>";
                    $like = is_like($id_usr, $id_usr_l);
                    if ($like == 1) {
                        $like_btn = "
                            <form method='post' action='../controllers/ProfilsController.php'>
                            <input type='hidden' name='id_usr' value='$id_usr'>
                            <input type='hidden' name='id_usr_l' value='$id_usr_l'>
                            <input type='hidden' name='id' value='$id_usr_l'>
                            <button class='pbb btn_like_page waves-effect waves-light btn' name='like' value='del'><i class=\"fas fa-heart-broken left\"></i>DISLIKE</button>
                            </form>";
                    } else {
                        $like_btn = "
                            <form method='post' action='../controllers/ProfilsController.php'>
                            <input type='hidden' name='id_usr' value='$id_usr'>
                            <input type='hidden' name='id_usr_l' value='$id_usr_l'>
                            <input type='hidden' name='id' value='$id_usr_l'>
                            <button class='pbb btn_like_page waves-effect waves-light btn' name='like' value='add'><i class=\"material-icons left\">favorite</i>LIKE</button>
                            </form>";
                    }
                    echo "
                    <tr class='fade-in three'>
                    <td>$nom ($login)</td>
                    <td style='$style_match'>$match</td>
                    <td>$like_btn $profil_btn</td>
                    </tr>
                    ";
                }
            } else
                echo "
                    <tr>
                    <td></td>
                    <td>Aucun like.</td>
                    <td></td>
                    </tr>
                    ";
            ?>
            </tbody>
        </table>

    </div>
</div>

<script>

</script>

<script src="assets/js/materialize.js"></script>
</body>