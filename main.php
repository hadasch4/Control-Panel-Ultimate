<?php
session_start();

// Framework einbinden
include("framework/framework.class.php");

if(!empty($_SESSION["acc"])){

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
    <!-- Bootstrap 3.3.4 -->
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
  <!-- ADD THE CLASS layout-boxed TO GET A BOXED LAYOUT -->
  <body class="skin-blue layout-boxed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="main.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><?php echo $o_main->getSmallHeadline();?></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?php echo $o_main->getHeadline();?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="http://weedarr.wdfiles.com/local--files/skinlistc/<?php echo $o_main->getSkinID($_SESSION["acc"]);?>.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION["acc"];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="http://weedarr.wdfiles.com/local--files/skinlistc/<?php echo $o_main->getSkinID($_SESSION["acc"]);?>.png" class="img-rounded" alt="User Image">
                    <p>
                      <?php echo $_SESSION["acc"];?>
                      <small><?php echo $o_main->getRegisterDate($_SESSION["acc"]);?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="framework/logout.php" class="btn btn-default btn-flat">Abmelden</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="http://weedarr.wdfiles.com/local--files/skinlistc/<?php echo $o_main->getSkinID($_SESSION["acc"]);?>.png" class="img-rounded" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION["acc"];?></p>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
			<li class="header">Informationen</li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i> <span>Mein Account</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="main.php?site=acc"><i class="fa fa-circle-o"></i> Allgemein</a></li>
				<li><a href="main.php?site=pwchange"><i class="fa fa-circle-o"></i> Passwort ändern</a></li>
				<li><a href="main.php?site=nichange"><i class="fa fa-circle-o"></i> Name ändern</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-university"></i> <span>Bank</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="main.php?site=banku"><i class="fa fa-circle-o"></i> Überweisung</a></li>
				<li><a href="main.php?site=bankt"><i class="fa fa-circle-o"></i> Transaktionen</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-car"></i> <span>Fahrzeuge</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="main.php?site=veh"><i class="fa fa-circle-o"></i> Fahrzeuge</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-home"></i> <span>Immobilien</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="main.php?site=myimmo"><i class="fa fa-circle-o"></i>Meine Immobilie</a></li>
				<li><a href="main.php?site=immo"><i class="fa fa-circle-o"></i>Freie Immobilien</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-building"></i> <span>Firmen</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="main.php?site=company"><i class="fa fa-circle-o"></i>Firmen</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-group"></i> <span>Fraktion</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="main.php?site=fraktion"><i class="fa fa-circle-o"></i> Allgemein</a></li>
				<?php 
				if($o_main->isFraktion($_SESSION["acc"])){
					echo "
						<li><a href='main.php?site=gang'><i class='fa fa-circle-o'></i> <span>Ganggebiete</span></a></li>
					";
				}
				?>
              </ul>
            </li>
            <li class="header">Sonstiges</li>
			<li><a href="main.php?site=changelog"><i class="fa fa-history"></i> <span>Changelog</span></a></li>
            <li><a href="<?php echo $o_main->getImpressum();?>"><i class="fa fa-file-text-o"></i> <span>Impressum</span></a></li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-ticket"></i> <span>Ticket</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="main.php?site=myticket"><i class="fa fa-ticket"></i>Meine Tickets</a></li>
				<li><a href="main.php?site=crticket"><i class="fa fa-plus"></i>Ticket erstellen</a></li>
              </ul>
            </li>
			<?php 
				if($o_main->isProjektleitung($_SESSION["acc"])){
					echo "
						<li class='header'>Adminbereich</li>
						<li><a href='main.php?site=admin'><i class='fa fa-cog'></i> <span>Allgemein</span></a></li>
						<li><a href='main.php?site=admint'><i class='fa fa-ticket'></i> <span>Tickets</span></a></li>
						<li><a href='main.php?site=adminc'><i class='fa fa-history'></i> <span>Changelog</span></a></li>
					";
				}
			?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		<?php
			if(isset($_GET["site"])){
				if($_GET["site"] == "acc"){
					$o_main->getMyAccount($_SESSION["acc"]);
				}elseif($_GET["site"] == "pwchange"){	
					$o_main->changePassword($_SESSION["acc"]);
				}elseif($_GET["site"] == "nichange"){	
					$o_main->changeNick($_SESSION["acc"]);
				}elseif($_GET["site"] == "banku"){	
					$o_main->getBankU($_SESSION["acc"]);
				}elseif($_GET["site"] == "bankt"){
					$o_main->getBankTransfer($_SESSION["acc"]);
				}elseif($_GET["site"] == "myticket"){	
					$o_main->getMyTickets($_SESSION["acc"]);
				}elseif($_GET["site"] == "crticket"){	
					$o_main->createTicket($_SESSION["acc"]);
				}elseif($_GET["site"] == "changelog"){	
					$o_main->getChangelog();
				}elseif($_GET["site"] == "immo"){	
					$o_main->getImmo();
				}elseif($_GET["site"] == "myimmo"){	
					$o_main->getMyImmo($_SESSION["acc"]);
				}elseif($_GET["site"] == "company"){
					$o_main->getCompanys();
				}elseif($_GET["site"] == "fraktion"){	
					$o_main->getMyFraktion($_SESSION["acc"]);
				}elseif($_GET["site"] == "gang"){	
					if($o_main->isFraktion($_SESSION["acc"])){
						$o_main->getGangarea();
					}else{
						// home page
						$o_main->error404();
					}
				}elseif($_GET["site"] == "veh"){	
					$o_main->getMyVehicle($_SESSION["acc"]);
				}elseif($_GET["site"] == "admin"){	
					if($o_main->isProjektleitung($_SESSION["acc"])){
						if(isset($_GET["search"])){
							$o_main->sAdminEx($_GET["search"]);
						}else{
							$o_main->sAdmin();
						}
					}else{
						// home page
						$o_main->error404();
					}
				}elseif($_GET["site"] == "admint"){	
					if($o_main->isProjektleitung($_SESSION["acc"])){
						$o_main->tAdmin();
					}else{
						// home page
						$o_main->error404();
					}
				}elseif($_GET["site"] == "adminc"){	
					if($o_main->isProjektleitung($_SESSION["acc"])){
						$o_main->cAdmin();
					}else{
						// home page
						$o_main->error404();
					}
				}else{
					// home page
					$o_main->error404();
				}
			}else{
				// home page
				$o_main->sHome();
			}
		?>
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> <?php echo $o_main->getVersion();?> <b>Entwickelt von</b> <a href="<?php echo $o_main->getDeveloperLink();?>"><?php echo $o_main->getDeveloper();?></a>
        </div>
        <strong>Copyright &copy; 2014-2015 <?php echo $o_main->getCopyright();?></strong>
      </footer>

	<?php
	
		// Javascript ... include
		$o_main->getJavascript();
	
	?>
  </body>
</html>
<?php
	}else{
		// Weiterleitung
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("Location: index.php");
	}
?>
