<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class ArticleSearch extends Article
{
    public function rules()
    {
        return [
            [['title'], 'safe'], // Add other fields as necessary
        ];
    }

    public function search($params)
    {
        $query = Article::find() ->orderBy('created_at DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider; // Return all articles if validation fails
        }

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
?>