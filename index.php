<?php 
	require_once "dropbox-sdk/Dropbox/autoload.php";
	use \Dropbox as dbx;

	$appInfo = dbx\AppInfo::loadFromJsonFile("config/app-info.json");
	$webAuth = new dbx\WebAuthNoRedirect($appInfo, "Rag");

	$authorizeUrl = $webAuth->start();

	echo $authorizeUrl;

	$authCode = "7FQ7CSCgO9EAAAAAAAAAARTJACK9hHoV-5F032mNDK0";

	list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
	print "Access Token: " . $accessToken . "<br>";

	$dbxClient = new dbx\Client($accessToken, "Rag");
	$accountInfo = $dbxClient->getAccountInfo();
	print_r($accountInfo);

	// $folderMetadata = $dbxClient->getMetadataWithChildren("/");
	// print_r($folderMetadata);

	$f = fopen("studio.pdf", "w+b");
	$fileMetaData = $dbxClient->getFile("studio.pdf");
	$fclose($f);
	print_r($fileMetaData);
 ?>