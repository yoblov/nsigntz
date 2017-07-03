<?php

namespace common\modules\recipes\controllers;

use common\filters\AccessControl;
use common\models\RecipeSearch;
use Yii;
use common\models\Ingredient;
use common\models\IngredientSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminIngredientsController implements the CRUD actions for Ingredient model.
 */
class UserSearchController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    /**
     * Lists all Ingredient models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecipeSearch();
        $ingredients = ArrayHelper::map(Ingredient::find()->all(), 'id', 'name');
        $emptyText = 'Ничего не найдено';
        $dataProvider = $searchModel->searchUser(Yii::$app->request->queryParams, $emptyText);
        $models = $dataProvider->getModels();
        $ingredientsRequest = $searchModel->name;
        if (count($models) > 0) {
            $separatedModels = $this->getSeparatedModels($models, $ingredientsRequest);
            $models = [];
            if (!empty($separatedModels['fullConcurrenceModels'])) {
                $models = $separatedModels['fullConcurrenceModels'];
            } elseif (!empty($separatedModels['partiallyConcurrenceModels'])) {
                $models = $separatedModels['partiallyConcurrenceModels'];
                usort($models, array('common\models\RecipeSearch','sortByIngredients'));
            };
            $dataProvider->setModels($models);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ingredients' => $ingredients,
            'emptyText' => $emptyText
        ]);
    }

    public function getSeparatedModels($models, $ingredients)
    {
        $result = [
            'fullConcurrenceModels' => [],
            'partiallyConcurrenceModels' => []
        ];
        foreach ($models as $model) {
            $modelIngredients = ArrayHelper::getColumn($model->recipeIngredients, 'id'); //Массив
            $concurrenceIngredientsCount = count(array_intersect($ingredients, $modelIngredients));
            $requestIngredientsCount = count($ingredients);
            if ($concurrenceIngredientsCount == $requestIngredientsCount) {
                $result['fullConcurrenceModels'][] = $model;
            } elseif ($concurrenceIngredientsCount >= 2) {
                $result['partiallyConcurrenceModels'][] = $model;
            }
        }
        return $result;
    }


}
