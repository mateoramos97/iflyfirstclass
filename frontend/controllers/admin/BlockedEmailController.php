<?php

namespace frontend\controllers\admin;

use yii;
use common\sys\repository\blockedEmails\models\BlockedEmails;
use common\sys\core\blockedEmails\BlockedEmailsInfoService;
use common\sys\core\blockedEmails\BlockedEmailsEditService;

class BlockedEmailController extends AdminController
{
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $blocked_email_info_service = new BlockedEmailsInfoService();

        $emails = $blocked_email_info_service->BlockedEmailListDataProvider(24);

        return $this->render('index',[
            'dataProvider' => $emails
        ]);
    }

    public function actionCreate()
    {
        //model
        $model = new BlockedEmails();
        $blocked_email_edit_service = new BlockedEmailsEditService();

        $errors = null;

        if($model->load(Yii::$app->request->post())){
            $isValid = $model->validate();
            if($isValid)
            {
                $model = $blocked_email_edit_service->add_item($model);
                Yii::$app->session->addFlash(
                    'info',
                    'Email was added.'
                );
                $this->redirect(['adminarea/blocked-email']);
            }
            else {
                $err = array();
                $err = array_merge($model->errors);
                $errors = $err;
            }
        }

        return $this->render('create', [
            'model' => $model,
            'errors' => $errors,
        ]);
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->getQueryParam('id');

        //service
        $blocked_email_edit_service = new BlockedEmailsEditService();
        $blocked_email_info_service = new BlockedEmailsInfoService();

        //model
        $model = new BlockedEmails();

        $errors = null;

        if($model->load(Yii::$app->request->post()))
        {
            $model->id = $id;

            $isValid = $model->validate();
            if($isValid)
            {
                $model = $blocked_email_edit_service->update_item($id, $model);
                Yii::$app->session->addFlash('info', 'Email was updated.');
                $this->redirect(['adminarea/blocked-email']);
            }
            else {
                $err = array();
                $err = array_merge($model->errors);
                $errors = $err;
            }
        }
        else {
            $model = $blocked_email_info_service->get_blocked_email_by_id($id);
            if(!$model)
                throw new HttpException(404, 'Page not found');
        }

        if(!$model)
            throw new HttpException(404, 'Page not found');

        return $this->render('create', [
            'model' => $model,
            'errors' => $errors,
        ]);
    }

    public function actionDelete()
    {
        $blocked_email_edit_service = new BlockedEmailsEditService();

        if(Yii::$app->request->post())
        {
            $id = Yii::$app->request->getQueryParam('id');
            $status = $blocked_email_edit_service->delete_item($id);
            Yii::$app->session->addFlash('info', 'Email was deleted.');
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

}