<?php

use yii\db\Migration;

class m170227_235440_auth_rule extends Migration
{
    public function up(){

        $this->execute("SET foreign_key_checks = 0");

        $this->createTable('{{%auth_rule}}', [
            'name' => 'varchar(64) COLLATE utf8_unicode_ci NOT NULL',
            'data' => 'blob',
            'created_at' => 'int(11) NULL',
            'updated_at' => 'int(11) NULL',
            'PRIMARY KEY (`name`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode)ci");

        $this->execute("SET foreign_key_checks = 1");
    }

    public function down(){

        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%auth_rule}}');
        $this->execute('SET foreign_key_checks = 1');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
