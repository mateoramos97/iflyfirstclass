<?php
use app\components\widgets\request\SupportFormWidget;
?>

<div class="support-chat-button">
	<img src="/public/img/message-gold.svg" alt="message-icon" width="20" height="19">
    <div class="chat-now font-proxima-nova-medium">Chat Now</div>
</div>
<?= SupportFormWidget::widget() ?>