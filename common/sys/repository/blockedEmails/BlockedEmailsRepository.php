<?php

namespace common\sys\repository\blockedEmails;

use common\sys\repository\blockedEmails\models\BlockedEmails;
use yii;

class BlockedEmailsRepository
{
    public function add_item($params)
    {
        $item_model = new BlockedEmails();

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $item_model->attributes = $params->attributes;
            $item_model->save(false);

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return $item_model;
    }

    public function update_item($id, $params)
    {
        $model = BlockedEmails::findOne($id);
        $model->attributes = $params->attributes;
        $model->save();

        return $model;
    }

    public function delete_item($id)
    {
        $model = BlockedEmails::findOne($id);
        $model->delete();

        return $model;
    }

    public function get_items()
    {
        return BlockedEmails::find()
            ->asArray()
            ->all();
    }

    public function get_item_by_email($email)
    {
        return BlockedEmails::find()
            ->where(['email' => $email])
            ->one();
    }

    public function get_blocked_email_by_id($id)
    {
        return BlockedEmails::find()
            ->where(['id' => $id])
            ->one();
    }

    public function BlockedEmailListDataProvider($pageSize)
    {
        $count = Yii::$app->db->createCommand('
            SELECT COUNT(*) FROM blocked_emails
            ORDER BY `blocked_emails`.`id` DESC')->queryScalar();

        $sql = "SELECT `blocked_emails`.`id`, `blocked_emails`.`email`
            FROM `blocked_emails`
            ORDER BY `blocked_emails`.`id` DESC";

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => $pageSize,
                'route' => 'blocked-email/list',
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
        ]);

        return $dataProvider;
    }
}