<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
?>

<?php foreach(Yii::$app->session->getAllFlashes() as $type => $messages): ?>
    <?php if($type == 'request_accept') { ?>
        <div class="request-result-wrapper open">
            <div class="request-result-inner border-box">
                <div class="body">
                    <p class="title"><?php echo $messages[0][0]; ?></p>
                    <p><?php echo $messages[0][1]; ?></p>
                </div>
                <div class="actions">
                    <button class="btn-close-request-result" onclick="requestResultClose(this)">Close</button>
                </div>
            </div>
            <script type="text/javascript">
                function requestResultClose(elem) {
                    var content = document.getElementsByClassName("request-result-wrapper");
                    content[0].classList.remove("open");
                }
            </script>
        </div>
    <?php } ?>
<?php endforeach ?>