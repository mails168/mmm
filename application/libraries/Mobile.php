<?php
class CI_Mobile{
    function __construct(){
        $this->CI=&get_instance();
    }	
    /**
     * @param msg 短信内容
     * @param $mobs 以分号分隔的手机号码,或是手机号码组成的数组
     * @return error message if fail. blank string if susccess
     */
    // public function send($msg,$mob){
    //     $userid = '1111'; //企业ID $userid
    //     $account = 'jksc013'; //用户账号 $account
    //     $password = 'ywSMS@88291093'; //用户密码 $password
    //     $mobile = $mob; //发送到的目标手机号码 $mobile
    //     $content = $msg;//短信内容 $content
    //     $content = urlencode($content);//短信内容 $content
    //     //            $content = addslashes($content);//短信内容 $content
    //     //发送短信（其他方法相同）
    //     $gateway = "http://sh2.ipyy.com/sms.aspx?action=send&userid={$userid}&account={$account}&password={$password}&mobile={$mobile}&content=".$content."&sendTime=&extno=";
    //     $result = @file_get_contents($gateway);
    //     //$result = @curl_get($gateway);
    //     $xml = @simplexml_load_string($result);
    //     return $xml;
    // }

    /**
     * v 2016.9.19 新的的运营商渠道 POST 
     */
    public function send($msg,$mob){
        $account = '004245'; //用户账号 $account
        $password = '76SEqTcggF7Z'; //用户密码 $password
        $mobile = $mob; //发送到的目标手机号码 $mobile                   
        $content = $msg;//短信内容 $content
        $content = urlencode($content);//短信内容 $content
        // 发送短信（其他方法相同）

        $url = 'http://120.26.69.248/msg/HttpSendSM';//POST指向的链接      
        $data = array(      
            'account'=>$account,   
            'pswd'=>$password,   
            'mobile'=>$mobile,   
            'msg'=>$content,   
            'needstatus'=>false,   
            'product'=>''  
        );      
        $result = $this->postData($url, $data);

        $res_data = explode(',',$result);
        if($res_data[1] == 0){
            $result = (object) ['returnstatus' => 'Success', 'message' => $res_data[1]];
        }else {
            $result = (object) ['returnstatus' => 'error', 'message' => $res_data[1]];
        }
        return $result;
    }
    
    function do_sms($msg,$mob){
        $this->CI->load->library("sms/sykj_http_sms", NULL, 'sms');
        $r = $this->CI->sms->sendMsg($mob, $msg);
        return $r;
    }
    private function postData($url, $data)      
    {   
        $data = http_build_query($data);   
        $ch = curl_init();      
        $timeout = 30;       
        curl_setopt($ch, CURLOPT_URL, $url);     
        curl_setopt($ch, CURLOPT_REFERER, "http://www.yueyawang.com");   //构造来路    
        curl_setopt($ch, CURLOPT_POST, true);      
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);      
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);      
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);      
        $handles = curl_exec($ch);      
        curl_close($ch);      
        return $handles;      
    }    
}
