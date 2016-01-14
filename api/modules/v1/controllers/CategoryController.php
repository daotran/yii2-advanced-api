<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\Category;
use Yii;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Country Controller API
 *
 * @author Dennis Tran <dennis@enclave.vn>
 */
class CategoryController extends ActiveController {

    public function init() {
        parent::init();
        Yii::$app->user->enableSession = false;
    }

    public $modelClass = 'api\modules\v1\models\Category';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

//    public function behaviors() {
//        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => HttpBasicAuth::className(),
//        ];
//        return $behaviors;
//    }
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['rateLimiter']['enableRateLimitHeaders'] = false;

        $behaviors['bootstrap'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['rateLimiter']['enableRateLimitHeaders'] = false;

        return $behaviors;
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {

        return Category::findOne($id);
    }

}
