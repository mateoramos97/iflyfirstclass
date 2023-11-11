<?php

namespace common\sys\repository\request\models;

use Yii;

/**
 * This is the model class for table "request_form_users_info".
 *
 * @property integer $id
 * @property integer $request_form_users_id
 * @property string $departure
 * @property string $arrival
 * @property string $from_air
 * @property string $to_air
 */
class RequestFormUsersInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_form_users_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_form_users_id'], 'required'],
            [['request_form_users_id'], 'integer'],
            [['departure', 'arrival'], 'safe'],
            [['from_air', 'to_air'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_form_users_id' => 'Request Form Users ID',
            'departure' => 'Departure',
            'arrival' => 'Arrival',
            'from_air' => 'From Air',
            'to_air' => 'To Air',
        ];
    }
}
