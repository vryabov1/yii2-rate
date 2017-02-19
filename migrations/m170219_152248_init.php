<?php

use yii\db\Migration;

class m170219_152248_init extends Migration
{
    const TABLE_NAME = 'rates';
    const TABLE = '{{%' . self::TABLE_NAME . '}}';

    public function up()
    {
        $this->createTable(self::TABLE, [
            'id' => $this->primaryKey()->unsigned() . ' AUTO_INCREMENT PRIMARY KEY',
            'item_type' => $this->smallInteger(1)->unsigned()->notNull(),
            'item_id' => $this->integer()->notNull()->unsigned(),
            'user_id' => $this->integer()->notNull()->unsigned(),
            'value' => $this->integer(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()
        ]);

        $this->createIndex(
            self::TABLE_NAME . '_main_uq_index',
            self::TABLE,
            ['item_type', 'item_id', 'user_id'],
            true
        );
    }

    public function down()
    {
        $this->dropTable(self::TABLE);
    }
}
