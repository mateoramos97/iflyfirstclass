<?php

namespace common\sys\models\request;

use common\sys\repository\request\models\RequestFormUsers;
use yii;
use yii\base\Model;

class FlightRequestMax extends Model
{
    public $from;
    public $to;
    public $name;
    public $phone;
    public $email;
    public $message;
    public $dep_date;
    public $arr_date;
    public $cabin_class_name;
    public $people_number;
    public $type_trip;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dep_date', 'name', 'phone', 'email'], 'required'],
            ['email', 'email'],
            [['phone', 'from', 'to', 'dep_date', 'arr_date', 'type_trip'], 'safe'],
            [['name', 'phone', 'email'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 100],
            [['dep_date', 'arr_date'], 'validateDateRange'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Your Name',
            'phone' => 'Your Telephone',
            'email' => 'Your Email',
            'from' => 'From',
            'to' => 'To',
            'dep_date' => 'Departure Date',
            'arr_date' => 'Return Date',
            'cabin_class_name' => 'Cabin class',
            'people_number' => 'People number'
        ];
    }

    public function validateDateRange($attribute, $params)
    {
        $value = $this->$attribute;
        if (!empty($value)) {
            // Handle array values from form
            $dateValue = is_array($value) ? $value[0] : $value;
            
            if (!empty($dateValue)) {
                $selectedDate = strtotime($dateValue);
                $maxDate = strtotime('+350 days');
                
                if ($selectedDate > $maxDate) {
                    $this->addError($attribute, 'Date cannot be more than 350 days from today.');
                }
            }
        }
    }

    public function sendEmailFlightRequest($email, $flight_request, $trips, $lastInsertID)
    {
        $request_number = RequestFormUsers::find()
            ->select(['request_number'])
            ->where(['id' => $lastInsertID])
            ->one();
        $data['flight_request'] = $flight_request;
        $data['request_number'] = $request_number->request_number;
        $data['trips'] = $trips;
        return Yii::$app->mailer
            ->compose(
                ['html' => 'flightRequest-html', 'text' => 'flightRequest-text'],
                ['data' => $data]
            )
            ->setFrom(Yii::$app->params['emailFrom'])
            ->setTo($email)
            ->setSubject('IFlyFirstClass - Quote Request Confirmation')
            ->send();
    }
}