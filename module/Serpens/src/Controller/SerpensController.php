<?php

namespace Serpens\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SerpensController extends AbstractActionController {
    
    public function indexAction(){
        return new ViewModel([
            'list' => ['Item1','Item2','Item3'],
            'title'=> 'Syscorpious from view'
        ]);
    }
    
    public function addAction(){
        
    }
    
    public function editAction(){
        
    }
    
    public function deleteAction(){
        
    }
}
?>