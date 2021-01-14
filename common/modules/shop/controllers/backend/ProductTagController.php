<?php

namespace common\modules\shop\controllers\backend;

use common\modules\shop\models\backend\Tag;
use common\modules\shop\Module;
use Yii;
use common\modules\shop\models\backend\ProductTag;
use common\modules\shop\models\backend\search\ProductTagSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductTagController implements the CRUD actions for ProductTag model.
 */
class ProductTagController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
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
     * Lists all ProductTag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductTagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new ProductTag();
        $relatedData = $model->getRelatedData();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'relatedData' => $relatedData,
        ]);
    }

    /**
     * Displays a single ProductTag model.
     * @param integer $product_id
     * @param integer $tag_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($product_id, $tag_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($product_id, $tag_id),
        ]);
    }

    /**
     * Creates a new ProductTag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param null $product_id
     * @return mixed
     */
    public function actionCreate($product_id = null)
    {
        $model = new ProductTag();

        $model->product_id = $product_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/shop/product/view/', 'id' => $model->product_id]);
        }

        $relatedData = $model->getRelatedData();

        return $this->render('create', [
            'model' => $model,
            'relatedData' => $relatedData,
        ]);
    }

    /**
     * Updates an existing ProductTag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $product_id
     * @param integer $tag_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($product_id, $tag_id)
    {
        $model = $this->findModel($product_id, $tag_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/shop/product/view/', 'id' => $product_id]);
        }

        $tags = new Tag();
        $relatedData = $tags->getRelatedData();

        return $this->render('update', [
            'model' => $model,
            'relatedData' => $relatedData,
        ]);
    }

    /**
     * Deletes an existing ProductTag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $product_id
     * @param integer $tag_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($product_id, $tag_id)
    {
        $this->findModel($product_id, $tag_id)->delete();

        return $this->redirect(['/shop/product/view/', 'id' => $product_id]);
    }

    /**
     * Finds the ProductTag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $product_id
     * @param integer $tag_id
     * @return ProductTag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id, $tag_id)
    {
        if (($model = ProductTag::findOne(['product_id' => $product_id, 'tag_id' => $tag_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('module', 'THE_REQUESTED_PAGE_DOES_NOT_EXIST'));
    }
}
