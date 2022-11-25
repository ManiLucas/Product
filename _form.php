<!--Visualiza el formulario de actualizacion de un producto-->
<?php

use yii\helpers\Html;
//use yii\bootstrap4\ActiveForm;
use kartik\form\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scale')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'quantity_in_stock')->textInput() ?>

    <?= $form->field($model, 'buy_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MSRP')->textInput(['maxlength' => true]) ?>

	 <?php if($model->image) {
	 		echo Html::img(Yii::$app->params['uploadImage'].$model->image,['height' => 60]);	
	 }?>
	 
	 <?php
	 	echo $form->field($model, 'uploadFile')->widget(FileInput::classname(),[
	 		'options' => [
				'accept' => 'image/',
				'multiple' => false,	 		
	 		],
	 		'pluginOptions' => [
				'showUpload' => false,	 		
	 		],
	 	]);
	 ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!--Github /var/www/html/classic/modules/admin/views/product/_form.php-->
