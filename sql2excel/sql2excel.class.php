<?php
	/* 
	 * @version V1.0 2002/July/18 (c) Erh-Wen,Kuo (erhwenkuo@yahoo.com). All rights reserved.
	 * Released under both BSD license and Lesser GPL library license. 
	 * Whenever there is any discrepancy between the two licenses, 
	 * the BSD license will take precedence. 
	 *
	 * purpose: providing a easy method to write mysql sql content to excel file format and stream
	 *          the output to user's browser directly.
	 */

	include_once('excelgen.class.php');
	class Sql2Excel{
		var $db_host;
		var $db_user;
		var $db_pwd;
		var $db_name;
		var $db_query;
		
		
		/*Sql2Excel is class constructor
		  Return: None
		*/
		function Sql2Excel($db_host="localhost",$db_user="",$db_pwd="",$db_name="")
		{
			$this->db_host=$db_host;
			$this->db_user=$db_user;
			$this->db_pwd=$db_pwd;
			$this->db_name=$db_name;
			
			//connect mysql database
			$this->db_link=mysql_pconnect($this->db_host,$this->db_user,$this->db_pwd) or die("Mysql database connecion failed!");
		}//Sql2Excel() END
		
		/*ExcelOutput() is the key method to let this class works
		  This method won't work if you have not include "excelgen.class.php" well.
				  
		  Return: None
		*/
		function ExcelOutput($query="")
		{
			//connect mysql database
			mysql_select_db($this->db_name,$this->db_link);
			
			//get result
			$result=mysql_query($query);
			$numoffields=mysql_num_fields($result);
			
			// now we could construct Excel output
			$fieldstype=array();
			
			for($i=0;$i<$numoffields;$i++){
				$fieldstype[]=mysql_field_type($result,$i);
			}// for($i=0;...) END
			
			//create new instance of ExcelGen() class
			$excel = new ExcelGen("Sql2Excel");
			
			//initiate a counter for excel "ROW" counter
			$rowscounter=0;
			
			//write fields to excel
			for($i=0;$i<$numoffields;$i++){
				$fld=mysql_fetch_field($result,$i);
				$fldname=$fld->name;
				$excel->WriteText($rowscounter,$i,$fldname);
			}// for($i=0;...) END
			
			$rowscounter++;
			
			while($row=mysql_fetch_array($result)){
			
				//fetch each Cell($rowscounter,$colscounter) into Excel output stream
				for($colscounter=0;$colscounter<$numoffields;$colscounter++){
				
					//identify field type to descide how to write excel cell
					if(eregi("(int)",$fieldstype[$colscounter])){
						$excel->WriteNumber($rowscounter,$colscounter,$row[$colscounter]);
					}else{ 
						$excel->WriteText($rowscounter,$colscounter,$row[$colscounter]);
					}
				}//for($colscounter..) END
				$rowscounter++;
			}// while($row=mysql..) END
			$excel->SendFile();
			return;		
		}//ExcelOut() END		
	}//class Sql2Excel END
?>