<?php

	if(!empty($_SESSION['REDIS']['HOSTNAME'])){
		header("HTTP/1.1 301 Moved Permanently"); 
		header('location: '.$LINK->getLink('dashboard'));
		exit(0);		
	}

	if(!empty($_POST['host']) AND !empty($_POST['user']) AND !empty($_POST['pass'])){
	 
		$post = $DB->Request('post');
		
		if( ($post['user']==$config['admin']['user']) AND ($post['pass']==$config['admin']['pass']) ){
		 
			$_SESSION['REDIS']['HOSTNAME']=$post['host'];
			
			header("HTTP/1.1 301 Moved Permanently"); 
			header('location: '.$LINK->getLink('dashboard'));
			exit(0);
			
		}else{
			$VARS['error']="Access denied."; 
		}
	}
?>
<?php $ROUTER->getInclude('header'); ?>


<div id="logintitle">
	<p><img src="<?php echo $LINK->getLink('logo-s'); ?>" title="Redis Admin" alt="Redis Admin" /></p>
</div>

<?php if(!empty($VARS['error'])){ ?><div id="error"><?php echo $VARS['error']; ?></div><?php } ?>

<form action="" method="post">
<input type="hidden" name="host" value="localhost" />
<div id="widget" style="margin: 0 auto; width: 280px;">
	<h1>Login</h1>
	<p>
		<label><strong>Username:</strong></label>
		<span><input type="text" name="user" width="20" /></span>
	</p>
	
	<p>
		<label><strong>Password:</strong></label>
		<span><input type="password" name="pass" width="20" /></span>
	</p>

	<p>
		<label>&nbsp;</label>	
		<span><input type="submit" value="Connect" /></span>
	</p>
	
	<div>&nbsp;</div>
</div>
</form>

<br />
<br />

<style>#footer { border: 0; }</style>

<?php $ROUTER->getInclude('footer'); ?>