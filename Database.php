<?php
/**
 *  This file handles connection to the database and can be used by Models to
 *  handle incoming requests for creating, updating and deleting.
 *
 *  The PDO class is used to handle connections.
 *  http://php.net/manual/en/class.pdo.php
 *
 *  Based on Codecourse PDO Wrapper:
 *  https://www.youtube.com/watch?v=3_alwb6Twiw&list=PLfdtiltiRHWF5Rhuk7k4UAU1_yLAZzhWc&index=7
 *
 *  Example of usage (getting all rows from the table 'users' where id is greater than zero):
 *  $users = Database::getInstance()->get('users', array('id', '>', '0'))->results();
 *
 *  Methods:
 *  getInstance() - Instantiate database wrapper
 *  query()       - Basic database query
 *  action()      - Action (select, insert, delete, update)
 *  insert()      - Insert row
 *  delete()      - Delete row
 *  update()      - Update row
 *
 */

namespace BasicMVC;

class Database {

	private static $instance = null;

	private $pdo;
	private $query;
	private $error = false;
	private $results;
	private $count = 0;

    private function __construct() {

        $database = 'studioKpi';
        $host     = 'localhost';
        $port     = '8888';
        $username = 'root';
        $password = 'root';

        try {
        	/* Establish connection to database */
      		$this->pdo = new \PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

	        /* Set PDO to use Exceptions for handling errors */
	        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $e) {
        	die('PDO:' . $e->getMessage());
        }
    }

    /**
     *   Implementation of Singleton Pattern.
     *
     *	 Read more about the Singleton Pattern here:
     *	 http://www.oodesign.com/singleton-pattern.html
     */
    public static function getInstance() {
    	if (!isset(self::$instance)) {
    		self::$instance = new Database;
    	}
    	return self::$instance;
    }

	/* Basic Query Function
     *
     * Example: query("GET * FROM table WHERE $id = ?", [$targetId])
     */
    public function query($sql, $params = array()) {

    	/* Return error status to false */
    	$this->error = false;

    	/* Set query as prepared sql statement */
    	if($this->query = $this->pdo->prepare($sql)) {

    		/* If there are parameters
                Bind each parameter */
    		if (count($params)) {
    			$x = 1;
    			foreach ($params as $param) {
    				$this->query->bindValue($x, $param);
    				$x++;
    			}
    		}
    		/* If query executes successfully */
    		if ($this->query->execute()) {

                /* Set row count */
                $this->count = $this->query->rowCount();

            	/* Fetch result as Object and put them into $results */

                //$this->results = $this->query->fetchAll(PDO::FETCH_OBJ);


    		} else {
    			$this->error = true;
    		}
    	}
    	return $this;
    }

    /* SELECT query builder, uses query() */
    /* TODO - Add second selection parameter */
    public function action($action, $table, $where = [], $andwhere = []) {

        /* If there are selection parameters (where) AND second selection
         * parameters (andwhere).
         */
        $validOperators = ['=', '>', '<', '>=', '<='];

    	if (count($where) === 3 AND $andwhere === 3) {

    		$field    = $where[0];
    		$operator = $where[1];
    		$value    = $where[2];

            $field2    = $andwhere[0];
            $operator2 = $andwhere[1];
            $value2    = $andwhere[2];

    		if (in_array($operator, $validOperators) AND in_array($operator2, $validOperators)) {
                $sql = $action . ' FROM ' . $table . ' WHERE ' . $field . ' ' . $operator . ' ? AND ' . $field2 . ' ' . $operator2 . ' ?';
    		}

            /* run query  */
            if (!$this->query($sql, [$value, $value2])->error()) {
                return $this;
            }
    	}

        /* If there's only the first three selection parameters */
        if (count($where) === 3) {

            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];

            if (in_array($operator, $validOperators)) {
                $sql = $action . ' FROM ' . $table . ' WHERE ' . $field . ' ' . $operator . ' ?';
            }

            /* run query */
            if (!$this->query($sql, [$value])->error()) {
                return $this;
            }
        }
    	return false;
    }

    /* SELECT query helper */
    public function get($table, $where) {
    	return $this->action('SELECT *', $table, $where);
    }

    /* DELETE query helper */
    public function delete($table, $where) {
    	return $this->action('DELETE', $table, $where);
    }

    /* INSERT query helper */
    public function insert($table, $fields = []) {
    	if (count($fields)) {

            $keys   = array_keys($fields);
    		$values = "";
    		$x      = 1;

    		/* Build string of ?, one for each field */
    		foreach ($fields as $field) {
    			$values .= "?";
    			if ($x < count($fields)) {
    				$values .= ", ";
    			}
    			$x++;
    		}

    		/* Build SQL query */
    		$sql = "INSERT INTO " . $table . " (" . implode(', ', $keys) . ") VALUES (" . $values . ")";
            //echo $sql;
    		/* Run query */
    		if (!$this->query($sql, $fields)->error()) {
    			return true;
    		}
    	}
    	return false;
    }

    /* UPDATE query helper */
    public function update($table, $id, $fields) {
    	$set = '';
    	$x = 1;

    	/* Build string of bindable paramaters */
    	foreach ($fields as $column => $value) {
    		$set .= $column . " = ?";
    		if ($x < count($fields)) {
    			$set .= ", ";
    		}
    		$x++;
    	}

    	/* Build query */
    	$sql = "UPDATE " . $table . " SET " . $set . " WHERE id = " . $id;

    	/* Run query */
    	if (!$this->query($sql, $fields)->error()) {
    		return true;
    	}
    	return false;
    }

    /* Return results from latest query */
	public function results() {
        $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
		return $this->results;
	}

	/* Return first row from latest query */
    public function first() {
    	return $this->results()[0];
    }

    /* Return error status from latest query */
    public function error() {
    	return $this->error;
    }

    public function count()
    {
        return $this->count;
    }
 /*
    public function mysqlFetchArray($result) {
	    $table_result = array();
	    $r = 0;
	    while ($row = mysql_fetch_assoc($result)) {
	        $arr_row = array();
	        $c = 0;
	        while ($c < mysql_num_fields($result)) {
	            $col = mysql_fetch_field($result, $c);
	            $arr_row[$col->name] = $row[$col->name];
	            $c++;
	        }
	        $table_result[$r] = $arr_row;
	        $r++;
	    }
	    return $table_result;
	}
	public function returnWhere($myTab, $row, $value) {
	    $result = mysql_query("SELECT * FROM $myTab WHERE $row = '$value' ");
	    return mysqlFetchArray($result);
	}

	public function returnWhereSort($myTab, $row, $value, $sort) {
	    $result = mysql_query("SELECT * FROM $myTab WHERE $row = '$value' ORDER BY $sort DESC");
	    return mysqlFetchArray($result);
	}

	public function returnWhereNot($myTab, $row, $value) {
	    $result = mysql_query("SELECT * FROM $myTab WHERE $row != '$value' ");
	    return mysqlFetchArray($result);
	}

	public function returnDbTab($tab) {
	    $result = mysql_query("SELECT * FROM $tab ORDER BY id DESC");
	    return mysqlFetchArray($result);
	}

	public function returnDbTabSortBy($tab,$sortBy){
	       $result = mysql_query("SELECT * FROM $tab order by name");
	    return mysqlFetchArray($result);
	}
*/
}
