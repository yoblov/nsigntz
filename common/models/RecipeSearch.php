<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Recipe;
use yii\helpers\ArrayHelper;

/**
 * RecipeSearch represents the model behind the search form about `common\models\Recipe`.
 */
class RecipeSearch extends Recipe
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'short_description', 'full_description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Recipe::find();
        $query->joinWith('recipeIngredients');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            //uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'full_description', $this->full_description]);
        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchUser($params, &$emptyText = 'Ничего не найдено')
    {
        $query = Recipe::find();
        $query->joinWith('recipeIngredients');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (empty($this->name) || !is_array($this->name) || count($this->name) < 2) {
            $query->where('0=1');
            $emptyText = 'Укажите больше ингредиентов';
            return $dataProvider;
        }

        if (!$this->validate()) {
            //uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);
        $query->andFilterWhere(['in', Ingredient::tableName() . '.id', $this->name])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'full_description', $this->full_description]);
        return $dataProvider;
    }


    public static function sortByIngredients($a, $b)
    {
        var_dump(Yii::$app->request->queryParams['name']);
        $ingredients = Yii::$app->request->queryParams['name'];
        $aIngredients = ArrayHelper::getColumn($a->recipeIngredients, 'id'); //Массив
        $bIngredients = ArrayHelper::getColumn($b->recipeIngredients, 'id'); //Массив
        $concurrenceIngredientsCount = count(array_intersect($ingredients, $modelIngredients));
        $requestIngredientsCount = count($ingredients);

        if ($a->id == $b->id) return 0;
        return ($a->id < $b->id) ? -1 : 1;
    }
}
