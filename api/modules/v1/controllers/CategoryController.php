<?php

namespace api\modules\v1\controllers;

// Json format
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Country Controller API
 *
 * @author Dennis Tran <dennis@enclave.vn>
 */
class CategoryController extends ActiveController {

    public $modelClass = 'api\modules\v1\models\Category';

//    public function behaviors() {
//        $behaviors['bootstrap'] = [
//            'class' => ContentNegotiator::className(),
//            'formats' => [
//                'application/json' => Response::FORMAT_JSON,
//            ],
//        ];
//        return $behaviors;
//    }

}
