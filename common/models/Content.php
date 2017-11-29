<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property string $meta_keyword
 * @property string $meta_desc
 * @property string $summary
 * @property string $description
 * @property string $image
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
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['meta_keyword', 'meta_desc', 'description', 'remarks'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['postby_id', 'is_verified', 'verifiedby_id', 'hits', 'is_active'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['url', 'image'], 'string', 'max' => 255],
            [['summary'], 'string', 'max' => 500],
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
            'url' => 'Url',
            'meta_keyword' => 'Meta Keyword',
            'meta_desc' => 'Meta Desc',
            'summary' => 'Summary',
            'description' => 'Description',
            'image' => 'Image',
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
     * @return ContentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContentQuery(get_called_class());
    }
}
