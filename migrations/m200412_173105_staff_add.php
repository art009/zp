<?php

use yii\db\Migration;

/**
 * Class m200412_173105_staff_add
 */
class m200412_173105_staff_add extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn('{{%staff}}','is_online', $this->tinyInteger(1)->notNull()->comment('Наличие записи'));
	    $this->addColumn('{{%staff}}','is_home', $this->tinyInteger(1)->notNull()->comment('Наличие записи'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('{{%staff}}','is_online');
	    $this->dropColumn('{{%staff}}','is_home');
    }
}
