<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Errors</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href=""> -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js">   </script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <style type="text/css">
        body {
            padding: 0px;
            margin: 0px;
            background: #685d5d;
        }

        #output {
            background: #fff;
            overflow: scroll;
            height: 90vh;
            box-sizing: border-box;
            position: absolute;
            width: 100vw;
            border-bottom: solid 5px black;
            white-space: pre-wrap;      /* CSS3 */
            word-wrap: break-word;      /* IE */
            word-break: break-all;
            word-wrap: break-word;
        }

        .codesnippet {
            display:none;
        }

        .logitem {
            display:flex;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size:12px;
            border-top:#685d5d 1px solid;
        }

        .logitem:nth-child(odd) {            
            background:#eeeeee;
        }

        .logitem span:first-child {
            min-width:7vw;
            max-width:7vw;
            border-right:#685d5d 1px dotted;
            background:#c9d3db;
            text-align:center;
        }

        .logitem span {
            display:block;
            padding:10px;
        }

        #tools {
            position:absolute;
            bottom:0px;
            left:0px;
        }

        #stat {
            position:absolute;
            bottom:0px;
            right:0px;
            color:#ffffff;
            margin:20px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-align:center;
        }

        #tools {
            margin:20px;
        }

        button {
            box-shadow:inset #ffffff 0px 1px 1px;
            background: rgba(13,150,181,1);
            /* background: linear-gradient(3deg, rgba(13,150,181,1) 0%, rgba(0,212,255,1) 100%); */
            border:solid 1px rgba(13,150,181,1);
            padding:5px 10px;
            border-radius:3px;
            margin-right:5px;
            color:#ffffff;
            cursor:pointer;
        }

        button:hover {
            box-shadow:inset #ffffff 0px 0px 1px;
        }

        button.small {
            font-size:12px;
            padding:3px 5px;
        }

        .icons {
            text-align:center;
            padding:10px 0px;
            color:#111111;
            margin-top:5px;
            position: relative;
            display:block;
            width:100%;
        }

        label {
            padding:3px;
            text-align:center;
            width:100%;
            display:block;
        }

        </style>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div id="output"></div>
        <div id="stat"><i class="fas fa-spinner fa-pulse loading" style="display:none;"></i></div>
        <div id="tools"><button onclick="clearFile()"><i class="fas fa-eraser"></i> Clear File</button><button onclick="updateScroll()"><i class="fas fa-angle-down"></i> Scroll To Bottom</button><input type="text" id="user" placeholder="Username"/><input type="text" id="keyword" placeholder="Keyword"/><button onclick="setFile()">Setup File</button></div>
        <div id="codesnippet">
            public function post_external_debug( $payload ,$type) {
                $result = false;
                $error = null;
                $url = 'http://www.themindofadev.com/errors/catch.php';
                $payload = json_encode ( $payload );
                $ch = curl_init ( $url );
                curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
                curl_setopt ( $ch, CURLOPT_POSTFIELDS, array('data' => $payload, 'type' => $type, 'user' => 'jan', 'key' => 'es') );
                $result = curl_exec ( $ch );
                $error = curl_error ( $ch );
                if (! empty ( $error )) {
                    $this->error_log($error);
                    error_log('error:'.$error);
                } else {
                    $result = json_decode ( $result, true );
                }
                curl_close ( $ch );
                return ;
            }
        </div>
        <script type="text/javascript" src="clipboard.min.js">   </script>
        <script type="text/javascript">

        new ClipboardJS('.ctc');

        setInterval(loadErrors,4000);

        function loadErrors(){
            $('.loading').show();
            refreshPage();
        }

        function clearFile()
        {
            $('#stat').load('clear.php',{'user' : localStorage.getItem("user"), "key" : localStorage.getItem("key")},function(){});
            refreshPage();
        }

        function updateScroll(){
            var element = document.getElementById("output");
            element.scrollTop = element.scrollHeight;
        }

        function refreshPage(){
            $('#output').load('get.php',{ 'user' : localStorage.getItem("user"), "key" : localStorage.getItem("key")  },function(data){
                $('#stat').load('stat.php',{},function(){});
                $('.loading').hide();
            });
        }

        function setFile(){
            var user = $('#user').val();
            var key = $('#keyword').val();
            localStorage.setItem("user", user);
            localStorage.setItem("key", key);
        }

        </script>
    </body>
</html>