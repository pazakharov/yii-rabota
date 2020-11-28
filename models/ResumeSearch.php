<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Resume;
use yii\db\Query;

/**
 * ResumeSearch represents the model behind the search form of `\app\models\Resume`.
 */
class ResumeSearch extends Resume
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'author_id', 'specialization_id'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'birthdate', 'sex', 'city', 'mail', 'phone', 'about'], 'safe'],
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
        $query = Resume::find()->where('1=1')
            ->with('specialization')
            ->with('experiencs');

        $query->limit(100);


        $allowed = ['specialization_id', 'sex', 'city', 'author_id'];
        $data = array_intersect_key($params, array_flip($allowed));
        $query->andFilterWhere($data);

        $allowed = ['experience_dev'];
        $data = array_intersect_key($params, array_flip($allowed));
        $operand1 = '';
        $operand2 = '';
        $operand3 = '';
        $operand4 = '';
        foreach ($data as $experience) {
            foreach ($experience as $key => $value) {
                switch ($value) {
                    case 1:
                        $userQuery1 = (new Query())->select('resume_id')
                            ->from('experience')
                            ->groupBy('resume_id');

                        $operand1 = ['not in', 'id', $userQuery1];
                        break;

                    case 2:
                        $userQuery1 = (new Query())->select('resume_id, YEAR(FROM_DAYS( to_days(MAX(DATE2)) - to_days(Min(DATE1))))  as experience')
                            ->from('experience')
                            ->groupBy('resume_id')
                            ->Having('experience >= 1 AND experience <= 3');

                        $userQuery2 = (new Query())->select('resume_id')->from($userQuery1);

                        $operand2 = ['id' => $userQuery2];
                        break;

                    case 3:
                        $userQuery1 = (new Query())->select('resume_id, YEAR(FROM_DAYS( to_days(MAX(DATE2)) - to_days(Min(DATE1))))  as experience')
                            ->from('experience')
                            ->groupBy('resume_id')
                            ->Having('experience >= 3 AND experience <= 6');

                        $userQuery2 = (new Query())->select('resume_id')->from($userQuery1);
                        $operand3 = ['id' => $userQuery2];
                        break;

                    case 4:
                        $userQuery1 = (new Query())->select('resume_id, YEAR(FROM_DAYS( to_days(MAX(DATE2)) - to_days(Min(DATE1))))  as experience')
                            ->from('experience')
                            ->groupBy('resume_id')
                            ->Having('experience > 6 ');

                        $userQuery2 = (new Query())->select('resume_id')->from($userQuery1);
                        $operand4 = ['id' => $userQuery2];
                        break;
                }
            }
        }

        $query->andFilterWhere(['OR', $operand1, $operand2, $operand3, $operand4]);
        $allowed = ['schedules'];
        $data = array_intersect_key($params, array_flip($allowed));
        if (isset($data['schedules'])) {

            $userQuery1 = (new Query())->select('resume_id')
                ->from('resume_schedule_tbl')
                ->where(['schedule_id' => array_values($data['schedules'])])
                ->column();
            $query->andFilterWhere(['id' => $userQuery1]);
        }

        $allowed = ['employments'];
        $data = array_intersect_key($params, array_flip($allowed));
        if (isset($data['employments'])) {

            $userQuery1 = (new Query())->select('resume_id')
                ->from('resume_employment_tbl')
                ->where(['employment_id' => array_values($data['employments'])])
                ->column();
            $query->andFilterWhere(['id' => $userQuery1]);
        }

        $allowed = ['zp1'];
        $data = array_intersect_key($params, array_flip($allowed));
        foreach ($data as $key => $value) {
            $key = substr($key, 0, -1);
            $query->andFilterWhere(['>=', $key, $value]);
        }
        $allowed = ['zp2'];
        $data = array_intersect_key($params, array_flip($allowed));
        foreach ($data as $key => $value) {
            $key = substr($key, 0, -1);
            $query->andFilterWhere(['<=', $key, $value]);
        }

        $allowed = ['birthdate1'];
        $data = array_intersect_key($params, array_flip($allowed));
        foreach ($data as $key => $value) {
            $key = substr($key, 0, -1);
            $birthdate = \Yii::$app->formatter->asDateTime(mktime(0, 0, 0, '1', '1', date('Y') - (int)$value + 1), 'Y-M-d H:m:s');
            $query->andFilterWhere(['<=', $key, $birthdate]);
        }
        $allowed = ['birthdate2'];
        $data = array_intersect_key($params, array_flip($allowed));
        foreach ($data as $key => $value) {
            $key = substr($key, 0, -1);

            ((int)$value == 0) ? $value = 200 : '';
            $birthdate = \Yii::$app->formatter->asDateTime(mktime(0, 0, 0, 1, 1, date('Y') - $value), 'Y-M-d H:m:s');

            $query->andFilterWhere(['>=', $key, $birthdate]);
        }


        //var_dump($query);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $dataProvider;
    }
}
