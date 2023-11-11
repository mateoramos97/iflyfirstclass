<?php

namespace common\sys\repository\request;

use app\components\AppConfig;
use common\sys\models\request\FlightRequestMax;
use common\sys\repository\request\models\RequestFormUsers;
use common\sys\repository\request\models\RequestFormUsersInfo;
use yii;

class FlightRequestRepository
{
    public function add_flight_request($params)
    {
        $request_form_user_model = new RequestFormUsers();

        $transaction = Yii::$app->db->beginTransaction();

        try {
            $query_request_number = $request_form_user_model::find()
                ->select('request_number')
                ->orderBy(['id' => SORT_DESC])
                ->one();
            if ($query_request_number)
                $request_number = $query_request_number->request_number + 1;
            else
                $request_number = 1000;

            $sql = "INSERT INTO request_form_users (email, name, phone, cabin_class_name, people_number, request_number,
                      type_trip, created_date)
                VALUES (:email, :name, :phone, :cabin_class_name, :people_number, :request_number,
                      :type_trip, :created_date)";

            Yii::$app->db->createCommand($sql)
                ->bindValue(':email', $params['email'])
                ->bindValue(':name', $params['name'])
                ->bindValue(':phone', $params['phone'])
                ->bindValue(':cabin_class_name', $params['cabin_class_name'])
                ->bindValue(':people_number', $params['people_number'])
                ->bindValue(':request_number', $request_number)
                ->bindValue(':type_trip', $params['type_trip'])
                ->bindValue(':created_date', date("Y-m-d H:i:s"))
                ->execute();

            $request_form_user_lastID = Yii::$app->db->getLastInsertID();

            foreach($params['from'] as $key => $item)
            {
                $arr_date = null;
                $sql_1 = "INSERT INTO request_form_users_info (request_form_users_id, departure, arrival, from_air, to_air)
                      VALUES (:request_form_users_id, :departure, :arrival, :from_air, :to_air)";

                if($params['type_trip'] == AppConfig::Type_Trip_Round_Trip) {
                    $arr_date = $params['arr_date'][$key];
                }
                else {
                    $arr_date = null;
                }

                Yii::$app->db->createCommand($sql_1)
                    ->bindValue(':request_form_users_id', $request_form_user_lastID)
                    ->bindValue(':departure', $params['dep_date'][$key])
                    ->bindValue(':arrival', $arr_date)
                    ->bindValue(':from_air', $item)
                    ->bindValue(':to_air', $params['to'][$key])
                    ->execute();
            }

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            return $e;
        }

        return $request_form_user_lastID;
    }

    public function update_number_page_visits($request_number) {
        $request_form_user_model = new RequestFormUsers();
        $request = $request_form_user_model::find()
            ->where(['request_number' => $request_number])
            ->one();
        $request->number_page_visits += 1;
        $request->save();
        return $request;
    }

    public function get_request_form_user_by_request_number($request_number)
    {
        $request_form_user_model = new RequestFormUsers();
        return $request_form_user_model::find()
            ->where(['request_number' => $request_number])
            ->asArray()
            ->one();
    }

    public function get_request_form_user_by_id($id)
    {
        $request_form_user_model = new RequestFormUsers();
        return $request_form_user_model::find()
            ->where(['id' => $id])
            ->asArray()
            ->one();
    }

    public function get_request_form_user_info_by_request_form_id($request_form_id)
    {
        $request_form_user_info_model = new RequestFormUsersInfo();
        return $request_form_user_info_model::find()
            ->where(['request_form_users_id' => $request_form_id])
            ->asArray()
            ->all();
    }

    public function get_request_form_user_emails()
    {
        $request_form_user_model = new RequestFormUsers();
        return $request_form_user_model::find()
            ->select(['email'])
            ->distinct()
            ->asArray()
            ->all();
    }

    public function RequestFlightDataProvider($params)
    {
        $data_provider_params = array();

        $sql_order_by = '';
        if(isset($params['order_by_id']) && $params['order_by_id'] == 'DESC')
        {
            $sql_order_by = 'DESC';
        }
        elseif (isset($params['order_by_id']) && $params['order_by_id'] == 'ASC')
        {
            $sql_order_by = 'ASC';
        }
        else {
            $sql_order_by = 'DESC';
        }

        $count = Yii::$app->db->createCommand('
              SELECT COUNT(*) FROM request_form_users
            ')->queryScalar();

        $sql = "SELECT `request_form_users`.`id`, `request_form_users`.`email`, `request_form_users`.`name`, `request_form_users`.`request_number`, `request_form_users`.`created_date`
            FROM request_form_users
            ORDER BY `request_form_users`.`id` ".$sql_order_by;

        $dataProvider = new yii\data\SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $count,
            'params' => $data_provider_params,
            'pagination' => [
                'pageSize' => 20,
                'route' => 'admin/request-flight/index',
            ],
        ]);

        return $dataProvider;
    }
}