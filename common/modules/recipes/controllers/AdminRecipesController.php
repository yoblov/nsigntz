<?php

namespace common\modules\recipes\controllers;

use common\models\Ingredient;
use common\models\RecipeIngredients;
use Yii;
use common\models\Recipe;
use common\models\RecipeSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminRecipesController implements the CRUD actions for Recipe model.
 */
class AdminRecipesController extends Controller
{
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
     * Lists all Recipe models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecipeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Recipe model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Recipe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Recipe();
        $ingredients = ArrayHelper::map(Ingredient::find()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && !empty(Yii::$app->request->post('RecipeIngredients'))) {
            $modelIngredients = Yii::$app->request->post('RecipeIngredients');
            if ($model->save()) {
                foreach ($modelIngredients as $modelIngredient) {
                    $recipeIngredient = new RecipeIngredients();
                    $recipeIngredient->ingredient_id = $modelIngredient;
                    $recipeIngredient->recipe_id = $model->id;
                    $recipeIngredient->save();
                }
            } else {
                Yii::$app->session->setFlash('danger', 'Блюдо ' . $model->name . ' не сохранено.');
                return $this->render('create', [
                    'model' => $model,
                    'ingredients' => $ingredients,
                    'modelIngredients' => $modelIngredients
                ]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'ingredients' => $ingredients,
            ]);
        }
    }

    /**
     * Updates an existing Recipe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $ingredients = ArrayHelper::map(Ingredient::find()->all(), 'id', 'name');
        $modelIngredients = ArrayHelper::map($model->recipeIngredientsRel, 'rel_id', 'ingredient_id');
        if ($model->load(Yii::$app->request->post()) && !empty(Yii::$app->request->post('RecipeIngredients'))) {
            $modelIngredients = Yii::$app->request->post('RecipeIngredients');
            if ($model->save()) {
                RecipeIngredients::deleteAll(['recipe_id' => $id]);
                foreach ($modelIngredients as $modelIngredient) {
                    $recipeIngredient = new RecipeIngredients();
                    $recipeIngredient->ingredient_id = $modelIngredient;
                    $recipeIngredient->recipe_id = $model->id;
                    $recipeIngredient->save();
                }
            } else {
                Yii::$app->session->setFlash('danger', 'Блюдо ' . $model->name . ' не сохранено.');
                return $this->render('update', [
                    'model' => $model,
                    'ingredients' => $ingredients,
                    'modelIngredients' => $modelIngredients
                ]);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'ingredients' => $ingredients,
                'modelIngredients' => $modelIngredients
            ]);
        }
    }

    /**
     * Deletes an existing Recipe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        RecipeIngredients::deleteAll(['recipe_id' => $model->id]);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Recipe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Recipe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Recipe::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
