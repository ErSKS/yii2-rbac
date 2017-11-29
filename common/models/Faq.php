<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%faq}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $question
 * @property string $detail
 * @property integer $sequence
 * @property string $remarks
 * @property string $created_at
 * @property integer $postby_id
 * @property integer $is_verified
 * @property integer $verifiedby_id
 * @property string $updated_at
 * @property string $hits
 * @property integer $is_active
 *
 * @property User $postby
 * @property User $verifiedby
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%faq}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['updated_at'], 'required'],
            [['detail', 'remarks'], 'string'],
            [['sequence', 'postby_id', 'is_verified', 'verifiedby_id', 'hits', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 150],
            [['question'], 'string', 'max' => 255],
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
            'question' => 'Question',
            'detail' => 'Answer',
            'sequence' => 'Display Sequence',
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
     * @return FaqQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FaqQuery(get_called_class());
    }
}
