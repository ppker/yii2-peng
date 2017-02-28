<?php

use yii\db\Migration;

class m170228_001123_menu extends Migration
{
    public function up() {

        $this->execute("SET foreign_key_checks = 0");
        $this->createTable('{{%menu}}', [
            'id' => 'int(10) unsigned not null auto_increment comment \'文档ID\'',
            'title' => 'varchar(50) not null default \'\' comment \'标题\'',
            'pid' => "int(10) unsigned not null default '0' COMMENT '上级分类ID'",
            'sort' => "int(10) unsigned not null default '0' COMMENT '排序（同级有效）'",
            'url' => "varchar(255) not null default '' comment '链接地址'",
            'hide' => "tinyint(1) unsigned not null default '0' comment '是否隐藏'",
            'group' => "varchar(50) default '' comment '分组'",
            'status' => "tinyint(1) not null default '0' comment '状态'",
            'PRIMARY KEY (`id`)'
        ], "ENGINE=MyISAM DEFAULT CHARSET=utf8");

        $this->createIndex('pid', '{{%menu}}', 'pid', 0);
        $this->createIndex('status', '{{%menu}}', 'status', 0);

        $this->execute("SET foreign_key_checks = 1");
    }

    public function down(){

        $this->execute('SET foreign_key_checks = 0');
        /* 删除表 */
        $this->dropTable('{{%menu}}');
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
