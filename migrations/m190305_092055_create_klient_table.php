<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%klient}}`.
 */
class m190305_092055_create_klient_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%klient}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'photo' => $this->string(),
            'year' => $this->date(),
            'phone' => $this->string()->defaultValue(null),
            'login' => $this->string(),
            'email' => $this->string(),
            'pass' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%klient}}');
    }
}
