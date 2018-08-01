<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use app\models\Tags;


/* @var $this yii\web\View */
/* @var $model app\models\Noticia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="noticia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contenido')->textarea(['rows' => 6]) ?>

    <?php 
        $item= \app\models\Tags::find()->all(); 
        $listData=ArrayHelper::map($item,'ID','nombre'); 
    ?>    
    <?= $form->field($model, 'tag')->dropDownList($listData,['prompt'=>'Seleccionar...']) ?>


      <?= $form->field($model, 'imagen')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
