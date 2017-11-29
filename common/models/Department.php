<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%department}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $summary
 * @property string $remarks
 * @property string $created_at
 * @property integer $postby_id
 * @property integer $is_verified
 * @property integer $verifiedby_id
 * @property string $updated_at
 * @property integer $is_active
 *
 * @property User $verifiedby
 * @property User $postby
 * @property Notice[] $notices
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%department}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['postby_id', 'is_verified', 'verifiedby_id', 'is_active'], 'integer'],
            [['title'], 'string', 'max' => 70],
            [['url'], 'string', 'max' => 30],
            [['summary'], 'string', 'max' => 255],
            [['remarks'], 'string', 'max' => 50],
            [['verifiedby_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['verifiedby_id' => 'id']],
            [['postby_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['postby_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Department Name',
            'url' => 'Url',
            'summary' => 'Summary',
            'remarks' => 'Remarks',
            'created_at' => 'Created At',
            'postby_id' => 'Post By',
            'is_verified' => 'Is Verified',
            'verifiedby_id' => 'Verified By',
            'updated_at' => 'Updated At',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVerifiedby()
    {
        return $this->hasOne(User::className(), ['id' => 'verifiedby_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostby()
    {
        return $this->hasOne(User::className(), ['id' => 'postby_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotices()
    {
        return $this->hasMany(Notice::className(), ['dept_id' => 'id']);
    }
}
