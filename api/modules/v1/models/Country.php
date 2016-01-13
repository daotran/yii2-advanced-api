<?php

namespace api\modules\v1\models;
 
use yii\db\ActiveRecord;
/**
 * Country Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class Country extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        //return 'country'; OR using as below:
        return '{{%country}}';
    }
 
    /**
     * We use the primary function because we don't use integer auto increment as a primary key.
     *
     * @inheritdoc
     */
    public static function primaryKey()
    {
        return ['code'];
    }
 
    /**
     * To let Yii know what fields exist on the table.
     * Define rules for validation
     */
    public function rules()
    {
        return [
            [['code', 'name', 'population'], 'required']
        ];
    }
}