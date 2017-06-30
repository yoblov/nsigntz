<?php

/* @var $this yii\web\View */

$this->title = 'Nsign Тестовое задание';
?>
<div class="site-index">

    <div class="body-content">
        <div class="jumbotron">
            <h1>Административная часть</h1>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="list-group">
                    <a href="<?=\yii\helpers\Url::to(['/recipes/admin-ingredients/index'])?>" class="list-group-item">
                        <h4 class="list-group-item-heading">Ингредиенты</h4>

                        <p class="list-group-item-text">Управление параметрами ингредиентов
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="list-group">
                    <a href="<?=\yii\helpers\Url::to(['/recipes/admin-recipes/index'])?>" class="list-group-item ">
                        <h4 class="list-group-item-heading">Блюда</h4>

                        <p class="list-group-item-text">Создание и управление блюдами
                        </p>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="list-group">
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading">Пользователи</h4>

                        <p class="list-group-item-text">Панель управления пользователями системы</p>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
