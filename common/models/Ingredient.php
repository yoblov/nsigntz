<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ingredients}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 *
 * @property RecipeIngredients[] $recipesIngredients
 */
class Ingredient extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 0;
    const STATUS_HIDDEN = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ingredients}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
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
            'name' => 'Название',
            'status' => 'Скрытый',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecipeIngredients()
    {
        return $this->hasMany(RecipeIngredients::className(), ['ingredient_id' => 'id']);
    }
}
