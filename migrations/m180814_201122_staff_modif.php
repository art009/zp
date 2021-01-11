<?php

use yii\db\Migration;

/**
 * Class m180814_201122_staff_modif
 */
class m180814_201122_staff_modif extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%page_staff}}','sort',$this->integer(6)->notNull()->comment('Позиция'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%page_staff}}','sort');
    }

}
