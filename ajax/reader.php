<?php
session_name('wmd');session_start();

require('../include/connect.php');

$update = $bdd->prepare('UPDATE ad_message SET seen=:seen WHERE ad_message_id=:id');
		$update->bindValue(':id',$_POST['ad_message_id']);
		$update->bindValue(':seen','1');

	$update->execute();	


$select = $bdd->prepare('SELECT * FROM ad_message LEFT JOIN (ad_dialog) ON (ad_message.ad_message_id=ad_dialog.ad_dialog_id) WHERE ad_message_id=:id');
		$select->bindValue(':id',$_POST['ad_message_id']);

	if($select->execute()){

		$msg = $select->fetchAll(PDO::FETCH_ASSOC);
		
	}else{ var_dump($select->errorInfo()); }	

?>
<style>

	.message{padding-bottom:15px;border-bottom: solid #cecece 1px}

</style>

<h4 class="message"><span>Objet : </span><?=$msg[0]['object']?></h4>
<p class="message">
	
	<?=$msg[0]['message']?>
</p>

<?php

	foreach($msg as $v){
		if(isset($v['date_sent'])){
		$dated = str_split($v['date_sent'],10);
		$dateEn = split('-',$dated[0]);
		$date = $dateEn[2].'/'.$dateEn[1].'/'.$dateEn[0];
		
		echo '<p>Le : '.$date.' à '.$dated[1].'</p><p class="message">'.$v['answer_message'].'</p>';
		}
	}
	
?>



<form method="post">
                                            		
	<textarea name="response" id="response" ></textarea>
<!--	<input type="hidden" name="ad_message_id" id="ad_message_id" value="<?//=$msg[0]['ad_message_id']?>">-->

<!--	<input type="hidden" name="answer_sender" id="answer_sender" value="<?//=$_SESSION['user']['id']?>">-->

<!--	<input type="hidden" name="answer_receiver" id="answer_receiver" value="<?//=$msg[0]['sender_id']?>">-->

	<input id="messenger" data-id="<?=$msg[0]['ad_message_id']?>" data-sender="<?=$_SESSION['user']['id']?>" data-receiver="<?php if($msg[0]['sender_id'] != $_SESSION['user']['id']){ echo $msg[0]['sender_id'];}else{ echo $msg[0]['receiver_id'];}?>" type="submit" value="REPONDRE">
	<p id="feedback"></p>
</form>

<script>

	$('#messenger').on('click',function(e){
			
			e.preventDefault();
			
			id 			= this.getAttribute('data-id');		
			sender 		= this.getAttribute('data-sender');		
			receiver 	= this.getAttribute('data-receiver');
			message		= $('#response').val();
			
			url = 'ajax/answer.php';
			
			$.ajax({
				  type: 'post',
				  url: url,	
				  data : {
					  ad_dialog_id 	: id,
					  answer_sender		: sender,
					  answer_receiver	: receiver,
					  answer_message	: message
				  }
				  
			}).done(function(o){
				
				$('#feedback').html(o);

			});
			
		});

</script>
