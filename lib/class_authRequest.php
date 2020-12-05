<?php
class AuthRequest{
	private $serverPath;
	private $serverMode;
	
	function __construct($server=null){
		$this->serverPath = $server;
		if (strpos($server, 'https://') === 0){
			$this->serverMode = 'remote';
		} else {
			$this->serverMode = 'local';
		}
	}
	
	function studentLogin($userID,$courseID){
		return($this->request('studentJoinCourse', array('userID'=>$userID, 'courseID'=>$courseID), null));
	}
	function studentUseDB($userID, $token, $dbLabel, $dbPath){
		return($this->request('studentUseDB', array('userID'=>$userID, 'dbLabel'=>$dbLabel, 'dbPath'=>$dbPath), $token));
	}
	function studentConfirm($userID, $token){
		return($this->request('studentConfirm', array('userID'=>$userID), $token));
	}
	function studentLogout($userID, $token){
		return($this->request('studentLogout', array('userID'=>$userID), $token));
	}
	
	function teacherRegister($userID, $userPass, $userPass_r, $userName, $userEmail, $userAffiliation){
	    $userInfoArray = array(
            'userID'=>$userID,
            'userPass' => $userPass,
			'userPass_r' => $userPass_r,
            'userName' => $userName,
            'userAffiliation' => $userAffiliation,
            'userEmail' => $userEmail,
        );
		
		return($this->request('teacherRegister', $userInfoArray, null));
	}
	
	function teacherLogin($userID, $userPass){
		return($this->request('teacherLogin', array('userID'=>$userID, 'userPass'=>$userPass), null));
	}
	function teacherLogout($userID, $token){
		return($this->request('teacherLogout', array('userID'=>$userID), $token));
	}
	function teacherConfirm($userID, $token){
		return($this->request('teacherConfirm', array('userID'=>$userID), $token));
	}
	function teacherRegisterCourse($userID, $token, $courseInfo){
		return($this->request('teacherRegisterCourse', array_merge(array('userID'=>$userID), $courseInfo), $token));
	}
	function teacherGetCourseInfo($userID, $token, $courseID){
		return($this->request('teacherGetCourseInfo', array('userID'=>$userID, 'courseID'=>$courseID), $token));
	}
	
	
	// 認証サーバに問い合わせ
	private function request($mode, $postdata, $token, $options=null){
		if(!is_array($postdata)) $postdata = array('value' => $postdata);
		$postdata['mode'] = 'api_'.$mode;
		if(!empty($token)) $postdata['token'] = $token;
		
		switch($this->serverMode){
			case 'remote':
				$context = array(
					'http' => array(
						'method' => 'POST',
						'content' => http_build_query($postdata),
					),
				);
		
				$result = file_get_contents($this->serverPath, false, stream_context_create($context));// print '(start:'.$mode.')'.$result.'!!!!!<br>';
				if($result !== false){
						return(json_decode($result, true));
				} else {
					return(false);
				}
				break;
			case 'local': // 調整中
				require_once($this->serverPath);
				$server = new AuthServer('test.db');
			
				$result = $as->auth($postdata);
					return($result);
				break;
		}
	}
}
?>