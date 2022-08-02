<?php 

function ValidateInt($input, $min = -10, $max = -10){
    if (!is_numeric($input))
        return false;

    if ($min != -10 || $max != -10){
        if ($input >= $min && $input <= $max) {
            return true;
        } else {
            return false;
        }
    }
    
    return true;
}

class PaymentData {

    private $startDate;
    private $sum;
    private $term;

    private $percent;
    private $sumAdd;

    private $HasAnyErrors;

    function __construct($startDate, $sum, $term, $percent, $sumAdd)
    {
        if (!preg_match("/^\s*(3[01]|[12][0-9]|0?[1-9])\.(1[012]|0?[1-9])\.((?:19|20)\d{2})\s*$/",$startDate)) {
            $HasAnyErrors = true;

            throw new Exception("Date validate failed!");
            return false;
        }

        if (!ValidateInt($sum, 1000, 3000000) || !ValidateInt($term, 1, 60) || !ValidateInt($percent, 3, 100) || !ValidateInt($sumAdd, 0, 3000000)) {
            $HasAnyErrors = true;

            throw new Exception("Int validate failed!");
            return false;
        }

        $this->startDate = $startDate;
        $this->sum = $sum;
        $this->term = $term;
        $this->percent = $percent;
        $this->sumAdd = $sumAdd;
    }

    function GetMonthlyPay($date, $sum, $percent, $lastSumm){
        $date->add(new DateInterval('P1M'));
    
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $date->format('m'), $date->format('y')) - $date->format('d');
        $lastResult = $lastSumm + ($lastSumm + $sum) * $daysInMonth * ($percent / 365);
    
        return $lastResult;
    }

    function GetResultSum() {
        $dateS = new DateTime($this->startDate);

        $FirstPay = $this->GetMonthlyPay($dateS, $this->sum, $this->percent, 0);
    
        $lastResult = $FirstPay;
        for ($i = 0; $i < $this->term; $i++) { 
            $lastResult = $this->GetMonthlyPay($dateS, $this->sumAdd, $this->percent, $lastResult);
        }
    
        return round($lastResult);
    }
}

$jsonString = file_get_contents("php://input");
if ($jsonString == ""){
    return http_response_code(404);
}

$decodedObject = json_decode($jsonString);
header('Content-Type: application/json');

$paymentData = new PaymentData($decodedObject[0]->value, $decodedObject[2]->value, $decodedObject[1]->value, $decodedObject[3]->value, $decodedObject[4]->value);


echo json_encode(['sum' => $paymentData->GetResultSum()]);
