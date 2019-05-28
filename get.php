<?php
$data = $_POST;
$file = 'logs/'.md5($_POST['user'].''.$_POST['key']).'.txt';
$current = json_decode(file_get_contents($file));
//$current = file_get_contents($file);
$content = '';
foreach($current as $key => $item){
    switch($item->type){
        case 'send':
            $type = '<i class="fas fa-server fa-2x"></i><i class="fas fa-chevron-right fa-2x"></i>';
            $label = 'Sent to Server';
            break;
        case 'receive':
            $type = '<i class="fas fa-chevron-left fa-2x"></i><i class="fas fa-server fa-2x"></i>';
            $label = 'Received from Server';
            break;
        case 'array':
            $type = '<i class="fas fa-layer-group fa-2x"></i>';
            $label = 'Array';
            break;
        default:
            $type = '<i class="fas fa-info-circle fa-2x"></i>';
            $label = $item->type;
            break;
    }
    $content .= '<div class="logitem">
                    <span class="date">'.$item->date.'
                        <div class="icons">'.$type.'</div>
                        <label>'.$label.'</label>
                        <div class="actions">
                            <button class="small ctc" data-clipboard-target="#content-'.$key.'">Copy to Clipboard</button>
                        </div>
                    </span>
                    <span class="content" id="content-'.$key.'">'.$item->content.'</span>
                </div>';
}
echo $content;