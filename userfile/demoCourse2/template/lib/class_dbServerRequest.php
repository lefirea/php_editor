<?php

class DBServerRequest{
	private $dbServerPath;

	function __construct($dbServerPath){
		$this->dbServerPath = $dbServerPath;
	}

	function getDBList($id, $token, $lang=null, $courseID=null){
		$postdata = array('id'=>$id);
		if(!is_null($lang)) $postdata['lang'] = $lang;
		if(!is_null($courseID)) $postdata['courseID'] = $courseID;

		$result = $this->authHTTP('getDBList', $postdata, $token);
		return($result);
	}
	function useDB($id, $token, $dbLabel){
		$postdata = array('id'=>$id, 'dbLabel' => $dbLabel);
		$result = $this->authHTTP('useDB', $postdata, $token);
		return($result);
	}
	function query($id, $token, $query){
		$postdata = array('id'=>$id, 'query' => $query);
		$result = $this->authHTTP('query', $postdata, $token);
		return($result);
	}
	function getDBPath($id, $token, $dbLabel){
		$postdata = array('id'=>$id, 'dbLabel' => $dbLabel);
		$result = $this->authHTTP('getDBPath', $postdata, $token);
		return($result);
	}

	function authHTTP($mode, $postdata, $token){
		// HTTPヘッダの内容(※ここがかなり重要っぽい)
		$headers = array(
  	  		'Content-Type: application/x-www-form-urlencoded',
		);

		if(!is_array($postdata)) $postdata = array('value' => $postdata);
		$postdata['mode'] = 'api_'.$mode;
		if(!empty($token)) $postdata['token'] = $token;

		$context = array(
			'http' => array(
				'method' => 'POST',
				'content' => http_build_query($postdata),
				'header' => implode("\r\n", $headers),
			),
		);

		$result = file_get_contents($this->dbServerPath, false, stream_context_create($context));
		if($result !== false){
			return(json_decode($result, true));
		} else {
			return(false);
		}

	}
}
?>