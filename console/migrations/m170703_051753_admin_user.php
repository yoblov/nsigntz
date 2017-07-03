<?php

use yii\db\Migration;

class m170703_051753_admin_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'role', $this->boolean()->defaultValue(0)->comment('user-0,admin-1'));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'role');
    }
}
