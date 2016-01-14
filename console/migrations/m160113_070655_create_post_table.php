<?php

use yii\db\Migration;

class m160113_070655_create_post_table extends Migration {

    public function up() {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(30)->notNull()->unique(),
            'content' => $this->text()
        ]);
    }

    public function down() {
        $this->dropTable('post');
    }

}
