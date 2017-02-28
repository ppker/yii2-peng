<?php

use yii\db\Migration;

class m170228_003238_user extends Migration
{
    public function up(){

        $this->execute("SET foreign_key_checks = 0");

        $this->createTable('{{%user}}', [
            'id' => "int(11) not null auto_increment comment '用户ID'",
            'username' => "varchar(255) COLLATE utf8_unicode_ci not null comment '用户名'",
            'sex' => "tinyint(1) unsigned not null default '0' comment '性别'",
            'avatar' => "varchar(255) CHARACTER SET utf8 not null comment '头像'",
            'signature' => "varchar(50) CHARACTER SET utf8 not null comment '个性签名'",
            'auth_key' => "varchar(32) COLLATE utf8_unicode_ci not null",
            'password_hash' => "varchar(255) COLLATE utf8_unicode_ci not null",
            'password_reset_token' => "varchar(255) COLLATE utf8_unicode_ci default null",
            'email' => "varchar(255) COLLATE utf8_unicode_ci not null",
            'status' => "smallint(6) not null default '10'",
            'created_at' => "int(11) not null",
            'updated_at' => "int(11) not null",
            "PRIMARY KEY (`id`)"
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='用户表'");

        $this->createIndex("username", "{{%user}}", "username", 1);
        $this->createIndex("email", "{{%user}}", "email", 1);
        $this->createIndex("password_reset_token", "{{%user}}", "password_reset_token", 1);
        $this->createIndex("status", "{{%user}}", "status", 1);

        $this->execute("SET foreign_key_checks = 1");
    }

    public function down()
    {
        $this->execute("SET foreign_key_checks = 0");
        /* 删除表 */
        $this->dropTable('{{%user}}');
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
