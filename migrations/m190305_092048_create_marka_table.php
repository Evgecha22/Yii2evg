<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%marka}}`.
 */
class m190305_092048_create_marka_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%marka}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%marka}}');
    }
}
