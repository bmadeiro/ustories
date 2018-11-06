<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; 
use yii\db\Expression;

/**
 * This is the model class for table "app_config".
 *
 * @property int $id
 * @property int $app_id
 * @property int $config_type_id
 * @property string $value
 * @property int $order
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property App $app
 * @property AppConfigType $configType
 */
class AppConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['app_id', 'config_type_id', 'is_active'], 'required'],
            [['app_id', 'config_type_id', 'order', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['value'], 'string', 'max' => 120],
            [['app_id'], 'exist', 'skipOnError' => true, 'targetClass' => App::className(), 'targetAttribute' => ['app_id' => 'id']],
            [['config_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppConfigType::className(), 'targetAttribute' => ['config_type_id' => 'id']],
        ];
    }

    public function behaviors()
    {
        return [
            /**
             * TimestampBehavior automatically fills the specified attributes with the current timestamp.
             */
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'app_id' => Yii::t('app', 'App ID'),
            'config_type_id' => Yii::t('app', 'Config Type ID'),
            'value' => Yii::t('app', 'Value'),
            'order' => Yii::t('app', 'Order'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApp()
    {
        return $this->hasOne(App::className(), ['id' => 'app_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigType()
    {
        return $this->hasOne(AppConfigType::className(), ['id' => 'config_type_id']);
    }
}
