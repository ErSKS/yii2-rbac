<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $usergroup_id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $contact_no
 * @property string $remarks
 * @property integer $created_at
 * @property integer $postby_id
 * @property integer $is_verified
 * @property integer $verifiedby_id
 * @property integer $updated_at
 * @property integer $status
 * @property integer $is_active
 *
 * @property Authitem[] $authitems
 * @property Authitem[] $authitems0
 * @property Authority[] $authorities
 * @property Authority[] $authorities0
 * @property Content[] $contents
 * @property Content[] $contents0
 * @property Faq[] $faqs
 * @property Faq[] $faqs0
 * @property Notice[] $notices
 * @property Notice[] $notices0
 * @property Usergroup $usergroup
 * @property Usergroup[] $usergroups
 * @property Usergroup[] $usergroups0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usergroup_id', 'created_at', 'postby_id', 'is_verified', 'verifiedby_id', 'updated_at', 'status', 'is_active'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'email', 'contact_no', 'created_at', 'updated_at'], 'required'],
            [['contact_no', 'remarks'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['usergroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usergroup::className(), 'targetAttribute' => ['usergroup_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usergroup_id' => 'Usergroup ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'contact_no' => 'Contact No.',
            'remarks' => 'Remarks',
            'created_at' => 'Created At',
            'postby_id' => 'Postby ID',
            'is_verified' => 'Is Verified',
            'verifiedby_id' => 'Verifiedby ID',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthitems()
    {
        return $this->hasMany(Authitem::className(), ['postby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthitems0()
    {
        return $this->hasMany(Authitem::className(), ['verifiedby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorities()
    {
        return $this->hasMany(Authority::className(), ['postby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthorities0()
    {
        return $this->hasMany(Authority::className(), ['verifiedby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['postby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContents0()
    {
        return $this->hasMany(Content::className(), ['verifiedby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqs()
    {
        return $this->hasMany(Faq::className(), ['postby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqs0()
    {
        return $this->hasMany(Faq::className(), ['verifiedby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotices()
    {
        return $this->hasMany(Notice::className(), ['postby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotices0()
    {
        return $this->hasMany(Notice::className(), ['verifiedby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsergroup()
    {
        return $this->hasOne(Usergroup::className(), ['id' => 'usergroup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsergroups()
    {
        return $this->hasMany(Usergroup::className(), ['postby_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsergroups0()
    {
        return $this->hasMany(Usergroup::className(), ['verifiedby_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
