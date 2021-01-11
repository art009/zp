<?php

use yii\db\Migration;

/**
 * Class m180808_080518_page2staff
 */
class m180808_080518_page2staff extends Migration
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
        $this->dropColumn('{{%staff}}','page_id');
        // таблица Ext News & Articles
        $this->createTable('{{%page_staff}}', [
            'page_id' => $this->integer()->notNull()->comment('Страница'),
            'staff_id' => $this->integer()->notNull()->comment('Сотрудник'),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_page_staff-page_id',
            '{{%page_staff}}',
            'page_id',
            '{{%pages}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk_page_staff-staff_id',
            '{{%page_staff}}',
            'staff_id',
            '{{%staff}}',
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
        $this->dropForeignKey('fk_page_staff-page_id','{{%page_staff}}');
        $this->dropForeignKey('fk_page_staff-staff_id','{{%page_staff}}');
        $this->dropTable('{{%page_staff}}');

        $this->addColumn('{{%staff}}', 'page_id', $this->integer(11)->null()->comment('Страница'));
    }
}
