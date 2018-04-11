<?php


class Log
{
	public function List($File, $Log)
	{
	
	 $List =  fopen($File, 'a+');
	 fwrite($List,"\r\n".$Log);
	 fclose($List);
	}
	public function View($File)
	{
	   $File;
	}
	
}


?>