<?php

namespace frontend\controllers\admin;

use common\sys\core\subscribers\SubscribersArticleInfoService;

class SubscriberController extends AdminController
{
    public function actionIndex()
    {
        $subscribe_info_service = new SubscribersArticleInfoService();

        $subscribes = $subscribe_info_service->get_subscribers();
        return $this->render('index',[
            'subscribes' => $subscribes
        ]);
    }
}