 <?php

Serpens\Model;

class Post{
    
    public $id;
    public $header;
    public $body;
    public $owner;
    public $data;
    public $tags;
    
    public function exchangeArray($data)
    {
        $this->id = !empty(data['id']) ? data['id'] : null;
        $this->header = !empty(data['header']) ? data['header'] : null;
        $this->body = !empty(data['body']) ? data['body'] : null;
        $this->data = !empty(data['data']) ? data['data'] : null;
        $this->tags = !empty(data['tags']) ? data['tags'] : null;
    }
}
?>
