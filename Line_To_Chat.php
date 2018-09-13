<?php

$accessToken = "GKTmRxPtlSGanBv4pz7OE3Kckxs93EKKpTzUJ/BfEu32CFq+d0N6dkup/3LgN8m+wLiaimWdqOXYECwLirSjbKa5fewj3uPpnBgb1yCeiEpF0ICEXBm465sagEWT6V1q9YKSYUEKjpN1PuPuVQ+V4wdB04t89/1O/w1cDnyilFU=";

    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
    //รับ user id ของผู้ใช้
    $id = $arrayJson['events'][0]['source']['userId'];
    $my_file = "/Chat/".$id.".txt";
if(!file_exists($my_file){
    #Message Type "Text"
    if(strpos($message, "สวัสดี") !== false || strtoupper($message) == "HELLO"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีครับยินดีตอนรับ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if(strpos($message, "ช่วยเหลือ") !== false || strtoupper($message) == "LOAN"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สินเชื่อ คุณภาพ บริการด้วยใจ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    # Message Type "Sticker"
    #else if($message == "เงินฝาก"){
    #    $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
    #    $arrayPostData['messages'][0]['type'] = "sticker";
    #    $arrayPostData['messages'][0]['packageId'] = "2";
    #    $arrayPostData['messages'][0]['stickerId'] = "46";
    #    replyMsg($arrayHeader,$arrayPostData);
    #}
    else if($message == "เงินฝาก"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "รับประกันเงินฝาก โดยรัฐบาล";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "สลากออมสิน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สลากออมสินการ ออมเงินอย่างดี";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if(strtoupper($message) == "PROMOTION"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "Promotion สุดพิเศษ สำหรับคุณ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "สมัครบริการ"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "มาร่วมใช้บรการกับเรา";
        replyMsg($arrayHeader,$arrayPostData);
    }
    # Message Type "Image"
    else if($message == "รูปน้องแมว"){
        $image_url = "https://cxpmiddleware.herokuapp.com/immapcard/card%20info.png";#"https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
    # Message Type "Location"
    else if($message == "พิกัดสยามพารากอน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
    # Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "131";
        replyMsg($arrayHeader,$arrayPostData);
    }
    # Message image map
    else if($message == "บัตรเครดิต"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
                array(
                    "type" => "imagemap",
                    "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard",
                    "altText"=> "This is an imagemap",
                    "baseSize"=> 
                    array(
                        "width"=> 1040,
                        "height"=> 1040
                    ),
                    "actions"=> [
                        array(
                            "type"=> "message",
                            "area"=> 
                            array(
                                "x"=> 15,
                                "y"=> 93,
                                "width"=> 322,
                                "height"=> 322
                            ),
                            "text"=> "GSB PREMIUM"
                        ),
                        array(
                            "type"=> "message",
                            "area"=> 
                            array(
                                "x"=> 350,
                                "y"=> 93,
                                "width"=> 322,
                                "height"=> 322
                            ),
                            "text"=> "GSB PRECIOUS"
                        ),
                        array(
                            "type"=> "message",
                            "area"=> 
                            array(
                                "x"=> 685,
                                "y"=> 93,
                                "width"=> 322,
                                "height"=> 322
                            ),
                            "text"=> "GSB PRESTIGE"
                        ),
                        array(
                            "type"=> "message",
                            "area"=> 
                            array(
                                "x"=> 15,
                                "y"=> 430,
                                "width"=> 322,
                                "height"=> 322
                            ),
                            "text"=> "บัตรเงินสด"
                        ),
                        array(
                            "type"=> "message",
                            "area"=> 
                            array(
                                "x"=> 350,
                                "y"=> 430,
                                "width"=> 322,
                                "height"=> 322
                            ),
                            "text"=> "บัตรออมสินวีซ่า"
                        ),
                        array(
                            "type"=> "message",
                            "area"=> 
                            array(
                                "x"=> 685,
                                "y"=> 430,
                                "width"=> 322,
                                "height"=> 322
                            ),
                            "text"=> "บัตรออมสินสมาร์ทแคร์"
                        )
                    ]
                )
            ]
        );
           replyMsg($arrayHeader,$arrayPostData);
    }
    # Message Confirm
    else if($message == "เมนู"){
        $arrayPostData = 
        array(
        "replyToken" => $arrayJson['events'][0]['replyToken'],
        "messages" => [
          array(
              "type" => "template",
              "altText" => "this is a confirm template",
              "template" => 
                 array(
                     "type" => "confirm",
                     "text" => "Are you sure?",
                     "actions" => [
                         array(
                             "type" => "datetimepicker",
                             "data" => "datestring", // will be included in postback action
                             "label" => "Please Choose",
                             "mode" => "date"
                             ),
                         array(
                             "type" => "message",
                             "label" => "No",
                             "text" => "no"
                         )
                         ]
                     )
              )
        ]
        );
           replyMsg($arrayHeader,$arrayPostData);
    }
    else if(strtoupper($message) == "GSB PREMIUM"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "บัตรแพลตตินั้ม สุดพิเศษ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if(strtoupper($message) == "GSB PRECIOUS"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "บัตร PRECIOUS สุดพิเศษ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if(strtoupper($message) == "GSB PRESTIGE"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "บัตร PRESTIGE สุดพิเศษ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "บัตรเงินสด"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "บัตรเงินสด สุดพิเศษ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "บัตรออมสินสมาร์ทแคร์"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "บัตรออมสินสมาร์ทแคร์ สุดพิเศษ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "บัตรออมสินวีซ่า"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "บัตรออมสินวีซ่า สุดพิเศษ";
        replyMsg($arrayHeader,$arrayPostData);
    }
     # Message Buttons
     else if($message == "เมนูหลัก"){      
                             
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "template";
        $arrayPostData['messages'][0]['altText'] = "this is a buttons template";
        $arrayPostData['messages'][0]['template']['type'] = "BUTTONS";
        $arrayPostData['messages'][0]['template']['title'] = "GSB Main menu";
        $arrayPostData['messages'][0]['template']['text'] = "ยินดีตอนรับสู่บริการของเราค่ะ";
        
        $arrayPostData['messages'][0]['template']['actions'][0]['type'] = "message";
        $arrayPostData['messages'][0]['template']['actions'][0]['label'] = "บัตรเครดิต";
        $arrayPostData['messages'][0]['template']['actions'][0]['text'] = "บัตรเครดิต";
        
        replyMsg($arrayHeader,$arrayPostData);
    }
    }
    else if($message == "Agent"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "กรุณารอซักครู่";
        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
         //write some data here
        fclose($handle);
        replyMsg($arrayHeader,$arrayPostData);
    }
}

function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>
