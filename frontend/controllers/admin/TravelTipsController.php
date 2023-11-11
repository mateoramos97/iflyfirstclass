<?php

namespace frontend\controllers\admin;

use app\components\AppConfig;
use common\sys\core\traveltips\TravelTipsAttactionsEditService;
use common\sys\core\traveltips\TravelTipsAttactionsInfoService;
use common\sys\core\traveltips\TravelTipsEditService;
use common\sys\core\traveltips\TravelTipsInfoService;
use common\sys\repository\traveltips\models\TravelTips;
use common\sys\repository\traveltips\models\TravelTipsAttractions;
use yii;
use frontend\modules\imagemanager\ImageManager;
use app\modules\imagemanager\models\Image;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

class TravelTipsController extends AdminController
{
    private $travel_tips_edit_service_repo;
    private $travel_tips_info_service_repo;
    private $travel_tips_attactions_edit_service_repo;
    private $travel_tips_attactions_info_service_repo;
    private function get_travel_tips_edit_service_repo()
    {
        if($this->travel_tips_edit_service_repo != null)
            return $this->travel_tips_edit_service_repo;
        $this->travel_tips_edit_service_repo = new TravelTipsEditService();
        return $this->travel_tips_edit_service_repo;
    }

    private function get_travel_tips_info_service_repo()
    {
        if($this->travel_tips_info_service_repo != null)
            return $this->travel_tips_info_service_repo;
        $this->travel_tips_info_service_repo = new TravelTipsInfoService();
        return $this->travel_tips_info_service_repo;
    }
    private function get_travel_tips_attactions_edit_service_repo()
    {
        if($this->travel_tips_attactions_edit_service_repo != null)
            return $this->travel_tips_attactions_edit_service_repo;
        $this->travel_tips_attactions_edit_service_repo = new TravelTipsAttactionsEditService();
        return $this->travel_tips_attactions_edit_service_repo;
    }

    private function get_travel_tips_attactions_info_service_repo()
    {
        if($this->travel_tips_attactions_info_service_repo != null)
            return $this->travel_tips_attactions_info_service_repo;
        $this->travel_tips_attactions_info_service_repo = new TravelTipsAttactionsInfoService();
        return $this->travel_tips_attactions_info_service_repo;
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $search_resp = $this->travel_tips_search(array());
        $filter_values = $search_resp['filter_values'];

        return $this->render('index',[
            'dataProvider' => $search_resp['items'],
            'filter_values' => $filter_values,
        ]);
    }

    public function actionTravelTipsAttactions()
    {
        $id = Yii::$app->request->getQueryParam('id');
        $travel_tips_attactions = $this->get_travel_tips_attactions_info_service_repo()->get_travel_tips_attctions_by_travel_tip_id($id);
        return $this->render('travel_tips_attactions', [
            'travel_tips_attactions' => $travel_tips_attactions,
            'travel_tips_id' => $id,
        ]);
    }

    private function travel_tips_search($params)
    {
        $travel_tips_info_service = new TravelTipsInfoService();

        $resp = array();
        $fv = array();

        $params = array();

        if(Yii::$app->request->get())
        {
            $fv['order_by_id'] = Yii::$app->request->get('order_by_id');
            $fv['title'] = Yii::$app->request->get('title');

            $params['order_by_id'] = $fv['order_by_id'];

            if ($fv['title'] != '')
            {
                $params['title'] = $fv['title'];
            }
            $dataProvider = $this->get_travel_tips_info_service_repo()->TravelTipsDataProvider($params);
        }
        else {
            $dataProvider = $this->get_travel_tips_info_service_repo()->TravelTipsDataProvider($params);
        }
        $resp['items'] = $dataProvider;
        $resp['filter_values'] = $fv;

        return $resp;
    }

    public function actionCreate()
    {
        //model
        $travel_tips_model = new TravelTips();
        $image_model = new Image();

        $image_alias_poster = null;
        $image_title = '';

        $errors = null;

        if($travel_tips_model->load(Yii::$app->request->post())){
            $images = array();
            $images = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'alias');
            $images_title = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'title');

            $imgValidation = $image_model->imageValidation($images);

            $travel_tips_model->alias = $this->GetAbsoluteUrl($travel_tips_model->alias);

            $isValid = $travel_tips_model->validate();
            if($isValid && $imgValidation)
            {
                $travel_tips_model = $this->get_travel_tips_edit_service_repo()->add_item($travel_tips_model, Yii::$app->request->post('image'));
                Yii::$app->session->addFlash('info', 'Travel Tip add. <a href="'. Url::to(['/travel-tip'], true) .'/'.$travel_tips_model->alias .'" >View</a>');
                $this->redirect(['adminarea/travel-tips']);
            }
            else {
                $err = array();
                $err = array_merge($travel_tips_model->errors);
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
                'route' => Url::to(['imagetraveltips']),
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
            'travel_tips_model' => $travel_tips_model,
            'img_params_poster' => $img_params_poster,
            'errors' => $errors,
        ]);
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->getQueryParam('id');

        //model
        $travel_tips_model = new TravelTips();
        $image_model = new Image();

        $image_alias_poster = null;
        $image_title = '';

        $errors = null;

        if($travel_tips_model->load(Yii::$app->request->post()))
        {
            $travel_tips_model->id = $id;
            $travel_tips_model->alias = $this->GetAbsoluteUrl($travel_tips_model->alias);

            $images = array();
            $images = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'alias');

            $imgValidation = $image_model->imageValidation($images);

            $isValid = $travel_tips_model->validate();
            if($isValid && $imgValidation)
            {
                $travel_tips_model = $this->get_travel_tips_edit_service_repo()->update_item($travel_tips_model, Yii::$app->request->post('image'));
                $this->redirect(['adminarea/travel-tips']);
            }
            else {
                $err = array();
                $err = array_merge($travel_tips_model->errors);
                $errors = $err;
            }
        }
        else {
            $travel_tips_model = $this->get_travel_tips_info_service_repo()->get_travel_tip_by_id($id);
            if(!$travel_tips_model)
                throw new HttpException(404, 'Page not found');
        }

        if(!$travel_tips_model)
            throw new HttpException(404, 'Page not found');

        $images = $this->get_travel_tips_info_service_repo()->get_travel_tip_images($id);

        $img_params_poster = array(
            'config' => array(
                'path' => Url::base().'/public/images/',
                'model_prefix' => 'image',
                'route' => Url::to(['imagetraveltips']),
                'enable_replace_button' => true,
                'enable_delete_button' => false,
                'enable_add_button' => false,
                'enable_title' => false,
                'enable_mainimage_button' => false,
                'content_id' => $id,
                'content_field_id' => AppConfig::Image_ContentField_TravelTips,
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
            'travel_tips_model' => $travel_tips_model,
            'img_params_poster' => $img_params_poster,
            'errors' => $errors,
        ]);
    }

    public function actionCreateTravelTipsAttaction()
    {
        $travel_tip_id = Yii::$app->request->getQueryParam('id');

        //model
        $travel_tips_attaction_model = new TravelTipsAttractions();
        $image_model = new Image();

        $image_alias_poster = null;
        $image_title = '';

        $errors = null;

        if($travel_tips_attaction_model->load(Yii::$app->request->post())){
            $images = array();
            $images = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'alias');
            $images_title = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'title');

            $imgValidation = $image_model->imageValidation($images);

            $isValid = $travel_tips_attaction_model->validate();
            if($isValid && $imgValidation)
            {
                $travel_tips_attaction_model = $this->get_travel_tips_attactions_edit_service_repo()->add_item($travel_tips_attaction_model, Yii::$app->request->post('image'));
                $this->redirect(['adminarea/travel-tips/'.$travel_tip_id.'/travel-tips-attactions']);
            }
            else {
                $err = array();
                $err = array_merge($travel_tips_attaction_model->errors);
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
                'route' => Url::to(['imagetraveltipsattaction']),
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

        return $this->render('create_travel_tip_attaction', [
            'travel_tip_id' => $travel_tip_id,
            'travel_tips_attaction_model' => $travel_tips_attaction_model,
            'img_params_poster' => $img_params_poster,
            'errors' => $errors,
        ]);
    }

    public function actionEditTravelTipsAttaction()
    {
        $travel_tip_id = Yii::$app->request->getQueryParam('id');
        $travel_tip_attaction_id = Yii::$app->request->getQueryParam('travel_tip_attaction_id');

        //model
        $travel_tips_attaction_model = new TravelTipsAttractions();
        $image_model = new Image();

        $image_alias_poster = null;
        $image_title = '';

        $errors = null;

        if($travel_tips_attaction_model->load(Yii::$app->request->post()))
        {
            $travel_tips_attaction_model->id = $travel_tip_attaction_id;

            $images = array();
            $images = ArrayHelper::getColumn(Yii::$app->request->post('image'), 'alias');

            $imgValidation = $image_model->imageValidation($images);

            $isValid = $travel_tips_attaction_model->validate();
            if($isValid && $imgValidation)
            {
                $travel_tips_attaction_model = $this->get_travel_tips_attactions_edit_service_repo()->update_item($travel_tips_attaction_model, Yii::$app->request->post('image'));
                $this->redirect(['adminarea/travel-tips/'.$travel_tip_id.'/travel-tips-attactions']);
            }
            else {
                $err = array();
                $err = array_merge($travel_tips_attaction_model->errors);
                $errors = $err;
            }
        }
        else {
            $travel_tips_attaction_model = $this->get_travel_tips_attactions_info_service_repo()->get_travel_tip_attaction_by_id($travel_tip_attaction_id);
            if(!$travel_tips_attaction_model)
                throw new HttpException(404, 'Page not found');
        }

        if(!$travel_tips_attaction_model)
            throw new HttpException(404, 'Page not found');

        $images = $this->get_travel_tips_attactions_info_service_repo()->get_travel_tip_attaction_images($travel_tip_attaction_id);

        $img_params_poster = array(
            'config' => array(
                'path' => Url::base().'/public/images/',
                'model_prefix' => 'image',
                'route' => Url::to(['imagetraveltipsattaction']),
                'enable_replace_button' => true,
                'enable_delete_button' => false,
                'enable_add_button' => false,
                'enable_title' => false,
                'enable_mainimage_button' => false,
                'content_id' => $travel_tip_attaction_id,
                'content_field_id' => AppConfig::Image_ContentField_TravelTipsAttactions,
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

        return $this->render('create_travel_tip_attaction', [
            'travel_tip_id' => $travel_tip_id,
            'travel_tips_attaction_model' => $travel_tips_attaction_model,
            'img_params_poster' => $img_params_poster,
            'errors' => $errors,
        ]);
    }

    public function actionDelete()
    {
        if(Yii::$app->request->post())
        {
            $id = Yii::$app->request->getQueryParam('id');
            $status = $this->get_travel_tips_edit_service_repo()->delete_item($id);
            Yii::$app->session->addFlash('info', 'Travel Tips delete.');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDeleteTravelTipsAttaction()
    {
        if(Yii::$app->request->post())
        {
            $id = Yii::$app->request->getQueryParam('travel_tip_attaction_id');
            $status = $this->get_travel_tips_attactions_edit_service_repo()->delete_item($id);
            Yii::$app->session->addFlash('info', 'Attactions item delete.');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionImagetraveltips()
    {
        $content_id = isset($_POST['content_id']) && $_POST['content_id'] != 'null' ? $_POST['content_id'] : FALSE;
        $content_type_id = AppConfig::Image_ContentType_TravelTips;
        $content_field_id = AppConfig::Image_ContentField_TravelTips;

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

    public function actionImagetraveltipsattaction()
    {
        $content_id = isset($_POST['content_id']) && $_POST['content_id'] != 'null' ? $_POST['content_id'] : FALSE;
        $content_type_id = AppConfig::Image_ContentType_TravelTipsAttactions;
        $content_field_id = AppConfig::Image_ContentField_TravelTipsAttactions;

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