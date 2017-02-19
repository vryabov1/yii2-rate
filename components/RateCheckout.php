<?php

namespace qvalent\rate\components;

use qvalent\rate\models\Rate;
use Yii;

class RateCheckout
{
    /** @var Rate  */
    private $rateModel;

    /**
     * RateCheckout constructor.
     * @param $itemType
     * @param $itemId
     * @param null $userId
     */
    public function __construct($itemType, $itemId, $userId = null)
    {
        $this->rateModel = Rate::findOrCreate(
            $itemType,
            $itemId,
            $userId ?: Yii::$app->user->id
        );
    }

    /**
     * @return bool
     */
    public function rateUp()
    {
        $this->rateModel->value = 1;
        return $this->rateModel->save();
    }

    /**
     * @return bool
     */
    public function rateDown()
    {
        $this->rateModel->value = -1;
        return $this->rateModel->save();
    }

    /**
     * @return bool
     */
    public function rateReset()
    {
        if ($this->rateModel->isNewRecord) return true;
        $this->rateModel->delete();
        return true;
    }

}