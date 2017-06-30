<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Recipe */

$this->title = 'Добавить блюдо';
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ingredients' => $ingredients,
        'modelIngredients' => $modelIngredients
    ]) ?>

</div>
