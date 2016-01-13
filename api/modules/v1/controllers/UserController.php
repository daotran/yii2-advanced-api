<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

class UserController extends ActiveController
{
    //public $modelClass = 'api\models\User'; OR using as below:
    public $modelClass = 'common\models\User';

}
