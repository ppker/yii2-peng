<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}

/*
create table if not exists `restaurant` (
`id` int(11) unsigned not null auto_increment,
	`name` varchar(60) not null default '' comment '饭店名称',
	`address` varchar(255) not null default '' comment '饭店地址',
	`phone` varchar(10) not null default '' comment '订餐电话',
	`star` int(2) unsigned not null default '0' comment '饭店几颗星',
	`zan` int(11) unsigned not null default '0' comment '饭店点赞数',
	`hate` int(11) unsigned not null default '0' comment '饭店批评数',
	`photo` varchar(80) not null default "" comment '饭店封面图片',
	`open_time` timestamp NULL comment '饭店开张时间',
	`close_time` timestamp NULL comment '饭店打烊时间',
	`mark` varchar(255) not null default "" comment '饭店介绍',
	`created_at` int(11) unsigned NOT NULL,
	`updated_at` int(11) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `name` (`name`),
	KEY `zan` (`zan`),
	KEY `star` (`star`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;*/