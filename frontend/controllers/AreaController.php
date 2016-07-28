<?php
/**
 * Created by PhpStorm.
 * User: yidashi
 * Date: 16/7/12
 * Time: 下午12:03
 */

namespace frontend\controllers;

use Yii;
use frontend\models\City;
use yii\web\Controller;
use yii\web\Response;

class AreaController extends Controller
{
    public function actionChildren($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (!is_numeric($id)) {
            $id = null;
        }
        return City::getChildren($id);
    }
}