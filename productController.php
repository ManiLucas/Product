<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $code Code
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($code)
    {
        return $this->render('view', [
            'model' => $this->findModel($code),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
        		$model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
        		if($model->uploadFile) {
        			$this->saveImage($model);
        		}
            return $this->redirect(['view', 'code' => $model->code]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $code Code
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($code)
    {
        $model = $this->findModel($code);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
        		$model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
        		if($model->uploadFile) {
        			$this->saveImage($model);
        		}
            return $this->redirect(['view', 'code' => $model->code]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $code Code
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($code)
    {
        $this->findModel($code)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $code Code
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    protected function saveImage($model){
	 	
	 	$file = $model->upload();
	 	if($file) {
	 		$model->image = $file;
	 		$model->save(false);
	 		Yii::$app->session->setFlash('success', Yii::t('app', 'File loaded on the server {0}',
	 			  $model->uploadFile->baseName. ' '.$model->uploadFile->extension));
	 	}else {
			Yii::$app->session->setFlash('error', Yii::t('app', 'File loaded on the server {0}',
	 			  $model->uploadFile->baseName. ' '.$model->uploadFile->extension));	 	
	 	}
	 	return;
	 } 
}

//Github /var/www/html/classic/modules/admin/controllers/ProductController.php
