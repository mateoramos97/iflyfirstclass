<?php

namespace frontend\controllers\admin;

use app\components\AppConfig;
use common\sys\core\testimonials\TestimonialsEditService;
use common\sys\core\testimonials\TestimonialsInfoService;
use common\sys\repository\testimonials\models\Testimonials;
use frontend\modules\imagemanager\ImageManager;
use app\modules\imagemanager\models\Image;
use yii\helpers\ArrayHelper;
use yii;
use yii\web\HttpException;
use yii\helpers\Url;

class TestimonialsController extends AdminController
{
    private $testimonials_edit_service_repo;
    private $testimonials_info_service_repo;
    private function get_testimonials_edit_service_repo()
    {
        if($this->testimonials_edit_service_repo != null)
            return $this->testimonials_edit_service_repo;
        $this->testimonials_edit_service_repo = new TestimonialsEditService();
        return $this->testimonials_edit_service_repo;
    }

    private function get_testimonials_info_service_repo()
    {
        if($this->testimonials_info_service_repo != null)
            return $this->testimonials_info_service_repo;
        $this->testimonials_info_service_repo = new TestimonialsInfoService();
        return $this->testimonials_info_service_repo;
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $search_resp = $this->testimonials_search(array());
        $filter_values = $search_resp['filter_values'];
        return $this->render('index',[
            'dataProvider' => $search_resp['items'],
            'filter_values' => $filter_values,
        ]);
    }

    private function testimonials_search($params)
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
            $dataProvider = $this->get_testimonials_info_service_repo()->TestimonialsDataProvider($params);
        }
        else {
            $dataProvider = $this->get_testimonials_info_service_repo()->TestimonialsDataProvider($params);
        }
        $resp['items'] = $dataProvider;
        $resp['filter_values'] = $fv;

        return $resp;
    }

    public function actionCreate()
    {
        //model
        $testimonials_model = new Testimonials();
        $image_model = new Image();

        $errors = null;

        if($testimonials_model->load(Yii::$app->request->post())){

            $images = array();
            $images = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'alias');

            $img_request = Yii::$app->request->post('image');

            $imgValidation = $image_model->imageValidation($images);

            if(!$imgValidation) {
                $img_request[0]['alias'] = "no_avatar.png";
            }

            $isValid = $testimonials_model->validate();
            if($isValid)
            {
                $testimonials_model = $this->get_testimonials_edit_service_repo()->add_item($testimonials_model, $img_request);
                Yii::$app->session->addFlash('info', 'Testimonials add.');
                $this->redirect(['adminarea/testimonials']);
            }
            else {
                $err = array();
                $err = array_merge($testimonials_model->errors);
                $errors = $err;
            }
        }

        $img_params = array(
            'config' => array(
                'path' => Url::base().'/public/images/',
                'model_prefix' => 'image',
                'route' => Url::to(['imagetestimonials']),
                'enable_replace_button' => true,
                'enable_delete_button' => false,
                'enable_add_button' => false,
                'enable_title' => false,
                'enable_mainimage_button' => false,
                'content_id' => 'null',
                'content_field_id' => 'null',
                'enable_rotate_button' => false,
            ),
            'images' => array(
                array(
                    'alias' => isset($images[0]) ? $images[0] : null,
                    'title' => isset($images_title[0]) ? $images[0] : null,
                    'queue' => 0,
                ),
            ),
        );

        return $this->render('create', [
            'testimonials_model' => $testimonials_model,
            'img_params' => $img_params,
            'errors' => $errors,
        ]);
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->getQueryParam('id');

        //model
        $testimonials_model = new Testimonials();
        $image_model = new Image();

        $errors = null;

        if($testimonials_model->load(Yii::$app->request->post()))
        {
            $testimonials_model->id = $id;

            $images = array();
            $images = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'alias');

            $img_request = Yii::$app->request->post('image');

            $imgValidation = $image_model->imageValidation($images);

            if(!$imgValidation) {
                $img_request[0]['alias'] = "no_avatar.png";
            }

            $isValid = $testimonials_model->validate();
            if($isValid)
            {
                $testimonials_model = $this->get_testimonials_edit_service_repo()->update_item($testimonials_model, $img_request);
                Yii::$app->session->addFlash('info', 'Testimonials Update.');
                $this->redirect(['adminarea/testimonials']);
            }
            else {
                $err = array();
                $err = array_merge($testimonials_model->errors);
                $errors = $err;
            }
        }
        else {
            $testimonials_model = $this->get_testimonials_info_service_repo()->get_testimonials_by_id($id);
            if(!$testimonials_model)
                throw new HttpException(404, 'Page not found');
        }

        if(!$testimonials_model)
            throw new HttpException(404, 'Page not found');

        $images = $this->get_testimonials_info_service_repo()->get_testimonials_images($id);

        $img_params = array(
            'config' => array(
                'path' => Url::base().'/public/images/',
                'model_prefix' => 'image',
                'route' => Url::to(['imagetestimonials']),
                'enable_replace_button' => true,
                'enable_delete_button' => false,
                'enable_add_button' => false,
                'enable_title' => false,
                'enable_mainimage_button' => false,
                'content_id' => $id,
                'content_field_id' => AppConfig::Image_ContentField_Testimonials,
                'enable_rotate_button' => false,
            ),
            'images' => array(
                array(
                    'alias' => $images[0]['alias'],
                    'title' => $images[0]['title'],
                    'queue' => $images[0]['queue'],
                    'content_field_id' => isset($images[0]['content_field_id']) ? $images[0]['content_field_id'] : null,
                ),
            ),
        );

        return $this->render('create', [
            'testimonials_model' => $testimonials_model,
            'img_params' => $img_params,
            'errors' => $errors,
        ]);
    }

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $id = Yii::$app->request->getQueryParam('id');
            $status = $this->get_testimonials_edit_service_repo()->delete_item($id);
            Yii::$app->session->addFlash('info', 'Testimonials item delete.');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionImagetestimonials()
    {
        $content_id = isset($_POST['content_id']) && $_POST['content_id'] != 'null' ? $_POST['content_id'] : FALSE;
        $content_type_id = AppConfig::Image_ContentType_Testimonials;
        $content_field_id = AppConfig::Image_ContentField_Testimonials;

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
}