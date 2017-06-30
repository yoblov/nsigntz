<?php

use yii\db\Migration;

class m170629_222438_create_table_recipes_ingredients_rel extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%recipes_ingredients_rel}}', [
            'rel_id' => $this->primaryKey(),
            'recipe_id' => $this->integer(),
            'ingredient_id' => $this->integer(),
        ], $tableOptions);
        $this->addForeignKey('fk_recipe_id', '{{%recipes_ingredients_rel}}', 'recipe_id', '{{%recipes}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_ingredient_id', '{{%recipes_ingredients_rel}}', 'ingredient_id', '{{%ingredients}}', 'id', 'cascade', 'cascade');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_recipe_id', '{{%recipes_ingredients_rel}}');
        $this->dropForeignKey('fk_ingredient_id', '{{%recipes_ingredients_rel}}');
        $this->dropTable('{{%recipes_ingredients_rel}}');
    }
}
