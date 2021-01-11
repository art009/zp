<?php

use yii\db\Migration;

/**
 * Class m200503_114748_modal_window
 */
class m200503_114748_modal_window extends Migration
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
	    // таблица Департаментов
	    $this->createTable('{{%modal_window}}', [
		    'id' => $this->primaryKey(),
		    'title' => $this->string(255)->notNull()->comment('Заголовок окна'),
		    'content' => $this->text()->null()->comment('Содержания модального окна'),
		    'date_from' => $this->integer()->notNull()->comment('Дата начала показа'),
		    'date_to' => $this->integer()->notNull()->comment('Дата кончания показа'),
		    'type_show' => $this->smallInteger(2)->comment('Тип показа'),
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
	    $this->dropTable('{{%modal_window}}');
    }
}
