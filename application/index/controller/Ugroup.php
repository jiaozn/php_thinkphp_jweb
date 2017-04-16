<?php
namespace app\index\controller;
use app\index\model\Article as ArticleModel;
use app\index\model\Category as CategoryModel;
use app\index\model\Tag as TagModel;
use app\index\model\Comment as CommentModel;
use app\index\model\User as UserModel;
use app\index\model\Ugroup as UgroupModel;
use think\Request;
use think\Controller;

class Ugroup extends Controller{
	public function index(){
		$ugrouplist=UgroupModel::all();
		$this->assign('ugrouplist',$ugrouplist);
		$this->assign('ugroupcount',count($ugrouplist));
		return $this->fetch();
	}
	public function edit($id){
		$ugroup=UgroupModel::get($id);
		$this->assign('ugroup',$ugroup);
		return $this->fetch();
	}
	public function update(){
		$ugroup=UgroupModel::get($_POST['id']);
		$ugroup->ugroupname=$_POST['ugroupname'];
		$ugroup->save();
		return '修改分类成功';
	}
	public function add(){
		
	}
}

?>