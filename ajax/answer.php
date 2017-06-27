<?php

require('../include/connect.php');

	if(!empty($_POST)){
	
	$post = array_map('trim',array_map('strip_tags',$_POST));
	$error = [];
		
	
		if(strlen($post['answer_message']) < 3 || strlen($post['answer_message']) > 255 ){

			$error[] = 'Les messages doivent contenir entre 20 et 255 caractères pour être valide!';

		}
	
		if(count($error) === 0){
			
			$insert = $bdd->prepare('INSERT INTO ad_dialog(ad_dialog_id,answer_sender,answer_receiver,answer_message)VALUES(:ad_dialog_id,:answer_sender,:answer_receiver,:answer_message)');

			$insert->bindValue(':ad_dialog_id',$post['ad_dialog_id']);
			$insert->bindValue(':answer_sender',$post['answer_sender']);
			$insert->bindValue(':answer_receiver',$post['answer_receiver']);
			$insert->bindValue(':answer_message',$post['answer_message']);
			
			if($insert->execute()){
				
				$update = $bdd->prepare('UPDATE ad_message SET seen=:seen WHERE ad_message_id=:id');
				$update->bindValue(':id',$post['ad_dialog_id']);
				$update->bindValue(':seen','0');

				$update->execute();	
				
				$done = '<p>Votre message a été transmis</p>';
				echo $done;
			}else{var_dump($insert->errorInfo());}
			
		}else{
			
			
			echo implode($error,'<br>');
		}
		
	}
?>