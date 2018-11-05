<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; 
use yii\db\Expression;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property int $application_id
 * @property string $frequency_type YEARLY, Monthly, Weekly, Daily, Hourly, Minutely
 * @property int $repeat_interval
 * @property string $start_date
 * @property string $start_time
 * @property string $end_date
 * @property string $end_time
 *
 * @property Application $application
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['application_id', 'frequency_type', 'repeat_interval', 'start_date', 'start_time'], 'required'],
            [['application_id', 'repeat_interval'], 'integer'],
            [['start_date', 'start_time', 'end_date', 'end_time'], 'safe'],
            [['frequency_type'], 'string', 'max' => 20],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::className(), 'targetAttribute' => ['application_id' => 'id']],
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
            'application_id' => Yii::t('app', 'Application ID'),
            'frequency_type' => Yii::t('app', 'Frequency Type'),
            'repeat_interval' => Yii::t('app', 'Repeat Interval'),
            'start_date' => Yii::t('app', 'Start Date'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_date' => Yii::t('app', 'End Date'),
            'end_time' => Yii::t('app', 'End Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(Application::className(), ['id' => 'application_id']);
    }
}
