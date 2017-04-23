<?php
namespace app\index\controller;
use app\index\model\Logs as LogsModel;
use think\Controller;
use think\Session;

class Logs extends Controller{
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