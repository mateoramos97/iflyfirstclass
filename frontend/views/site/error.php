<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<script type="text/javascript">
    var body = document.getElementsByTagName('body')[0].classList.add('error-404');
</script>
<div class="site-error">
    <?php if($exception->statusCode === 404) { ?>
        <div class="code">
            404
        </div>
        <div class="title">
            Page Not Found
        </div>
        <div class="actions">
            <a href="/">Return to Home</a>
        </div>
    <?php } else { ?>

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>
            The above error occurred while the Web server was processing your request.
        </p>
        <p>
            Please contact us if you think this is a server error. Thank you.
        </p>

    <?php } ?>

</div>
