<?php
namespace app\index\controller;
use app\index\model\Article as ArticleModel;
use app\index\model\Category as CategoryModel;
use app\index\model\Tag as TagModel;
use app\index\model\Comment as CommentModel;
use app\index\model\User as UserModel;
use app\index\model\Ugroup as UgroupModel;
use app\index\model\Logs as LogsModel;
use think\Request;
use think\Controller;
use think\Db;
use think\Session;

class Logs extends Controller{
	public function index(){
		
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		
		$list=LogsModel::paginate(20);
		$count=LogsModel::count();
		$this->assign('list',$list);
		$this->assign('count',$count);
	
		// $cip=LogsModel::getIp();
		// dump($cip);
		
		// dump($this->request->url());
		
		
		
		// $logsmodel=new LogsModel;
		// $logsmodel->addlog($this->request);
		
		
	/* 	$from=LogsModel::getIp();
		$to=$this->request->url();
		$uid=Session::get('vip')?Session::get('vip')['id']:'1';
		dump($from);
		dump($to);
		dump($uid); */
	
		$logs=new LogsModel;
		$logs->from=LogsModel::getIp();
		$logs->to=$this->request->url();
		$logs->user_id=Session::get('vip')?Session::get('vip')['id']:1;
		$logs->save();
		
		
		return $this->fetch();
	}

	
	
}
?>