<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


class UserController extends AbstractActionController{
    public function indexAction(){
    	$sm = $this->getServiceLocator();
     	$db = $sm->get('Zend\Db\Adapter\Adapter');
    	$query = $db->query("select * from web_user_admin where id = ?");
    	$data=$query->execute(array(6));
		foreach ($data as $item) {
			echo '<pre>';
			print_r($item);
			echo '<pre>';
		}
    	
        return new ViewModel();
    }
    public function index2Action(){
    	$sm = $this->getServiceLocator();
    	$db=$sm->get("Zend\Db\Adapter\Adapter");
    	$query = $db->query("INSERT INTO web_user_admin(name,email,password) VALUES(?,?,?)");
    	$query->execute(array("cuonghehe","cuonghehe@gmail.com","123456"));
    	return new ViewModel();
    }
    public function index3Action(){
    	$sm = $this->getServiceLocator();
    	$db=$sm->get("Zend\Db\Adapter\Adapter");
    	$query = $db->query("UPDATE web_user_admin SET password = md5(?) WHERE id = ?");
    	$query->execute(array("654321",6));
    	return new ViewModel();
    }
    public function index4Action(){
    	$sm = $this->getServiceLocator();
    	$db=$sm->get("Zend\Db\Adapter\Adapter");
    	$query = $db->query("DELETE FROM web_user_admin WHERE id = ?");
    	$query->execute(array(9));
    	return $this->redirect()->toRoute("user/index");
    	/*return $this->redirect()->toRoute('user', array(
    														'controller'=>'user',
												        	'action' => 'index',
												        	//'params' =>$params
												       )
  											);*/
    }
    public function index5Action(){
    	$sm = $this->getServiceLocator();
    	$db=$sm->get("Zend\Db\Adapter\Adapter");
    	$resultSet = new \Zend\Db\ResultSet\ResultSet;
    	$resultSet->setArrayObjectPrototype(new \User\Model\User);
    	$tableGateway = new \Zend\Db\TableGateway\TableGateway('web_user_admin',$db,null,$resultSet);
    	$userTable = new \User\Model\UserTable($tableGateway);
    	$data = $userTable->fetchAll();
    	foreach ($data as $key => $item) {
    		echo '<pre>';
    		print_r($item);
    	}
    	
    	return new ViewModel();
    }
    public function index6Action(){
    	$dataInput = array(
    		"name" => "hahaha",
    		"email" => "hahaha@gmail.com",
    		"password" => "123456",
    	);
    	$user = new \User\Model\User;
    	$user->exchangeArray($dataInput);
    	$sm = $this->getServiceLocator();
    	$db=$sm->get("Zend\Db\Adapter\Adapter");
    	$resultSet = new \Zend\Db\ResultSet\ResultSet;
    	$resultSet->setArrayObjectPrototype(new \User\Model\User);
    	$tableGateway = new \Zend\Db\TableGateway\TableGateway('web_user_admin',$db,null,$resultSet);
    	$userTable = new \User\Model\UserTable($tableGateway);
    	$userTable->saveUser($user);
    	echo "<h1>Done</h1>";
    	return new ViewModel();
    }
    public function index7Action(){
    	$sm = $this->getServiceLocator();
    	$db=$sm->get("Zend\Db\Adapter\Adapter");
    	$resultSet = new \Zend\Db\ResultSet\ResultSet;
    	$resultSet->setArrayObjectPrototype(new \User\Model\User);
    	$tableGateway = new \Zend\Db\TableGateway\TableGateway('web_user_admin',$db,null,$resultSet);
    	$userTable = new \User\Model\UserTable($tableGateway);
    	$data = $userTable->getUserById();
    	echo '<pre>';
    	print_r($data);
    	return new ViewModel();
    }
    public function index8Action(){
    	$sm = $this->getServiceLocator();
    	$db=$sm->get("Zend\Db\Adapter\Adapter");
    	$resultSet = new \Zend\Db\ResultSet\ResultSet;
    	$resultSet->setArrayObjectPrototype(new \User\Model\User);
    	$tableGateway = new \Zend\Db\TableGateway\TableGateway('web_user_admin',$db,null,$resultSet);
    	$userTable = new \User\Model\UserTable($tableGateway);
    	$data = $userTable->getUseWhere(11);
    	foreach ($data as $key => $value) {
    		echo '<pre>';
    		print_r($value);
    	}
    	return $this->getResponse();
    }
    public function index9Action(){
    	$sm = $this->getServiceLocator();
    	$db=$sm->get("Zend\Db\Adapter\Adapter");
    	$resultSet = new \Zend\Db\ResultSet\ResultSet;
    	$resultSet->setArrayObjectPrototype(new \User\Model\User);
    	$tableGateway = new \Zend\Db\TableGateway\TableGateway('web_user_admin',$db,null,$resultSet);
    	$userTable = new \User\Model\UserTable($tableGateway);
    	$data = $userTable->getUseWhereSql(11);
    	foreach ($data as $key => $value) {
    		echo '<pre>';
    		print_r($value);
    	}
    	return $this->getResponse();
    }
    public function index10Action(){
    	$sm = $this->getServiceLocator();
    	$db=$sm->get("Zend\Db\Adapter\Adapter");
    	$resultSet = new \Zend\Db\ResultSet\ResultSet;
    	$resultSet->setArrayObjectPrototype(new \User\Model\User);
    	$tableGateway = new \Zend\Db\TableGateway\TableGateway('web_user_admin',$db,null,$resultSet);
    	$userTable = new \User\Model\UserTable($tableGateway);
    	$data = $userTable->getUseJoin(11);
    	foreach ($data as $key => $value) {
    		echo '<pre>';
    		print_r($value);
    	}
    	return $this->getResponse();
    }
    public function index11Action(){
        $sm = $this->getServiceLocator();
        $userTable = $sm->get("UserTable");
        $data = $userTable->fetchAll();
        foreach ($data as $key => $value) {
            echo '<pre>';
            print_r($value);
        }
        return $this->getResponse();
    }
    public function index12Action(){
        $sm = $this->getServiceLocator();
        $data = $sm->get("AllUser");
        foreach ($data as $key => $value) {
            echo '<pre>';
            print_r($value);
        }
        return $this->getResponse();
    }
    public function index13Action(){
        $sm = $this->getServiceLocator();
        echo $sm->get("DemoService");
        return $this->getResponse();
    }
    public function index14Action(){
        $sm = $this->getServiceLocator();
        $data = $sm->get("MyTest");
        echo "<pre>";
        print_r($data->test());
        return $this->getResponse();
    }

}

