<?php

namespace qvalent\rate\controllers;

use qvalent\rate\components\RateCheckout;
use Yii;
use yii\web\Controller;

class RateController extends Controller
{

    const RETURN_PARAM = 'returnUrl';

    public function actionUp($itemType, $itemId)
    {
        $this->getCheckout($itemType, $itemId)->rateUp();
        return $this->redirect($this->getReturnUrl());
    }

    public function actionDown($itemType, $itemId)
    {
        $this->getCheckout($itemType, $itemId)->rateDown();
        return $this->redirect($this->getReturnUrl());
    }

    public function actionReset($itemType, $itemId)
    {
        $this->getCheckout($itemType, $itemId)->rateReset();
        return $this->redirect($this->getReturnUrl());
    }

    /**
     * @return string
     */
    protected function getReturnUrl()
    {
        return Yii::$app->request->post(static::RETURN_PARAM, Yii::$app->request->get(static::RETURN_PARAM));
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