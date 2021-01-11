<?php

use yii\db\Migration;

/**
 * Class m180723_130546_modif_slider
 */
class m180723_130546_modif_slider extends Migration
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
        // таблица Sliders
        $this->alterColumn('{{%sliders}}', 'url', $this->string(255)->null()->comment('URL'));
        $this->alterColumn('{{%sliders}}', 'page_id', $this->integer()->null()->comment('Страница'));
        // таблица Pages
        $this->alterColumn('{{%pages}}', 'meta_description', $this->string(1024)->comment('Meta description'));
        // таблица Reviews
        $this->alterColumn('{{%reviews}}', 'email', $this->text()->null()->comment('Email'));
        $this->addColumn('{{%reviews}}', 'answer', $this->text()->null()->comment('Ответ'));
        $this->addColumn('{{%reviews}}', 'type', $this->smallInteger()->notNull()->comment('Тип'));
        $this->addColumn('{{%reviews}}', 'category_id', $this->integer()->null()->comment('Категория'));
        // таблица Reviews category
        $this->createTable('{{%categiry_reviews}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Название категории'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%sliders}}', 'url', $this->string(255)->notNull()->comment('URL'));
        $this->alterColumn('{{%sliders}}', 'page_id', $this->integer()->notNull()->comment('Страница'));
        $this->alterColumn('{{%pages}}', 'meta_description', $this->string(255)->comment('Meta description'));
        $this->alterColumn('{{%reviews}}', 'email', $this->text()->notNull()->comment('Email'));
        $this->dropColumn('{{%reviews}}', 'answer');
        $this->dropColumn('{{%reviews}}', 'type');
        $this->dropColumn('{{%reviews}}', 'category_id');
        $this->dropTable('{{%categiry_reviews}}');
    }
}
