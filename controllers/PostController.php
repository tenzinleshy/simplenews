<?php

namespace app\controllers;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Yii;
use app\models\Post;
use app\models\PostSearch;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    const COUNT_PER_PAGE = [
        2=>2,
        5 =>5,
        10 =>10,
        20 =>20,
        50 =>50,
    ];
    const POST_PICTURE_WIDTH = 600;
    const POST_PICTURE_HEIGHT = 350;

    public $numPosts = 2;

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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'postPictureHeight' => self::POST_PICTURE_HEIGHT,
            'postPictureWeight' => self::POST_PICTURE_WIDTH,
        ]);
    }

    /**
     * Lists all Post models.
     * @param integer $numItems
     * @return mixed
     */
    public function actionList()
     {

//         $model = new Post();
//         $data = Post::find()->one()->getAuthor()->one();
//         var_dump($data);die;

        $this->numPosts = Yii::$app->request->post('per-page-select');
        if(is_null($this->numPosts)){
            $this->numPosts = 2;
        }
        $showMoreParams = [
            'id' => Yii::$app->request->post('id'),
            'advanced' => Yii::$app->request->post('advanced')
        ];

        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->where(['activity'=>Post::STATUS_ACTIVE])->orderBy('date DESC'),
        ]);

        $dataProvider->pagination = [
            'defaultPageSize' => $this->numPosts
        ];


        $this->view->title = 'News List';
        return $this->render('list', [
            'listDataProvider' => $dataProvider,
            'numItems' => self::COUNT_PER_PAGE,
            'selected' => $this->numPosts,
            'advanced' =>   $showMoreParams['advanced'],
            'advanced_id' => $showMoreParams['id'],

        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('single_post', [
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
        if ($model->load(Yii::$app->request->post())) {
            $activity = (isset(Yii::$app->request->post()['Post']['activity']))?Yii::$app->request->post()['Post']['activity']:1;
            $model->date = date('U');
            $model->activity = $activity;
            $model->author_id = Yii::$app->user->getId();
            $model->category_id = 1;

            if ($model->save()){
                $model = new Post();
            }
            //если пост запрос и save
        }
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, true);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'postPictureHeight' => self::POST_PICTURE_HEIGHT,
            'postPictureWeight' => self::POST_PICTURE_WIDTH,
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
//            if(Yii::$app->request->isAjax){
//                echo 'success';
//                Yii::$app->end();
//            }else{
                return $this->redirect(['view', 'id' => $model->id]);
//            }
        } else {
//            if(Yii::$app->request->isAjax){
//                $this->renderPartial('update', array('model' => $model));//, false, true
//            }else {
                return $this->render('update', [
                    'model' => $model,
                ]);
//            }
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
