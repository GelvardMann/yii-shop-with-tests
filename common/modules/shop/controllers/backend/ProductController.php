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
     * @return mixed
     */
    public function actionIndex()
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
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id)
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
     * @return mixed
     * @throws
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

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
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Exception
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $images = $model->images;
        $imagesPath = $model->getPathImages($images);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

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
     * @return mixed
     * @throws NotFoundHttpException
     * @throws StaleObjectException|\Throwable
     */
    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);
        $images = $model->images;
        $imageModel = new Image();
//        $path = Module::getAlias('@uploads/images/shop/' . $id);
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
