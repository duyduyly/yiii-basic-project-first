<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m260323_143735_create_post_and_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // 1. Create table
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'status' => $this->integer()->defaultValue(0),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
        ]);

        //2. create user table
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->text(),
            'status' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
        ]);

        // 4. Insert sample data
        $this->batchInsert('user',
            ['username', 'password', 'status', 'created_at'],
            [
                ['user01', '123456', 1, time()],
                ['user02', '123456', 0, time()],
            ]
        );

        // 2. Create index
        $this->createIndex(
            'idx-post-title',
            'post',
            'title'
        );

        // 3. Foreign key (giả sử có bảng user)
        $this->addForeignKey(
            'fk-post-user_id',
            'post',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // 4. Insert sample data
        $this->batchInsert('post',
            ['title', 'content', 'status', 'user_id', 'created_at'],
            [
                ['First Post', 'This is content 1', 1, 1, time()],
                ['Second Post', 'This is content 2', 0, 1, time()],
            ]
        );
    }

    public function safeDown()
    {
        // rollback theo thứ tự ngược lại

        // 1. drop foreign key
        $this->dropForeignKey(
            'fk-post-user_id',
            'post'
        );

        // 2. drop index
        $this->dropIndex(
            'idx-post-title',
            'post'
        );

        // 3. drop table
        $this->dropTable('post');
    }
}
