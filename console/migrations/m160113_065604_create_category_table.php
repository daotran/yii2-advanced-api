<?php

use yii\db\Migration;
use yii\db\Schema;

class m160113_065604_create_category_table extends Migration {

    public function up() {
        $this->createTable('category', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ]);
    }

    public function down() {
        $this->dropTable('category');
    }

}
