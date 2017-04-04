<?php
/**
 * Yii2 Shortcuts
 * @author Eugene Terentev <eugene@terentev.net>
 * -----
 * This file is just an example and a place where you can add your own shortcuts,
 * it doesn't pretend to be a full list of available possibilities
 * -----
 */

/**
 * @return int|string
 */
function getMyId()
{
    return Yii::$app->user->getId();
}

/**
 * @param array $url
 * @return string
 */
function url($url=[]){

   return \yii\helpers\Url::to($url,true);
}

/**
 * @param $field
 * @param $symbols
 * @param string $ender
 * @return string
 */
function truncrate($field, $symbols, $ender = '...'){
    return \yii\helpers\StringHelper::truncate($field,$symbols, $ender, null, true);
}


/**
 * @param string $view
 * @param array $params
 * @return string
 */
function render($view, $params = [])
{
    return Yii::$app->controller->render($view, $params);
}

/**
 * @param $view
 * @param array $params
 * @return mixed
 */
function renderInView($view, $params = []){
    return $this->render($view,$params);
}
/**
 * @param $url
 * @param int $statusCode
 * @return \yii\web\Response
 */
function redirect($url, $statusCode = 302)
{
    return Yii::$app->controller->redirect($url, $statusCode);
}

/**
 * @param $form \yii\widgets\ActiveForm
 * @param $model
 * @param $attribute
 * @param array $inputOptions
 * @param array $fieldOptions
 * @return string
 */
function activeTextinput($form, $model, $attribute, $inputOptions = [], $fieldOptions = [])
{
    return $form->field($model, $attribute, $fieldOptions)->textInput($inputOptions);
}

function user(){
    return Yii::$app->user;
}

function userModel(){
    return \common\models\User::findOne(['id'=>user()->getId()]);
}

function l($text,$url,$options = []){
    return \yii\helpers\Html::a($text,$url,$options);
}

function getAvatar($id){
    $model = \common\models\UserProfile::find()->where(['user_id' => $id])->one();
    return $model->avatar_path;
}
