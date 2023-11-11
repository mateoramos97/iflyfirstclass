<?php

namespace frontend\controllers\admin;

use yii\filters\AccessControl;

class AdminController extends \yii\web\Controller
{
    public $layout = "@app/views/admin/layouts/main";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['developer', 'admin'],
                    ],
                ],
            ],
        ];
    }
}