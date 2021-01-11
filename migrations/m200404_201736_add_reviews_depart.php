<?php

use yii\db\Migration;

/**
 * Class m200404_201736_add_reviews_depart
 */
class m200404_201736_add_reviews_depart extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn('{{%reviews}}','depart', $this->integer(11)->null()->comment('Подразделение'));
	    $this->addColumn('{{%staff}}','depart', $this->integer(11)->null()->comment('Подразделение'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('{{%reviews}}','depart');
	    $this->dropColumn('{{%staff}}','depart');
    }
}
