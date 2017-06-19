<?php session_name('wmd'); session_start();?>
<?php $m = '/Home/ProjetWelcomed/modal/';?>
<li>
    <?php if(!isset($_SESSION['user'])){?>
        <a class="btn wmregister mod" data-offset="100" data-url="<?=$m?>subscribe.php" data-toggle="modal" data-target="#modal4all">S'inscrire</a>
        
        <a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>login.php" data-toggle="modal" data-target="#modal4all">Se connecter</a>
    <?php }else{?>                                      
            
        <a class="btn wmlogin mod" data-offset="100" data-url="<?=$m?>logout.php" data-toggle="modal" data-target="#modal4all">Se déconnecter</a>
        
    <?php }?>
</li>