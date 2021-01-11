<?php

use yii\db\Migration;

/**
 * Class m180824_101230_staff_field_is_enable
 */
class m180824_101230_staff_field_is_enable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%staff}}','is_record', $this->tinyInteger(1)->notNull()->comment('Наличие записи'));
        $this->update('{{%staff}}',['is_record' => 1]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%staff}}','is_record');
    }
}
