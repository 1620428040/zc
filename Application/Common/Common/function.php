<?php

function http_post_json($url, $jsonStr, $auth)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept:application/json',
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr),
            "Authorization:$auth"
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return array($httpCode, $response);
}


//生成验证码
function verifyImg($action = ''){
    $fontsize = I('fontsize',30);
    $config =    array(
        'fontSize'    =>    $fontsize,    // 验证码字体大小
        'length'      =>    4,     // 验证码位数
        'useNoise'    =>    true, // 关闭验证码杂点
    );
    ob_clean();
    $Verify = new \Think\Verify($config);
    $Verify->entry($action);
}

/**
 * 验证码检测
 */
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}


//发送手机验证码
function sendmsg($code,$phone){
    $timec = date('YmdHis',time());
    $sid = '0309d207e1ac83fc62829576686570ee';
    $token = '4e7c674c2bf87dc725a94d2721ef09d4';
    $sign = strtoupper(md5($sid.$token.$timec));
    $auth = base64_encode($sid.':'.$timec);
    $url = "https://api.ucpaas.com/2014-06-30/Accounts/".$sid."/Messages/templateSMS?sig=$sign";
    $jsonstr2 = "{
        'templateSMS' : {
            'appId' : '40c25cd2810b4befb72c6224c4f38ce4',
            'param': $code,
            'templateId':'44494',
            'to': $phone,
        }
        }";
    return http_post_json($url,$jsonstr2,$auth);

}