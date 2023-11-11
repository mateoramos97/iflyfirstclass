<?php

namespace frontend\controllers\admin;

use common\sys\core\landing\ContinentInfoService;
use yii;
use common\sys\core\landing\ContinentEditService;
use common\sys\repository\landing\models\Continent;
use frontend\modules\imagemanager\ImageManager;
use app\components\AppConfig;
use app\modules\imagemanager\models\Image;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

class ContinentController extends AdminController
{
    private $continent_edit_service_repo;
    private $continent_info_service_repo;
    private function get_continent_edit_service_repo()
    {
        if($this->continent_edit_service_repo != null)
            return $this->continent_edit_service_repo;
        $this->continent_edit_service_repo = new ContinentEditService();
        return $this->continent_edit_service_repo;
    }

    private function get_continent_info_service_repo()
    {
        if($this->continent_info_service_repo != null)
            return $this->continent_info_service_repo;
        $this->continent_info_service_repo = new ContinentInfoService();
        return $this->continent_info_service_repo;
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $search_resp = $this->continent_search(array());
        $filter_values = $search_resp['filter_values'];

        return $this->render('index',[
            'dataProvider' => $search_resp['items'],
            'filter_values' => $filter_values,
        ]);
    }

    private function continent_search($params)
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
            $dataProvider = $this->get_continent_info_service_repo()->ContinentDataProvider($params);
        }
        else {
            $dataProvider = $this->get_continent_info_service_repo()->ContinentDataProvider($params);
        }
        $resp['items'] = $dataProvider;
        $resp['filter_values'] = $fv;

        return $resp;
    }

    public function actionCreate()
    {
        //model
        $continent_model = new Continent();
        $image_model = new Image();

        $image_alias_poster = null;
        $image_title = '';

        $errors = null;

        if($continent_model->load(Yii::$app->request->post())){
            $images = array();
            $images = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'alias');
            $images_title = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'title');

            $imgValidation = $image_model->imageValidation($images);

            $continent_model->alias = $this->GetAbsoluteUrl($continent_model->alias);

            $isValid = $continent_model->validate();
            if($isValid && $imgValidation)
            {
                $continent_model = $this->get_continent_edit_service_repo()->add_continent($continent_model, Yii::$app->request->post('image'));
                $this->redirect(['adminarea/continent']);
            }
            else {
                $err = array();
                $err = array_merge($continent_model->errors);
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
                'route' => Url::to(['imagecontinent']),
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
                array(
                    'alias' => isset($images[1]) ? $images[1] : null,
                    'title' => isset($images_title[1]) ? $images[1] : null,
                    'queue' => 1,
                ),
                array(
                    'alias' => isset($images[2]) ? $images[2] : null,
                    'title' => isset($images_title[2]) ? $images[2] : null,
                    'queue' => 2,
                )
            ),
        );

        return $this->render('create', [
            'continent_model' => $continent_model,
            'img_params_poster' => $img_params_poster,
            'errors' => $errors,
        ]);
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->getQueryParam('id');

        //model
        $continent_model = new Continent();
        $image_model = new Image();

        $image_alias_poster = null;
        $image_title = '';

        $errors = null;

        if($continent_model->load(Yii::$app->request->post()))
        {
            $continent_model->id = $id;
            $continent_model->alias = $this->GetAbsoluteUrl($continent_model->alias);

            $images = array();
            $images = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'alias');


            $imgValidation = $image_model->imageValidation($images);

            $isValid = $continent_model->validate();
            if($isValid && $imgValidation)
            {
                $continent_model = $this->get_continent_edit_service_repo()->update_continent($continent_model, Yii::$app->request->post('image'));
                $this->redirect(['adminarea/continent']);
            }
            else {
                $err = array();
                $err = array_merge($continent_model->errors);
                $errors = $err;
            }
        }
        else {
            $continent_model = $this->get_continent_info_service_repo()->get_continent_by_id($id);
            if(!$continent_model)
                throw new HttpException(404, 'Page not found');
        }

        if(!$continent_model)
            throw new HttpException(404, 'Page not found');

        $images = $this->get_continent_info_service_repo()->get_continent_images($id);

        $img_params_poster = array(
            'config' => array(
                'path' => Url::base().'/public/images/',
                'model_prefix' => 'image',
                'route' => Url::to(['imagecontinent']),
                'enable_replace_button' => true,
                'enable_delete_button' => false,
                'enable_add_button' => false,
                'enable_title' => false,
                'enable_mainimage_button' => false,
                'content_id' => $id,
                'content_field_id' => AppConfig::Image_ContentField_Continent,
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
                array(
                    'alias' => $images[2]['alias'],
                    'title' => $images[2]['title'],
                    'queue' => $images[2]['queue'],
                    'content_field_id' => isset($images[2]['content_field_id']) ? $images[2]['content_field_id'] : null,
                )
            ),
        );

        return $this->render('create', [
            'continent_model' => $continent_model,
            'img_params_poster' => $img_params_poster,
            'errors' => $errors,
        ]);
    }

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $id = Yii::$app->request->getQueryParam('id');
            $status = $this->get_continent_edit_service_repo()->delete_item($id);
            Yii::$app->session->addFlash('info', 'Continent delete.');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionImagecontinent()
    {
        $content_id = isset($_POST['content_id']) && $_POST['content_id'] != 'null' ? $_POST['content_id'] : FALSE;
        $content_type_id = AppConfig::Image_ContentType_Continent;
        $content_field_id = AppConfig::Image_ContentField_Continent;

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