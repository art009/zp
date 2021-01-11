<?php

use yii\db\Migration;

/**
 * Class m180801_125946_gallery
 */
class m180801_125946_gallery extends Migration
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
        // таблица Ext News & Articles
        $this->createTable('{{%gallery}}', [
            'id'            => $this->primaryKey(),
            'page_id'       => $this->integer()->notNull()->comment('Страница'),
            'image'         => $this->string(255)->notNull()->comment('Картинка'),
            'description'   => $this->string(1024)->comment('Описание'),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_gallery-page_id',
            '{{%gallery}}',
            'page_id',
            '{{%pages}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->addColumn('{{%reviews}}','phone',$this->string('25')->null()->comment('Телефон'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_gallery-page_id');
        $this->dropTable('{{%gallery}}');

        $this->dropColumn('{{%reviews}}','phone');
    }
}
