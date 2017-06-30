<?php

use yii\db\Migration;

class m170629_222415_create_table_ingredients extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ingredients}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'status' => $this->boolean()->defaultValue(true),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%ingredients}}');
    }
}
