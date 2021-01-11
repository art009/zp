<?php

use yii\db\Migration;

/**
 * Class m200222_182206_table_settings
 */
class m200222_182206_table_settings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    // таблица настроек
    	$this->addColumn('{{%settings}}','key_param',$this->string(50)->notNull()->unique()->comment('Ключ параметра') );
    	$this->alterColumn('{{%settings}}','name',$this->string(50)->notNull()->comment('Название параметра') );
	    $this->alterColumn('{{%settings}}','description', $this->string(255)->null()->comment('Описание параметра') );
	    $this->alterColumn('{{%settings}}','value', $this->string(255)->null()->comment('Значение параметра') );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('{{%settings}}','key_param');
	    $this->alterColumn('{{%settings}}','name',$this->integer(11)->notNull()->comment('Ид корзины') );
	    $this->alterColumn('{{%settings}}','description', $this->string(255)->notNull()->comment('Название товара') );
	    $this->alterColumn('{{%settings}}','value', $this->integer(11)->null()->comment('Ид товара') );

    }
}
