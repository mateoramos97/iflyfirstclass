<?php

namespace frontend\controllers\admin;

use common\sys\core\subscribers\SubscribersArticleInfoService;
use common\sys\repository\request\models\RequestFormUsers;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class SubscriberController extends AdminController
{
    public function actionIndex()
    {
        $query = RequestFormUsers::find()->orderBy(['created_date' => SORT_DESC]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
    
    public function actionDownloadCsv()
    {
        $flightRequests = RequestFormUsers::find()
            ->orderBy(['created_date' => SORT_DESC])
            ->all();
        
        $filename = 'flight_requests_' . date('Y-m-d_H-i-s') . '.csv';
        
        \Yii::$app->response->format = Response::FORMAT_RAW;
        \Yii::$app->response->headers->set('Content-Type', 'application/octet-stream');
        \Yii::$app->response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '"');
        \Yii::$app->response->headers->set('Cache-Control', 'no-cache, must-revalidate');
        \Yii::$app->response->headers->set('Pragma', 'no-cache');
        \Yii::$app->response->headers->set('Expires', '0');
        
        $output = fopen('php://output', 'w');
        
        // Add CSV headers
        fputcsv($output, ['Name', 'Email', 'Phone', 'Request Number', 'Cabin Class', 'People Number', 'Created Date']);
        
        // Add data rows
        foreach ($flightRequests as $request) {
            fputcsv($output, [
                $request->name,
                $request->email,
                $request->phone,
                $request->request_number,
                $request->cabin_class_name == '1' ? 'Business' : 'First',
                $request->people_number,
$request->created_date
            ]);
        }
        
        fclose($output);
        return \Yii::$app->response;
    }
}