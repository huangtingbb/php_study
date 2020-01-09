<?php
        @go(function () {

		 $txt = [
            "control"=>"Room",
            "action"=>"onJoin",
            "data"=>[
                "token"=>"84933fe991b0c7495aede8e5731b8301e4f223e7",
                "rid"=>"418",
            ],
         ];
            $cli = new Co\http\Client("127.0.0.1", 9501);
			$cli->setMethod("get");
			$cli->setData("token=84933fe991b0c7495aede8e5731b8301e4f223e7");
            $ret = $cli->upgrade("ws://127.0.0.1:9501?token=84933fe991b0c7495aede8e5731b8301e4f223e7");

            if ($ret) {
					
                //while(true) {
                    $cli->push(json_encode($txt));
                    var_dump($cli->recv());
                    co::sleep(0.1);
					//break;
                //}
            }
        });
