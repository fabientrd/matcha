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
include('../controllers/SuggestController.php');
?>

<body>

<div id="background">
</div>

<div class="container_s">
    <div class="">
        <div style="padding-top: 50px;" class="row">
            <?php
            $res = suggest_ponderate_array();
            if (!empty($res)) {
                echo "<div style='margin-bottom: 50px' class=\"homesuggest\">Notre sélection selon votre profil</div>";
                foreach ($res as $key => $value) {
                    $user = recup_user_id($value);
                    $data = recup_data_id($value);
                    $inter = recup_inter_id($value);
                    $photo = new photos(array(
                        'id2' => $value
                    ));
                    $array_pic = $photo->array_pic();
                    $pp = $array_pic['pp'];
                    $sex = '';
                    $orientation = '';
                    if ($user['statut'] == 1) {
                        $icon_statut = 'connected';
                        $statut = 'Connecté';
                    } else {
                        $icon_statut = 'deconnected';
                        $statut = $user['statut'];
                    }
                    switch ($data['sex']) {
                        case 0:
                            $sex = 'Non binaire';
                            break;
                        case 1:
                            $sex = 'Femme';
                            break;
                        case 2:
                            $sex = 'Homme';
                            break;
                        case 3:
                            $sex = 'Transsexuelle';
                            break;
                        case 4:
                            $sex = 'Transsexuel';
                            break;
                        case 5:
                            $sex = 'Intersexuel';
                            break;
                    }
                    switch ($data['orientation']) {
                        case 0:
                            $orientation = 'Bisexuel';
                            break;
                        case 1:
                            $orientation = 'Hétérosexuel';
                            break;
                        case 2:
                            $orientation = 'Homosexuel';
                            break;
                        case 3:
                            $orientation = 'Altersexuel';
                            break;
                        case 4:
                            $orientation = 'Pansexuel';
                            break;
                        case 5:
                            $orientation = 'Asexuel';
                            break;
                        case 6:
                            $orientation = 'Sapiosexuel';
                            break;
                    }
                    echo "
            <a style='color: inherit !important;' href='profile.php?id=" . $value . "'>
            <div class=\"card_profil col s12 m3 l3\">
                <div class=\"card fade-in two\">
                    <div class=\"card-image\">
                        <img src=\"$pp\">
                        <span class=\"card-title\">" . $user['login'] . "</span>                
                    </div>
                    <div class=\"card-content\">
                        <h6>
                            " . $user['nom'] . ", <span class=\"fw100\">" . $data['age'] . " ans</span>
                        </h6>
                        <p class=\"fw100\">" . $data['location'] . ", France</p>
                        <div class=\"row\">
                            <div class=\"container center\" style=\"margin-top: 20px; margin-bottom: 20px\">
                                <b class=\"info_sub_profil\"><i class=\"fas fa-star icon_spacing\"></i>" . $data['popularite'] . "</b>
                            </div>
                            <div class=\"col m6 left\">
                                <p class=\"fw100 left\"><i class=\"fas fa-venus-mars icon_spacing\"></i>$sex</p>
                            </div>
                            <div class=\"col m6 right\">
                                <p class=\"fw100 right\"><i class=\"fas fa-search icon_spacing\"></i>$orientation</p>
                            </div>
                        </div>
                        <div class=\"container center\">
                            <p><i class=\"fas fa-circle $icon_statut\"></i> $statut</p>
                        </div>
                    </div>
                </div>
            </div>
            </a>
            ";
                }
            } else {

                echo "<div class=\"homesuggest\">Aucune suggestion disponible.</div></p>";
            }
            ?>

        </div>
    </div>
</div>

<script>

</script>

<script src="assets/js/materialize.js"></script>
</body>