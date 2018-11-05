<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; 
use yii\db\Expression;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name
 * @property string $state Abbreviation
 * @property string $country
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Person[] $people
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'state', 'country', 'is_active', 'created_at'], 'required'],
            [['is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'country'], 'string', 'max' => 120],
            [['state'], 'string', 'max' => 20],
            [['name', 'state', 'country'], 'unique', 'targetAttribute' => ['name', 'state', 'country']],
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
            'state' => Yii::t('app', 'State'),
            'country' => Yii::t('app', 'Country'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['city_id' => 'id']);
    }
}
