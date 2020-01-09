<?php
	for($i=0;$i<=1;$i++){
        @go(function () {

		 $txt = [
            "control"=>"Room",
            "action"=>"onJoin",
            "data"=>[
                "rid"=>"510",
            ],
         ];
            $cli = new Co\http\Client("118.25.5.242", 9501);
			$cli->setMethod('get');
			$cli->setData("token=af8d5b57540fa588e85ede570f333a662ff9b026");
			$cli->execute("/",function($data){
				var_dump($data);
			});
            $ret = $cli->upgrade("/");

            if ($ret) {
					
                //while(true) {
                    $cli->push(json_encode($txt));
                    var_dump($cli->recv());
                    co::sleep(0.1);
					//break;
                //}
            }
        });
	}
