<?php 
namespace Music\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
class SongController extends AbstractActionController{
	public function playAction(){
		return new ViewModel();
	}
}