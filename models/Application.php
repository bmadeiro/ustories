<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; 
use yii\db\Expression;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string $name
 * @property string $manager
 * @property string $manager_phone
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Config[] $configs
 * @property Schedule[] $schedules
 * @property ScheduleLog[] $scheduleLogs
 * @property Users[] $users
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'is_active'], 'required'],
            [['is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 60],
            [['manager'], 'string', 'max' => 120],
            [['manager_phone'], 'string', 'max' => 40],
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
                'value' => date('Y-m-d H:i:s'),//new Expression('NOW()'),
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
            'name' => Yii::t('app', 'Name'),
            'manager' => Yii::t('app', 'Manager'),
            'manager_phone' => Yii::t('app', 'Manager Phone'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigs()
    {
        return $this->hasMany(Config::className(), ['application_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['application_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScheduleLogs()
    {
        return $this->hasMany(ScheduleLog::className(), ['application_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['application_id' => 'id']);
    }
}
