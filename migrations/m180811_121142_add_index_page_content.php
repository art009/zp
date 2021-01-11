<?php

use yii\db\Migration;

/**
 * Class m180811_121142_add_index_page_content
 */
class m180811_121142_add_index_page_content extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('ALTER TABLE {{%pages}} ADD FULLTEXT INDEX idx_pages_content (content)');

        $this->addColumn('{{%staff}}', 'page_id', $this->integer(11)->null()->comment('Страница'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_pages_content','{{%pages}}');
        $this->dropColumn('{{%staff}}', 'page_id');
    }

}
