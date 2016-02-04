<?php
session_start();

// Framework einbinden
include("framework/framework.class.php");

$sta = 0;

if(isset($_POST["acc"]) AND isset($_POST["password"])){
	
	$acc = mysql_real_escape_string($_POST["acc"]);
	$pw = mysql_real_escape_string($_POST["password"]);
	
	if(empty($acc) OR empty($pw)){
		$sta = 1;
	}else{
		// check account
		$pw = $o_main->getVerschluesseln($pw,$acc);
		if($o_main->checkAccount($acc,$pw) == true){
			$_SESSION["acc"] = $acc;
			$sta = 2;
		}else{
			$sta = 1;
		}
	}
	
}


?>

<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $o_main->getTitle();?></title>
	<meta charset="<?php echo $o_main->getCharset();?>">
	<meta name="description" content="<?php echo $o_main->getDescription();?>">
	<meta name="keywords" content="<?php echo $o_main->getKeywords();?>">
	<meta name="author" content="<?php echo $o_main->getAuthor();?>">
	<meta http-equiv="language" content="<?php echo $o_main->getLanguage();?>">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?php
	
		// CSS include
		$o_main->getCSS();
	
	?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <b><?php echo $o_main->getHeadline();?></b> <?php echo $o_main->getSubtitle();?>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Melde dich mit deinen Ingame Daten an</p>
		<?php 
			if($sta == 2){
		?>
			<div class="alert alert-success  alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<h4><i class="icon fa fa-check"></i> Anmeldung erfolgreich</h4>
				Sie werden nun weitergeleitet
			</div>
			<meta http-equiv='refresh' content='3; URL=main.php' />
		<?php 
			}elseif($sta == 1){
		?>
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Fehler</h4>
            Accountname oder Passwort falsch
        </div>
		<?php 
			}
			
			if($sta != 2){
		?>
        <form action="index.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Account" name="acc">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
		<?php
			}
		?>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <?php
	
		// Javascript ... include
		$o_main->getJavascript();
	
	?>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
