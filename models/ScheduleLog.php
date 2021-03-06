<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; 
use yii\db\Expression;

/**
 * This is the model class for table "schedule_log".
 *
 * @property int $id
 * @property int $app_id
 * @property string $last_execution
 * @property string $next_execution
 * @property string $information
 * @property string $created_at
 * @property string $updated_at
 *
 * @property App $app
 */
class ScheduleLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['app_id', 'last_execution', 'created_at'], 'required'],
            [['app_id'], 'integer'],
            [['last_execution', 'next_execution', 'information', 'created_at', 'updated_at'], 'safe'],
            [['app_id'], 'exist', 'skipOnError' => true, 'targetClass' => App::className(), 'targetAttribute' => ['app_id' => 'id']],
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
            'last_execution' => Yii::t('app', 'Last Execution'),
            'next_execution' => Yii::t('app', 'Next Execution'),
            'information' => Yii::t('app', 'Information'),
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
}
