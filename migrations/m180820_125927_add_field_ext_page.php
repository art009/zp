<?php

use yii\db\Migration;

/**
 * Class m180820_125927_add_field_ext_page
 */
class m180820_125927_add_field_ext_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ext_page}}','image', $this->string(255)->null()->comment('Подробная картинка'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ext_page}}','image');
    }
}
