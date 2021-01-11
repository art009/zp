<?php

use yii\db\Migration;

/**
 * Class m200905_052541_add_block_plus
 */
class m200905_052541_add_block_plus extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $tableOptions = null;
	    if ($this->db->driverName === 'mysql') {
		    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
	    }
	    // таблица Staff
	    $this->createTable('{{%plus_depart}}', [
		    'id' => $this->primaryKey(),
		    'title' => $this->string(255)->notNull()->comment('Заголовок'),
		    'content' => $this->text()->null()->comment('Контент'),
		    'icon' => $this->string(100)->null()->comment('Иконка'),
		    'depart_id' => $this->integer(11)->notNull()->comment('Департамент'),
		    'link' => $this->string(255)->notNull()->comment('Ссылка'),
		    'created_at' => $this->integer()->notNull()->comment('Дата добавления'),
		    'updated_at' => $this->integer()->notNull()->comment('Дата изменения'),
		    'created_by' => $this->integer()->notNull()->comment('Автор'),
		    'updated_by' => $this->integer()->notNull()->comment('Модератор'),
	    ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropTable('{{%plus_depart}}');
    }

}
