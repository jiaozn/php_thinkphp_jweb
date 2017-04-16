<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
class Index extends Controller
{
    public function index()
    {
		Session::set('user','jiao');
		return $this->fetch();
    }
}
