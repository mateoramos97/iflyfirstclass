<?php

namespace frontend\controllers;


use yii\web\Controller;

class BaseController extends Controller
{
    public $layout = "main";
    public $bodyClass;
}