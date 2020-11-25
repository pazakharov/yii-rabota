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
        $query = Resume::find()->where( '1=1')->with('specialization')->with('opyts');


       // $this->load($params);
           
        //if (!$this->validate()) {

       //      $query->where('0=1');
           
      //  }
        

        $allowed_strict = ['specialization_id', 'sex', 'city'];
        $data = array_intersect_key($params, array_flip($allowed_strict));
        $query->andFilterWhere($data);
        
        
        
        $allowed_strict = ['opyt_dev'];
        $data = array_intersect_key($params, array_flip($allowed_strict));
        
        foreach ($data as $opyt){
        
            foreach ($opyt as $key => $value){
            
             switch($value){
              
              
                case 1: 

                        $userQuery1 = (new Query())->select('resume_id')
                                                    ->from('opyt')
                                                    ->groupBy('resume_id');
                                                    
                            $query->orFilterWhere(['not in', 'id' , $userQuery1]);
                break;
                case 2: 

                        $userQuery1 = (new Query())->select('resume_id, YEAR(FROM_DAYS( to_days(MAX(DATE2)) - to_days(Min(DATE1))))  as opyt')
                                                    ->from('opyt')
                                                    ->groupBy('resume_id')
                                                    ->Having( 'opyt >= 1 AND opyt <= 3');

                        $userQuery2 = (new Query())->select('resume_id')->from($userQuery1);

                            $query->orFilterWhere([ 'id' => $userQuery2]);
                break;            
                case 3: 

                        $userQuery1 = (new Query())->select('resume_id, YEAR(FROM_DAYS( to_days(MAX(DATE2)) - to_days(Min(DATE1))))  as opyt')
                                                    ->from('opyt')
                                                    ->groupBy('resume_id')
                                                    ->Having( 'opyt >= 3 AND opyt <= 6');

                        $userQuery2 = (new Query())->select('resume_id')->from($userQuery1);

                            $query->OrFilterWhere(['id' => $userQuery2]);
                break;
                case 4: 

                        $userQuery1 = (new Query())->select('resume_id, YEAR(FROM_DAYS( to_days(MAX(DATE2)) - to_days(Min(DATE1))))  as opyt')
                                                    ->from('opyt')
                                                    ->groupBy('resume_id')
                                                    ->Having( 'opyt > 6 ');

                        $userQuery2 = (new Query())->select('resume_id')->from($userQuery1);

                            $query->orFilterWhere(['id' => $userQuery2]);
                        break;

              }
        }
    }
        
            



        $allowed_1 = ['zp1'];
        $data = array_intersect_key($params, array_flip($allowed_1));
        foreach ($data as $key => $value){
            $key=substr($key,0,-1);
            $query->andFilterWhere(['>=',$key,$value]);
        }
        $allowed_2 = ['zp2'];
        $data = array_intersect_key($params, array_flip($allowed_2));
        foreach ($data as $key => $value){
            $key=substr($key,0,-1);
            $query->andFilterWhere(['<=',$key,$value]);
        }
        
        $allowed_age1 = ['birthdate1'];
        $data = array_intersect_key($params, array_flip($allowed_age1));
        foreach ($data as $key => $value){
            $key=substr($key,0,-1);
            $birthdate = \Yii::$app->formatter->asDateTime(mktime(0, 0, 0, '1', '1', date('Y')-(int)$value+1),'Y-M-d H:m:s');
            $query->andFilterWhere(['<=',$key,$birthdate]);
        }
        $allowed_age2 = ['birthdate2'];
        $data = array_intersect_key($params, array_flip($allowed_age2));
        foreach ($data as $key => $value){
            $key=substr($key,0,-1);
           
            ((int)$value == 0)?$value = 200:'';
            $birthdate = \Yii::$app->formatter->asDateTime(mktime(0, 0, 0,1,1, date('Y')-$value),'Y-M-d H:m:s');
           
            $query->andFilterWhere(['>=',$key,$birthdate]);
        }

       
        

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);

        return $dataProvider;
    }
}
