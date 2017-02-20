<?php

namespace qvalent\rate\components;

use qvalent\rate\models\Rate;
use Yii;
use yii\base\Object;

class RateCheckout extends Object
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
        parent::__construct();
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