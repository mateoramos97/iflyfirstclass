<?php

namespace common\queue;

use common\sys\models\request\FlightRequestMax;
use Yii;
use yii\base\BaseObject;
class SendEmail extends BaseObject implements \yii\queue\JobInterface
{
    public $flightRequest;
    public $email;
    public $trips;
    public $lastInsertId;

    public function execute($queue)
    {
        $flight_request_max_model = new FlightRequestMax();

        $flight_request_max_model
            ->sendEmailFlightRequest(
                $this->email,
                $this->flightRequest,
                $this->trips,
                $this->lastInsertId,
            );
    }
}