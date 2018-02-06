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
        // $query = Scope::query()->update( self::className() );
        // $set = [];
        // $this->is_enabled = 0;
        // foreach( $this->_attributes as $k => $v ){
        //     $set[] = "$k=" . $query->createValue( $this->$k );
        // }
        //
        // $set = implode(',', $set);
        // $tableName = $this->getTableName();
        // $id = $this->id;
        // $sql = "UPDATE $tableName SET $set WHERE id=$id";
        //
        //
        // $sth = \Scope::$context->conn->prepare( $sql );
        // $sth->setFetchMode(\PDO::FETCH_CLASS, $this->className(), [
        //     $this->className() => [
        //         'isNewRecord' => false
        //     ]
        // ]);
        // $sth->execute();
        // var_dump( $sth->rowCount() );
        // var_dump( $sql );
        // die;
    }
}
?>
