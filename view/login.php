<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 11:59
 */

session_start();

if (isset($_SESSION['loggued_on_user']))
    header("Location: index.php");

include('header_alt.php');
?>

<body>

<div id="background">
</div>
<div class="form_create_profil fade-in two">
    <div class="row">
        <div class="col s6">
            <div class="form_pic"></div>
        </div>
        <div class="col s6">
            <h2 class="title-form">Connexion <br><span class="title-form-alt">sign up</span></h2>
        </div>
    </div>
    <form class="fade-in three" id="register-form" method="POST" action="../controllers/ProfilsController.php">
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input id="login" type="text" class="validate" name="login" autofocus required>
                <label for="login">Nom d'utilisateur</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">vpn_key</i>
                <input id="password" type="password" class="validate" name="password" required>
                <label for="password">Mot de passe</label>
            </div>
        </div>
        <input type="hidden" name="connec" value="ok">
        <div style="text-align: center">
            <button class="waves-teal btn-large fade-in five" type="submit" name="submit"
                    value="Créer mon profil">Se connecter
                <i class="material-icons right">send</i>
            </button>
        </div>
    </form>
    <div style="text-align: center; margin-top: 50px">
        <p class="connect fade-in four">Mot de passe oublié ? <a class="link" href="reset.php">Réinitialiser le mot de passe</a></p>
    </div>
</div>

<script src="assets/js/materialize.js"></script>
<script>
    $(document).ready(function () {
        $('select').formSelect();
    });
</script>

</body>