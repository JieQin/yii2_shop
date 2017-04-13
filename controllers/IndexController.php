<?php
namespace app\controllers;
use yii\web\Controller;
class IndexController extends Controller{
	//第三种方法禁止layout布局
	//public $layout = false;
	public function actionIndex(){
		//第一种:通过禁止加载layout公共布局.
		//$this->layout = false;
		//第二种:使用renderPartial,也可以不加载layout布局
		//return $this->renderPartial('index');
		$this->layout = "layout1";
		return $this->render('index');
	}
}
