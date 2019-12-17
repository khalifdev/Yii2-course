<?php

namespace app\models;

use yii\base\Model;
use yii\caching\DbDependency;
use yii\data\ActiveDataProvider;
use app\models\Activity;

/**
 * ActivitySearch represents the model behind the search form of `app\models\Activity`.
 */
class ActivitySearch extends Activity
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'isBlocked', 'userId'], 'integer'],
            [['title', 'description', 'files', 'startDateTime', 'endDateTime', 'email', 'createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Activity::find()->cache(15,new DbDependency(['sql' => 'select max(id) from activity']));

        // проверка на админа
        if(!\Yii::$app->rbac->canAdminActivity()){
            $query->andWhere([
                'userId' => \Yii::$app->user->getIdentity()->id
            ]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->with('user');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'startDateTime' => $this->startDateTime,
            'endDateTime' => $this->endDateTime,
            'isBlocked' => $this->isBlocked,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'userId' => $this->userId,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'files', $this->files])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
