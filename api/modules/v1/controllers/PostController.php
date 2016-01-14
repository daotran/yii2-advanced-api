<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
// Json format
use yii\filters\ContentNegotiator;
use yii\web\Response;

class PostController extends ActiveController {

    public $modelClass = 'api\modules\v1\models\Post';

    public function behaviors() {

        $behaviors['bootstrap'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

}
