<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 11:59
 */

if (!isset($_SESSION))
    session_start();

if (isset($_SESSION['loggued_but_not_complet']))
    header("Location: createprofile.php");

if (!isset($_SESSION['loggued_on_user']))
    header("Location: ../index.php");

include('header_connect.php');

if (isset($_SESSION['nbr']) && isset($_SESSION['photo'])) {
    $photo = new photos(['collage' => $_SESSION['photo']]);
    $photo->add_pic();
    unset($_SESSION['nbr']);
    unset($_SESSION['photo']);
}
?>

<body>

<main class="my_profil row">

    <div class="col s6">
        <div class="title_account">
            <img class="image_title_account" src="assets/images/picture_profil.svg">
            <h2 style="margin-left: 100px;" class="title-form-alt">Mes <br><span class="title-form">Photos</span></h2>
        </div>
        <form method="POST" name="form1" enctype="multipart/form-data"
              action="../controllers/PhotosController.php">
            <div class="photopp">
                <?php
                $myid = $_SESSION['id'];
                $photo = new photos(array(
                    'id2' => $myid
                ));
                $pp = $array_pic['pp'];
                echo "
                <canvas style=\"background-image: url('$pp')\" id=\"canvas_pp\" class=\"img_pp circle\" type=\"file\"></canvas>
                ";
                ?>

                <input class="circle" type="file" id="imagepp" name="pp" size="30000" accept="image">
                <button class="btn-large btn_up_pp" id="btnpp" onclick="UploadPic()" value="Upload" type="button"
                        disabled><i
                            class="fas fa-save icon_spacing2"></i>Sauvegarder
                </button>
            </div>
            <input name="hidden_data" id='hidden_data' type="hidden"/>
        </form>

        <div style="margin-top: 30px" class="row">
            <div class="col_margin col s3">
                <form method="POST" name="form2" enctype="multipart/form-data"
                      action="../controllers/PhotosController.php">
                    <div class="photop1">
                        <?php
                        $myid = $_SESSION['id'];
                        $photo = new photos(array(
                            'id2' => $myid
                        ));
                        $array_pic = $photo->array_pic();
                        $p1 = $array_pic['p1'];
                        echo "
                        <canvas style=\"background-image: url('$p1')\" id=\"canvas_p1\" class=\"img_p1 circle\" type=\"file\"></canvas>
                        ";
                        ?>
                        <input class="circle" type="file" id="imagep1" name="fichier" size="30000" accept="image">
                        <button class="btn btn_up_pp1" id="btnp1" onclick="UploadPic1()" value="Upload" type="button" disabled><i class="fas fa-save icon_spacing2"></i>Sauvegarder</button>
                    </div>
                    <input name="hidden_data1" id='hidden_data1' type="hidden"/>
                </form>
            </div>
            <div class="col_margin col s3">
                <form method="POST" name="form3" enctype="multipart/form-data"
                      action="../controllers/PhotosController.php">
                    <div class="photop1">
                        <?php
                        $myid = $_SESSION['id'];
                        $photo = new photos(array(
                            'id2' => $myid
                        ));
                        $array_pic = $photo->array_pic();
                        $p2 = $array_pic['p2'];
                        echo "
                        <canvas style=\"background-image: url('$p2')\" id=\"canvas_p2\" class=\"img_p1 circle\" type=\"file\"></canvas>
                        ";
                        ?>
                        <input class="circle" type="file" id="imagep2" name="fichier" size="30000" accept="image">
                        <button class="btn btn_up_pp1" id="btnp2" onclick="UploadPic2()" value="Upload" type="button" disabled><i class="fas fa-save icon_spacing2"></i>Sauvegarder</button>
                    </div>

                    <input name="hidden_data2" id='hidden_data2' type="hidden"/>
                </form>
            </div>
            <div class="col_margin col s3">
                <form method="POST" name="form4" enctype="multipart/form-data"
                      action="../controllers/PhotosController.php">
                    <div class="photop1">
                        <?php
                        $myid = $_SESSION['id'];
                        $photo = new photos(array(
                            'id2' => $myid
                        ));
                        $array_pic = $photo->array_pic();
                        $p3 = $array_pic['p3'];
                        echo "
                        <canvas style=\"background-image: url('$p3')\" id=\"canvas_p3\" class=\"img_p1 circle\" type=\"file\"></canvas>
                        ";
                        ?>
                        <input class="circle" type="file" id="imagep3" name="fichier" size="30000" accept="image">
                        <button class="btn btn_up_pp1" id="btnp3" onclick="UploadPic3()" value="Upload" type="button" disabled><i class="fas fa-save icon_spacing2"></i>Sauvegarder</button>
                    </div>
                    <input name="hidden_data3" id='hidden_data3' type="hidden"/>
                </form>
            </div>
            <div class="col_margin col s3">
                <form method="POST" name="form5" enctype="multipart/form-data"
                      action="../controllers/PhotosController.php">
                    <div class="photop1">
                        <?php
                        $myid = $_SESSION['id'];
                        $photo = new photos(array(
                            'id2' => $myid
                        ));
                        $array_pic = $photo->array_pic();
                        $p4 = $array_pic['p4'];
                        echo "
                        <canvas style=\"background-image: url('$p4')\" id=\"canvas_p4\" class=\"img_p1 circle\" type=\"file\"></canvas>
                        ";
                        ?>
                        <input class="circle" type="file" id="imagep4" name="fichier" size="30000" accept="image">
                        <button class="btn btn_up_pp1" id="btnp4" onclick="UploadPic4()" value="Upload" type="button" disabled><i class="fas fa-save icon_spacing2"></i>Sauvegarder </button>
                    </div>
                    <input name="hidden_data4" id='hidden_data4' type="hidden"/>
                </form>
            </div>
        </div>


    </div>
    <div class="col s6 panel_info">
        <div class="title_account">
            <img class="image_title_account" src="assets/images/createprofil.svg">
            <h2 style="margin-left: 100px;" class="title-form-alt">Informations<br><span
                        class="title-form">Générales</span></h2>
        </div>
    </div>
    <div class="row">
        <?php
        $user = recup_user();
        $user_name = $user['nom'];
        $user_login = $user['login'];
        $user_email = $user['email'];
        echo "
       
        <form id=\"user-form\" method=\"POST\" action=\"../controllers/ProfilsController.php\">
            <div class=\"row\">
                <div class=\"input-field col s3\">
                    <i class=\"material-icons prefix\">account_circle</i>
                    <input id=\"nom\" type=\"text\" value='$user_name' class=\"validate\" pattern=\"[A-Za-z\séèâêëçû -]+\" name=\"nom\" maxlength=\"50\"
                           required>
                    <span class=\"helper-text\" data-error=\"Format invalide: (A-z) et (-)\"
                          data-success=\"Format valide\"></span>
                    <label for=\"nom\">Nom et Prénom</label>
                </div>
                <div class=\"input-field col s3\">
                    <i class=\"material-icons prefix\">account_circle</i>
                    <input id=\"login\" type=\"text\"  value='$user_login' class=\"validate\" pattern=\"[A-Za-z-0-9\s -]+\" name=\"login\"
                           maxlength=\"25\" required>
                    <span class=\"helper-text\" data-error=\"Format invalide: (A-z), (0-9), (-)\"
                          data-success=\"Format valide\"></span>
                    <label for=\"login\">Nom d'utilisateur</label>
                </div>
                <div class=\"input-field col s3\">
                    <i class=\"material-icons prefix\">vpn_key</i>
                    <input id=\"password\" type=\"password\" class=\"validate\" pattern=\"(?=.*[!@#$%^&*(),.?:{}|<>]).{6,}\"
                           name=\"password\" maxlength=\"25\">
                    <span class=\"helper-text\"
                          data-error=\"Format invalide: Doit contenir 6 caractères minimum dont 1 caractère special (!@#$%^&*(),.?:{}|<>)\"
                          data-success=\"Format valide\"></span>
                    <label for=\"password\">Mot de passe</label>
                </div>
                <div class=\"input-field col s3\">
                    <i class=\"material-icons prefix\">vpn_key</i>
                    <input id=\"password2\" type=\"password\" class=\"validate\" pattern=\"(?=.*[!@#$%^&*(),.?:{}|<>]).{6,}\"
                           name=\"password2\" maxlength=\"25\">
                    <span class=\"helper-text\" data-error=\"Les mots de passe ne correspondent pas\"
                          data-success=\"Format valide\"></span>

                    <label for=\"password2\">Mot de passe (confirmation)</label>
                </div>
                <div class=\"input-field col s3\">
                    <i class=\"material-icons prefix\">email</i>
                    <input id=\"email\" type=\"email\" value='$user_email' class=\"validate\" name=\"email\" required>
                    <label for=\"email\">Adresse email</label>
                </div>
                <div class=\"col s12\" style=\"text-align: right\">
                    <button class=\"btn-large waves-effect waves-light pink accent-3\" type=\"submit\" name=\"submit\"
                            value=\"Créer mon profil\">Mettre à jour
                        <i class=\"material-icons right\">send</i>
                    </button>
                </div>
            </div>
            <input type=\"hidden\" name=\"user_modif\" value=\"ok\">
        </form>
        
        ";
        ?>
    </div>
</main>


<main class="my_profil row">

    <div class="col s12 panel_info">
        <div class="title_account">
            <img class="image_title_account" src="assets/images/user_info.svg">
            <h2 style="margin-left: 100px;" class="title-form-alt">Mes données<br><span
                        class="title-form">personelles</span></h2>
        </div>
    </div>
    <?php
    $data = recup_data();
    $data_age = $data['age'];
    $data_location = $data['location'];
    $data_bio = $data['bio'];
    $interest = recup_inter();

    echo "
    <form id=\"data-form\" method=\"POST\" action=\"../controllers/ProfilsController.php\">
        <div class=\"col s3\">
            <p class=\"title-form2\">Âge (18 à 116 ans)</p>
            <input type=\"number\" name=\"age\" id=\"age\" value=\"$data_age\" min=\"18\" max=\"116\" required><br/>
        </div>
        <div class=\"col s3\">
            <p class=\"title-form2\">Ville</p>
            <input type=\"text\" name=\"location\" value=' $data_location' id=\"location\" required><br/>
        </div>
        <div class=\"col s3\">
            <p class=\"title-form2\">Genre</p>
            <select name=\"sexe\">
                <option class=\"red\" value=\"0\"";
    if ($data['sex'] == 0) echo 'selected';
    echo ">Non binaire</option>
                <option value=\"1\"";
    if ($data['sex'] == 1) echo 'selected';
    echo ">Femme</option>
                <option value=\"2\"";
    if ($data['sex'] == 2) echo 'selected';
    echo ">Homme</option>
                <option value=\"3\"";
    if ($data['sex'] == 3) echo 'selected';
    echo ">Transsexuelle</option>
                <option value=\"4\"";
    if ($data['sex'] == 4) echo 'selected';
    echo ">Transsexuel</option>
                <option value=\"5\"";
    if ($data['sex'] == 5) echo 'selected';
    echo ">Intersexuel</option>
            </select>
        </div>
        <div class=\"col s3\">
            <p class=\"title-form2\">Orientation Sexuelle</p>
            <select id=\"orientation\" name=\"orientation\">
                <option value=\"0\"";
    if ($data['orientation'] == 0) echo 'selected';
    echo ">Bisexuelle</option>
                <option value=\"1\"";
    if ($data['orientation'] == 1) echo 'selected';
    echo ">Hétérosexuelle</option>
                <option value=\"2\"";
    if ($data['orientation'] == 2) echo 'selected';
    echo ">Homosexuelle</option>
                <option value=\"3\"";
    if ($data['orientation'] == 3) echo 'selected';
    echo ">Altersexuelle</option>
                <option value=\"4\"";
    if ($data['orientation'] == 4) echo 'selected';
    echo ">Pansexuelle</option>
                <option value=\"5\"";
    if ($data['orientation'] == 5) echo 'selected';
    echo ">Asexuelle</option>
                <option value=\"6\"";
    if ($data['orientation'] == 6) echo 'selected';
    echo ">Sapiosexuelle</option>
            </select>
        </div>
        <div class=\"col s12\">
            <p class=\"title-form2\">Bio (max 255 caractères)</p>
            <textarea id=\"textarea1\" class=\"materialize-textarea\" name='bio' maxlength=\"255\" required>$data_bio</textarea>
            <p class=\"title-form2\">Centre(s) d'intérêt(s)</p>
        </div>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"sport\" value=\"101\"";
    if ($interest['sport'] == 1) echo 'checked';
    echo "/>
                <span>Sport</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"voyage\" value=\"101\"";
    if ($interest['voyage'] == 1) echo 'checked';
    echo "/>
                <span>Voyage</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"vegan\" value=\"101\"";
    if ($interest['vegan'] == 1) echo 'checked';
    echo "/>
                <span>Vegan</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"geek\" value=\"101\"";
    if ($interest['geek'] == 1) echo 'checked';
    echo "/>
                <span>Geek</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"soiree\" value=\"101\"";
    if ($interest['soiree'] == 1) echo 'checked';
    echo "/>
                <span>Soiree</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"tattoo\" value=\"101\"";
    if ($interest['tattoo'] == 1) echo 'checked';
    echo "/>
                <span>Tattoo</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"musique\" value=\"101\"";
    if ($interest['musique'] == 1) echo 'checked';
    echo "/>
                <span>Musique</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"lecture\" value=\"101\"";
    if ($interest['lecture'] == 1) echo 'checked';
    echo "/>
                <span>Lecture</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"theatre\" value=\"101\"";
    if ($interest['theatre'] == 1) echo 'checked';
    echo "/>
                <span>Théâtre</span>
            </label>
        </p>
        <p class=\"col s4\">
            <label>
                <input type=\"checkbox\" name=\"religion\" value=\"101\"";
    if ($interest['religion'] == 1) echo 'checked';
    echo "/>
                <span>Religion</span>
            </label>
        </p>
        <input type=\"hidden\" name=\"data_modif\" value=\"ok\">
        <div class=\"col s12\" style=\"text-align: right\">
            <button class=\"btn-large waves-effect waves-light pink accent-3\" type=\"submit\" name=\"submit\"
                    value=\"Créer mon profil\">Mettre à jour
                <i class=\"material-icons right\">send</i>
            </button>
        </div>
    </form>
    ";

    ?>

</main>

<script src="assets/js/materialize.js"></script>
<script src="assets/js/photo.js"></script>

<script>
    $('.carousel.carousel-slider').carousel({
        fullWidth: true,
        indicators: true
    });
    $(document).ready(function () {
        $('select').formSelect();
    });


    var password = document.getElementById("password")
        , confirm_password = document.getElementById("password2");

    function validatePassword() {
        if (password.value !== confirm_password.value) {
            confirm_password.setCustomValidity("Les mots de passe ne correspondent pas");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

</body>