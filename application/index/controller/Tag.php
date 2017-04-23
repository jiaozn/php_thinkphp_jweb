<?php
namespace app\index\controller;
use app\index\model\Tag as TagModel;
use app\index\model\Category as CategoryModel;
use think\Controller;
use app\index\model\Logs as LogsModel;
use think\Session;

class Tag extends Controller{
	
	public function index(){
		
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		$categorylist=CategoryModel::all();
		$this->assign('categorylist',$categorylist);
		$this->assign('categorycount',count($categorylist));
		
		// $list=TagModel::all();
		$list=TagModel::order('id desc')->paginate(15);
		$count=TagModel::count();
		$this->assign('taglist',$list);
		$this->assign('tagcount',$count);
		return $this->fetch();
	}
}
?>