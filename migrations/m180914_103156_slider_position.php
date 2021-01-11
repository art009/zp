<?php

use yii\db\Migration;

/**
 * Class m180914_103156_slider_position
 */
class m180914_103156_slider_position extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%sliders}}', 'position', $this->integer()->null()->comment('Сортировка'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%sliders}}', 'position');
    }
}
