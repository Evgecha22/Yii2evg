<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auto}}`.
 */
class m190305_101433_create_auto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%auto}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'city' => $this->string(),
            'data' => $this->date(),
            'price' => $this->decimal(10,2),
            'photo' => $this->string(),
            'id_marka' => $this->integer(),
            'id_klient' => $this->integer()
        ]);
        $this->createIndex(
            'idx-post-id_marka',
            'auto',
            'id_marka'
        );
        $this->addForeignKey(
            'fk-post-id_marka',
            'auto',
            'id_marka',
            'marka',
            'id',
            'cascade'
        );
        $this->createIndex(
            'idx-post-id_klient',
            'auto',
            'id_klient'
        );
        $this->addForeignKey(
            'fk-post-id_klient',
            'auto',
            'id_klient',
            'klient',
            'id',
            'cascade'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%auto}}');
    }
}
