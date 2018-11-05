<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; 
use yii\db\Expression;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $abbreviation
 * @property string $name
 * @property string $manager_name
 * @property string $manager_phone
 * @property int $order
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Person[] $people
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['abbreviation', 'is_active', 'created_at'], 'required'],
            [['order', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['abbreviation'], 'string', 'max' => 5],
            [['name', 'manager_name'], 'string', 'max' => 120],
            [['manager_phone'], 'string', 'max' => 20],
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
            'abbreviation' => Yii::t('app', 'Abbreviation'),
            'name' => Yii::t('app', 'Name'),
            'manager_name' => Yii::t('app', 'Manager Name'),
            'manager_phone' => Yii::t('app', 'Manager Phone'),
            'order' => Yii::t('app', 'Order'),
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
        return $this->hasMany(Person::className(), ['department_id' => 'id']);
    }
}
