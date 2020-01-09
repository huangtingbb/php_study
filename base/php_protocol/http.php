<?php
/**
 * 使用socket模拟post请求
 * User: LJ
 * Date: 2019/1/26
 * Time: 0:31
 */
/**
 * @param string $url
 * @param array $data
 * @return array
 */
function doPost(string $url, array $data=[]){
    $host = "";
    $uri = "";
    if(strpos($url,'http')!==false){
    }else{
        $host = substr($url,0,strpos($url,'/'));
        $uri = strstr($url,'/');
    }

    $req_data = "";
    //构建请求参数
    if($data){
        foreach($data as $k=>$v){
            if($req_data) $req_data .= "&";
            $req_data .= "{$k}=".urlencode($v);
        }
    }
    $content_length = strlen($req_data);
    //构建请求主体
    $body = "POST {$uri} HTTP/1.1\r\n";
    $body .= "HOST: $host\n"."User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36\r\n";
    $body .= "Content-Type:application/x-www-form-urlencoded\r\n";
    $body .="Content-length:{$content_length}\r\n\r\n";
    $body .=$req_data."\r\n";

    //打开socket通道
    $socket = fsockopen($host,80,$error,$errstr);

//    echo $body;exit;
    $result =[];
    if(!$socket){
        $result['error'] = $error;
        $result['errstr'] = $errstr;
        return $result;
    }
    //发起请求
    fputs($socket,$body);
    while(!feof($socket)){
        $result[] = fgets($socket,4096);
    }
    fclose($socket);
    return $result;
}
var_dump(doPost('php_study.ljstu.top/base/php_context/server.php',['a'=>1]));