<?php

namespace backend\modules\settings\models;

/**
 * This is the ActiveQuery class for [[Authitem]].
 *
 * @see Authitem
 */
class AuthitemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Authitem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Authitem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
