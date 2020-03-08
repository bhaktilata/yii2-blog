<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ImageUpload;
use yii\web\UploadedFile;
/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        /*echo '<pre>';
        var_dump($_POST['Article']);
        echo '</pre>';
        echo '<pre>';
        var_dump(Yii::$app->request->post());die;
        echo '</pre>';
            */
        //$model->title = $_POST['Article']['title'];
        //var_dump($model->title);die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', ['model' => $model,]);
    }

    public function actionUploadImage($id)
    {
        $model = new ImageUpload;
        
        if (Yii::$app->request->isPost)
        {
            
            $article = $this->findModel($id); // создаёт запрос к БД для того, чтобы извлечь статью по id
            // поэтому нужно создать и отобразить вид (admin/views/article/image.php) с формой, в которой будем загружать картинку 
             /*echo '<pre>';
            var_dump($article->title);die;
             echo '</pre>';*/
            $file = UploadedFile::getInstance($model, 'image');
             /*echo '<pre>'; 
             var_dump($file);die;
             echo '</pre>';*/
          
            if($article->saveImage($model->uploadFile($file, $article->image))) //возврат на мтраницу 
            {
                return $this->redirect(['view', 'id'=>$article->id]);
            } 
           
            $model->uploadFile($file);
            // создадим метод, который будет принимать название картинки, которое нужно сохранить, название картинки возвращает нам метод UploadImage($id) 
            $article->saveImage($model->uploadFile($file, article->image));
            
        }
        
        return $this->render('image', ['model'=>$model]);
    }
    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) // метод, который делает запрос к БД 
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
