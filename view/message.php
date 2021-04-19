<?php
include('header_connect.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['loggued_on_user']))
    header('Location: ../index.php');

if (!isset($_GET['id']))
    header('Location: .');

if (isset($_GET['id'])) {
    $match = is_match($_SESSION['id'], $_GET['id']);
    $db_con = new account([]);
    if (empty($_GET['id'])){
        $_SESSION['error'] = 11;
        header('Location: .');
    }
    if ($db_con->select_id($_GET['id']) == 0){
        $_SESSION['error'] = 11;
        header('Location: .');
    }
    if ($match != 1){
        $_SESSION['error'] = 10;
        header('Location: .');
    }
}

?>

<body>
<div class="container_message">

    <div style="position: relative" class="user_send_message row">
        <div class="title_account">
            <img class="image_title_account" src="assets/images/chat.svg">
            <h2 style="margin-left: 10px; text-align: left;" class="title-form-alt title-form-alt2">Envoyer <br><span class="title-form">un message</span></h2>
        </div>
        <div class="col s12 panel_info">
            <form method="post" action="../controllers/ProfilsController.php">
                <div class="">
                    <p class="fw100">Votre message (max 255 caractères)</p>
                    <textarea id="textarea1" class="materialize-textarea" name='message' maxlength="255"
                              required></textarea>
                    <input type="hidden" name="id_usr" value="<?php echo $_SESSION['id'] ?>">
                    <input type="hidden" name="id_usr_l" value="<?php echo $_GET['id'] ?>">
                    <div style="text-align: center; margin-top: 50px">
                        <button class='pbb btn_msg_page waves-effect waves-light btn-large' name='send' value='ok'><i
                                    class="fas fa-paper-plane left"></i>Envoyer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="mess" class="user_message">
        <?php
        $res = get_message($_SESSION['id'], $_GET['id']);
        if (!empty($res)){
            foreach ($res as $k => $v) {
                if ($v['id_usr'] === $_SESSION['id']){
                    $date = $v['date'];
                    $message = $v['message'];
                    echo "
                <div class=\"msg_bubble_bleu_main\">
                <p class=\"fw100 date_left\"><i class=\"fas fa-clock icon_spacing2\"></i>$date</p>
                    <div class=\"msg_bubble_bleu\">                  
                        <p class=\"fw100 center\">$message</p>
                    </div>
                </div>
                ";
                }
                else if ($v['id_usr'] === $_GET['id']){
                    $date = $v['date'];
                    $message = $v['message'];
                    echo "
                <div class=\"msg_bubble_rose_main\">
                <p class=\"fw100 date_right\"><i class=\"fas fa-clock icon_spacing2\"></i>$date</p>
                    <div class=\"msg_bubble_rose\">                     
                        <p class=\"fw100 center\">$message</p>
                    </div>
                </div>
                ";
                }
            }
        }
        else
            echo "
            <h5 class='result_nbr'>Envoyer un message pour démarrer la conversation !</h5>
            ";

        ?>



    </div>

</div>


<script src="assets/js/materialize.js"></script>
<script>
    $(document).ready(function () {
        $('.carousel').carousel();
    });
    $(document).ready(function () {
        $('.materialboxed').materialbox();
    });

    var scrollDiv = document.getElementById("mess");
    scrollDiv.scrollTop = scrollDiv.scrollHeight;
</script>
</body>