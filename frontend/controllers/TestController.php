<?php
namespace frontend\controllers;
use yii\web\Controller;
use yii\data\Pagination;
use frontend\models\City;
use frontend\models\UploadForm;
use yii\web\UploadedFile;
use Yii;

class TestController extends Controller
{
    public $pagination;

    public function actionPage()
    {

        //$query = City::find()->where(['parent_id' => 0]);

        $query = City::find();

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count,'defaultPageSize' => 10,]);

        $city = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('page',[
            'models' => $city,
            'pages' => $pagination,
        ]);
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                // 文件上传成功
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }


}
