<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use kartik\export\ExportMenu;

/**
 * @var yii\web\View $this
 * @var common\models\RecipeSearch $model
 * @var yii\widgets\ActiveForm $form
 */
$idv = isset($id) ? $id : 0;
$script = <<< JS
var id=$idv;
(function($) {
	$(document).on('pjax:success', function() {
		initRecipesPage();
	});
	initRecipesPage();
})(jQuery);

function searchRecipes(){
	var data = $('.report-search form').serialize();
	//var url = window.location.toString();
	pages = getAgentsUrlVars();
	var url = window.location.href.match(/^[^\#\?]+/)[0];
	if(pages.page != undefined){
		var page = pages.page;
		var perpage = pages['per-page'];
		url = url+'?page='+page+'&id='+id;
	} else {
		url = url+'?id='+id;
	}
	$.pjax.reload('#pjax-recipes', {
		history: true,
		type: 'GET',
		data: data,
		url: url,

	});
    $('#pjax-recipes').on('pjax:complete', function() {
         $('#expAgents-form').attr('action', window.location.href);
    });
}

function getAgentsUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
function initRecipesPage(){

	$("#reportagentssearch-term").off("blur");
	$("#reportagentssearch-term").on("blur",function(){
		searchRecipes();
	});

	$("#reportagentssearch-term").off("keyup");
	$("#reportagentssearch-term").on("keyup",function(e){
		//console.log(e.keyCode);
		if(e.keyCode == 13){
		searchRecipes()
		}
	});

}
JS;
$this->registerJs($script, View::POS_END);
?>


<div class="report-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?php
    echo  \kartik\widgets\Select2::widget([
        'model' => $model,
        'attribute'=>'ingredients',
        'data' => $ingredients,
        'options' => [
            'placeholder' => 'Выберите ингредиенты...',
            'multiple' => true
        ],
        'pluginEvents' => [
            "change" => "function() { searchRecipes(); }",
        ],
    ]);
    ActiveForm::end();
    ?>
</div>
