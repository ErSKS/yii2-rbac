<?php

namespace backend\modules\settings\models;

/**
 * This is the ActiveQuery class for [[Authority]].
 *
 * @see Authority
 */
class AuthorityQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Authority[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Authority|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
