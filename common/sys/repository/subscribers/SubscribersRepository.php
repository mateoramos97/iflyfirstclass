<?php

namespace common\sys\repository\subscribers;

use common\sys\repository\subscribers\models\Subscribers;
use yii;

class SubscribersRepository
{
    public function add_item($email)
    {
        $item_model = new Subscribers();

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $sql = "INSERT INTO subscribers (email)
                VALUES (:email)";

            Yii::$app->db->createCommand($sql)
                ->bindValue(':email', $email)
                ->execute();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return $item_model;
    }

    public function get_subscribers()
    {
        return Subscribers::find()
            ->asArray()
            ->all();
    }

    public function get_subscriber_by_email($email)
    {
        return Subscribers::find()
            ->where(['email' => $email])
            ->one();
    }
}