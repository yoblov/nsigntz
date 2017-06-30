<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%recipes}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $short_description
 * @property string $full_description
 *
 * @property RecipeIngredients[] $recipeIngredientsRel
 * @property Ingredient[] $recipeIngredients
 */
class Recipe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%recipes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'full_description'], 'required'],
            [['status'], 'integer'],
            [['short_description', 'full_description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название блюда',
            'short_description' => 'Описание',
            'full_description' => 'Рецепт',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipeIngredientsRel()
    {
        return $this->hasMany(RecipeIngredients::className(), ['recipe_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipeIngredients()
    {
        //return $this->hasMany(RecipeIngredients::className(), ['recipe_id' => 'id']);
        return $this->hasMany(Ingredient::className(), ['id' => 'ingredient_id'])
            ->viaTable(RecipeIngredients::tableName(), ['recipe_id' => 'id']);
    }
}
