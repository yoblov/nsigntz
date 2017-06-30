<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\IngredientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ингредиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingredient-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить ингредиент', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status == \common\models\Ingredient::STATUS_HIDDEN) {
                        return Html::a('Вернуть', ['show', 'id' => $model->id], ['onclick' => 'return confirm("Вернуть ингредиент? Блюда с этим ингредиентом снова появятся в списке.")', 'class' => 'btn btn-warning']);
                    } else {
                        return Html::a('Скрыть', ['hide', 'id' => $model->id], ['onclick' => 'return confirm("Блюда с этим ингредиентом исчезнут из выборки.Скрыть ингредиент?")', 'class' => 'btn btn-warning ']);
                    }
                },
                'filter' => [false => 'Скрытый', true => 'Активен'],
                'format' => 'raw'
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
