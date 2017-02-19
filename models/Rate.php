<?php

namespace qvalent\rate\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%rates}}".
 *
 * @property integer $id
 * @property integer $item_type
 * @property integer $item_id
 * @property integer $user_id
 * @property integer $value
 * @property integer $created_at
 * @property integer $updated_at
 */
class Rate extends \yii\db\ActiveRecord
{

    /**
     * @return array
     */
    public function behaviors()
    {
        return [TimestampBehavior::className()];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rates}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_type', 'item_id', 'user_id'], 'required'],
            [['item_type', 'item_id', 'user_id', 'value'], 'integer'],
            [['item_type', 'item_id', 'user_id'], 'unique', 'targetAttribute' => ['item_type', 'item_id', 'user_id'], 'message' => 'The combination of Item Type, Item ID and User ID has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_type' => 'Item Type',
            'item_id' => 'Item ID',
            'user_id' => 'User ID',
            'value' => 'Value',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return RatesQuery|object the active query used by this AR class.
     */
    public static function find()
    {
        return Yii::$container->has(RatesQuery::className())
            ? Yii::createObject(RatesQuery::className())
            : new RatesQuery(get_called_class());
    }

    public static function findOrCreate($itemType, $itemId, $userId)
    {
        $params = [
            'itemType' => $itemType,
            'itemId' => $itemId,
            'userId' => $userId ?: Yii::$app->user->id
        ];

        return self::findOne($params) ?: Yii::createObject(get_called_class(), $params);
    }
}
