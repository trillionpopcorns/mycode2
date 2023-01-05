<?php

define("DefaultDBServer","localhost");
define("MyDBUser","root");
define("MyDBPasswd","");  
define("DefaultDBName","mysql");

class MyDB {
	
	var $DbResult;
	var $CurRow;
  var $connect;
  
	function MyDB() {
		
	}
	function Connect($mydbdomain, $mydbuser, $mydbpasswd, $mydbname) {
//		@mysql_query("set names euckr");//mysql 4���� �ϰ��
		$this->connect=mysqli_connect( $mydbdomain, $mydbuser, $mydbpasswd) or  die( "Connection Failed"); 
		if(!$this->connect){
			echo "DB Connect Error";
		  exit;
		}
		mysqli_select_db($this->connect,$mydbname);

		//@mysqli_query("set names euckr");//mysql 5�̻� �ϰ��
	}
	
	function Query($query) {
		$start_time = (int)time() + (int)microtime();
		if(!$result = mysqli_query($this->connect, $query)) {
			echo "DB ����";

			return false;
		}
		else {

			$this->DbResult = $result;
			return true;
			//mysql_free_result($result);
		}
	}

	function NextRow()
	{
		$this->CurRow = @mysqli_fetch_array($this->DbResult);
		
		if (!$this->CurRow)
			return false;
		else
			return $this->CurRow;
	}
	
	function NextRowAssoc()
	{
		$this->CurRow = @mysqli_fetch_assoc($this->DbResult);
		
		if (!$this->CurRow)
			return false;
		else
			return $this->CurRow;
	}
	function NextRowIndex()
	{
		$this->CurRow = @mysql_fetch_row($this->DbResult);
		
		if (!$this->CurRow)
			return false;
		else
			return $this->CurRow;
	}

	function TotalRows()
	{
		$total_rows = @mysqli_affected_rows($this->connect);
		
		if(!$total_rows) return false;
		else return $total_rows;
	}
	
	function close() {
		mysqli_close();
	}
}

?>