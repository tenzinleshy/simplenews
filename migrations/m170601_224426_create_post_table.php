<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170601_224426_create_post_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(), //Автор
            'date' => $this->timestamp()->notNull(),
            'category_id' => $this->integer()->notNull(), //Номер категории
            'text' => $this->text()->notNull(),
            'title' => $this->string()->notNull()->unique(), // Название статьи
            'abridgment' => $this->text()->notNull(), // Сокращенный текст
            'picture' => $this->string()->unique(), //Адрес картинки
            'activity' => $this->integer()->notNull()->defaultValue(0), // Активность статьи
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('post');
    }
}
