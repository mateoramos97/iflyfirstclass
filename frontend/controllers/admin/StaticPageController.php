<?php

namespace frontend\controllers\admin;

use common\sys\core\seo\StaticPageEditService;
use common\sys\core\seo\StaticPageInfoService;
use common\sys\repository\seo\models\StaticPage;
use yii;
use yii\web\HttpException;

class StaticPageController extends AdminController
{
    private $static_page_edit_service_repo;
    private $static_page_info_service_repo;
    private function get_static_page_edit_service_repo()
    {
        if($this->static_page_edit_service_repo != null)
            return $this->static_page_edit_service_repo;
        $this->static_page_edit_service_repo = new StaticPageEditService();
        return $this->static_page_edit_service_repo;
    }

    private function get_static_page_info_service_repo()
    {
        if($this->static_page_info_service_repo != null)
            return $this->static_page_info_service_repo;
        $this->static_page_info_service_repo = new StaticPageInfoService();
        return $this->static_page_info_service_repo;
    }

    public function actionIndex()
    {
        $static_pages = $this->get_static_page_info_service_repo()->get_static_pages();
        return $this->render('index',[
            'static_pages' => $static_pages
        ]);
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->getQueryParam('id');

        //model
        $static_page_model = new StaticPage();

        $errors = null;

        if($static_page_model->load(Yii::$app->request->post()) &&
            $static_page_model->validate())
        {
            $static_page_model->id = $id;
            $static_page_model = $this->get_static_page_edit_service_repo()->update_static_page($static_page_model);
            Yii::$app->session->addFlash('info', 'Update.');
            $this->redirect(['adminarea/static-page']);
        }
        else {
            $static_page_model = $this->get_static_page_info_service_repo()->get_static_page_by_id($id);
            if(!$static_page_model)
                throw new HttpException(404, 'Page not found');
        }

        if(!$static_page_model)
            throw new HttpException(404, 'Page not found');

        return $this->render('edit', [
            'static_page_model' => $static_page_model,
            'errors' => $errors,
        ]);
    }
}