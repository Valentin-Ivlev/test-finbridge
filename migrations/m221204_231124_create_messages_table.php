<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%messages}}`.
 */
class m221204_231124_create_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%messages}}', [
            'id'        => $this->primaryKey(),
            'text'      => $this->string(),
            'send_at'   => $this->dateTime().' DEFAULT NOW()',
            'status'    => "ENUM('sent', 'not sent')",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%messages}}');
    }
}
