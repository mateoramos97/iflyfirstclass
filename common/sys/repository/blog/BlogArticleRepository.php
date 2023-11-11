<?php

namespace common\sys\repository\blog;

use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use yii;
use common\sys\repository\blog\models\BlogArticles;

class BlogArticleRepository
{
    public function add_blog_article($params, $images)
    {
        $blog_article = new BlogArticles();
        $model_image = new Image();

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $blog_article->attributes = $params->attributes;
            $blog_article->posted = date("Y-m-d H:i:s");
            $blog_article->update_date = date("Y-m-d H:i:s");
            $blog_article->save(false);

            $blog_id = $blog_article->id;

            foreach($images as $key => $image)
            {
                $sql = "INSERT INTO image (alias, content_type_id, content_id, content_field_id, queue, title)
                VALUES (:alias, :content_type_id, :content_id, :content_field_id, :queue, :title)";

                Yii::$app->db->createCommand($sql)
                    ->bindValue(':content_id', $blog_id)
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_BlogArticle)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_BlogArticle)
                    ->bindValue(':title', $image['title'])
                    ->bindValue(':alias', $image['alias'])
                    ->bindValue(':queue', $image['queue'])
                    ->execute();
            }

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return $blog_article;
    }

    public function update_blog_article($params, $images)
    {
        //$blog_article = new BlogArticles();

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $blog_article = BlogArticles::findOne($params->id);
            $blog_article->attributes = $params->attributes;
            $blog_article->update_date = date("Y-m-d H:i:s");
            $blog_article->save(false);

            $q = 0;
            foreach($images as $key => $image)
            {
                $q = $image['queue'];
                $sql = "UPDATE image
                SET alias = :alias, title = :title, queue = :queue
                WHERE content_type_id = :content_type_id
                    AND content_id = :content_id AND content_field_id = :content_field_id
                    AND queue = :q";

                Yii::$app->db->createCommand($sql)
                    ->bindValue(':content_id', $params->id)
                    ->bindValue(':content_type_id', AppConfig::Image_ContentType_BlogArticle)
                    ->bindValue(':content_field_id', AppConfig::Image_ContentField_BlogArticle)
                    ->bindValue(':title', $image['title'])
                    ->bindValue(':alias', $image['alias'])
                    ->bindValue(':queue', $image['queue'])
                    ->bindValue(':q', $q)
                    ->execute();
            }
            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return $blog_article;
    }

    public function delete_item($id)
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $item = BlogArticles::findOne($id);
            $item->delete();

            $sql = "DELETE FROM image
                WHERE content_id = :content_id AND content_type_id = :content_type_id AND
                  content_field_id = :content_field_id";

            Yii::$app->db->createCommand($sql)
                ->bindValue(':content_id', $id)
                ->bindValue(':content_type_id', AppConfig::Image_ContentType_BlogArticle)
                ->bindValue(':content_field_id', AppConfig::Image_ContentField_BlogArticle)
                ->execute();

            $transaction->commit();
        } catch(\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return true;
    }

    public function get_blog_article_by_alias($alias)
    {
        $blog_article = new BlogArticles();
        return $blog_article::find()->where([
            'alias' => $alias,
        ])->one();
    }

    public function get_blog_article_by_id($id)
    {
        $blog_article = new BlogArticles();
        return $blog_article::find()->where(['id' => $id])->one();
    }

    public function get_top_articles_in_list()
    {
        return BlogArticles::find()
            ->select(['title', 'alias'])
            ->where(['is_top_list' => 1])
            ->all();
    }

    public function get_blog_images($blog_id)
    {
        $sql = "SELECT `alias`, `queue`, `title`, `content_field_id`
                FROM `image`
                WHERE `image`.`content_id` = :content_id AND `image`.`content_type_id` = :content_type_id
                  AND `image`.`content_field_id` = :content_field_id
                ORDER BY `image`.`queue` ASC";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':content_id', $blog_id)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_BlogArticle)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_BlogArticle)
            ->queryAll();

        return $query;
    }

    public function get_all_blogs()
    {
        $sql = "SELECT `blog_articles`.`id`, `blog_articles`.`alias`, `blog_articles`.`title`, `blog_articles`.`posted`,
                  `blog_articles`.`summary`, `image`.`alias` as image_alias, `image`.`title` as image_title
            FROM blog_articles, image
            WHERE `blog_articles`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `blog_articles`.`id` DESC";

        $query = Yii::$app->db->createCommand($sql)
            ->bindValue(':content_type_id', AppConfig::Image_ContentType_BlogArticle)
            ->bindValue(':content_field_id', AppConfig::Image_ContentField_BlogArticle)
            ->queryAll();

        return $query;
    }

    public function BlogListDataProvider($pageSize)
    {
        $data_provider_params = array(
            ':content_type_id' => AppConfig::Image_ContentType_BlogArticle,
            ':content_field_id' => AppConfig::Image_ContentField_BlogArticle,
        );
        $count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM blog_articles, image
            WHERE `blog_articles`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `blog_articles`.`id` DESC', $data_provider_params)->queryScalar();

        $sql = "SELECT `blog_articles`.`id`, `blog_articles`.`alias`, `blog_articles`.`title`, `blog_articles`.`posted`,
                  `blog_articles`.`summary`, `image`.`alias` as image_alias, `image`.`title` as image_title
            FROM blog_articles, image
            WHERE `blog_articles`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `blog_articles`.`id` DESC";

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'params' => $data_provider_params,
            'pagination' => [
                'pageSize' => $pageSize,
                'route' => 'blog/list',
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ],
        ]);

        return $dataProvider;
    }

    public function BlogDataProvider($params)
    {
        $data_provider_params = array(
            ':content_type_id' => AppConfig::Image_ContentType_BlogArticle,
            ':content_field_id' => AppConfig::Image_ContentField_BlogArticle,
        );

        $sql_order_by = '';
        if(isset($params['order_by_id']) && $params['order_by_id'] == 'DESC')
        {
            $sql_order_by = 'DESC';
        }
        elseif (isset($params['order_by_id']) && $params['order_by_id'] == 'ASC')
        {
            $sql_order_by = 'ASC';
        }
        else {
            $sql_order_by = 'DESC';
        }

        $sql_part_name = '';
        if (isset($params['name']))
        {
            $sql_part_name = "`blog_articles`.`title` like :name AND ";
            $data_provider_params_temp = array(
                ':name' => '%'.$params['name'].'%',
            );
            $data_provider_params = array_merge($data_provider_params, $data_provider_params_temp);
        }

        /*$count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM blog_articles
            ')->queryScalar();*/

        $count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM blog_articles, image
            WHERE '.$sql_part_name.'`blog_articles`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `blog_articles`.`id` '.$sql_order_by.'
            ', $data_provider_params)->queryScalar();

        $sql = "SELECT `blog_articles`.`id`, `blog_articles`.`alias`, `blog_articles`.`title`, `blog_articles`.`posted`,
                  `blog_articles`.`summary`, `image`.`alias` as image_alias, `image`.`title` as image_title
            FROM blog_articles, image
            WHERE ".$sql_part_name."`blog_articles`.`id` = `image`.`content_id` AND
              `image`.`content_type_id` = :content_type_id AND
              `image`.`content_field_id` = :content_field_id AND
              `image`.`queue` = 0
            ORDER BY `blog_articles`.`id` ".$sql_order_by;

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'params' => $data_provider_params,
            'pagination' => [
                'pageSize' => 20,
                'route' => 'admin/blog/index',
            ],
        ]);

        return $dataProvider;
    }
}