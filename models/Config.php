<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "config".
 *
 * @property int $id
 * @property int $owner
 * @property int $key
 * @property int $value
 * @property int $userId
 */
class Config extends \yii\db\ActiveRecord
{
    const OWNER_CLOCKIFY = 'clockify';
    const OWNER_STRIPE = 'stripe';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['owner','key','value'], 'required'],
            [['owner','key','value'], 'string'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'owner' => 'API Name',
            'key' => 'Key Name',
            'value' => 'Key Value',

        ];
    }


}