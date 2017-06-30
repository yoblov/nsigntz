<?php

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\select2\Select2Asset;

Select2Asset::register($this);
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var common\models\RecipeSearch $searchModel
 */


$gridColumns = [
    [
        'hidden' => true,
        'enableRowClick' => true,
        'class' => 'kartik\grid\ExpandRowColumn',
        'width' => '50px',
        'value' => function ($model, $key, $index, $column) {
            return \kartik\grid\GridView::ROW_COLLAPSED;
        },
        'headerOptions' => ['class' => 'kartik-sheet-style'],
        'detailRowCssClass' => 'grid-recipes-detail-expand',
        'expandOneOnly' => false,
        'attribute' => 'id',
        'label' => false,
        'format' => 'raw',
        'header' => false,
        'detail' => function ($model, $key, $index, $widget) {
            return Yii::$app->controller->renderPartial('_details_row', [
                'model' => $model
            ]);
        },
        'detailAnimationDuration' => 500,
        'hAlign' => 'left',
        'vAlign' => 'middle',

    ],
    [
        'attribute' => 'name',
        'label' => 'Блюда',
        'format' => 'raw',
        'header' => 'Блюда',
        'filterType' => GridView::FILTER_SELECT2,
        'filter' => $ingredients,
        'filterWidgetOptions' => [
            'language' => 'ru',
            'showToggleAll' => false,
            'pluginOptions' => ['allowClear' => true, 'multiple' => true, 'maximumSelectionLength' => 5, 'minimumSelectionLength' => 2],
        ],
        'filterInputOptions' => ['placeholder' => 'Выберите ингредиенты...'],
        /*'format' => 'raw',
        'filter' => [
            'attribute' => 'name',
            'value' => \yii\helpers\ArrayHelper::map(\common\models\Catnew::find()->all(), 'name', 'name'),

            ],
            \kartik\widgets\Select2::widget([
            'model' => $searchModel,
            'attribute' => 'ingredients',
            'data' => $ingredients,
            'theme' => \kartik\widgets\Select2::THEME_BOOTSTRAP,
            'hideSearch' => false,
            'options' => [
                'multiple' => true,
                'placeholder' => 'Выберите ингредиенты...',
                'value' => isset($_GET['RecipeSearch[ingredients]']) ? $_GET['RecipeSearch[ingredients]'] : null
            ]
        ]),*/
    ],
];

?>
<div class="jumbotron">
    <h1>Поиск блюд по ингредиентам</h1>
</div>


<?= GridView::widget([
    'layout' => '{items}{pager}',
    'dataProvider' => $dataProvider,
    'pager' => [
        'class' => yii\widgets\LinkPager::className(),
        'firstPageLabel' => 'Первая',
        'lastPageLabel' => 'Последняя',
        'prevPageLabel' => 'Предыдущая',
        'nextPageLabel' => 'Следующая'
    ],
    'emptyText' => $emptyText,
    'pjax' => true,
    'pjaxSettings' => [
        'options' => [
            'id' => 'pjax-recipes',
        ],
        'neverTimeout' => true,
    ],
    'filterModel' => $searchModel,
    'tableOptions' => ['class' => 'table table-striped recipe-table table-hover'],
    'bordered' => false,
    'headerRowOptions' => ['class' => 'x'],
    'columns' => $gridColumns
]); ?>
