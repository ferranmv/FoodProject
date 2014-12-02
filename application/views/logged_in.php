<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo "Logged in <br/>";
echo $status.'<br/>';
echo $query;

?>
<script src="../../jquery-2.0.3.min.js"></script>
<button onclick="ajax_hit()">Ajax hit</button>

<div id="server_reply">
    
</div>

<script>
    set_base_url('<?php echo $this->config->item('base_url');?>');
    function set_base_url(base_url){
        window.base_url=base_url;
    }
    
    function ajax_hit(){
        $.ajax({
            'url':base_url+'/welcome/login_calculation',
            'type':'POST',
            'dataType':'json',
            success:function(data){
                console.log('success');
                console.log(data);
                var server_reply=document.getElementById('server_reply');
                server_reply.innerHTML=data['Calculation'];
            },
            error:function(data){
                console.log('error');
                console.log(data);
            }
        });
    }
</script>