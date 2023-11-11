<?php

namespace common\sys\repository\blockedEmails\models;

use Yii;

/**
 * This is the model class for table "blocked_emails".
 *
 * @property integer $id
 * @property string $email
 */
class BlockedEmails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blocked_emails';
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
