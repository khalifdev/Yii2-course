<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $files
 * @property string $startDateTime
 * @property string $endDateTime
 * @property int $isBlocked
 * @property string|null $email
 * @property string $createdAt
 * @property string|null $updatedAt
 * @property int $userId
 *
 * @property Users $user
 */
class ActivityBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'startDateTime', 'endDateTime', 'userId'], 'required'],
            [['description'], 'string'],
            [['startDateTime', 'endDateTime', 'createdAt', 'updatedAt'], 'safe'],
            [['isBlocked', 'userId'], 'integer'],
            [['title', 'email'], 'string', 'max' => 150],
            [['files'], 'string', 'max' => 600],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'files' => Yii::t('app', 'Files'),
            'startDateTime' => Yii::t('app', 'Start Date Time'),
            'endDateTime' => Yii::t('app', 'End Date Time'),
            'isBlocked' => Yii::t('app', 'Is Blocked'),
            'email' => Yii::t('app', 'Email'),
            'createdAt' => Yii::t('app', 'Created At'),
            'updatedAt' => Yii::t('app', 'Updated At'),
            'userId' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'userId']);
    }
}
