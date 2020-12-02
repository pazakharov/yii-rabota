<?php

namespace app\controllers;

use Yii;
use app\models\Resume;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\UploadImage;
use yii\filters\VerbFilter;
use app\models\ResumeSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

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
                'actions' => [],
            ],
            'access' => [
                'class' => AccessControl::className(),

                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup', 'index', 'view'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'my-resume', 'update', 'create', 'delete', 'index', 'view', 'upload'],
                        'roles' => ['@'],
                    ],
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
        $searchModel = new ResumeSearch();
        $params = Yii::$app->request->queryParams;
        $dataProvider = $searchModel->search($params);

        return $this->render('allResume', [
            'dataProvider' => $dataProvider,
            'params' =>  $params,
            'cities' => Resume::getAvalibleCitiesArray()
        ]);
    }

    /**
     * @return mixed
     * 
     */
    public function actionMyResume()
    {
        return $this->render('myResume', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Resume::find()->where(['author_id' => Yii::$app->user->id]),
                'pagination' => ['pageSize' => 10]
            ])
        ]);
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
            'resume' => $this->findModel($id),
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

        if ($resume->load(Yii::$app->request->post()) && ($resume->transactionSave())) {
            return $this->redirect(['view', 'id' => $resume->id]);
        }

        $resume->foto = "uploads/noavatar.png";
        $resume->birthdate = date('Y-m-d');

        return $this->render('create', [
            'resume' => $resume,
            'image' => $image,
        ]);
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
        $resume = Resume::find()->where(['id' => $id])->one();
        if ($resume->load(Yii::$app->request->post()) && $resume->transactionSave()) {
            return $this->redirect(['view', 'id' => $resume->id]);
        }
        return $this->render('update', [
            'resume' => $resume,
            'image' => $image,
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
        $this->findModel($id, Yii::$app->user->id)->delete();
        return $this->redirect(['resume/my-resume']);
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
            $imageModel->imageFile = UploadedFile::getInstance($imageModel, "imageFile");
            if (Yii::$app->request->isPost) {
                return $imageModel->upload();
            } else {
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
    protected function findModel($id, $author_id = null)
    {
        $resumeQuery = Resume::find()->where(['id' => $id]);
        if ($author_id) {
            $resumeQuery->FilterWhere(['author_id' => $author_id]);
        }
        if (($resume = $resumeQuery->one()) !== null) {
            return $resume;
        }
        throw new NotFoundHttpException(Yii::t('app', 'Запрошенная страница не найдена.'));
    }
}
