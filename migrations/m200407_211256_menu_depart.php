<?php

use yii\db\Migration;

/**
 * Class m200407_211256_menu_depart
 */
class m200407_211256_menu_depart extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn('{{%category_menu}}','depart', $this->integer(11)->null()->comment('Подразделение'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('{{%category_menu}}','depart');
    }
}
