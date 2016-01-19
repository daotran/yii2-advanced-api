<?php

namespace api\modules\v1\controllers;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class UserController extends ActiveController {

    public $modelClass = 'api\common\models\User'; //OR using as below:
    //public $modelClass = 'common\models\User';

    /* You may configure the REST API application with OAuth2 server on Yii2 as follows */
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['bootstrap'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(), // this supports multiple authentication methods
            'authMethods' => [
                QueryParamAuth::className(), // this supports authentication based on access_token
            ],
        ];
        return $behaviors;
    }

}
