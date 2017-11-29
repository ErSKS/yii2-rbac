<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%notice}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $description
 * @property integer $dept_id
 * @property integer $sem_id
 * @property string $image
 * @property string $expiry_date
 * @property integer $order
 * @property integer $priority
 * @property string $remarks
 * @property string $created_at
 * @property integer $postby_id
 * @property integer $is_verified
 * @property integer $verifiedby_id
 * @property string $updated_at
 * @property string $hits
 * @property integer $is_active
 *
 * @property Department $dept
 * @property User $postby
 * @property User $verifiedby
 */
class Notice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%notice}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description', 'remarks'], 'string'],
            [['dept_id', 'sem_id', 'order', 'priority', 'postby_id', 'is_verified', 'verifiedby_id', 'hits', 'is_active'], 'integer'],
            [['expiry_date', 'created_at', 'updated_at'], 'safe'],
            [['title', 'summary', 'image'], 'string', 'max' => 255],
            [['dept_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['dept_id' => 'id']],
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
            'summary' => 'Summary',
            'description' => 'Description',
            'dept_id' => 'Targeted Department',
            'sem_id' => 'Targeted Semester',
            'image' => 'Image',
            'expiry_date' => 'Expiry Date',
            'order' => 'Order',
            'priority' => 'Priority',
            'remarks' => 'Remarks',
            'created_at' => 'Created At',
            'postby_id' => 'Post By',
            'is_verified' => 'Is Verified',
            'verifiedby_id' => 'Verified By',
            'updated_at' => 'Updated At',
            'hits' => 'Hits',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDept()
    {
        return $this->hasOne(Department::className(), ['id' => 'dept_id']);
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
     * @inheritdoc
     * @return NoticeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NoticeQuery(get_called_class());
    }
}
