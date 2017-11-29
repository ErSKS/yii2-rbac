<?php

namespace backend\modules\settings\models;

use Yii;

/**
 * This is the model class for table "{{%authority}}".
 *
 * @property integer $id
 * @property integer $usergroup_id
 * @property integer $authitem_id
 * @property integer $is_access
 * @property string $created_at
 * @property integer $postby_id
 * @property integer $is_verified
 * @property integer $verifiedby_id
 * @property string $updated_at
 * @property integer $is_active
 *
 * @property User $postby
 * @property User $verifiedby
 * @property Usergroup $usergroup
 * @property Authitem $authitem
 */
class Authority2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%authority}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usergroup_id'], 'required'],
            [['usergroup_id', 'authitem_id', 'is_access', 'postby_id', 'is_verified', 'verifiedby_id', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['postby_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['postby_id' => 'id']],
            [['verifiedby_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['verifiedby_id' => 'id']],
            [['usergroup_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usergroup::className(), 'targetAttribute' => ['usergroup_id' => 'id']],
            [['authitem_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authitem::className(), 'targetAttribute' => ['authitem_id' => 'id']],
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
            'authitem_id' => 'Authitem ID',
            'is_access' => 'Is Access',
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
    public function getAuthitem()
    {
        return $this->hasOne(Authitem::className(), ['id' => 'authitem_id']);
    }

    /**
     * @inheritdoc
     * @return AuthorityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorityQuery(get_called_class());
    }
}
