<?php
namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use Yii;
class Category extends ActiveRecord
{
	static public function tableName()
	{	
		return "{{%category}}";
	}
	public function attributeLabels()
	{
		return [
		    'parentid' => '上级分类',
		    'title'    => '分类名称',
		];
	}
	public function rules()
	{
		return [
		   ['parentid', 'required', 'message'=>'请选择分类'],
		   ['title', 'required', 'message'=>'请输入分类名称'],
		   ['title', 'unique', 'message'=>'分类名称不能重复'],
		   ['createtime', 'safe'],
		];
	}
	public function add($data)
	{
		$data['Category']['createtime'] = time();
		if ($this->load($data) && $this->save()) {
			return true;
		}
		return false;
	}
	public function getData()
	{
		$data = self::find()->all();
		$data =ArrayHelper::toArray($data);
		return $data;
	}
	public function getTree($cates, $pid = 0, $level = 0)
	{
		$tree = [];
		foreach($cates as $cate){
			if ($cate['parentid'] == $pid) {
				$cate['title'] = str_repeat('-',$level).$cate['title'];
				$tree[] = $cate;
				$tree = array_merge($tree, $this->getTree($cates, $cate['cateid'], $level+4));
			}
		}
		return $tree;
	}
	public function getOptions()
	{
		$data = $this->getData();
		$tree = $this->getTree($data);
		$options = ['顶级分类'];
		foreach($tree as $v){
			$options[$v['cateid']] = $v['title'];
		}
		return $options;
	}
	public function getTreeList()
	{
		$data = $this->getData();
		$tree = $this->getTree($data);
		return $tree;
	}
}
