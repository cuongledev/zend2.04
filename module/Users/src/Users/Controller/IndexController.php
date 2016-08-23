<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\EventManager\EventManager;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    public function event01Action(){
    	$e = new EventManager();
    	$e->attach("demo123",function($e){
    		$name = $e->getName();
    		$params= json_encode($e->getParams());
    		echo "Event Call , Event Name: $name , params : $params";
    	});
    	$e->trigger("demo123",null,array(12,13,14));
    	return new ViewModel();
    }
    public function event02Action(){
    	$e = new EventManager();
    	$e->attach("demo234",array("User\Event\DemoEvent","test123"));
    	$e->trigger("demo234");
    	return $this->getResponse();
    }
}
