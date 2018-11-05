<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; 
use yii\db\Expression;

/**
 * This is the model class for table "config_type".
 *
 * @property int $id
 * @property int $config_group_id
 * @property string $name
 * @property string $description
 * @property int $is_active
 *
 * @property Config[] $configs
 * @property ConfigGroup $configGroup
 */
class ConfigType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config_type';
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
            [['name'], 'string', 'max' => 60],
            [['config_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConfigGroup::className(), 'targetAttribute' => ['config_group_id' => 'id']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigs()
    {
        return $this->hasMany(Config::className(), ['config_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigGroup()
    {
        return $this->hasOne(ConfigGroup::className(), ['id' => 'config_group_id']);
    }
}
