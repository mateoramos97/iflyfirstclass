<?php

namespace frontend\controllers\admin;

use common\sys\core\request\FlightRequestInfoService;
use yii;
use yii\web\HttpException;

class RequestFlightController extends AdminController
{
    private $flght_request_info_service_repo;

    private function get_flght_request_info_service_repo()
    {
        if($this->flght_request_info_service_repo != null)
            return $this->flght_request_info_service_repo;
        $this->flght_request_info_service_repo = new FlightRequestInfoService();
        return $this->flght_request_info_service_repo;
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $search_resp = $this->request_flight_search(array());
        $filter_values = $search_resp['filter_values'];

        return $this->render('index',[
            'dataProvider' => $search_resp['items'],
            'filter_values' => $filter_values,
        ]);
    }

    public function actionRequestFlightDetails() {
        $id = Yii::$app->request->getQueryParam('id');

        $request = $this->get_flght_request_info_service_repo()->get_request_form_user_by_id($id);
        $details = $this->get_flght_request_info_service_repo()->get_request_form_user_info_by_request_form_id($id);

        return $this->render('request-flight-details', [
            'request' => $request,
            'details' => $details
        ]);
    }

    private function request_flight_search($params)
    {
        $travel_tips_info_service = new FlightRequestInfoService();

        $resp = array();
        $fv = array();

        $params = array();

        if(Yii::$app->request->get())
        {
            $fv['order_by_id'] = Yii::$app->request->get('order_by_id');

            $params['order_by_id'] = $fv['order_by_id'];

            $dataProvider = $this->get_flght_request_info_service_repo()->RequestFlightDataProvider($params);
        }
        else {
            $dataProvider = $this->get_flght_request_info_service_repo()->RequestFlightDataProvider($params);
        }
        $resp['items'] = $dataProvider;
        $resp['filter_values'] = $fv;

        return $resp;
    }
}