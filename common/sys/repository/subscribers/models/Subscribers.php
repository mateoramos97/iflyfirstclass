<?php

namespace common\sys\repository\subscribers\models;

use Yii;

/**
 * This is the model class for table "subscribers".
 *
 * @property integer $id
 * @property string $email
 */
class Subscribers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email', 'email'],
            [['email'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
        ];
    }
}
