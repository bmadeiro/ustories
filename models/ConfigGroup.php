<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; 
use yii\db\Expression;

/**
 * This is the model class for table "config_group".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $is_active
 *
 * @property ConfigType[] $configTypes
 */
class ConfigGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'is_active'], 'required'],
            [['description'], 'string'],
            [['is_active'], 'integer'],
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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'is_active' => Yii::t('app', 'Is Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigTypes()
    {
        return $this->hasMany(ConfigType::className(), ['config_group_id' => 'id']);
    }
}
