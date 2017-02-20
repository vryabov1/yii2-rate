<?php

namespace qvalent\rate\controllers;

use qvalent\rate\components\RateCheckout;
use Yii;
use yii\base\Controller;

class RateController extends Controller
{
    public function actionUp($itemType, $itemId)
    {
        $this->getCheckout($itemType, $itemId)->rateUp();
    }

    public function actionDown($itemType, $itemId)
    {
        $this->getCheckout($itemType, $itemId)->rateDown();
    }

    public function actionReset($itemType, $itemId)
    {
        $this->getCheckout($itemType, $itemId)->rateReset();
    }

    /**
     * @param $itemType
     * @param $itemId
     * @return object|RateCheckout
     */
    private function getCheckout($itemType, $itemId)
    {
        return Yii::createObject(RateCheckout::class, [$itemType, $itemId]);
    }
}