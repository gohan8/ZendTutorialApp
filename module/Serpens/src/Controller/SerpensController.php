<?php

namespace Serpens\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SerpensController extends AbstractActionController {
    
    public $table;
    
    public function __construct(PostTable $table)
    {
        $this->table = $table;
    }
    
    public function indexAction(){
        return new ViewModel([
            'posts' => $table->fetchAll()
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