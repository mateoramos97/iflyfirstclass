<?php

namespace frontend\controllers;

use common\sys\core\landing\AirlineInfoService;
use common\sys\core\landing\CountryInfoService;
use common\sys\core\request\FlightRequestEditService;
use common\sys\core\request\FlightRequestInfoService;
use common\sys\core\subscribers\SubscribersArticleEditService;
use common\sys\core\subscribers\SubscribersArticleInfoService;
use common\sys\core\blockedEmails\BlockedEmailsInfoService;
use common\sys\models\request\FlightRequestMax;
use common\sys\models\request\RequestQuote;
use common\sys\models\request\RequestCorporateAccounts;
use common\sys\models\request\RequestHotel;
use common\sys\repository\request\models\RequestFormUsers;
use common\sys\repository\subscribers\models\Subscribers;
use frontend\models\SupportForm;
use app\components\AppConfig;
use common\sys\core\seo\StaticPageInfoService;
use common\sys\core\landing\CityInfoService;
use yii;

class RequestController extends BaseController
{
    public function actionSearchAirport()
    {
        $keyword = filter_input(INPUT_POST,'keyword');
        $url = 'https://airlabs.co/api/v9/suggest?q=' . urlencode($keyword) . '&api_key=4a758c12-39af-453c-87f5-5ac58aa3ce37';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }

    public function actionSearchAirline()
    {
        $keyword = filter_input(INPUT_POST,'keyword');

        $url = "https://www.flightstats.com/go/Suggest/airlineSuggest.do?responseType=json&desiredResults=10&term=" . urlencode($keyword);
        $referer = "https://www.flightstats.com/go/FlightTracker/flightTracker.do";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        $content = curl_exec($ch);
        curl_close($ch);

        echo json_encode($content);
    }

    public function actionFlightRequestAccepted()
    {
        $request_number = Yii::$app->request->getQueryParam('request_number');

        $static_page_info_service = new StaticPageInfoService();
        $static_page = $static_page_info_service->get_static_page_by_id(AppConfig::Flight_Request_Page);

        $city_info_service = new CityInfoService();
        $random_cities = $city_info_service->get_random_cities(4);

        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'description',
            'content' => $static_page->description
        ]);
        Yii::$app->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $static_page->keywords
        ]);

        $this->bodyClass = "flight-request-accepted";

        $flight_request_info_service = new FlightRequestInfoService();
        $flight_request_edit_service = new FlightRequestEditService();

        $request_form_users = $flight_request_info_service
            ->get_request_form_user_by_request_number($request_number);

        if ($request_form_users['number_page_visits'] >= AppConfig::limit_number_page_visits_flight_request_page) {
            return $this->goHome();
        }
        $flight_request_edit_service->update_number_page_visits($request_number);

        $request_form_user_info = $flight_request_info_service
            ->get_request_form_user_info_by_request_form_id($request_form_users['id']);

        $country_info_service = new CountryInfoService();
        $city_info_service = new CityInfoService();
        $airline_info_service = new AirlineInfoService();

        $countries = $country_info_service->get_countries_list();
        $cities = $city_info_service->get_cities_list();
        $airlines = $airline_info_service->get_airlines_list();

        return $this->render('flight_request_accepted', [
            'static_page' => $static_page,
            'request_form_users' => $request_form_users,
            'request_form_user_info' => $request_form_user_info,
            'random_cities' => $random_cities,
            'countries' => $countries,
            'cities' => $cities,
            'airlines' => $airlines,
        ]);
    }

    public function actionFlight()
    {
        $flight_request_max_model = new FlightRequestMax();
        $flight_request_info_service = new FlightRequestInfoService();
        $flight_request_edit_service = new FlightRequestEditService();
        $blocked_email_info_service = new BlockedEmailsInfoService();

        $check_subscription = false;

        if ($flight_request_max_model->load(Yii::$app->request->post())) {
            $isValid = $flight_request_max_model->validate();

            if (Yii::$app->request->post('check_subscription') == 'jfghfHdhsdgUjbn345Hd') {
                $check_subscription = true;
            }
            $isValid = $check_subscription && $isValid;

            $isEmailBlocked = $blocked_email_info_service->get_blocked_email($flight_request_max_model->email);
            if ($isEmailBlocked) return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
            $flightRequestMax = Yii::$app->request->post('FlightRequestMax');
            $trips = $flight_request_info_service->GetTrips($flightRequestMax);

            if ($isValid) {
                $lastInsertID = $flight_request_edit_service->add_flight_request($flightRequestMax);

                // Send emails immediately
                $flight_request_max_model
                    ->sendEmailFlightRequest(Yii::$app->params['adminEmail'], $flightRequestMax, $trips, $lastInsertID);
                $flight_request_max_model
                    ->sendEmailFlightRequest($flight_request_max_model->email, $flightRequestMax, $trips, $lastInsertID);

                $request_number = RequestFormUsers::find()
                    ->select(['request_number'])
                    ->where(['id' => $lastInsertID])
                    ->one();
                return $this->redirect(['flight-request/' . $request_number->request_number]);
            }
            var_dump($flight_request_max_model->getErrors());
        }
    }

    public function actionHotel()
    {
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'robots',
            'content' => 'noindex, follow'
        ]);

        $hotel_model = new RequestHotel();
        $blocked_email_info_service = new BlockedEmailsInfoService();

        if ($hotel_model->load(Yii::$app->request->post())) {
            $isValid = $hotel_model->validate();

//            $isEmailBlocked = $blocked_email_info_service->get_blocked_email($hotel_model->email);
//            if ($isEmailBlocked) return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
//            if ($isValid) {
//                if ($hotel_model->sendEmailRequestHotel(Yii::$app->params['adminEmail'], $hotel_model)) {
//                    $this->bodyClass = "accept-page";
//                    Yii::$app->session->addFlash('request_accept', ['Your message has been sent', 'Travel expert will contact you asap']);
//                    $this->redirect(['service/hotel']);
//                }
//            } else {
//                $err = array();
//                $err = array_merge($hotel_model->errors);
//                $errors = $err;
//                $this->bodyClass = "rejected-page";
//                return $this->render('rejected', [
//                    'errors' => $errors,
//                ]);
//            }
        }
    }

    public function actionRequestQuote()
    {
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'robots',
            'content' => 'noindex, follow'
        ]);

        $model = new RequestQuote();
        $blocked_email_info_service = new BlockedEmailsInfoService();

        if ($model->load(Yii::$app->request->post())) {
            $isValid = $model->validate();

//            $isEmailBlocked = $blocked_email_info_service->get_blocked_email($model->email);
//            if ($isEmailBlocked) return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

//            if ($isValid) {
//                if ($model->sendEmailRequestQuote(Yii::$app->params['adminEmail'], $model)) {
//                    $this->bodyClass = "accept-page";
//                    Yii::$app->session->addFlash('request_accept', ['Your message has been sent', 'Travel expert will contact you asap']);
//                    $this->redirect(['tools/request-quote']);
//                }
//            } else {
//                $err = array();
//                $err = array_merge($model->errors);
//                $errors = $err;
//                $this->bodyClass = "rejected-page";
//                return $this->render('rejected', [
//                    'errors' => $errors,
//                ]);
//            }
        }
    }

    public function actionCorporateAccount()
    {
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'robots',
            'content' => 'noindex, follow'
        ]);

        $model = new RequestCorporateAccounts();
        $blocked_email_info_service = new BlockedEmailsInfoService();

        if ($model->load(Yii::$app->request->post())) {
            $isValid = $model->validate();

//            $isEmailBlocked = $blocked_email_info_service->get_blocked_email($model->email);
//            if ($isEmailBlocked) return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

//            if ($isValid) {
//                if ($model->sendEmailRequestCorporateAccount(Yii::$app->params['adminEmail'], $model)) {
//                    $this->bodyClass = "accept-page";
//                    Yii::$app->session->addFlash('request_accept', ['Your message has been sent', 'Travel expert will contact you asap']);
//                    $this->redirect(['static-page/corporate-account']);
//                }
//            } else {
//                $err = array();
//                $err = array_merge($model->errors);
//                $errors = $err;
//                $this->bodyClass = "rejected-page";
//                return $this->render('rejected', [
//                    'errors' => $errors,
//                ]);
//            }
        }
    }

    public function actionSupportMessage()
    {
        //meat tags
        Yii::$app->view->registerMetaTag([
            'name' => 'robots',
            'content' => 'noindex, follow'
        ]);

        $model = new SupportForm();
        $blocked_email_info_service = new BlockedEmailsInfoService();

        $check_subscription = false;
        if ($model->load(Yii::$app->request->post())) {
            $isValid = $model->validate();

            $isEmailBlocked = $blocked_email_info_service->get_blocked_email($model->email);
            if ($isEmailBlocked) return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

            if (Yii::$app->request->post('check_subscription') == 'jfghfHdhsdgUjbn345Hddf0') {
                $check_subscription = true;
            }
            $isValid = $check_subscription && $isValid;

            if ($isValid) {
                if ($model->sendEmailSupportRequest(Yii::$app->params['adminEmail'], $model)) {
                    $this->bodyClass = "accept-page";
                    Yii::$app->session->addFlash('request_accept', ['Your message has been sent', 'Travel expert will contact you asap']);
                    return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
                }
            } else {
                $err = array();
                $err = array_merge($model->errors);
                $errors = $err;
                $this->bodyClass = "rejected-page";
                return $this->render('rejected', [
                    'errors' => $errors,
                ]);
            }
        }
    }

    public function actionSubscriber()
    {
        $subscribers_article_edit_service = new SubscribersArticleEditService();
        $subscribers_article_info_service = new SubscribersArticleInfoService();
        $blocked_email_info_service = new BlockedEmailsInfoService();
        if (Yii::$app->request->isAjax) {
            $email = Yii::$app->request->post('email');
            $check_subscription = Yii::$app->request->post('check_subscription');
            $subscribe_email = $subscribers_article_info_service
                ->get_subscriber_by_email($email);
            $isEmailBlocked = $blocked_email_info_service->get_blocked_email($email);
            if ($isEmailBlocked) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'message' => 'error',
                    'status' => 'error',
                ];
            }

            if($subscribe_email) {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'message' => 'Email already exists',
                    'status' => 'error',
                ];
            }
            if ($email && !$subscribe_email && $check_subscription == 'f546jfghfHdhsdgUjbn345Hdssa3dsfdsf') {
                if ($subscribers_article_edit_service->add_item($email)) {
                    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return [
                        'message' => 'Subscribed',
                        'status' => 'success',
                    ];
                }
            } else {
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return [
                    'message' => 'error',
                    'status' => 'error',
                ];
            }
        }
    }

    public function actionTestEmail()
    {
        $flightRequest = [
            'name' => 'Test User',
            'phone' => '+1234567890',
            'email' => 'test@example.com',
            'type_trip' => '1',
            'cabin_class_name' => '2',
            'people_number' => '2',
        ];

        $trips = [
            [
                'from' => 'New York (JFK)',
                'to' => 'London (LHR)',
                'dep_date' => '2024-12-25',
                'arr_date' => '2025-01-05'
            ]
        ];

        try {
            // Test direct email sending with your actual email
            $testEmail = 'mateoramos97@gmail.com'; // Replace with your email
            
            $flight_request_max_model = new FlightRequestMax();
            $result = $flight_request_max_model->sendEmailFlightRequest(
                $testEmail,
                $flightRequest,
                $trips,
                999
            );
            
            // Also test queue system
            Yii::$app->queue->push(new \common\queue\SendEmail([
                'email' => $testEmail,
                'flightRequest' => $flightRequest,
                'trips' => $trips,
                'lastInsertId' => 999,
            ]));
            
            return 'Email sent to: ' . $testEmail . '. Result: ' . ($result ? 'SUCCESS' : 'FAILED') . '. Queue job added.';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}