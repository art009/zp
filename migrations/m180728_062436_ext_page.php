<?php

use yii\db\Migration;

/**
 * Class m180728_062436_ext_page
 */
class m180728_062436_ext_page extends Migration
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
        $this->createTable('{{%ext_page}}', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer()->notNull()->comment('Страница'),
            'cover' => $this->string(255)->comment('Обложка'),
            'shor_content' => $this->text()->comment('Описание'),
        ], $tableOptions);

        $this->addForeignKey(
            'fk_ext_page-page_id',
            '{{%ext_page}}',
            'page_id',
            '{{%pages}}',
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
        $this->dropForeignKey('fk_ext_page-page_id','{{%ext_page}}');
        $this->dropTable('{{%ext_page}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180728_062436_ext_page cannot be reverted.\n";

        return false;
    }
    */
}
