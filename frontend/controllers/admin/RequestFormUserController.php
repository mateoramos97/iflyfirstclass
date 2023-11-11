<?php

namespace frontend\controllers\admin;

use common\sys\core\request\FlightRequestInfoService;

class RequestFormUserController extends AdminController
{
    public function actionFlightEmails()
    {
        $flight_request_info_service = new FlightRequestInfoService();

        $emails = $flight_request_info_service->get_request_form_user_emails();
        return $this->render('flight-emails',[
            'emails' => $emails
        ]);
    }
}