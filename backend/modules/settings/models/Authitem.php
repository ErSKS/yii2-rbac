<?php

namespace backend\modules\settings\models;

use Yii;

/**
 * This is the model class for table "{{%authitem}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $group_name
 * @property string $controller
 * @property string $action
 * @property string $unique_item
 * @property string $remarks
 * @property string $created_at
 * @property integer $postby_id
 * @property integer $is_verified
 * @property integer $verifiedby_id
 * @property string $updated_at
 * @property integer $is_active
 *
 * @property User $postby
 * @property User $verifiedby
 * @property Authority[] $authorities
 */
class Authitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%authitem}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'controller', 'action', 'unique_item'], 'required'],
            [['remarks'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['postby_id', 'is_verified', 'verifiedby_id', 'is_active'], 'integer'],
            [['title'], 'string', 'max' => 60],
            [['group_name'], 'string', 'max' => 50],
            [['controller', 'action'], 'string', 'max' => 20],
            [['unique_item'], 'string', 'max' => 40],
            [['unique_item'], 'unique'],
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
            'group_name' => 'Group Name',
            'controller' => 'Controller',
            'action' => 'Action',
            'unique_item' => 'Unique Item',
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
    public function getAuthorities()
    {
        return $this->hasMany(Authority::className(), ['authitem_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return AuthitemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthitemQuery(get_called_class());
    }
}
