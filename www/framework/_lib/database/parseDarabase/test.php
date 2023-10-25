<?php

$path = dirname(__FILE__).'/../../trigger/trigger_sql.xml';
		
if(file_exists($path))
{
	require_once('Class.Parser.Database.php');
	
	$useParserDatabase = new ParserDatabase();
	$useParserDatabase->setFile($path);
	$useParserDatabase->setIni();
	$useParserDatabaseRetorno = $useParserDatabase->getDatabase();
	
	echo $useParserDatabaseRetorno;


}
		
?>