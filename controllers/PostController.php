<?php

namespace app\controllers;

use Yii;
use app\models\Post;
use app\models\PostSearch;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

/*
 array(2) { ["_csrf"]=> string(56) "RmRqdjJsM09yM141eSRjeTAlBxVGAEsWdgIeKXw9Ai4qVgcHegpRLg==" ["Post"]=> array(7) { ["author_id"]=> string(2) "47" ["date"]=> string(13) "1497992400000" ["category_id"]=> string(1) "1" ["text"]=> string(9) "drgedhedt" ["title"]=> string(10) "thdhedthdt" ["abridgment"]=> string(9) "edthtedhj" ["activity"]=> string(1) "1" } } create
 * */

        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('U');
            $model->activity = 1;
            $model->author_id = 47;
            $model->category_id = 1;

            if ($model->save()){
                $model = new Post();
            }
            //если пост запрос и save
        }
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);

    }

//    public function actionUpload()
//    {
//        $uploadModel = new UploadForm();
//
//        if (Yii::$app->request->isPost) {
//            $uploadModel->imageFile = UploadedFile::getInstance($uploadModel, 'imageFile');
//            if ($uploadModel->upload()) {
//                // file is uploaded successfully
//                return;
//            }
//        }
//
//        return $this->render('upload', ['model' => $uploadModel]);
//    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(Yii::$app->request->isAjax){
                echo 'success';
                Yii::$app->end();
            }else{
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            if(Yii::$app->request->isAjax){
                $this->renderPartial('update', array('model' => $model));//, false, true
            }else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
