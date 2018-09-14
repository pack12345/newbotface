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
    $my_file = './Chat/Agent.txt';
    $agentHold = "";
if(file_exists($my_file)){
    $line = file($my_file);
    $agentHold = $line[0];
}
if($agentHold != $id){
    #Message Type "Text"
    if(strpos($message, "สวัสดี") !== false || strtoupper($message) == "HELLO"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีครับยินดีตอนรับ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if(strpos($message, "บัตร/เงินสด/สินเชื่อ") !== false){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
array(
  "type"=> "template",
  "altText"=> "this is a buttons template",
  "template"=> array(
    "type"=> "buttons",
    "actions"=> [
      array(
        "type"=> "message",
        "label"=> "บัตรเครดิต",
        "text"=> "บัตรเครดิต"
      ),
      array(
        "type"=> "message",
        "label"=> "บัตรกดเงินสด",
        "text"=> "บัตรกดเงินสด"
      ),
      array(
        "type"=> "message",
        "label"=> "สินเชื่อ",
        "text"=> "สินเชื่อ"
      )
    ],
    "title"=> "กรุณาเลือกรายการที่ท่าน",
    "text"=> "ผลิตภัณฑ์บัตร, เงินฝาก และสินเชื่อ"
  )
)
]
);
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if(strpos($message, "ช่วยเหลือ") !== false || strtoupper($message) == "HELP"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
                array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/help",
  "altText"=> "This is an imagemap",
  "baseSize"=> array(
    "width"=> 1040,
    "height"=> 1506
  ),
  "actions"=> [
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 28,
        "y"=> 154,
        "width"=> 979,
        "height"=> 145
      ),
      "text"=> "Action 1"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 29,
        "y"=> 299,
        "width"=> 979,
        "height"=> 171
      ),
      "text"=> "Action 2"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 26,
        "y"=> 470,
        "width"=> 979,
        "height"=> 158
      ),
      "text"=> "Action 3"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 27,
        "y"=> 628,
        "width"=> 979,
        "height"=> 163
      ),
      "text"=> "Action 4"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 28,
        "y"=> 791,
        "width"=> 978,
        "height"=> 169
      ),
      "text"=> "Action 5"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 27,
        "y"=> 960,
        "width"=> 979,
        "height"=> 168
      ),
      "text"=> "Action 6"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 26,
        "y"=> 1128,
        "width"=> 978,
        "height"=> 179
      ),
      "text"=> "Action 7"
    )
  ]
)
                ]
            );
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
    else if($message == "บัญชีเงินฝาก"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
        array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/บัญชีเงินฝาก",
  "altText"=> "This is an imagemap",
  "baseSize"=> array(
    "width"=> 1040,
    "height"=> 1022
  ),
  "actions"=> [
    array(
      "type"=> "uri",
      "area"=> array(
        "x"=> 89,
        "y"=> 695,
        "width"=> 828,
        "height"=> 119
      ),
      "linkUri"=> "https=>//developers.line.me/en/reference/messaging-api/#imagemap-action-objects"
    )
  ]
)
            ]
            );
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if($message == "สลากออมสิน"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
        array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/สลากออมสิน",
  "altText"=> "This is an imagemap",
  "baseSize"=> array(
    "width"=> 1040,
    "height"=> 1049
  ),
  "actions"=> [
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 71,
        "y"=> 93,
        "width"=> 903,
        "height"=> 260
      ),
      "text"=> "หมายเลขสลาก"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 71,
        "y"=> 381,
        "width"=> 901,
        "height"=> 262
      ),
      "text"=> "หมายเลขสลาก"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 71,
        "y"=> 673,
        "width"=> 903,
        "height"=> 264
      ),
      "text"=> "หมายเลขสลาก"
    )
  ]
)
            ]
            );
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
    else if($message == "หมายเลขสลาก"){
        $image_url = "https://cxpmiddleware.herokuapp.com/image/oomsin.png";#"https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
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
    else if(strtoupper($message) == "AGENT"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "กำลังติดต่อ";
        replyMsg($arrayHeader,$arrayPostData);

        replyMsgChat($id,"ลูกค้าต้องการคุยกับพนักงาน");
    }
}
else{
    replyMsgChat($id,$message);   
}

function replyMsgChat($arrayHeader,$arrayPostData){
        $strUrl = "https://cxpmiddleware.herokuapp.com/Chat/lineToChat.php?userid=".$arrayHeader."&text=".$arrayPostData;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $strUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $result = curl_exec($ch);
        curl_close ($ch);
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
