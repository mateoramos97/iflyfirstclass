<?php

namespace common\sys\repository\request\models;

use Yii;

/**
 * This is the model class for table "request_form_users".
 *
 * @property integer $id
 * @property string $email
 * @property string $name
 * @property string $phone
 * @property string $cabin_class_name
 * @property string $people_number
 * @property integer $request_number
 * @property integer $type_trip
 * @property integer $created_date
 * @property integer $number_page_visits
 */
class RequestFormUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_form_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'name', 'phone', 'cabin_class_name', 'people_number', 'request_number'], 'required'],
            [['request_number', 'type_trip', 'cabin_class_name'], 'integer'],
            [['created_date'], 'safe'],
            [['email', 'name', 'phone', 'people_number'], 'string', 'max' => 100],
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
            'name' => 'Name',
            'phone' => 'Phone',
            'cabin_class_name' => 'Cabin Class',
            'people_number' => 'People Number',
            'request_number' => 'Request Number',
            'created_date' => 'Created Date'
        ];
    }
}
