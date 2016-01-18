<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace api\modules\v1\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\Link;
use yii\web\Linkable;
use yii\helpers\Url;
use frontend\models\PostSearch;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 */
class Post extends ActiveRecord implements Linkable {
    
    public function getLinks() {
        return [
            Link::REL_SELF => Url::to(['/posts/', 'id' => $this->id], true)
        ];
    }

    public function prepareDataProvider() {

        $searchModel = new PostSearch();
        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}
