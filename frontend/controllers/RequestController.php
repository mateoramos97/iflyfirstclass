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
use common\queue\SendEmail;
use yii;

class RequestController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        // Disable CSRF validation for the async email endpoint
        if ($action->id == 'send-email-async') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
    
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

                // Use HTTP fire-and-forget for async email sending
                // Prepare email data
                $emailData = [
                    'flightRequest' => $flightRequestMax,
                    'trips' => $trips,
                    'lastInsertId' => $lastInsertID
                ];
                
                // Fire-and-forget request for admin email
                $this->fireAndForgetRequest([
                    'adminEmail' => Yii::$app->params['adminEmail'],
                ] + $emailData);
                
                // Fire-and-forget request for user email
                $this->fireAndForgetRequest([
                    'userEmail' => $flight_request_max_model->email,
                ] + $emailData);

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

    public function actionSendEmailAsync()
    {
        
        // Security check - use a secret token (COMMENTED OUT FOR TESTING)
        // $token = Yii::$app->request->post('token');
        // $secretToken = isset(Yii::$app->params['emailAsyncToken']) 
        //     ? Yii::$app->params['emailAsyncToken'] 
        //     : 'iflyfirstclass-async-email-2025-secret';
            
        // if ($token !== $secretToken) {
        //     Yii::$app->response->statusCode = 403;
        //     return 'Invalid token';
        // }
        
        // Set time limit for email sending
        set_time_limit(120); // 2 minutes should be enough
        
        // Get the raw JSON data from the request body
        $rawData = Yii::$app->request->getRawBody();
        $decodedData = json_decode($rawData, true);
        
        // Log received data for debugging
        Yii::info('Received raw data: ' . substr($rawData, 0, 500), 'email'); // Log first 500 chars
        
        // Get the email data from decoded JSON
        $emailData = isset($decodedData['emailData']) ? $decodedData['emailData'] : null;
        
        if ($emailData) {
            $flight_request_max_model = new FlightRequestMax();
            $emailsSent = [];
            
            try {
                // Log the structure of emailData for debugging
                Yii::info('Email data structure: ' . json_encode(array_keys($emailData)), 'email');
                
                // Send to admin
                if (isset($emailData['adminEmail'])) {
                    Yii::info('Sending email to admin: ' . $emailData['adminEmail'], 'email');
                    $result = $flight_request_max_model->sendEmailFlightRequest(
                        $emailData['adminEmail'],
                        $emailData['flightRequest'],
                        $emailData['trips'],
                        $emailData['lastInsertId']
                    );
                    $emailsSent['admin'] = $result;
                }
                
                // Send to user
                if (isset($emailData['userEmail'])) {
                    Yii::info('Sending email to user: ' . $emailData['userEmail'], 'email');
                    $result = $flight_request_max_model->sendEmailFlightRequest(
                        $emailData['userEmail'],
                        $emailData['flightRequest'],
                        $emailData['trips'],
                        $emailData['lastInsertId']
                    );
                    $emailsSent['user'] = $result;
                }
                
                // Log the result
                Yii::info('Async emails sent: ' . json_encode($emailsSent), 'email');
                
                return json_encode(['status' => 'success', 'sent' => $emailsSent]);
            } catch (\Exception $e) {
                Yii::error('Async email error: ' . $e->getMessage() . ' Stack: ' . $e->getTraceAsString(), 'email');
                return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            Yii::error('No email data received. Raw data: ' . substr($rawData, 0, 200), 'email');
        }
        
        return json_encode(['status' => 'error', 'message' => 'No email data']);
    }
    
    /**
     * Helper method to make fire-and-forget HTTP requests
     */
    private function fireAndForgetRequest($emailData)
    {
        $url = Yii::$app->urlManager->createAbsoluteUrl(['request/send-email-async']);
        // Token security commented out for testing
        // $token = isset(Yii::$app->params['emailAsyncToken']) 
        //     ? Yii::$app->params['emailAsyncToken'] 
        //     : 'iflyfirstclass-async-email-2025-secret';
        
        // Encode data as JSON to preserve complex array structure
        $jsonData = json_encode([
            // 'token' => $token,
            'emailData' => $emailData
        ]);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        // Set Content-Type header for JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ]);
        
        // Key settings for fire-and-forget
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 50); // 50ms timeout - just enough to start the request
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1); // Required for millisecond timeouts to work
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true); // Don't reuse connections
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true); // Close connection after use
        
        // SSL options for local development (remove in production if not needed)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        
        // Execute and immediately continue (don't wait for response)
        @curl_exec($ch); // @ suppresses timeout warnings which are expected
        curl_close($ch);
        
        // Log that we initiated the request with data preview
        Yii::info('Fire-and-forget email request initiated for: ' . 
            (isset($emailData['adminEmail']) ? 'admin' : 'user') . 
            ' with data size: ' . strlen($jsonData) . ' bytes', 'email');
        
        // We don't care about the response - continue immediately
        return true;
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
            // Test fire-and-forget async email
            $testEmail = 'mateoramos97@gmail.com'; // Replace with your email
            
            // Prepare email data
            $emailData = [
                'flightRequest' => $flightRequest,
                'trips' => $trips,
                'lastInsertId' => 999
            ];
            
            // Test fire-and-forget for admin
            $this->fireAndForgetRequest([
                'adminEmail' => Yii::$app->params['adminEmail'],
            ] + $emailData);
            
            // Test fire-and-forget for user
            $this->fireAndForgetRequest([
                'userEmail' => $testEmail,
            ] + $emailData);
            
            return 'Fire-and-forget email requests initiated for: ' . $testEmail . ' and admin. Check emails in a few seconds.';
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
