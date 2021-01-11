<?php

use yii\db\Migration;

class m180209_103319_main extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // таблица Pages
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull()->comment('Дата добавления'),
            'updated_at' => $this->integer()->notNull()->comment('Дата изменения'),
            'created_by' => $this->integer()->notNull()->comment('Автор'),
            'updated_by' => $this->integer()->notNull()->comment('Модератор'),
            'content' => $this->text()->comment('Содержание'),
            'status' => $this->smallInteger()->notNull()->defaultValue(10)->comment('Статус'),
            'layout' => $this->smallInteger(3)->defaultValue(20)->comment('Шаблон'),
            'url' => $this->string(255)->notNull()->comment('URL'),
            'title_page' => $this->string(255)->notNull()->comment('Заголовок (H1)'),
            'meta_title' => $this->string(255)->comment('Заголовок (title)'),
            'meta_keywords' => $this->string(255)->comment('Meta keywords'),
            'meta_description' => $this->string(255)->comment('Meta description'),
        ], $tableOptions);

        $this->createIndex('idx-pages-status', '{{%pages}}', 'status');
        $this->createIndex('idx-pages-layout', '{{%pages}}', 'layout');
        $this->createIndex('idx-pages-url', '{{%pages}}', 'url');

        // таблица Redirect
        $this->createTable('{{%redirect}}', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer()->notNull()->comment('Страница'),
            'old_url' => $this->string(255)->notNull()->comment('Старая ссылка'),
        ], $tableOptions);

        $this->createIndex('idx-redirect-page_id', '{{%redirect}}', 'page_id');
        $this->createIndex('idx-redirect-old_url', '{{%redirect}}', 'old_url');

        // таблица Menu
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull()->comment('Название'),
            'url' => $this->string(1024)->comment('Ссылка'),
            'page' => $this->integer()->comment('Страницы'),
            'parent' => $this->integer()->comment('Родительский раздел'),
            'position' => $this->integer()->comment('Позиция'),
            'category_id' => $this->integer()->notNull()->comment('Категория'),
            'created_at' => $this->integer()->notNull()->comment('Дата добавления'),
            'updated_at' => $this->integer()->notNull()->comment('Дата изменения'),
            'created_by' => $this->integer()->notNull()->comment('Автор'),
            'updated_by' => $this->integer()->notNull()->comment('Модератор'),
        ], $tableOptions);
        // таблица CategoryMenu
        $this->createTable('{{%category_menu}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Заголовок'),
            'description' => $this->text()->comment('Полное описание'),
            'created_at' => $this->integer()->notNull()->comment('Дата добавления'),
            'updated_at' => $this->integer()->notNull()->comment('Дата изменения'),
            'created_by' => $this->integer()->notNull()->comment('Автор'),
            'updated_by' => $this->integer()->notNull()->comment('Модератор'),
        ], $tableOptions);

        // таблица настроек
        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'name' => $this->integer(11)->notNull()->comment('Ид корзины'),
            'description' => $this->string(255)->notNull()->comment('Название товара'),
            'value' => $this->integer(11)->null()->comment('Ид товара'),

            'created_by' => $this->integer(11)->notNull()->comment('Добавил'),
            'updated_by' => $this->integer(11)->notNull()->comment('Изменил'),

            'created_at' => $this->integer(11)->notNull()->comment('Дата создания'),
            'updated_at' => $this->integer(11)->notNull()->comment('Дата изменения'),

        ], $tableOptions);

        $this->createIndex(
            'idx-settings-name',
            '{{%settings}}',
            'name'
        );

        // таблица Sliders
        $this->createTable('{{%sliders}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull()->comment('Дата добавления'),
            'updated_at' => $this->integer()->notNull()->comment('Дата изменения'),
            'created_by' => $this->integer()->notNull()->comment('Автор'),
            'updated_by' => $this->integer()->notNull()->comment('Модератор'),
            'images' => $this->string(255)->notNull()->comment('Картинка'),
            'name' => $this->string(255)->notNull()->comment('Название'),
            'description' => $this->string(255)->comment('Описание'),
            'url' => $this->string(255)->notNull()->comment('URL'),
            'page_id' => $this->integer()->notNull()->comment('Страница'),
        ], $tableOptions);

        // таблица Отзывы
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'status' => $this->tinyInteger(2)->notNull()->comment('Статус'),
            'email' => $this->string(150)->notNull()->comment('Email'),
            'created_name' => $this->string(150)->notNull()->comment('Автор'),
            'review' => $this->text()->notNull()->comment('Отзыв'),
            'created_at' => $this->integer()->notNull()->comment('Дата добавления'),
            'updated_at' => $this->integer()->notNull()->comment('Дата изменения'),
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropIndex('idx-settings-name', '{{%settings}}');

        $this->dropTable('{{%pages}}');
        $this->dropTable('{{%redirect}}');
        $this->dropTable('{{%menu}}');
        $this->dropTable('{{%category_menu}}');
        $this->dropTable('{{%settings}}');
        $this->dropTable('{{%sliders}}');
        $this->dropTable('{{%reviews}}');
    }
}
