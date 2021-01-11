<?php

use yii\db\Migration;

/**
 * Class m180725_092052_staff
 */
class m180725_092052_staff extends Migration
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
        // таблица Staff
        $this->createTable('{{%staff}}', [
            'id' => $this->primaryKey(),
            'photo' => $this->string(255)->null()->comment('Фотография'),
            'name' => $this->string(255)->notNull()->comment('ФИО'),
            'position' => $this->string(255)->notNull()->comment('Должность'),
            'page_id' => $this->integer(11)->null()->comment('Страница'),
            'created_at' => $this->integer()->notNull()->comment('Дата добавления'),
            'updated_at' => $this->integer()->notNull()->comment('Дата изменения'),
            'created_by' => $this->integer()->notNull()->comment('Автор'),
            'updated_by' => $this->integer()->notNull()->comment('Модератор'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%staff}}');
    }
}
