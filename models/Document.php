<?php

namespace app\models;


/**
 * This is the model class for table "reports".
 *
 * @property int $id
 * @property string $filename
 * @property string $size
 * @property string $type
 * @property string $extension
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filename', 'type','extension'], 'string'],
            [['size'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'filename' => 'Filename',
            'size' => 'Size',
            'type' => 'Type',
            'extension' => 'Extension',
        ];
    }
}
