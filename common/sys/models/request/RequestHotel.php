<?php

namespace common\sys\models\request;

use yii;
use yii\base\Model;

class RequestHotel extends Model
{
    public $hotel_checkin;
    public $check_in;
    public $check_out;
    public $name;
    public $email;
    public $phone;
    public $rooms_number;
    public $adults_number;
    public $children_number;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotel_checkin', 'check_in', 'check_out', 'name', 'email', 'phone', 'rooms_number'], 'required'],
            ['email', 'email'],
            [['adults_number', 'children_number', 'check_in', 'check_out'], 'safe'],
            [['hotel_checkin', 'name', 'email', 'phone', 'rooms_number', 'adults_number', 'children_number'], 'string'],
            [['hotel_checkin'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hotel_checkin' => 'Hotel checkin',
            'check_in' => 'Check in',
            'check_out' => 'Check out',
            'name' => 'Your Name',
            'email' => 'Your Email',
            'phone' => 'Phone',
            'rooms_number' => 'Rooms',
            'adults_number' => 'Adults',
            'children_number' => 'Hotel checkin',
        ];
    }

    public function sendEmailRequestHotel($email, $request_hotel)
    {
        return Yii::$app->mailer
            ->compose(
                ['html' => 'requestHotel-html', 'text' => 'requestHotel-text'],
                ['request_hotel' => $request_hotel]
            )
            ->setFrom(Yii::$app->params['emailFrom'])
            ->setTo($email)
            ->setSubject('IFlyFirstClass - New request hotel')
            ->send();
    }
}