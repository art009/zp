<?php

use yii\db\Migration;

/**
 * Class m200609_211832_modif_depart_mails
 */
class m200609_211832_modif_depart_mails extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

	    $this->addColumn('{{%depart}}','mails', $this->string(255)->null()->comment('Mails'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
	    $this->dropColumn('{{%depart}}','mails');
    }

}
