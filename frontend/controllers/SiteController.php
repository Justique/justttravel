<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\Cities;
use common\models\Countries;
use common\models\TourfirmsReviews;
use common\models\Tours;
use common\models\UserIformation;
use frontend\models\ContactForm;
use Yii;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public static function getCountries(){
        $countries = Countries::find()->all();
        return $countries;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'set-locale'=>[
                'class'=>'common\actions\SetLocaleAction',
                'locales'=>array_keys(Yii::$app->params['availableLocales'])
            ]
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tours::find()->with(['tourfirm', 'tourAttachments'])->orderBy('published_at desc')->limit(6)->all(),
        ]);
        $newReviews = TourfirmsReviews::find()->where(['status'=>1])->orderBy('date_create desc')->limit(4)->all();
        $countries = Countries::find()->with('tours')->orderBy('name asc')->all();
        $big = Article::find()->where(['is_big'=>1])->one();
        $article = Article::find()->where(['is_big' => 0])->andWhere(['status' => 1])->orderBy('created_at DESC')->limit(8)->all();
        /*if (!$big) {
            throw new NotFoundHttpException('Нет большой картинки, поставьте чекбокс is_big хотя бы на одной новости');
        }*/
        return $this->render('index',['big'=>$big,'tours' => $dataProvider, 'newReviews'=>$newReviews,'articles'=>$article, 'countries'=>$countries]);
    }
    
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->contact(Yii::$app->params['adminEmail'])) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>Yii::t('frontend', 'Thank you for contacting us. We will respond to you as soon as possible.'),
                    'options'=>['class'=>'alert-success']
                ]);
                return $this->refresh();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body'=>\Yii::t('frontend', 'There was an error sending email.'),
                    'options'=>['class'=>'alert-danger']
                ]);
            }
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    public function actionCitylist($q = null, $id = null) {
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$out = ['results' => ['id' => '', 'text' => '']];
		if (!is_null($q)) {
			$query = new Query;
			$query->select('id, city AS text')
				->from('tbl_cities')
				->where(['like', 'city', $q])
				->limit(20);
			$command = $query->createCommand();
			$data = $command->queryAll();
			$out['results'] = array_values($data);
		}
		elseif ($id > 0) {
			$out['results'] = ['id' => $id, 'text' => City::find($id)->name];
		}
		return $out;
	}
    /**
     * 
     */
    public function actionFeedback()
    {
        $request = Yii::$app->request;
        $post = $request->post();

        $model = new ContactForm;
        $model->load($post);
        if ($request->isAjax && !$request->isPjax && $request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        } elseif (Yii::$app->request->isPjax && $model->validate()) {
            $model->contact(Yii::$app->params['adminEmail']);
            Yii::$app->session->setFlash('alert', 'Спасибо за сообщение об ошибке!');
            return $this->redirect(['index']);
        }

        return $this->renderAjax('_feedback', [
                    'model'      => $model,
        ]);
    }

    public function actionCities(){
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getCityList($cat_id);
                $selection = '';
                if (!empty($_POST['depdrop_params'])) {
                    $selection = $_POST['depdrop_params'][0];
                }
                echo Json::encode(['output' => $out, 'selected' => $selection]);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getCityList($id){ 
        $data = Cities::find()->select(['id', 'city', 'country_id'])->where(['country_id'=>$id])->asArray()->all();
        $array = [];
        foreach($data as $item){
            $array[$item['id']] = [
                'id'=>$item['id'],
                'name' => $item['city']
            ];
        }

        return $array;
    }
    
    /**
     * Просмотр моделей City.
     * @return mixed
     */
    public function actionSearchCities($q, $pid=false)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '', 'lat' => 0, 'lon' => 0]];
        if ($q) {
            $data = [];
            $query = Cities::find();
            if($pid) {
                $query->andWhere(['country_id' => $pid]);
            }
            
            $cities = $query
                    ->andWhere(['like', 'city', $q . '%', false])
                    ->limit(100)
                    ->all();
            foreach ($cities as $city) {
                $data[] = [
                    'id'   => $city->id,
                    'text' => $city->getFullTitle(),
                ];
            }
            $out['results'] = $data;
        }
        return $out;
    }

    public function actionNotuser() {
            echo Json::encode(
                [
                    'errorNotUser' => ' '
                ]
            );
    }

    public function actionInformations(){
        $model = new UserIformation();
        if($model->load(yii::$app->request->post()) && $model->save()){
            echo Json::encode(
                [
                    'closeModal'=>'#leave-report-form',
                    'success'=>' '
                ]
            );
        }
    }

    public function actionNoactive()
    {
        return $this->render('noactive');
    }
}
