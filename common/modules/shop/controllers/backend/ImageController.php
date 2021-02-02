<?php

namespace common\modules\shop\controllers\backend;

use common\modules\shop\models\backend\helpers\FileManager;
use common\modules\shop\Module;
use Yii;
use common\modules\shop\models\backend\Image;
use common\modules\shop\models\backend\search\ImageSearch;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Image models.
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new ImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Image model.
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Image model.
     * If creation is successful, the browser will be redirected to the 'product view' page.
     * @param $product_id
     * @return string
     */
    public function actionCreate($product_id): string
    {
        $model = new Image();

        $model->product_id = $product_id;

        if ($model->load(Yii::$app->request->post())) {
            $images = UploadedFile::getInstances($model, 'file');
            $model->uploadImages($images, $product_id);

            $model->save();
            $this->redirect(['/shop/product/view/', 'id' => $model->product_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Image model.
     * If update is successful, the browser will be redirected to the 'product view' page.
     * @param integer $id
     * @param integer $product_id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id, int $product_id): string
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstances($model, 'file');
            $model->updateImage($image, $product_id, $model->name);
            $model->save();
            return $this->redirect(['/shop/product/view/', 'id' => $product_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'multiple' => false,
        ]);
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'product view' page.
     * @param integer $id
     * @param integer $product_id
     * @return mixed
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id, int $product_id): mixed
    {
        $fileManager = new FileManager();

        $model = $this->findModel($id);
        $path = Module::getAlias('@uploads/images/shop/' . $product_id . '/');
        $fileManager->deleteFile($model->name, $path);

        $model->delete();

        return $this->redirect(['/shop/product/view/', 'id' => $product_id]);
    }

    /**
     * @return bool
     * @throws
     */
    public function actionAjaxDelete(): bool
    {
        if ($model = $this->findModel(Yii::$app->request->post('key')) and Yii::$app->request->isAjax) {
            $fileManager = new FileManager();
            $path = Module::getAlias('@uploads/images/shop/' . $model->product_id . '/');
            $fileManager->deleteFile($model->name, $path);
            $model->delete();

            return true;
        } else {
            return false;
        }
    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Image
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('module', 'THE_REQUESTED_PAGE_DOES_NOT_EXIST'));
    }
}
