<?php
/**
 * 解析markdown为html并过滤非法标签
 * @param string $text
 * @return string
 */
function decodeMarkdown(string $text) {
    return srcToLazy(clean((new ParsedownExtra())->text($text), 'markdown'));
}

/**
 * 替换字符串的src为v-lazy.container
 * @param string $str
 * @return string
 */
function srcToLazy(string $str) {
    return (string)preg_replace('/src="(.*?)"/', 'v-lazy.container="\'$1\'" class="img-responsive"', $str);
}


/**
 * 获取用户ip
 * @return mixed
 */
function getIpAddr() {
    $ip = isset($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
    $ip = isset($ip) ? $ip : $_SERVER["REMOTE_ADDR"];
    return $ip;
}

/**
 * @param string $content
 * @return string
 */
function clearMk($content) {
    $content = json_encode($content);
    $content = preg_replace('/```.*?```/', ' {代码} ', $content);
    $arr = ['`', '*', '> ', '-', '#', '|', '   ', '\r\n'];
    foreach ($arr as $val) {
        $content = str_replace($val, '', $content);
    }
    $content = preg_replace('/!\[.*?\]\(.*?\)/', ' {图片} ', $content);
    $content = preg_replace('/\[.*?\]\(.*?\)/', ' {链接} ', $content);
    return json_decode($content);
}

/**
 * 判断字符串是否为当前url
 * @param string $path
 * @param string $active
 * @return string
 */
function setActive(string $path,string $active = 'active') {
    return (Request::is($path) || Request::is($path.'/*')) ? $active : '';
}

/**
 * 字符串中http替换成https
 * @param string $http
 * @return mixed|string
 */
function httpToHttps(string $http) {
    $http = preg_replace_callback("/http/i", function($str){
        return 'https';
    },$http);
    return $http;
}

/**
 * 转义（主要针对特殊符号和emoji表情）
 * @param string $str
 * @return mixed|string
 */
function userTextEncode(string $str){
    if(!is_string($str))return $str;
    if(!$str || $str=='undefined')return '';

    $text = json_encode($str); //暴露出unicode
    $text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i",function($str){
        return addslashes($str[0]);
    },$text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
    return json_decode($text);
}

/**
 * 解码上面的转义
 * @param string $str
 * @return mixed
 */
function userTextDecode(string $str){
    $text = json_encode($str); //暴露出unicode
    $text = preg_replace_callback('/\\\\\\\\/i',function($str){
        return '\\';
    },$text); //将两条斜杠变成一条，其他不动
    return json_decode($text);
}

/**
 * 转化成get的url
 * @param string $url
 * @param array $params
 * @return string
 */
function urlArrToStr(string $url,array $params = []) {
    return $url . '?' . http_build_query($params);
}

/**
 * curl
 * @param string $url 请求网址
 * @param array $params 请求参数
 * @param bool $ispost 请求方式
 * @param bool $https https协议
 * @return bool|mixed
 */
function curl(string $url, array $params = [], bool $ispost = false, bool $https = false) {
    $httpInfo = array();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if ($https) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
    }
    if ($ispost) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
    } else {
        if ($params) {
            if (is_array($params)) {
                $params = http_build_query($params);
            }
            curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
        }
    }

    $response = curl_exec($ch);

    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
    curl_close($ch);
    return $response;
}



