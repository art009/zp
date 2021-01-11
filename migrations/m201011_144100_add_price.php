<?php

use yii\db\Migration;

/**
 * Class m201011_144100_add_price
 */
class m201011_144100_add_price extends Migration
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

	    $this->createTable('{{%price_list}}', [
		    'id' => $this->primaryKey(),
		    'title' => $this->string(255)->notNull()->comment('Название'),
	    ], $tableOptions);
	    $this->createTable('{{%price_items}}', [
		    'id' => $this->primaryKey(),
		    'price_id' => $this->integer(11)->notNull()->comment('Прайс'),
		    'item' => $this->string(255)->notNull()->comment('Наименование позиции'),
		    'price' => $this->string(55)->notNull()->comment('Стоимость'),
	    ], $tableOptions);

	    $this->addForeignKey(
		    'fk_price_items-price_id',
		    '{{%price_items}}',
		    'price_id',
		    '{{%price_list}}',
		    'id',
		    'CASCADE',
		    'CASCADE'
	    );

	    $this->createTable('{{%price_page}}', [
		    'page_id' => $this->integer()->notNull()->comment('Страница'),
		    'price_id' => $this->integer()->notNull()->comment('Прайс'),
	    ], $tableOptions);

	    $this->addForeignKey(
		    'fk_price_page-page_id',
		    '{{%price_page}}',
		    'page_id',
		    '{{%pages}}',
		    'id',
		    'CASCADE',
		    'CASCADE'
	    );
	    $this->addForeignKey(
		    'fk_price_page-price_id',
		    '{{%price_page}}',
		    'price_id',
		    '{{%price_list}}',
		    'id',
		    'CASCADE',
		    'CASCADE'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropForeignKey('fk_price_items-price_id','{{%price_items}}');
	    $this->dropForeignKey('fk_price_page-page_id','{{%price_page}}');
	    $this->dropForeignKey('fk_price_page-price_id','{{%price_page}}');
	    $this->dropTable('{{%price_list}}');
	    $this->dropTable('{{%price_items}}');
	    $this->dropTable('{{%price_page}}');
    }

}
