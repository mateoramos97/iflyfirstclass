<?php

namespace common\sys\models\request;

use yii;
use yii\base\Model;

class RequestCorporateAccounts extends Model
{
    public $name;
    public $cell_phone;
    public $work_phone;
    public $email;
    public $from;
    public $to;
    public $dep_date;
    public $arr_date;
    public $fare;
    public $message;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
            [['cell_phone', 'work_phone', 'from', 'to', 'dep_date', 'arr_date', 'fare', 'message'], 'safe'],
            [['name', 'cell_phone', 'work_phone', 'email', 'from', 'to', 'fare', 'message'], 'string'],
            [['message'], 'string', 'max' => 500],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 100],
            [['cell_phone', 'work_phone'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Your Name',
            'cell_phone' => 'Cell Phone',
            'work_phone' => 'Work Phone',
            'email' => 'Your Email',
            'from' => 'From',
            'to' => 'To',
            'dep_date' => 'Departure Date',
            'arr_date' => 'Return Date',
            'fare' => 'Best Fare Quoted ($)',
            'message' => 'Your Message',
        ];
    }

    public function sendEmailRequestCorporateAccount($email, $model)
    {
        return Yii::$app->mailer
            ->compose(
                ['html' => 'requestCorporateAccount-html', 'text' => 'requestCorporateAccount-text'],
                ['model' => $model]
            )
            ->setFrom(Yii::$app->params['emailFrom'])
            ->setTo($email)
            ->setSubject('IFlyFirstClass - New Corporate Account Message')
            ->send();
    }
}