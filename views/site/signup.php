<?php
/**
 * Created by PhpStorm.
 * User: ahala
 * Date: 30.04.2018
 * Time: 18:12
 */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
?>

<div class="site-signup container">
    <h1><?=Html::encode($this->title);?></h1>
    <p>Пожалуйста введите данные пользователя</p>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']);?>
            <?=$form->field($model,'username')->textInput(['autofocus' => true]);?>
            <?=$form->field($model,'email');?>
            <?=$form->field($model,'password')->passwordInput();?>
            <div class="form-group">
                <?=Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'signup-button']);?>
            </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
</div>
