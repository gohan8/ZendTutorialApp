<?php

namespace Serpens\Model;

use RuntimeException;
use Zendz\Db\TableGateway\TableGatewayInterface;

class PostTable {
    
    private $tableGateway;
    
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll()
    {
        $this->tableGateway->select();
    }
    
    public function getPost($id)
    {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (! $row) {
            throw RuntimeException(
                sprintf("No post found with id = %d.",$id));
        }
        return $row;
    }
    
    public function savePost(Post $post)
    {
        $data = [ 
            'header' => $post->header,
            'data' => $post->data, 'tags' => $post->tags,
            'owner' => $post->owner
        ];
        $id = (int) $post->id;
        
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;  
        }
        
        if (! $this->getPost($id)) throw RuntimeException(
                "Post id = %d does not exists. It can not br updated.",$id);
                
        $this->tableGateway->update($data, ['id' => $id]);
    }
    
    public function deletePost($id)
    {
        $tableGateway->delete(['id' => (int)$id]);    
    }
}
