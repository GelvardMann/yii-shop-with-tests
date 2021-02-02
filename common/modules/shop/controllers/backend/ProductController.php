<?php

namespace common\modules\shop\controllers\backend;

use common\modules\shop\models\backend\Image;
use common\modules\shop\Module;
use Yii;
use common\modules\shop\models\backend\Product;
use common\modules\shop\models\backend\search\ProductSearch;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 * @var ProductController
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return string
     */
    public function actionIndex(): string
    {
        $model = new Product();

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $relatedData = $model->getRelatedData();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'relatedData' => $relatedData,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        $model = $this->findModel($id);

        $attributeValue = new ActiveDataProvider(['query' => $model->getAttributeValues()->with('productAttributes')]);
        $productTags = new ActiveDataProvider(['query' => $model->getProductTags()->with('tag')]);
        $images = new ActiveDataProvider(['query' => $model->getImages()]);

        return $this->render('view', [
            'model' => $model,
            'attributeValue' => $attributeValue,
            'productTags' => $productTags,
            'images' => $images,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string
     * @throws
     */
    public function actionCreate(): string
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($files = UploadedFile::getInstances($model, 'file')) {
                $image = new Image();
                $image->uploadImages($files, $model->id);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        $relatedData = $model->getRelatedData();

        return $this->render('create', [
            'model' => $model,
            'relatedData' => $relatedData,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return Response|string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id): Response|string
    {
        $model = $this->findModel($id);
        $imagesPath = $model->getPathImages($model->images);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if ($files = UploadedFile::getInstances($model, 'file')) {
                $image = new Image();
                $image->uploadImages($files, $model->id);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        $relatedData = (new Product())->getRelatedData();

        return $this->render('update', [
            'model' => $model,
            'relatedData' => $relatedData,
            'images' => $imagesPath,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return Response|string
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDelete(int $id): Response|string
    {
        $model = $this->findModel($id);
        $images = $model->images;
        $imageModel = new Image();
        $imageModel->deleteImages($images, $id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): Product
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('module', 'THE_REQUESTED_PAGE_DOES_NOT_EXIST'));
    }
}
