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
    $my_file1 = './Chat/AgentLOAN.txt';
    $my_file2 = './Chat/AgentCREDIT.txt';
    $agentHold = "";
    $agentType = "";
if(file_exists($my_file)){
    $line = file($my_file);
    $agentHold = $line[0];
    $agentType = "Agent.txt";
} else if(file_exists($my_file1)){
    $line = file($my_file1);
    $agentHold = $line[0];
    $agentType = "AgentLOAN.txt";
} else if(file_exists($my_file2)){
    $line = file($my_file2);
    $agentHold = $line[0];
    $agentType = "AgentCREDIT.txt";
}
    
if($agentHold != $id){
    #Message Type "Text"
    if(strpos($message, "สวัสดี") !== false || strtoupper($message) == "HELLO"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีครับยินดีตอนรับ";
        replyMsg($arrayHeader,$arrayPostData);
    }
    
 #Main 1   
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
        "label"=> "บัตรเครดิต/บัตรกดเงินสด",
        "text"=> "บัตรเครดิต"
      ),
      array(
        "type"=> "message",
        "label"=> "บัตรสินเชื่อ",
        "text"=> "บัตรสินเชื่อ"
      )
    ],
    "title"=> "กรุณาเลือกรายการของท่าน",
    "text"=> "ผลิตภัณฑ์ บัตรเครดิต/บัตรกดเงินสด และสินเชื่อ"
  )
)
]
);
        replyMsg($arrayHeader,$arrayPostData);
    }
 #Main 1-1   
    else if($message == "บัตรเครดิต/บัตรกดเงินสด"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
                array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/accoutcredit",
  "altText"=> "This is an imagemap",
  "baseSize"=> array(
    "width"=> 1040,
    "height"=> 459
  ),
  "actions"=> [
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 0,
        "y"=> 135,
        "width"=> 1040,
        "height"=> 168
      ),
      "text"=> "บัตรเคครดิต"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 0,
        "y"=> 304,
        "width"=> 1040,
        "height"=> 155
      ),
      "text"=> "บัตรกดเงินสด"
    )
  ]
)
                ]
);
        replyMsg($arrayHeader,$arrayPostData);
    }
 #Main 1-1-1
    else if($message == "บัตรเครดิต"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
                array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/creditSum",
  "altText"=> "This is an imagemap",
  "baseSize"=> array(
    "width"=> 1040,
    "height"=> 1136
  ),
  "actions"=> [
    array(
      "type"=> "uri",
      "area"=> array(
        "x"=> 89,
        "y"=> 807,
        "width"=> 828,
        "height"=> 119
      ),
      "linkUri"=> "https://cxpmiddleware.herokuapp.com/image/creditbarcode.png"
    )
  ]
)
                ]
);
        replyMsg($arrayHeader,$arrayPostData);
    }
#Main 1-1-2
        else if($message == "บัตรกดเงินสด"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
                array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/bookSum",
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
      "linkUri"=> "https://cxpmiddleware.herokuapp.com/image/checking.png"
    )
  ]
)
                ]
);
        replyMsg($arrayHeader,$arrayPostData);
    }
    
#MAIN 1-2
    else if($message == "บัตรสินเชื่อ"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
                array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/loanSum",
  "altText"=> "This is an imagemap",
  "baseSize"=> array(
    "width"=> 1040,
    "height"=> 1136
  ),
  "actions"=> [
    array(
      "type"=> "uri",
      "area"=> array(
        "x"=> 89,
        "y"=> 807,
        "width"=> 828,
        "height"=> 119
      ),
      "linkUri"=> "https://cxpmiddleware.herokuapp.com/image/loanbarcode.png"
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
    
#Main 2  
    else if($message == "บัญชีเงินฝาก"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
        array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/accoutbank",
  "altText"=> "This is an imagemap",
  "baseSize"=> array(
    "width"=> 1040,
    "height"=> 428
  ),
  "actions"=> [
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 0,
        "y"=> 134,
        "width"=> 1040,
        "height"=> 143
      ),
      "text"=> "บัตรกดเงินสด"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 0,
        "y"=> 277,
        "width"=> 1040,
        "height"=> 144
      ),
      "text"=> "บัตรกดเงินสด"
    )
  ]
)
            ]
            );
        replyMsg($arrayHeader,$arrayPostData);
    }
    
#Main 3   
    else if($message == "สลากออมสิน"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
        array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/oomsin",
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
    
 #MAIN 4
    else if(strtoupper($message) == "PROMOTION"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
                array(
  "type"=> "template",
  "altText"=> "this is a carousel template",
  "template"=> array(
    "type"=> "carousel",
    "actions"=> [],
    "columns"=> [
      array(
        "thumbnailImageUrl"=> "https://cxpmiddleware.herokuapp.com/Carousel/CreditCard/precious.png",
        "text"=> "GSB Precious Credit Card",
        "actions"=> [
          array(
            "type"=> "uri",
            "label"=> "สิทธิประโยชน์",
            "uri"=> "https://www.gsb.or.th/PrivilegePrestige.aspx"
          ),
          array(
            "type"=> "uri",
            "label"=> "สมัครบัตร",
            "uri"=> "https://www.gsb.or.th/Register-Online.aspx"
          )
        ]
      ),
      array(
        "thumbnailImageUrl"=> "https://cxpmiddleware.herokuapp.com/Carousel/CreditCard/premium.png",
        "text"=> "GSB Premium Credit Card",
        "actions"=> [
          array(
            "type"=> "uri",
            "label"=> "สิทธิประโยชน์",
            "uri"=> "https://www.gsb.or.th/products/cards/credit_card/gsbpremium.aspx"
          ),
          array(
            "type"=> "uri",
            "label"=> "สมัครบัตร",
            "uri"=> "https://www.gsb.or.th/Register-Online-Premium.aspx"
          )
        ]
      ),
      array(
        "thumbnailImageUrl"=> "https://cxpmiddleware.herokuapp.com/Carousel/CreditCard/prestige.png",
        "text"=> "GSB Prestige Credit Card",
        "actions"=> [
          array(
            "type"=> "uri",
            "label"=> "สิทธิประโยชน์",
            "uri"=> "https://www.gsb.or.th/products/cards/credit_card/gsbprestige.aspx"
          ),
          array(
            "type"=> "uri",
            "label"=> "สมัครบัตร",
            "uri"=> "https://www.gsb.or.th/personal/products/cards/credit_card/gsbprestige.aspx"
          )
        ]
      )
    ]
  )
)
                ]
            );
        replyMsg($arrayHeader,$arrayPostData);
    }
    
#Main 5   
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
    "height"=> 1110
  ),
  "actions"=> [
    array(
      "type"=> "uri",
      "area"=> array(
        "x"=> 28,
        "y"=> 160,
        "width"=> 979,
        "height"=> 108
      ),
      "linkUri"=> "https://www.google.com/maps/search/สาขาธนาคารออมสิน/"
    ),
    array(
      "type"=> "uri",
      "area"=> array(
        "x"=> 29,
        "y"=> 275,
        "width"=> 979,
        "height"=> 112
      ),
      "linkUri"=> "https://www.google.com/maps/search/ตู้ATMธนาคารออมสิน/"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 29,
        "y"=> 387,
        "width"=> 979,
        "height"=> 115
      ),
      "text"=> "Action 3"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 29,
        "y"=> 504,
        "width"=> 979,
        "height"=> 106
      ),
      "text"=> "Action 4"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 28,
        "y"=> 610,
        "width"=> 978,
        "height"=> 114
      ),
      "text"=> "Action 5"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 28,
        "y"=> 724,
        "width"=> 978,
        "height"=> 106
      ),
      "text"=> "Action 6"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 28,
        "y"=> 830,
        "width"=> 978,
        "height"=> 110
      ),
      "text"=> "Action 7"
    )
  ]
)
                ]
            );
        replyMsg($arrayHeader,$arrayPostData);
    }
    
    else if($message == "สมัครบริการ"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
        array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/registers",
  "altText"=> "This is an imagemap",
  "baseSize"=> array(
    "width"=> 1040,
    "height"=> 1040
  ),
  "actions"=> [
    array(
      "type"=> "uri",
      "area"=> array(
        "x"=> 226,
        "y"=> 906,
        "width"=> 561,
        "height"=> 97
      ),
      "linkUri"=> "http://ark-insights.com/gsb"
    )
  ]
)
            ]
            );
        replyMsg($arrayHeader,$arrayPostData);
    }
    
#MAIN 6
        else if($message == "SETTING"){
        $arrayPostData = 
        array(
            "replyToken" => $arrayJson['events'][0]['replyToken'],
            "messages" => [
                array(
  "type"=> "imagemap",
  "baseUrl"=> "https://cxpmiddleware.herokuapp.com/immapcard/setting",
  "altText"=> "This is an imagemap",
  "baseSize"=> array(
    "width"=> 1040,
    "height"=> 1208
  ),
  "actions"=> [
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 0,
        "y"=> 433,
        "width"=> 1040,
        "height"=> 192
      ),
      "text"=> "Account"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 0,
        "y"=> 625,
        "width"=> 1040,
        "height"=> 192
      ),
      "text"=> "Chat Agent"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 0,
        "y"=> 817,
        "width"=> 1040,
        "height"=> 200
      ),
      "text"=> "Notifications"
    ),
    array(
      "type"=> "message",
      "area"=> array(
        "x"=> 0,
        "y"=> 1017,
        "width"=> 1040,
        "height"=> 191
      ),
      "text"=> "Help"
    )
  ]
)
                ]
            );
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
    else if($message == "BARCODE"){
        $image_url = "https://cxpmiddleware.herokuapp.com/image/creditbarcode.png";#"https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
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
    else if($message == "Promotionบัตรเครดิต"){
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
    else if(strtoupper($message) == "CHAT AGENT"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        if($agentType = "Agent.txt"){
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "กำลังติดต่อ";
            replyMsgChat($id,"ลูกค้าต้องการคุยกับพนักงาน","Agent.txt");
        } else{
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "ขณะนี้ Agent ให้บริการเต็ม";
        }
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if(strtoupper($message) == "LOAN AGENT"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        if($agentType = "AgentLOAN.txt"){
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "กำลังติดต่อ";
            replyMsgChat($id,"ลูกค้าต้องการคุยกับพนักงาน","AgentLOAN.txt");
        } else{
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "ขณะนี้ Agent สินเชื่อ ให้บริการเต็ม";
        }
        replyMsg($arrayHeader,$arrayPostData);
    }
    else if(strtoupper($message) == "LOAN AGENT"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        if($agentType = "AgentCREDIT.txt"){
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "กำลังติดต่อ";
            replyMsgChat($id,"ลูกค้าต้องการคุยกับพนักงาน","AgentCREDIT.txt");
        } else{
            $arrayPostData['messages'][0]['type'] = "text";
            $arrayPostData['messages'][0]['text'] = "ขณะนี้ Agent สินเชื่อ ให้บริการเต็ม";
        }
        replyMsg($arrayHeader,$arrayPostData);
    }
}
else{
    replyMsgChat($id,$message,$agentType);   
}

function replyMsgChat($arrayHeader,$arrayPostData,$agentType){
        $strUrl = "https://cxpmiddleware.herokuapp.com/Chat/lineToChat.php?userid=".$arrayHeader."&text=".$arrayPostData."&type=".$agentType;
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
