<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "templates".
 *
 * @property int $id
 * @property string $title
 * @property string $filename
 * @property int $created_at
 * @property int $updated_at
 */
class Template extends \yii\db\ActiveRecord
{
    public $content;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%templates}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'filename', 'content'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['title', 'filename'], 'string', 'max' => 255],
            [['filename'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'filename' => 'Filename',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->saveContentToFile();
    }

    public function getContentPath()
    {
        return Yii::getAlias('@common/storage/' . $this->filename);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->deleteContentFile();
    }

    public function saveContentToFile()
    {
        $savePath = $this->getContentPath();
        file_put_contents($savePath, $this->content);
        @chmod($savePath, 0777);
    }

    public function getContentFromFile()
    {
        $filePath = $this->getContentPath();

        if (is_file($filePath)) {
            $this->content = file_get_contents($filePath);
        }
    }

    public function deleteContentFile()
    {
        $filePath = $this->getContentPath();

        if (is_file($filePath)) {
            unlink($filePath);
        }
    }
}
