<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; 
use yii\db\Expression;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $application_id
 * @property int $person_id
 * @property string $username
 * @property string $name
 * @property string $email
 * @property string $ssn
 * @property string $creation_date
 * @property string $expiration_date
 * @property string $information
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Application $application
 * @property Person $person
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['application_id', 'person_id', 'is_active'], 'integer'],
            [['username', 'name', 'is_active', 'created_at'], 'required'],
            [['creation_date', 'expiration_date', 'created_at', 'updated_at'], 'safe'],
            [['information'], 'string'],
            [['username', 'email'], 'string', 'max' => 60],
            [['name'], 'string', 'max' => 120],
            [['ssn'], 'string', 'max' => 40],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::className(), 'targetAttribute' => ['application_id' => 'id']],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
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
            'person_id' => Yii::t('app', 'Person ID'),
            'username' => Yii::t('app', 'Username'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'ssn' => Yii::t('app', 'Ssn'),
            'creation_date' => Yii::t('app', 'Creation Date'),
            'expiration_date' => Yii::t('app', 'Expiration Date'),
            'information' => Yii::t('app', 'Information'),
            'is_active' => Yii::t('app', 'Is Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(Application::className(), ['id' => 'application_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }
}
