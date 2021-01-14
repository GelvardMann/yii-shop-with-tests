<?php

namespace common\modules\shop\controllers\backend;

use common\modules\shop\models\backend\Attribute;
use common\modules\shop\Module;
use Yii;
use common\modules\shop\models\backend\AttributeValue;
use common\modules\shop\models\backend\search\AttributeValueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AttributeValueController implements the CRUD actions for AttributeValue model.
 */
class AttributeValueController extends Controller
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
     * Lists all AttributeValue models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AttributeValueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new AttributeValue();
        $relatedData = $model->getRelatedData();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'relatedData' => $relatedData,
        ]);
    }

    /**
     * Displays a single AttributeValue model.
     * @param integer $product_id
     * @param integer $attribute_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($product_id, $attribute_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($product_id, $attribute_id),
        ]);
    }

    /**
     * Creates a new AttributeValue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param null $product_id
     * @return mixed
     */
    public function actionCreate($product_id = null)
    {
        $model = new AttributeValue();
        $model->product_id = $product_id;

        $attributes = new AttributeValue();
        $relatedData = $attributes->getRelatedData();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/shop/product/view/', 'id' => $model->product_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'relatedData' => $relatedData,
        ]);
    }

    /**
     * Updates an existing AttributeValue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $product_id
     * @param integer $attribute_id
     * @return mixed
     * @var array $relatedData
     * @var Attribute $attributes
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($product_id, $attribute_id)
    {
        $model = $this->findModel($product_id, $attribute_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/shop/product/view/', 'id' => $model->product_id]);
        }

        $attributes = new AttributeValue();
        $relatedData = $attributes->getRelatedData();

        return $this->render('update', [
            'model' => $model,
            'relatedData' => $relatedData,
        ]);
    }

    /**
     * Deletes an existing AttributeValue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $product_id
     * @param integer $attribute_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($product_id, $attribute_id)
    {
        $this->findModel($product_id, $attribute_id)->delete();

        return $this->redirect(['/shop/product/view/', 'id' => $product_id]);
    }

    /**
     * Finds the AttributeValue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $product_id
     * @param integer $attribute_id
     * @return AttributeValue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id, $attribute_id)
    {
        if (($model = AttributeValue::findOne(['product_id' => $product_id, 'attribute_id' => $attribute_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Module::t('module', 'THE_REQUESTED_PAGE_DOES_NOT_EXIST'));
    }
}
