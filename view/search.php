<?php
/**
 * Created by PhpStorm.
 * User: pimaglio
 * Date: 2019-02-12
 * Time: 11:59
 */
session_start();
if (isset($_SESSION['loggued_but_not_complet']))
    header("Location: createprofile.php");

if (!isset($_SESSION['loggued_on_user']))
    header("Location: ../index.php");

include('header_connect.php');
include('../controllers/SuggestController.php');
include('../controllers/ResearchController.php');
?>

<body>

<div id="background">
</div>

<div class="container_s_2">

    <div class="search_container row">
        <form method="get" action="search.php">

            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-numeric-down icon_spacing2"></i>Âge minimum</p>
                <p class="range-field">
                    <input name="agemin" type="range" id="test5" value="30" min="18" max="116"/>
                </p>
            </div>


            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-numeric-up icon_spacing2"></i>Âge maximum</p>
                <p class="range-field">
                    <input name="agemax" type="range" id="test5" value="77" min="18" max="116"/>
                </p>
            </div>

            <div class="col s3">
                <p class="fw100"><i class="fas fa-sort-amount-up icon_spacing2"></i>Popularité minimum</p>
                <p class="range-field">
                    <input name="popmin" type="range" id="test5" min="0" max="10000"/>
                </p>
            </div>

            <div class="col s3">
                <p class="fw100"><i class="fas fa-street-view icon_spacing2"></i>Distance maximum (km)</p>
                <p class="range-field">
                    <input name="distmax" type="range" id="test5" min="0" max="1000"/>
                </p>
            </div>

            <div style="position: relative" class="col s12">
                <p class="fw100"><i class="fas fa-sort-amount-up icon_spacing2"></i>Centre(s) d'intérêt(s)</p>
                <div class="row">
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="sport" value="101"/>
                            <span>Sport</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="voyage" value="101"/>
                            <span>Voyage</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="vegan" value="101"/>
                            <span>Vegan</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="geek" value="101"/>
                            <span>Geek</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="soiree" value="101"/>
                            <span>Soiree</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="tattoo" value="101"/>
                            <span>Tattoo</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="musique" value="101"/>
                            <span>Musique</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="lecture" value="101"/>
                            <span>Lecture</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="theatre" value="101"/>
                            <span>Théâtre</span>
                        </label>
                    </p>
                    <p class="col s4">
                        <label>
                            <input type="checkbox" name="religion" value="101"/>
                            <span>Religion</span>
                        </label>
                    </p>
                </div>
                <div class="row">
                    <div class="col s3">

                        <p>
                            <label>
                                <input name="sort" value="0" class="with-gap pulse" name="group1" type="radio" checked/>
                                <span>Ne pas trier</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s3">

                        <p>
                            <label>
                                <input name="sort" value="1" class="with-gap pulse" name="group1" type="radio"/>
                                <span>Trier par âge croissant</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s3">
                        <p>
                            <label>
                                <input name="sort" value="2" class="with-gap pulse" name="group1" type="radio"/>
                                <span>Trier par âge décroissant</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s3">
                        <p>
                            <label>
                                <input name="sort" value="3" class="with-gap pulse" name="group1" type="radio"/>
                                <span>Trier par popularité croissante</span>
                            </label>
                        </p>
                    </div>
                    <div class="col s3">
                        <p>
                            <label>
                                <input name="sort" value="4" class="with-gap pulse" name="group1" type="radio"/>
                                <span>Trier par popularité décroissante</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div >
                    <button class=" btn_search btn-large waves-effect waves-light pink accent-3 fade-in two">Rechercher
                        <i style="position: absolute" class="fab fa-searchengin icon_spacing3"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
<?php if (isset($_GET) && isset($_GET['agemin']) && isset($_GET['agemax']) && isset($_GET['popmin'])
    && isset($_GET['distmax']) && isset($_GET['sort'])) {
    echo '
<div class="row result">

    <div style="padding-top: 50px;" id="tab1" class="col s12">';


    $arr = [];
    foreach ($_GET as $k => $v) {
        if ($v == 101) {
            $arr[] = $k;
        }
    }
    $res = search($_GET['agemin'], $_GET['agemax'], $_GET['popmin'], $_GET['distmax'], $arr, $_GET['sort']);
    $res = limit_block_popu($res);
    $size = sizeof($res);
    if ($size == 0)
        $size = "Aucun profil trouvé";
    else if ($size == 1)
        $size = sizeof($res) . " profil trouvé";
    else
        $size = sizeof($res) . " profils trouvés";
    echo "<h5 class='result_nbr'>Résultat: $size</h5>";
    foreach ($res as $key => $value) {
        $user = recup_user_id($value['id_usr']);
        $data = recup_data_id($value['id_usr']);
        $inter = recup_inter_id($value['id_usr']);
        $photo = new photos(array(
            'id2' => $value['id_usr']
        ));
        $array_pic = $photo->array_pic();
        $pp = $array_pic['pp'];
        $sex = '';
        $orientation = '';
        if ($user['statut'] == 1){
            $icon_statut = 'connected';
            $statut = 'Connecté';
        }
        else{
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
            <a style='color: inherit !important;' href='profile.php?id=" . $value['id_usr'] . "'><div class=\"col s12 m6 l3 card_search\">
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
            </div></a>
            ";
    }
    echo '
    </div>

</div>';
}
?>
<script>
    $(document).ready(function () {
        $('.tabs').tabs();
    });
    $(document).ready(function () {
        $('select').formSelect();
    });
</script>


<script src="assets/js/materialize.js"></script>

</body>