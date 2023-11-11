<?php

namespace frontend\controllers\admin;

use app\modules\imagemanager\models\Image;
use common\sys\core\blog\BlogArticleEditService;
use common\sys\core\blog\BlogArticleInfoService;
use common\sys\repository\blog\models\BlogArticles;
use yii;
use app\components\AppConfig;
use frontend\modules\imagemanager\ImageManager;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

class BlogController extends AdminController
{
    private $blog_edit_service_repo;
    private $blog_info_service_repo;
    private function get_blog_edit_service_repo()
    {
        if($this->blog_edit_service_repo != null)
            return $this->blog_edit_service_repo;
        $this->blog_edit_service_repo = new BlogArticleEditService();
        return $this->blog_edit_service_repo;
    }

    private function get_blog_info_service_repo()
    {
        if($this->blog_info_service_repo != null)
            return $this->blog_info_service_repo;
        $this->blog_info_service_repo = new BlogArticleInfoService();
        return $this->blog_info_service_repo;
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $search_resp = $this->blog_search(array());
        $filter_values = $search_resp['filter_values'];

        return $this->render('index',[
            'dataProvider' => $search_resp['items'],
            'filter_values' => $filter_values,
        ]);
    }

    private function blog_search($params)
    {
        $resp = array();
        $fv = array();

        $params = array();

        if(Yii::$app->request->get())
        {
            $fv['order_by_id'] = Yii::$app->request->get('order_by_id');
            $fv['name'] = Yii::$app->request->get('name');

            $params['order_by_id'] = $fv['order_by_id'];

            if ($fv['name'] != '')
            {
                $params['name'] = $fv['name'];
            }
            $dataProvider = $this->get_blog_info_service_repo()->BlogDataProvider($params);
        }
        else {
            $dataProvider = $this->get_blog_info_service_repo()->BlogDataProvider($params);
        }
        $resp['items'] = $dataProvider;
        $resp['filter_values'] = $fv;

        return $resp;
    }

    public function actionCreate()
    {
        //model
        $blog_article_model = new BlogArticles();
        $image_model = new Image();

        $image_alias_poster = null;
        $image_title = '';

        $errors = null;

        if($blog_article_model->load(Yii::$app->request->post())){
            $images = array();
            $images = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'alias');
            $images_title = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'title');

            $imgValidation = $image_model->imageValidation($images);

            $blog_article_model->alias = $this->GetAbsoluteUrl($blog_article_model->alias);

            $isValid = $blog_article_model->validate();
            if($isValid && $imgValidation)
            {
                $blog_article_model = $this->get_blog_edit_service_repo()
                    ->add_blog_article($blog_article_model, Yii::$app->request->post('image'));
                Yii::$app->session->addFlash(
                    'info',
                    'Post add. <a href="'. Url::to(['/blog'], true) .'/'.$blog_article_model->alias .'" >View</a>');
                $this->redirect(['adminarea/blog']);
            }
            else {
                $err = array();
                $err = array_merge($blog_article_model->errors);
                if (!$imgValidation)
                    $err['image'] = array(
                        0 => 'Image not found',
                    );
                $errors = $err;
            }
        }

        $img_params_poster = array(
            'config' => array(
                'path' => Url::base().'/public/images/',
                'model_prefix' => 'image',
                'route' => Url::to(['imageblogposter']),
                'enable_replace_button' => true,
                'enable_delete_button' => false,
                'enable_add_button' => false,
                'enable_title' => false,
                'enable_mainimage_button' => false,
                'content_id' => 'null',
                'content_field_id' => AppConfig::Image_ContentField_BlogArticle,
                'enable_rotate_button' => false,
            ),
            'images' => array(
                array(
                    'alias' => isset($images[0]) ? $images[0] : null,
                    'title' => isset($images_title[0]) ? $images[0] : null,
                    'queue' => 0,
                ),
                array(
                    'alias' => isset($images[1]) ? $images[1] : null,
                    'title' => isset($images_title[1]) ? $images[1] : null,
                    'queue' => 1,
                ),
            ),
        );

        return $this->render('create', [
            'blog_article_model' => $blog_article_model,
            'img_params_poster' => $img_params_poster,
            'errors' => $errors,
        ]);
    }

    public function actionEdit()
    {
        $blog_id = Yii::$app->request->getQueryParam('id');

        //service
        $blog_article_edit_service = new BlogArticleEditService();
        $blog_article_info_service = new BlogArticleInfoService();

        //model
        $blog_article_model = new BlogArticles();
        $image_model = new Image();

        $image_alias_poster = null;
        $image_title = '';

        $errors = null;

        if($blog_article_model->load(Yii::$app->request->post()))
        {
            $blog_article_model->id = $blog_id;
            $blog_article_model->alias = $this->GetAbsoluteUrl($blog_article_model->alias);

            $images = array();
            $images = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'alias');

            $imgValidation = $image_model->imageValidation($images);

            $isValid = $blog_article_model->validate();
            if($isValid && $imgValidation)
            {
                $blog_article_model = $this->get_blog_edit_service_repo()->update_blog_article($blog_article_model, Yii::$app->request->post('image'));
                Yii::$app->session->addFlash('info', 'Post update. <a href="'. Url::to(['/blog'], true) .'/'.$blog_article_model->alias .'" >View</a>');
                $this->redirect(['adminarea/blog']);
            }
            else {
                $err = array();
                $err = array_merge($blog_article_model->errors);
                $errors = $err;
            }
        }
        else {
            $blog_article_model = $this->get_blog_info_service_repo()->get_blog_article_by_id($blog_id);
            if(!$blog_article_model)
                throw new HttpException(404, 'Page not found');
        }

        if(!$blog_article_model)
            throw new HttpException(404, 'Page not found');

        $images = $this->get_blog_info_service_repo()->get_blog_images($blog_id);

        $img_params_poster = array(
            'config' => array(
                'path' => Url::base().'/public/images/',
                'model_prefix' => 'image',
                'route' => Url::to(['imageblogposter']),
                'enable_replace_button' => true,
                'enable_delete_button' => false,
                'enable_add_button' => false,
                'enable_title' => false,
                'enable_mainimage_button' => false,
                'content_id' => $blog_id,
                'content_field_id' => AppConfig::Image_ContentField_BlogArticle,
                'enable_rotate_button' => false,
            ),
            'images' => array(
                array(
                    'alias' => $images[0]['alias'],
                    'title' => $images[0]['title'],
                    'queue' => $images[0]['queue'],
                    'content_field_id' => isset($images[0]['content_field_id']) ? $images[0]['content_field_id'] : null,
                ),
                array(
                    'alias' => $images[1]['alias'],
                    'title' => $images[1]['title'],
                    'queue' => $images[1]['queue'],
                    'content_field_id' => isset($images[1]['content_field_id']) ? $images[1]['content_field_id'] : null,
                ),
            ),
        );

        return $this->render('create', [
            'blog_article_model' => $blog_article_model,
            'img_params_poster' => $img_params_poster,
            'errors' => $errors,
        ]);
    }

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $id = Yii::$app->request->getQueryParam('id');
            $status = $this->get_blog_edit_service_repo()->delete_item($id);
            Yii::$app->session->addFlash('info', 'Post delete.');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionImageblogposter()
    {
        $content_id = isset($_POST['content_id']) && $_POST['content_id'] != 'null' ? $_POST['content_id'] : FALSE;
        $content_type_id = AppConfig::Image_ContentType_BlogArticle;
        $content_field_id = AppConfig::Image_ContentField_BlogArticle;

        $im = new ImageManager(array(
            'content_id' => $content_id,
            'content_type_id' => $content_type_id,
            'content_field_id' => $content_field_id,
            'alias_to_remove' => isset($_POST['alias_to_remove']) && $_POST['alias_to_remove'] != '' ? $_POST['alias_to_remove'] : FALSE,
            'alias_to_rotate' => isset($_POST['alias_to_rotate']) && $_POST['alias_to_rotate'] != '' ? $_POST['alias_to_rotate'] : FALSE,
            'file' => isset($_FILES['upload_file']) ? TRUE : FALSE,
        ), Yii::$app->params['docRoot'] .'/web/public/images/');

        //print_r($im);

        $et = $im->get_event_type();
        $fs = $et['fs'];

        $fs_resp = NULL;

        switch($et['event'])
        {
            case ImageManager::EVENT_TYPE_ADD :
                $fs_resp = $fs->save();
                if ( ! $fs_resp['success'])
                    break;
                $im->update_repo($fs_resp['upload_name']);
                break;
            case ImageManager::EVENT_TYPE_DELETE :
                $im->update_repo();
                $fs->remove_old_image();
                break;
            case ImageManager::EVENT_TYPE_REPLACE :
                $fs_resp = $fs->save();
                if ( ! $fs_resp['success'])
                    break;
                $im->update_repo($fs_resp['upload_name']);
                $fs->remove_old_image();
                break;
            case ImageManager::EVENT_TYPE_ROTATE :
                $fs->rotate_image();
                break;
        }

        echo $im->get_response($fs_resp);
    }

    private function GetAbsoluteUrl($str)
    {
        return preg_replace('/[^a-zA-Z0-9_]+/iu', '-', $str);
    }
}