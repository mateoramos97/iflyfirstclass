<?php

namespace frontend\controllers\admin;


class HomeController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}