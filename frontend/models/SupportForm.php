<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * SupportForm is the model behind the contact form.
 */
class SupportForm extends Model
{
    public $name;
    public $email;
    public $message;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message'], 'required'],
            ['email', 'email'],
            [['name', 'email', 'message'], 'string'],
            [['name', 'email'], 'string', 'max' => 100],
            [['message'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'From Name: *',
            'email' => 'From e-mail address: *',
            'message' => 'Message: *'
        ];
    }

    public function sendEmailSupportRequest($email, $support_request)
    {
        return Yii::$app->mailer
            ->compose(
                ['html' => 'supportRequest-html', 'text' => 'supportRequest-text'],
                ['model' => $support_request]
            )
            ->setFrom(Yii::$app->params['emailFrom'])
            ->setTo($email)
            ->setSubject('IFlyFirstClass - New request message')
            ->send();
    }
}
