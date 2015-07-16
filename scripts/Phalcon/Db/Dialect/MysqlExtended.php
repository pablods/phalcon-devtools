<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 7/14/15
 * Time: 7:27 PM
 */


namespace Phalcon\Db\Dialect;

class MysqlExtended extends Mysql {

    /**
     * Returns the SQL column definition from a column
     *
     * @param \Phalcon\Mvc\Model\Column $column
     * @return string
     */
    public function getColumnDefinition($column)
    {


        $definition = $mysqltype = parent::getColumnDefinition($column);


        if($column->getMysqlType() && $column->getMysqlType() !=$mysqltype){
            $definition = $column->getMysqlType();
        }

        if(!$column->isNotNull()){
            $definition.= ' NULL';
        }


        if($column->getDefault()){
            $default = $column->getDefault();
            switch($column->getType()){
                case(\Phalcon\Mvc\Model\Column::TYPE_TEXT):
                case(\Phalcon\Mvc\Model\Column::TYPE_VARCHAR):
                    if($default != 'NULL')
                        $default= '\''.addcslashes($default,"'").'\'';
                    break;
                case(\Phalcon\Mvc\Model\Column::TYPE_DATETIME):
                case(\Phalcon\Mvc\Model\Column::TYPE_DATE):
                    switch($default){
                        case("CURENT_DATE"):
                        case("CURRENT_TIMESTAMP"):
                        case("NOW"):
                            break;
                        default:
                            $default = '\''.$default.'\'';
                    }
                    break;
            }
            $definition .= ' DEFAULT '.$default;
        }

        return $definition;
    }

}