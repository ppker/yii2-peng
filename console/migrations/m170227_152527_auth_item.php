<?php

use yii\db\Migration;

class m170227_152527_auth_item extends Migration
{
    public function up(){

        // 取消外键约束
        $this->execute("SET foreign_key_checks = 0");
        // 创建表
        $this->createTable('{{%auth_item}}', [
            'name' => 'varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT \'角色或权限名称\'',
            'type' => 'smallint(6) NOT NULL COMMENT \'1角色 2权限\'',
            'description' => 'text COLLATE utf8_unicode_ci',
            'rule_name' => 'varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL',
            'data' => 'blob',
            'created_at' => 'int(11) NULL',
            'updated_at' => 'int(11) NULL',
            'PRIMARY KEY(`name`)'
        ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

        $this->addForeignKey('auth_item_ibfk_1', '{{%auth_item}}', 'rule_name', '{{%auth_rule}}', 'name', 'DELETE SET NULL', 'UPDATE CASCADE');
        // 索引设置
        $this->createIndex('rule_name', '{{%auth_item}}', 'rule_name', 0);
        $this->createIndex('type', '{{%auth_item}}', 'type', 0);

        // 插入数据
        $this->insert('{{%auth_item}}', ['name' => 'administer', 'type' => '2', 'description' => '超级管理员', 'rule_name' => '', 'data' => '', 'created_at' => '1460031880', 'updated_at' => '1460031880']);

        $this->execute("SET foreign_key_checks = 1");
    }

    public function down()
    {
        $this->execute("SET foreign_key_checks = 0");
        $this->dropTable('{{%auth_item}}');
        $this->execute('SET foreign_key_checks = 1');
        return false;
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
