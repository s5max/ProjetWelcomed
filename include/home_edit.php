<?php

/*INSERTION DES IMAGES DEPUIS LA BDD*/
    $backOne = $bdd->prepare('SELECT * FROM pictures WHERE img_id = 1');
    $backTwo = $bdd->prepare('SELECT * FROM pictures WHERE img_id = 2');
    $picOne = $bdd->prepare('SELECT * FROM pictures WHERE img_id = 3');
    $picTwo = $bdd->prepare('SELECT * FROM pictures WHERE img_id = 4');
    $picThree = $bdd->prepare('SELECT * FROM pictures WHERE img_id = 5');
    $picFour = $bdd->prepare('SELECT * FROM pictures WHERE img_id = 6');
    $picFive = $bdd->prepare('SELECT * FROM pictures WHERE img_id = 7');
    $picSix = $bdd->prepare('SELECT * FROM pictures WHERE img_id = 8');
    $picWC = $bdd->prepare('SELECT * FROM pictures WHERE img_id = 9');

    if($backOne->execute()){$imgOne = $backOne->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($backTwo->execute()){$imgTwo = $backTwo->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($picOne->execute()){$minOne = $picOne->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($picTwo->execute()){$minTwo = $picTwo->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($picThree->execute()){$minThree = $picThree->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($picFour->execute()){$minFour = $picFour->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($picFive->execute()){$minFive = $picFive->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($picSix->execute()){$minSix = $picSix->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($picWC->execute()){$minWC = $picWC->fetch(PDO::FETCH_ASSOC);}else {die;}

    /*INSERTION DU TEXTE DEPUIS LA BDD*/
    $hTitle = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 1');
    $hSlogan = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 2');
    $hTitleTwo = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 3');
    $hTitleTwoDesc = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 4');
    $hParaOne = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 5');
    $hParaTwo = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 6');
    $hParaThree = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 7');
    $hRespOne = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 8');
    $hRespOneT = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 9');
    $hRespTwo = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 10');
    $hRespTwoT = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 11');
    $hRespThree = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 12');
    $hRespThreeT = $bdd->prepare('SELECT * FROM home_text WHERE text_id = 13');

    if($hTitle->execute()){$home_title = $hTitle->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hSlogan->execute()){$home_slogan = $hSlogan->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hTitleTwo->execute()){$home_titleTwo = $hTitleTwo->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hTitleTwoDesc->execute()){$home_titleTwoD = $hTitleTwoDesc->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hParaOne->execute()){$home_paraOne = $hParaOne->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hParaTwo->execute()){$home_paraTwo = $hParaTwo->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hParaThree->execute()){$home_paraThree = $hParaThree->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hRespOne->execute()){$home_respOne = $hRespOne->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hRespOneT->execute()){$home_respOneT = $hRespOneT->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hRespTwo->execute()){$home_respTwo = $hRespTwo->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hRespTwoT->execute()){$home_respTwoT = $hRespTwoT->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hRespThree->execute()){$home_respThree = $hRespThree->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($hRespThreeT->execute()){$home_respThreeT = $hRespThreeT->fetch(PDO::FETCH_ASSOC);}else {die;}

    /*INSERTION DES PUBLICITES DEPUIS LA BDD*/
    $pubOne = $bdd->prepare('SELECT * FROM partnership WHERE partner_id = 1');
    $pubTwo = $bdd->prepare('SELECT * FROM partnership WHERE partner_id = 2');
    $pubThree = $bdd->prepare('SELECT * FROM partnership WHERE partner_id = 3');
    $pubFour = $bdd->prepare('SELECT * FROM partnership WHERE partner_id = 4');

    if($pubOne->execute()){$onePub = $pubOne->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($pubTwo->execute()){$twoPub = $pubTwo->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($pubThree->execute()){$threePub = $pubThree->fetch(PDO::FETCH_ASSOC);}else {die;}
    if($pubFour->execute()){$fourPub = $pubFour->fetch(PDO::FETCH_ASSOC);}else {die;}
