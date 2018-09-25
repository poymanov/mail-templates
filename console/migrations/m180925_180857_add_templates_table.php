<?php

use yii\db\Migration;

/**
 * Class m180925_180857_add_templates_table
 */
class m180925_180857_add_templates_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%templates}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'filename' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%templates}}');
    }
}
