<?php

use yii\db\Migration;

/**
 * Class m200306_171245_departs
 */
class m200306_171245_departs extends Migration
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
	    $this->createTable('{{%depart}}', [
	    	'id' => $this->primaryKey(),
		    'name' => $this->string(255)->notNull()->comment('Название департамента'),
		    'slug' => $this->string(50)->notNull()->comment('Slug'),
		    'phone' => $this->string(25)->comment('Телефон'),
		    'email' => $this->string(50)->comment('Email'),
		    'address' => $this->string(255)->comment('Адрес'),
		    'image' => $this->string(255)->comment('Картинка'),
		    'is_main' => $this->smallInteger(1)->defaultValue(0)->comment('Основное'),
	    ], $tableOptions);

	    $this->addColumn('{{%ext_page}}','depart', $this->integer(11)->null()->comment('Подразделение'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('{{%ext_page}}','depart');
	    $this->dropTable('{{%depart}}');
    }
}
