<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "usergroup".
 *
 * @property integer $id
 * @property string $title
 * @property string $detail
 * @property string $remarks
 * @property string $created_at
 * @property integer $postby_id
 * @property integer $is_verified
 * @property integer $verifiedby_id
 * @property string $updated_at
 * @property integer $is_active
 *
 * @property Authority[] $authorities
 * @property User[] $users
 * @property User $postby
 * @property User $verifiedby
 */
class Usergroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usergroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['detail', 'remarks'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['postby_id', 'is_verified', 'verifiedby_id', 'is_active'], 'integer'],
            [['title'], 'string', 'max' => 30],
            [['postby_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['postby_id' => 'id']],
            [['verifiedby_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['verifiedby_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'detail' => 'Detail',
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
    public function getAuthorities()
    {
        return $this->hasMany(Authority::className(), ['usergroup_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['usergroup_id' => 'id']);
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
    public function getVerifiedby()
    {
        return $this->hasOne(User::className(), ['id' => 'verifiedby_id']);
    }
}
