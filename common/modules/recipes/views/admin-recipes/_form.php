<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Recipe */
/* @var $form yii\widgets\ActiveForm */
/* @var $ingredients array */

?>

<div class="recipe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= Select2::widget([
        'name' => 'RecipeIngredients[]',
        'data' => $ingredients,
        'value' => $modelIngredients,
        'options' => [
            'placeholder' => 'Выберите ингредиенты...',
            'multiple' => true
        ],
    ]) ?>

    <?= $form->field($model, 'short_description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'full_description')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
