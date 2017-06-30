<?php
/* @var $model common\models\Recipe */
?>
<table class="table table-considered table-bordered">
    <tbody>
        <tr>
            <td>
                Ингредиенты
            </td>
            <td>
                <?php
                    if(!empty($model->recipeIngredients)){
                        foreach ($model->recipeIngredients as $ingredient){
                            echo $ingredient->name.'<br>';
                        }
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $model->getAttributeLabel('short_description') ?></td>
            <td>
                <?= $model->short_description?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $model->getAttributeLabel('full_description') ?></td>
            <td>
                <?= $model->full_description?>
            </td>
        </tr>
    </tbody>
</table>