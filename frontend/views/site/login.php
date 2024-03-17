<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login container mx-auto my-20 xl:px-12 px-4">
    <h2><?= Html::encode($this->title) ?></h2>
    <p class="my-5 text-lg">Please fill out the following fields to login:</p>
    <div class="w-fit my-6">
		<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
		<div class="grid grid-cols-1 gap-5">
			<?= $form->field($model, 'username')->textInput(['autofocus' => true, ]) ?>

			<?= $form->field($model, 'password')->passwordInput() ?>

			<?= $form->field($model, 'rememberMe')->checkbox() ?>

			<div style="color:#999;margin:1em 0">
				If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
			</div>
		</div>

		<div class="form-group">
			<?= Html::submitButton('Login', ['class' => 'btn btn-primary w-full', 'name' => 'login-button']) ?>
		</div>

		<?php ActiveForm::end(); ?>
    </div>
</div>
