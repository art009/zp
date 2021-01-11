<?php

use yii\db\Migration;

/**
 * Class m200404_154051_add_depart_slider
 */
class m200404_154051_add_depart_slider extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn('{{%sliders}}','depart', $this->integer(11)->null()->comment('Подразделение'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('{{%sliders}}','depart');
    }
}
