<?php

namespace app\controllers;

use Yii;
use app\models\Resume;
use app\models\ResumeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use app\models\UploadImage;
use yii\data\ActiveDataProvider;

/**
 * ResumeController implements the CRUD actions for Resume model.
 */
class ResumeController extends Controller
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
     * 
     * Lists all Resume models.
     * 
     * @return mixed
     * 
     */
    public function actionIndex()
    {
        // $searchModel = new ResumeSearch();
       
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index_new', [

        //     'searchModel' => $searchModel,

        //     'dataProvider' => $dataProvider,

        // ]);

      

        $dataProvider = new ActiveDataProvider([
            'query' => Resume::find()->with('specialization')->with('opyts'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

       
        
        

        return $this->render('index_new', ['dataProvider' => $dataProvider]);


    }

    /**
     * Displays a single Resume model.
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
     * Creates a new Resume model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $resume = new Resume();
        
        $image = new UploadImage();

        
        
        $resume->load(Yii::$app->request->post());
       
               
        if ($resume->save()) {
          
            return $this->redirect(['view', 'id' => $resume->id]);

        }else{
            
            
            $resume->foto = "uploads/noavatar.png";
            $resume->birthdate = date('Y-m-d');

            return $this->render('create', [

            'model' => $resume,
            
            'model2' => $image,
            ]);
        }
    }

    /**
     * Updates an existing Resume model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {   
        $image = new UploadImage();
       
        $model = $this->findModel($id);


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           
            
            return $this->redirect(['view', 'id' => $model->id]);
      
        }
            
           // var_dump($model); die;  
            return $this->render('update', [
            
             

            'model' => $model,
            
            'model2' => $image,


      
         ]);
    }

    /**
     * Deletes an existing Resume model.
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
     * Upload foto for resume.
     * If Upload is successful, the browser will resive response.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpload()
    {
        
        
        if (Yii::$app->request->isPost) {

            $imageModel = new UploadImage();

               

            $imageModel->imageFile = UploadedFile::getInstance($imageModel,"imageFile");
            
            if (Yii::$app->request->isPost) {
                
                return $imageModel->upload();
            
            }else{
              
                return "uploads/noavatar.png";
            
            }
        }

        
    }



    /**
     * Finds the Resume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resume the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resume::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
