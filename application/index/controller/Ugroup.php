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
use app\index\model\Logs as LogsModel;
use think\Session;
class Ugroup extends Controller{
	public function index(){
		
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
		$ugrouplist=UgroupModel::all();
		$this->assign('ugrouplist',$ugrouplist);
		$this->assign('ugroupcount',count($ugrouplist));
		return $this->fetch();
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
		if(Session::get('vip')->ugroup_id>1){
			return '权限不够！';
		}
		$ugroup=UgroupModel::get($id);
		$this->assign('ugroup',$ugroup);
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
		if(Session::get('vip')->ugroup_id>1){
			return '权限不够！';
		}
		$ugroup=UgroupModel::get($_POST['id']);
		$ugroup->ugroupname=$_POST['ugroupname'];
		$ugroup->save();
		return '修改分类成功';
	}
	public function add(){
		
	}
}

?>