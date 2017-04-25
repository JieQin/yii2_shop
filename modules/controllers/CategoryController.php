<?php
namespace app\modules\controllers;
use yii\web\Controller;
use app\models\Category;
use Yii;
class CategoryController extends Controller
{
	public $layout = false;
	public function actionList()
	{
		$this->layout = "layout1";
		$model = new Category;
		$data = $model -> getTreeList();
		return $this->render('cates', ['data'=>$data]);
	}
	public function actionAdd()
	{
		$this->layout = "layout1";
		$model = new Category();
		$data = $model->getOptions();
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if ($model->add($post)) {
				Yii::$app->session->setFlash('info','添加成功');
			}
		}
		return $this->render('add', ['model'=>$model, 'list'=>$data]);
	}	
	public function actionMod()
	{
		$this->layout = 'layout1';
		$cateid = Yii::$app->request->get('cateid');
		$model  = Category::find()->where('cateid = :id', [':id'=>$cateid])->one();
		if (Yii::$app->request->isPost) {
			$post = Yii::$app->request->post();
			if ($model->load($post) && $model->save()) {
				Yii::$app->session->setFlash('info', '修改成功');
			}
		}
		$data = $model->getOptions();
		return $this->render('add', ['model'=>$model, 'list'=>$data]);
	}
	public function actionDel()
	{
		try{
			$cateid = Yii::$app->request->get('cateid');
			if (empty($cateid)) {
				throw new \Exception('参数错误');
			}
			$data = Category::find()->where('parentid = :id', [':id'=>$cateid])->one();
			if ($data) {
				throw new \Exception('该分类有子分类,禁止删除');
			}
			if (!Category::deleteAll('cateid = :id', [':id'=>$cateid])) {
				throw new Exception('删除失败');
			}
		} catch(\Exception $e) {
			Yii::$app->session->setFlash('info', $e->getMessage());
		}
		return $this->redirect(['category/list']);
	}
}
