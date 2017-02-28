<?php

use yii\db\Migration;

class m170227_161113_auth_item_child extends Migration
{
    public function up(){

        $this->execute('foreign_key_checks = 0');

        $this->createTable('{{%auth_item_child}}', [
            'parent' => 'varchar(64) collate utf8_unicode_ci not null',
            'child' => 'varchar(64) collate utf8_unicode_ci not null',
            'PRIMARY KEY (`parent`, `child`)'
        ], "ENGINE=InnoDB default charset=utf8 collate=utf8_unicode_ci");

        $this->createIndex('child', '{{%auth_item_child}}', 'child', 0);

        $this->addForeignKey('auth_item_child_ibfk_1','{{%auth_item_child}}', 'parent', '{{%auth_item}}', 'name', 'DELETE CASCADE', 'UPDATE CASCADE' );
        $this->addForeignKey('auth_item_child_ibfk_2','{{%auth_item_child}}', 'child', '{{%auth_item}}', 'name', 'DELETE CASCADE', 'UPDATE CASCADE' );

        $this->insert('{{%auth_item_child}}',['parent'=>'administrator','child'=>'user/edit']);
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%auth_item_child}}');
        $this->execute('SET foreign_key_checks = 1;');
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
