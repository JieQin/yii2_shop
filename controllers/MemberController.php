<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\User;
use Yii;
class MemberController extends Controller{
	public $layout = false;
	public function actionAuth(){
		$this->layout = 'layout2';
		$model = new User;
		return $this->render('auth', ['model'=>$model]);
	}
	public function actionReg()
	{
		$this->layout = 'layout2';
		$model = new User;
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if ($model->regByMail($post)) {
				Yii::$app->session->setFlash('info', '电子邮件发送成功');
			}
		}	
		return $this->render('auth', ['model'=>$model]);
	}
}
