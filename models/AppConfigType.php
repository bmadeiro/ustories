<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; 
use yii\db\Expression;

/**
 * This is the model class for table "app_config_type".
 *
 * @property int $id
 * @property int $config_group_id
 * @property string $name
 * @property string $description
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AppConfig[] $appConfigs
 */
class AppConfigType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_config_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['config_group_id', 'is_active'], 'integer'],
            [['name', 'is_active'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 60],
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
            'config_group_id' => Yii::t('app', 'Config Group ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAppConfigs()
    {
        return $this->hasMany(AppConfig::className(), ['config_type_id' => 'id']);
    }
}
