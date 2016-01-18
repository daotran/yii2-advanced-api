<?php

namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\Link;
use yii\web\Linkable;
use yii\helpers\Url;

use frontend\models\CategorySearch;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 */
class Category extends ActiveRecord implements Linkable {

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
            //Link::REL_SELF => Url::to(['categories/view', 'id' => $this->id], true)
            Link::REL_SELF => Url::to(['/categories/' . $this->id], true)
        ];
    }

    /*
     * How to use RATE LIMITING
     * You may want to limit the API usage of each user to be at most 100 API calls within a period of 10 minutes.
     * If too many requests are received from a user within the stated period of the time, a response with status
     * code 429 (meaning "Too Many Requests") should be returned.
     */

    public function getRateLimit($request, $action) {
        return [$this->rateLimit, 1]; // $rateLimit requests per second
    }

    public function loadAllowance($request, $action) {
        return [$this->allowance, $this->allowance_updated_at];
    }

    public function saveAllowance($request, $action, $allowance, $timestamp) {
        $this->allowance = $allowance;
        $this->allowance_updated_at = $timestamp;
        $this->save();
    }

    /* Get all categories in database */
    public function getAllCategories() {
        $result = Category::find()->orderBy("id")->all();
                                //->where(['name' => $keyword])
                                //->all();
        return $result;
    }
    
    /*
     * Way 2: How to do custom search items using the built in Search Class generated by Gii which is 
     * already performing validation and using 'like' (still OK for use)
     * API: http://localhost/yii2-advanced-api/api/web/v1/categories?CategorySearch[name]=Shoes
     */
    public function prepareDataProvider() {

        $searchModel = new CategorySearch();
        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}
