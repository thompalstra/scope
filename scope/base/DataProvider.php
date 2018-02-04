<?php
namespace scope\base;

class DataProvider extends \scope\core\Base{

    public $pagination = [
        'page' => 1,
        'pageSize' => 15
    ];

    public function getData(){
        if( get_class($this->data) == 'scope\db\Query' ){
            return $this->getDataFromQuery();
        } else {
            return $this->getDataFromArray();
        }
    }
    public function getDataFromArray(){

    }
    public function getDataFromQuery(){

        if( $this->pagination !== false ){

            $p = $this->pagination['page'] - 1;

            $offset = $p * $this->pagination['pageSize'];
            $limit = $this->pagination['pageSize'];

            $this->data->limit( $limit );
            $this->data->offset( $offset );
        }

        return $this->data->all();
    }
}
?>
