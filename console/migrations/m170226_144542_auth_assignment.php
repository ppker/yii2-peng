<?php

use yii\db\Migration;

class m170226_144542_auth_assignment extends Migration
{
    public function up() {

        // 先取消外键约束
        $this->execute("set foreign_key_checks = 0");
        // 创建表
        $this->createTable("{{%auth_assignment}}", [
                'item_name' => 'varchar(64) COLLATE utf8_unicode_ci NOT NULL \'角色名称 role\'',
                'user_id' => 'varchar(64) COLLATE utf8_unicode_ci NOT NULL \'用户ID\'',
                'create_at' => 'int(11) NULL',
                'PRIMARY KEY (`item_name`, `user_id`)'
            ], "ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
        // 索引设置
        // 外键约束设置

        $this->addForeignKey('auth_assignment_ibfk_1', '{{%auth_assignment}}', 'item_name', '{{%auth_item}}', 'name', 'CASCADE', 'CASCADE');
        // 插入数据
        $this->insert('{{%auth_assignment}}', ['item_name' => 'administrator', 'user_id' => 1, 'created_at' => '1476437918']);
        $this->insert('{{%auth_assignment}}', ['item_name' => 'administrator', 'user_id' => 2, 'created_at' => '1476537918']);

        // 启动外键约束
        $this->execute("SET foreign_key_checks = 1");
    }

    public function down()
    {
        $this->execute("SET foreign_key_checks = 0");
        $this->dropTable('{{%auth_assignment}}');
        $this->execute("SET foreign_key_checks = 1");
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
