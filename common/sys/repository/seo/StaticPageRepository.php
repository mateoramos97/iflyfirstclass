<?php

namespace common\sys\repository\seo;

use common\sys\repository\seo\models\StaticPage;
use yii;

class StaticPageRepository
{
    public function update_static_page($params)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $static_page_model = StaticPage::findOne($params->id);
            $static_page_model->attributes = $params->attributes;
            $static_page_model->save(false);

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return $static_page_model;
    }

    public function get_static_pages()
    {
        return StaticPage::find()
            ->asArray()
            ->all();
    }

    public function get_static_page_by_id($id)
    {
        return StaticPage::find()
            ->where(['id' => $id])
            ->one();
    }
}