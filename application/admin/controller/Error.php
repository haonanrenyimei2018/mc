<?php

namespace app\admin\controller;


class Error extends Base
{
    public function index()
    {
		return $this->fetch('/index');	
    }


}
