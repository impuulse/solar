<?php

namespace api\controllers\v1;

use api\controllers\ApiController;
use common\models\User;
use Yii;

/**
 * Контроллер пользователя
 */
class UserController extends ApiController
{
    /**
     * Данные пользователя
     * @param $id
     * @return array
     */
    public function actionIndex($id)
    {
        $model = User::find()
            ->where(['id' => Yii::$app->user->identity->getId()])
            ->asArray()
            ->one();

        if ($model) {
            $this->response['success'] = true;
            $this->response['data'] = $model;
        } else {
            $this->response['success'] = false;
            $this->response['message'] = 'Пользователь не существует';
        }

        return $this->response;
    }
}
