<?php
namespace app\index\controller;
use app\index\model\Category as CategoryModel;
use think\Controller;
use think\Db;
use think\Session;
use app\index\model\Logs as LogsModel;
use app\index\model\Tag as TagModel;
class Category extends Controller{
	public function index(){
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		$taglist=TagModel::paginate(20);
		$tagcount=TagModel::count();
		$this->assign('taglist',$taglist);
		$this->assign('tagcount',$tagcount);
		
		
		$categorylist=CategoryModel::all();
		$this->assign('categorylist',$categorylist);
		$this->assign('categorycount',count($categorylist));
		return $this->fetch();
	}
	
	public function input(){
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
		return $this->fetch();
	}
	public function add(){
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
		$category=new CategoryModel;
		$category->allowField(true)->save(input('post.'));
		return '新增成功！';
	}
	public function delete($id){
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>1){
			return '权限不够！';
		}
		if($id==1){
			return '默认分类不允许删除';
		}
		Db::query('update javaj_article set category_id = 1 where category_id=?',[$id]);
		$category=CategoryModel::get($id);
		$category->delete();
		return '删除分类成功';
	}
	public function edit($id){
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
		$category=CategoryModel::get($id);
		$this->assign('category',$category);
		return $this->fetch();
	}
	public function update(){
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		
			if(!Session::get('vip')){
			return '权限不够！';
		}
		if(Session::get('vip')->ugroup_id>2){
			return '权限不够！';
		}
		$category=CategoryModel::get($_POST['id']);
		$category->name=$_POST['name'];
		$category->save();
		return '修改分类成功';
	}
}


?>