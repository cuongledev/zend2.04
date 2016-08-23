<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        // get Service Demo
        /*$sm = $e->getApplication()->getServiceManager();
        $data = $sm->get("DemoService");
        echo '<pre>';
        print_r($data);*/
    }
    public function getServiceConfig(){
        return array(
            "abstract_factories" => array(),
            "aliases" => array(
                "MyTest" => "MyClassTest",
            ),
            "factories" => array(
                        "UserTable" => function($sm){
                            //$sm = $this->getServiceLocator();
                            $tableGateway = $sm->get("UserTableGateway");
                            $userTable = new \User\Model\UserTable($tableGateway);
                            return $userTable;
                        },
                        "UserTableGateway" => function($sm){
                            $db=$sm->get("Zend\Db\Adapter\Adapter");
                            $resultSet = new \Zend\Db\ResultSet\ResultSet;
                            $resultSet->setArrayObjectPrototype(new \User\Model\User);
                            $tableGateway = new \Zend\Db\TableGateway\TableGateway('web_user_admin',$db,null,$resultSet);
                            return $tableGateway;
                        },
                        "AllUser" => function($sm){
                            $userTable = $sm->get("UserTable");
                            return $userTable->fetchAll();
                        },
                        "DemoService" => "User\Service\Demo",
            ),
            "invokables" => array(
                "MyClassTest" => "User\Service\DemoInvokable",
                ),
            "services" => array(),
            "shares" => array(),
        );
    }
}
