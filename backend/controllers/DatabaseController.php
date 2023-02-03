<?php
class DatabaseController extends BaseController{
    public function getTables(){
        $sql = "show tables";
        $tables = Database::execQuery($sql);
        foreach ($tables as $key => $table) {
            $sql="desc ".$table[0];
            $columnsData = Database::execQuery($sql);
            $columns=[];
            foreach ($columnsData as $row => $value) {
                $columns[]=$value[0];
            }
            $fullTables[$table[0]]= $columns;
        }      
        $this->outputData($fullTables);
    }

    public function getRowsCount(){
        $params = $this->getParams();
        $tables = $params['table'];
        foreach ($tables as $key => $table) {
            $sql = "select count(1) from $table";
            $rowCount[] = Database::execQuery($sql);
        }
        $this->outputData($rowCount);
    }

    public function select(){
        $params = $this->getParams();
        $table = $params['table'][0];
        $columnsSql= "desc $table";
        $columnsData = Database::execQuery($columnsSql);
        foreach ($columnsData as $row => $value) {
            $columns[]=$value[0];
        }

        if (isset($params['columns']) && !empty($params['columns']) ) {
            $columns=$params['columns'];
            $sql_columns = "";
            foreach ($columns as $key => $value) {
                $value = Database::escape_string($value);
                if ($key == 0) {
                    $sql_columns .= $value;
                }else{
                    $sql_columns .= ",".$value;
                }
            }
            $sql="select $sql_columns from $table ";
        }else{
            $sql="select * from $table";
        }
        
        if (isset($params['search']) && isset($params['search_criteria']) && !empty($params['search']) && !empty($params['search_criteria'])) {
            $search=Database::escape_string($params['search'][0]);
            $search_criteria=$params['search_criteria'];
            $sql_search = "";
            foreach ($search_criteria as $key => $value) {
                $value = Database::escape_string($value);
                if ($key == 0) {
                    $sql_search .= $value." like \"%$search%\"";
                }else{
                    $sql_search .= " or ".$value." like \"%$search%\"";
                }
            }
            $sql .= " where $sql_search";
        }

        if (isset($params['order_by']) && !empty($params['order_by'])) {
            $order_by=Database::escape_string($params['order_by'][0]);
            $sql_orderBy = $order_by;

            if (isset($params['order_by_sense'])) {
                if ($params['order_by_sense'][0] == "desc") {
                    $sql_orderBy.=" desc";
                }else {
                    $sql_orderBy .= " asc";
                }
            }

            $sql .= " order by $sql_orderBy";
        }

        if(isset($params['limit']) && !empty($params['limit']) && is_numeric($params['limit'][0])){
            $limit=Database::escape_string($params['limit'][0]);
            $sql .= " limit $limit";
        }

        
        $rows = Database::execQuery($sql);
        $data = ['rows'=>$rows,'columns'=>$columns,'sql'=>$sql]; 
        $this->outputData($data);
    }

    public function createTable(){
        $params = $this->getParams();
        $tableName = $params['tableName'][0];
        $table = ucfirst($tableName);
        $modelTable = new $table();
        $createSql = $modelTable->createSql;

        $query = Database::execSql($createSql);
        

        
    }
}
