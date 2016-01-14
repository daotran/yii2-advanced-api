<?php

namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\Link;
use yii\web\Linkable;
use yii\helpers\Url;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 */
class Category extends ActiveRecord implements Linkable {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /*
     * CUSTOMIZE RESTFUL API
     */

    /*
     * How to use FIELDS() & EXTRAFIELDS()
     *  API: http://localhost/yii2-advanced-api/api/web/v1/categories?fields=id,name&expand=description
     */

    public function fields() {
        return ['id', 'name'];
    }

    public function extraFields() {
        return ['description'];
    }

    /*
     * How to use HATEOAS with LINKS
     *  API: http://localhost/yii2-advanced-api/api/web/v1/categories?fields=id,name&expand=description
     */

    public function getLinks() {
        return [
            Link::REL_SELF => Url::to(['categories/', 'id' => $this->id], true)
        ];
    }

}
