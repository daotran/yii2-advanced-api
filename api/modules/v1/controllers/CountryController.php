<?php

namespace api\modules\v1\controllers;

// Json format
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class CountryController extends ActiveController {

    public $modelClass = 'api\modules\v1\models\Country';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['bootstrap'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];

        return $behaviors;
    }

}

/*
 * Whether to automatically pluralize the URL names for controllers. 
 * If true, a controller ID will appear in plural form in URLs. 
 * For example, user controller will appear as users in URLs.
 * 
GET /countries: list all countries
HEAD /countries: show the overview information of country listing
POST /countries: create a new country
GET /countries/AU: return the details of the country AU
HEAD /countries/AU: show the overview information of country AU
PATCH /countries/AU: update the country AU
PUT /countries/AU: update the country AU
DELETE /countries/AU: delete the country AU
OPTIONS /countries: show the supported verbs regarding endpoint /countries
OPTIONS /countries/AU: show the supported verbs regarding endpoint /countries/AU.
*/