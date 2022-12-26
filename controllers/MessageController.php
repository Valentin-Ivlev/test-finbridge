<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\Request;

class MessageController extends ActiveController
{
    public $modelClass = 'app\models\Message';

    public function actions(): array
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'prepareDataProvider' => fn() => new ActiveDataProvider(
                [
                    'query' => $this->modelClass::find(),
                    'pagination' => false,
                ]
            ),
        ];

        return $actions;
    }

    public function actionSend()
    {

        $request = Yii::$app->request;
        $post = $request->post('text');

        define('TELEGRAM_TOKEN', '5850177043:AAEOAcN9CFlhU7rjZ6u7U3_MwN7gxujB1xw');

        define('TELEGRAM_CHATID', '71200151');

        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_POSTFIELDS => array(
                    'chat_id' => TELEGRAM_CHATID,
                    'text' => $post,
                ),
            )
        );
        return curl_exec($ch);
    }
}