<?php
namespace scope\base;

use Scope;

class Model extends \scope\core\Base{
    public $isNewRecord = true;

    public function save( $validate = true ){
        if( $validate && !$this->validate() ){
            return;
        }
        if( $this->isNewRecord ){
            return $this->createRecord();
        } else {
            return $this->updateRecord();
        }
    }

    public function updateRecord(){

        $set = [];
        $where = '';

        foreach( $this->_attributes as $k => $v ){
            $set[$k] = $this->$k;
        }
        $where = "id = $this->id";

        return Scope::query()->updateAll( self::className(), $set, $where );
    }
}
?>
