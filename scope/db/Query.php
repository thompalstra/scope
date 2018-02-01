<?php
namespace scope\db;

use Scope;

class Query extends \scope\core\Base{

    public $select = '';
    public $from = '';

    public $arguments = [];

    public function select( $argument ){
        $this->select = $argument;
    }

    public function from( $argument ){
        if( class_exists( $argument )  ){
            $this->select( $argument::getTableName() . '.*' );
            $this->from( $argument::getTableName() );

        } else {
            $this->from = $argument;
        }
        return $this;
    }

    public function where( $argument ){
        $this->arguments[] = [
            'WHERE' => $argument
        ];
        return $this;
    }
    public function orWhere( $argument ){
        $this->arguments[] = [
            'OR' => $argument
        ];

        return $this;
    }
    public function andWhere( $argument ){
        $this->arguments[] = [
            'WHERE' => $argument
        ];

        return $this;
    }


    public function createCommand(){

        $lines = [];

        $lines[] = "SELECT $this->select";
        $lines[] = "FROM $this->from";

        foreach( $this->arguments as $argument ){
            foreach( $argument as $type => $data ){
                if( in_array( strtoupper( $type ), ['WHERE', "AND", "OR"] ) ){
                    $lines[] = strtoupper( $type ) . $this->createWhere( $data );
                }
            }
        }

        return implode(' ', $lines );
    }

    public function createWhere( $data ){
        $lines = [];

        if( isset($data[0]) && in_array( strtoupper($data[0]), ['AND', 'OR', 'WHERE'] ) ){
            $glue = $data[0];
            array_shift( $data );
            $lines[] = " ( " . $this->createGroup( $glue, $data ) . " ) ";
        } else if( isset($data[0]) ){
            $lines[] = $this->createParam( $data[1], $data[0], $data[2] );
        } else {

            $column = array_keys($data)[0];
            $value = $data[$column];
            $glue = '=';

            $lines[] = $this->createParam( $column, $glue, $value );
        }

        return implode(" ", $lines);
    }

    public function createParam( $column, $glue, $value ){

        $parts = explode('.', $column);
        foreach( $parts as $k => $v ){
            $parts[$k] = "`$v`";
        }
        $column = implode('.', $parts);

        return $column . ' ' . $glue . ' ' . $this->createValue( $value );
    }

    public function createGroup( $glue, $data ){
        $lines = [];
        foreach( $data as $k => $v ){
            $lines[] = $this->createWhere($v);
        }
        return implode( " $glue ", $lines );
    }

    public function createValue( $value ){
        if( $value === null ){
            return 'NULL';
        } else if( is_string($value) ){
            return Scope::$context->conn->quote( 'NULL' );
        }
        return $value;
    }
}
?>