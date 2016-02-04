<?php

include("config/config.class.php");

$o_config = new config();
$o_main = new framework();


mysql_connect($o_config->getMysqlHost(), $o_config->getMysqlUser(), $o_config->getMysqlPassword());
mysql_select_db($o_config->getMysqlDatabase());


class framework{
	
	//////////////////////
	// variable			//
	//////////////////////

	// general settings
	private $title = "CP";
	private $description = "Diese Seite wurde mit PHP OOP erstellt.";
	private $keywords = "PHP, OOP, PHP OOP";
	private $author = "CobraDE";
	private $language = "de";
	private $charset = "UTF-8";
	private $impressum = "http://www.google.de";
	
	// page settings
	private $headline = "Server";
	private $small_headline = "SER"; // for mobile devices 
	private $subtitle = "Control Panel";
	private $dev = false;
	private $copyright = "CobraDE";
	private $developer = "CobraDE";
	private $developer_link = "https://www.mta-sa.org/user/7955-cobrade/";
	private $legend = true;
	private $online_player = true;
	private $version = "1.1.0";
	private $ip = "localhost";
	private $mta_version = "1.5.2";
	private $ts = "localhost";
	private $forum = "localhost/forum";
	private $website = "localhost";
	private $money_border = "1000000";

	// style settings
	private $css = array("bootstrap/css/bootstrap.min.css","https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css","https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css","dist/css/AdminLTE.min.css","dist/css/skins/_all-skins.min.css");
	
	// javascript settings
	private $javascript = array("plugins/jQuery/jQuery-2.1.4.min.js","bootstrap/js/bootstrap.min.js","plugins/slimScroll/jquery.slimscroll.min.js","plugins/fastclick/fastclick.min.js","dist/js/app.min.js","dist/js/demo.js");
	
	// Legend settings
	private $user = "default";
	private $vip = "default";
	private $ticket = "primary";
	private $supporter = "success";
	private $moderator = "info";
	private $admin = "warning";
	private $projektleitung = "danger";
	
	private $mafia = "#000";
	private $sfpd = "#00FFFF";
	private $triaden = "#FF0000";
	private $terroristen = "#663300";
	private $reporter = "#FF8000";
	private $fbi = "#000099";
	private $aztecas = "#FFFF00";
	private $biker = "#07D200";
	private $cdefault = "#E600FF";
	private $font_color = "#323232";
	
	// sonstiges
	private $nick_money = 250000;
	
	//////////////////////
	// functions		//
	//////////////////////
	
	function getTitle(){
		return $this->title;
	}
	
	function getDescription(){
		return $this->description;
	}
	
	function getKeywords(){
		return $this->keywords;
	}
	
	function getAuthor(){
		return $this->author;
	}
	
	function getLanguage(){
		return $this->language;
	}
	
	function getCharset(){
		return $this->charset;
	}
	
	function getImpressum(){
		return $this->impressum;
	}
	
	function getHeadline(){
		return $this->headline;
	}
	
	function getSmallHeadline(){
		return $this->small_headline;
	}
	
	function getSubtitle(){
		return $this->subtitle;
	}
	
	function getVersion(){
		return $this->version;
	}
	
	function getDev(){
		return $this->dev;
	}
	
	function getCopyright(){
		return $this->copyright;
	}
	
	function getDeveloper(){
		return $this->developer;
	}
	
	function getDeveloperLink(){
		return $this->developer_link;
	}
	
	function getIP(){
		return $this->ip;
	}
	
	function getMtaVersion(){
		return $this->mta_version;
	}
	
	function getTs(){
		return $this->ts;
	}
	
	function getForum(){
		return $this->forum;
	}
	
	function getWebsite(){
		return $this->website;
	}
	
	function getCSS(){
		$count = count($this->css);
		for($i=0;$i<$count;$i++){
			echo "<link rel='stylesheet' href='{$this->css[$i]}'>\n";
		}
	}
	
	function getJavascript(){
		$count = count($this->javascript);
		for($i=0;$i<$count;$i++){
			echo "<script src='{$this->javascript[$i]}'></script>\n";
		}
	}
	
	function getLegend(){
		if($this->legend){
			return true;
		}else{
			return false;
		}
	}
	
	function getOnlinePlayer(){
		if($this->online_player){
			return true;
		}else{
			return false;
		}
	}
	
	function getTeamColor($name){
		if($name == 0){
			return $this->user;
		}else if($name == 1){
			return $this->vip;
		}else if($name == 2){
			return $this->ticket;
		}else if($name == 3){
			return $this->supporter;
		}else if($name == 4){
			return $this->moderator;
		}else if($name == 5){
			return $this->admin;
		}else if($name == 6){
			return $this->projektleitung;
		}else{
			return $this->user;
		}
	}
	
	function getFraktionColor($name){
		if($name == "Mafia"){
			return $this->mafia;
		}else if($name == "SFPD"){
			return $this->sfpd;
		}else if($name == "Triaden"){
			return $this->triaden;
		}else if($name == "Terroristen"){
			return $this->terroristen;
		}else if($name == "Reporter"){
			return $this->reporter;
		}else if($name == "FBI"){
			return $this->fbi;
		}else if($name == "Aztecas"){
			return $this->aztecas;
		}else if($name == "Biker"){
			return $this->biker;
		}else{
			return $this->cdefault;
		}
	}
	
	function getFraktionLabel($msg,$color){
		return "<span class='label label-default' style='background-color:{$color};color:{$this->font_color}'>{$msg}</span>";
	}
	
	function getAllOnlinePlayers(){
		$query = mysql_query("SELECT * FROM loggedin") or die(mysql_error());
		$result = mysql_num_rows($query);
		
		if($result >= 1){
			echo "<i>Online Players {$result}</i><div class='well well-sm'>";
			while($row = mysql_fetch_assoc($query)){
				$name = $row['Name'];
				$getTeam = mysql_query("SELECT Adminlevel FROM userdata WHERE Name = '$name'") or die (mysql_error());
				while($row = mysql_fetch_assoc($getTeam)){
					$rang = $row["Adminlevel"];
					$color = $this->getTeamColor($rang);
				}
				echo "<span class='label label-{$color}'>{$name}</span>\n";
			}
			echo "</div>";
		}
	}
	
	function error($headline,$msg){
		echo "
		<div class='container'>
			<div class='alert alert-warning' role='alert'><strong>{$headline}</strong> {$msg}</div>
		</div>
		";
	}
	
	function checkAccount($acc,$pw){
		$query = mysql_query("SELECT * FROM players WHERE Name = '$acc' AND Passwort='$pw'") or die(mysql_error());
		$result = mysql_num_rows($query);
		if($result >= 1){
			return true;
		}else{
			return false;
		}
	}
	
	function getRegisterDate($name){
		$query = mysql_query("SELECT RegisterDatum FROM players WHERE Name = '$name'") or die(mysql_error());
		$result = mysql_num_rows($query);
		if($result >= 1){
			while($row = mysql_fetch_assoc($query)){
				$date = $row["RegisterDatum"];
			}
			return "Mitglied seit {$date}";
		}else{
			return "Datum nicht verfügbar";
		}
	}
	
	function getSkinID($name){
		$query = mysql_query("SELECT Skinid FROM userdata WHERE Name = '$name'") or die(mysql_error());
		$result = mysql_num_rows($query);
		if($result >= 1){
			while($row = mysql_fetch_assoc($query)){
				$id = $row["Skinid"];
			}
			return $id;
		}else{
			return 0;
		}
	}
	
	function changePassword($name){
		echo "<section class='content-header'>
				  <h1>
					<i class='fa fa-key'></i> Passwort ändern
				  </h1>
				</section>
				<section class='content'>
					<div class='callout callout-info'>
						<strong>Hallo {$name}</strong>
						<p>Sie können hier Ihr Passwort ändern. Sofern die Aktion erfolgreich war, werden Sie automatisch auf die Login Seite weitergeleitet.</p>
					</div>
					<div class='row'>
						<div class='col-md-12'>
							<form class='form-horizontal' method='post' action='pw_change.php'>
								<div class='form-group'>
									<label for='inputName' class='col-sm-2 control-label'>altes Passwort</label>
									<div class='col-sm-10'>
										<input type='password' class='form-control' id='inputName' name='old' required>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputDate' class='col-sm-2 control-label'>neues Passwort</label>
									<div class='col-sm-10'>
										<input type='password' class='form-control' id='inputDate' name='new' required>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputDate2' class='col-sm-2 control-label'>Passwort wiederholen</label>
									<div class='col-sm-10'>
										<input type='password' class='form-control' id='inputDate2' name='new2' required>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-offset-2 col-sm-10'>
										<button type='submit' class='btn btn-primary'>Passwort ändern</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
		";
	}
	
	function changeNick($name){
		echo "<section class='content-header'>
				  <h1>
					<i class='fa fa-key'></i> Namen ändern
				  </h1>
				</section>
				<section class='content'>
					<div class='callout callout-info'>
						<strong>Hallo {$name}</strong>
						<p>Sie können hier Ihren Namen ändern. Sofern die Aktion erfolgreich war, werden Sie automatisch auf die Login Seite weitergeleitet.</p>
					</div>
					<div class='alert alert-danger' role='alert'>Der Nickchange kostet Sie <strong>{$this->nick_money} $</strong></div>
					<div class='row'>
						<div class='col-md-12'>
							<form class='form-horizontal' method='post' action='nick_change.php'>
								<div class='form-group'>
									<label for='inputName' class='col-sm-2 control-label'>neuer Name</label>
									<div class='col-sm-10'>
										<input type='text' class='form-control' id='inputName' name='new' required>
									</div>
								</div>
								<input type='hidden' name='money' value='{$this->nick_money}'>
								<div class='form-group'>
									<div class='col-sm-offset-2 col-sm-10'>
										<button type='submit' class='btn btn-primary'>Name ändern</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
		";
	}
	
	function destroySession(){
		session_destroy();
	}
	
	function getVerschluesseln($password,$name){
		return hash( "sha512" , hash( "sha512" , $password));
	} 
	
	function getVehicles(){
		$query = mysql_query("SELECT * FROM vehicles") or die(mysql_error());
		$result = mysql_num_rows($query);
		return $result;
	}
	
	function getMoney(){
		$query = mysql_query("SELECT Geld,Bankgeld FROM userdata") or die(mysql_error());
		$money = 0;
		while($row = mysql_fetch_assoc($query)){
			$geld = $row["Geld"];
			$bank = $row["Bankgeld"];
			$money = $money + $geld + $bank;
		}
		return $money;
	}
	
	function getMembers(){
		$query = mysql_query("SELECT * FROM userdata") or die(mysql_error());
		$result = mysql_num_rows($query);
		return $result;
	}
	
	function getTeamMembers(){
		$query = mysql_query("SELECT * FROM userdata WHERE Adminlevel != '0'") or die(mysql_error());
		$result = mysql_num_rows($query);
		return $result;
	}
	
	function getMoneyBorder(){
		return $this->money_border;
	}
	
	function isProjektleitung($name){
		$query = mysql_query("SELECT * FROM userdata WHERE Adminlevel >= '4' AND Name = '$name'") or die(mysql_error());
		$result = mysql_num_rows($query);
		if($result >= 1){
			return true;
		}else{
			return false;
		}
	}
	
	function getChangelog(){
		echo "
			<section class='content'>
				<div class='row'>
					<div class='col-md-12'>
						<!-- The time line -->
						<ul class='timeline'>
						<!-- timeline item -->";

						
		$query = mysql_query("SELECT * FROM cp_changelog ORDER BY ID DESC LIMIT 10") or die(mysql_error());
		$result = mysql_num_rows($query);
		if($result != 0){
			while($row = mysql_fetch_assoc($query)){
				$id = $row["ID"];
				$date = $row["Date"];
				$msg = nl2br($row["msg"]);
				$name = $row["user"];
				$betreff = $row["betreff"];
				echo "
				<li>
                  <i class='fa fa-envelope bg-blue'></i>
                  <div class='timeline-item'>
                    <span class='time'><i class='fa fa-clock-o'></i> {$date}</span>
                    <h3 class='timeline-header'><a href='#'>{$name}</a> {$betreff}</h3>
                    <div class='timeline-body'>
                     {$msg}
                    </div>
                  </div>
                </li>
				";
			}
			echo "
				<li>
				<i class='fa fa-clock-o bg-gray'></i>
            </li>
			";
		}else{
			echo '
			<li>
				<i class="fa fa-envelope bg-blue"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> XX.XX</span>
                    <h3 class="timeline-header"><a href="#">Support Team</a></h3>
                    <div class="timeline-body">
                     Es wurde noch kein Eintrag erstellt.
                    </div>
                  </div>
                </li>
			<li>
				<i class="fa fa-clock-o bg-gray"></i>
            </li>';
		}
		
		echo "
					</ul>
				</div>
			</div>
		</section>
		";
	}
	
	function getLastPlayers(){
		$query = mysql_query("SELECT * FROM players ORDER BY UID DESC LIMIT 4") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$name = $row["Name"];
			$date = $row["RegisterDatum"];
			$gender = $row["Geschlecht"];
			if($gender == 0){
				$gender = "male";
			}else{
				$gender = "female";
			}
			
			echo "
				<tr>
					<td>{$name}</td>
					<td>{$date}</td>
					<td><i class='fa fa-{$gender}'></i></td>
				</tr>
			";
			
		}
	}
	
	function sHome(){
		echo "
		<section class='content-header'>
          <h1>
            {$this->getHeadline()}
            <small>{$this->getSubtitle()}</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class='content'>
		  <div class='callout callout-info'>
            <strong>IP: {$this->getIP()}</strong>
            <p>Version: {$this->getMtaVersion()}</p>
			<p>Teamspeak: {$this->getTs()}<br>Website: {$this->getWebsite()}<br>Forum: {$this->getForum()}</p>
          </div>
          <div class='callout callout-info'>
            <h4>{$_SESSION['acc']}</h4>
            <p>Sie befinden sich nun im Control Panel von  {$this->getHeadline()} {$this->getSubtitle()}. Sie können hier Informationen über Ihren Account sowie Statistiken des Server einsehen.</p>
          </div>
		  <!-- Small boxes (Stat box) -->
          <div class='row'>
            <div class='col-lg-3 col-md-6'>
              <!-- small box -->
              <div class='small-box bg-aqua'>
                <div class='inner'>
                  <h3>{$this->getVehicles()}</h3>
                  <p>Fahrzeuge</p>
                </div>
                <div class='icon'>
                  <i class='fa fa-car'></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class='col-lg-3 col-md-6'>
              <!-- small box -->
              <div class='small-box bg-green'>
                <div class='inner'>
                  <h3>{$this->getMoney()} $</h3>
                  <p>Geld</p>
                </div>
              </div>
            </div><!-- ./col -->
            <div class='col-lg-3 col-md-6'>
              <!-- small box -->
              <div class='small-box bg-yellow'>
                <div class='inner'>
                  <h3>{$this->getMembers()}</h3>
                  <p>Mitglieder</p>
                </div>
                <div class='icon'>
                  <i class='ion ion-person-add'></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class='col-lg-3 col-md-6'>
              <!-- small box -->
              <div class='small-box bg-red'>
                <div class='inner'>
                  <h3>{$this->getTeamMembers()}</h3>
                  <p>Team Mitglieder</p>
                </div>
                <div class='icon'>
                  <i class='ion ion-pie-graph'></i>
                </div>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->
		  <div class='row'>
            <div class='col-md-12'>
				<div class='box'>
					<div class='box-header'>
					  <h3 class='box-title'>Neuste Mitglieder</h3>
					</div><!-- /.box-header -->
					<div class='box-body no-padding'>
					  <table class='table'>
						<tr>
						  <th>Name</th>
						  <th>Registrierdatum</th>
						  <th>Geschlecht</th>
						</tr>";
			$this->getLastPlayers();
			echo "
					  </table>
					</div><!-- /.box-body -->
				  </div><!-- /.box -->";
				  $this->getTeam();
				  echo "
				</div>
			</div>
        </section><!-- /.content -->";
	}
	
	function error404(){
		echo "
        <!-- Main content -->
        <section class='content'>
          <div class='error-page'>
            <h2 class='headline text-yellow'> 404</h2>
            <div class='error-content'>
              <h3><i class='fa fa-warning text-yellow'></i> Oops! Seite nicht gefunden.</h3>
              <p>
                Wir konnten die angegebene Seite nicht finden.
                Möchtest du zur <a href='main.php'>Hauptseite zurückkehren</a>.
              </p>
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
        </section><!-- /.content -->
		";
	}
	
	function sAdmin(){
		echo "
		<section class='content-header'>
          <h1>
            Administrations
            <small>Bereich</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class='content'>
		  <div class='callout callout-info'>
            <strong>Information</strong>
            <p>Auffällige Einträge werden rot markiert.</p>
          </div>
		   <form class='search-form' style='margin-bottom:10px;'>
                <div class='input-group'>
				  <input type='hidden' name='site' value='admin'>
                  <input type='text' name='search' class='form-control' placeholder='Spieler suchen'>
                  <div class='input-group-btn'>
                    <button type='submit' class='btn btn-warning btn-flat'><i class='fa fa-search'></i></button>
                  </div>
                </div><!-- /.input-group -->
            </form>
		<div class='row'>
			<div class='col-md-12'>
			  <div class='box'>
                <div class='box-body'>
                  <table id='example2' class='table table-bordered table-hover'>
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Geschlecht</th>
                        <th>Geld</th>
                        <th>Zuletzt Online</th>
                        <th>Serial</th>
                      </tr>
                    </thead>
                    <tbody>";
		$query = mysql_query("SELECT * FROM players ORDER BY UID DESC") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			
			$name = $row["Name"];
			$serial = $row["Serial"];
			$last_login = $row["Last_login"];
			$gender = $row["Geschlecht"];
			
			$query2 = mysql_query("SELECT * FROM userdata WHERE Name = '$name'") or die(mysql_error());
			$money = 0;
			while($row = mysql_fetch_assoc($query2)){
				
				$geld = $row["Geld"];
				$bank = $row["Bankgeld"];
				
				$money = $money + $geld + $bank;
			}
			
			if($money >= $this->getMoneyBorder()){
				$money = "<span class='label label-danger'>{$money} $</span>";
			}else{
				$money = "{$money} $";
			}
			
			if($gender == 0){
				$gender = "male";
			}else{
				$gender = "female";
			}
			
			echo "
			 <tr>
				<td><a href='main.php?site=admin&search={$name}'>{$name}</a></td>
				<td><i class='fa fa-{$gender}'></i></td>
                <td>{$money}</td>
				<td>{$last_login}</td>
                <td>{$serial}</td>
             </tr>
			";
			
        }     
		
		echo "
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			</div>
		</div>
		</section>
		";
	}
	
	function getDate($day,$month,$year){
		date_default_timezone_set("Europe/Berlin");
		 
		$datum1 = new DateTime("{$day}-{$month}-{$year}"); //Geburtsdatum
		$datum2 = new DateTime(date('Y')+'-'+date('m')+'-'+date('d')); //Aktuelles Datum
		 
		$interval = $datum2->diff($datum1);

		if($interval->format("%Y") < 18){
			return "<span class='label label-danger'>Unter 18 ({$interval->format('%Y')})</span>";
		}else{
			return "";
		}
	}
	
	function multiexplode ($delimiters,$string) {
   
		$ready = str_replace($delimiters, $delimiters[0], $string);
		$launch = explode($delimiters[0], $ready);
		return  $launch;
		
	}
	
	function mathTime($time){
		$new = $this->multiexplode(array(",","."),$time);
		$day = intval($new[0]);
		$month = $new[1];
		$year = $new[2];
		
		date_default_timezone_set("Europe/Berlin");
		 
		$datum1 = new DateTime("{$day}-{$month}-{$year}"); //Geburtsdatum
		$datum2 = new DateTime(date('Y')+'-'+date('m')+'-'+date('d')); //Aktuelles Datum

		$interval = $datum2->diff($datum1);
		
		$wochen = floor($interval->format('%d') / 7);
		$tage = ($interval->format('%d') % 7);
		
		if($interval->format("%Y") > 0){
			$y_new = "{$interval->format("%Y")} Jahren";
		}else{
			$y_new = "";
		}
		
		if($interval->format("%m") > 0){
			$m_new = "{$interval->format("%m")} Monaten";
		}else{
			$m_new = "";
		}
		
		if($interval->format("$tage") > 0){
			$t_new = "{$interval->format("$tage")} Tagen";
		}else{
			$t_new = "";
		}
		
		if($interval->format("$wochen") > 0){
			$w_new = "{$interval->format("$wochen")} Wochen";
		}else{
			$w_new = "";
		}

		return "{$day}.{$month}.{$year} - zuletzt online vor {$y_new} {$m_new} {$w_new} {$t_new}";

	}
	
	function sAdminEx($name){
		echo "
		<section class='content-header'>
          <h1>
            Administrations
            <small>Bereich</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class='content'>
		  <div class='callout callout-info'>
            <strong>Information</strong>
            <p>Auffällige Einträge werden rot markiert.</p>
          </div>
		  <div class='row'>
			<div class='col-md-12'> 
			";
	$query = mysql_query("SELECT * FROM players WHERE Name = '$name'") or die(mysql_error());
	$result = mysql_num_rows($query);
	
	if($result >= 1){
		echo "
		<div class='box'>
			<div class='box-header'>
					  <h3 class='box-title'>allgemein</h3>
					</div><!-- /.box-header -->
                <div class='box-body'>
                  <table id='example2' class='table table-bordered table-hover'>
                    <tbody>
		";
		while($row = mysql_fetch_assoc($query)){
		
			$name = $row["Name"];
			$serial = $row["Serial"];
			$last_login = $row["Last_login"];
			$gender = $row["Geschlecht"];
			$ip = $row["IP"];
			$day = $row["Geburtsdatum_Tag"];
			$month = $row["Geburtsdatum_Monat"];
			$year = $row["Geburtsdatum_Jahr"];
			
			$query2 = mysql_query("SELECT * FROM userdata WHERE Name = '$name'") or die(mysql_error());
			$money = 0;
			while($row = mysql_fetch_assoc($query2)){
				
				$geld = $row["Geld"];
				$bank = $row["Bankgeld"];
				
				$money = $money + $geld + $bank;
				
			}
			
			if($money >= $this->getMoneyBorder()){
				$money = "<span class='label label-danger'>{$money} $</span>";
			}else{
				$money = "{$money} $";
			}
			
			if($gender == 0){
				$gender = "male";
			}else{
				$gender = "female";
			}
			
			echo "
			 <tr>
				<td>Username</td>
				<td>{$name}</td>
             </tr>
			  <tr>
				<td>Geschlecht</td>
				<td><i class='fa fa-{$gender}'></i></td>
             </tr>
			 <tr>
				<td>Geburtstag</td>
				<td>{$day}.{$month}.{$year} {$this->getDate($day,$month,$year)}</td>
             </tr>
			  <tr>
				<td>Geld</td>
				<td>{$money}</td>
             </tr>
			  <tr>
				<td>Zuletzt Online</td>
				<td>{$this->mathTime($last_login)}</td>
             </tr>
			  <tr>
				<td>Serial</td>
				<td>{$serial}</td>
             </tr>
			 <tr>
				<td>IP</td>
				<td>{$ip}</td>
             </tr>
			";
			
		}
			echo "
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
		";
		// Warnings
		echo "
		<div class='box'>
			<div class='box-header'>
					  <h3 class='box-title'>Informationen</h3>
					</div><!-- /.box-header -->
                <div class='box-body'>
                  <table id='example2' class='table table-bordered table-hover'>
                    <tbody>
		";
		
			$query3 = mysql_query("SELECT * FROM players WHERE IP = '$ip' AND Name != '$name'") or die(mysql_error());
			$result3 = mysql_num_rows($query3);
			if($result3 != 0){
				$output = "";
				while($row = mysql_fetch_assoc($query3)){
					
					$nname = $row["Name"];
					$output = "{$output} <a href='main.php?site=admin&search={$nname}'>{$nname}</a> ,";
					
				}
				echo "<tr>
					<td>Doppelaccounts</td>
					<td>{$output}</td>
				 </tr>";
			}else{
				echo "<tr>
					<td>Doppelaccounts</td>
					<td>keine</td>
				 </tr>";
			}
		
		echo "
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
		";
	}else{
		echo "
			<div class='error-page'>
            <h2 class='headline text-yellow'> 404</h2>
            <div class='error-content'>
              <h3><i class='fa fa-warning text-yellow'></i> Oops!</h3>
              <p>
                <strong>{$name}</strong> wurde nicht in der Datenbank gefunden. Haben Sie sich verschrieben</a>.
              </p>
            </div><!-- /.error-content -->
          </div><!-- /.error-page -->
		";
	}

	echo"
			</div>
		  </div>
		  </section>";
	}
	
	function getTeam(){
		$query = mysql_query("SELECT * FROM userdata WHERE Adminlevel != '0'") or die(mysql_error());
		echo "
		<div class='box'>
                <div class='box-body no-padding'>
				<div class='box-header'>
					  <h3 class='box-title'>Team Mitglieder</h3>
					</div><!-- /.box-header -->
                  <table class='table'>
				  <thead>
                      <tr>
                        <th>Name</th>
                        <th>Rang</th>
                      </tr>
                    </thead>
                    <tbody>
		";
		while($row = mysql_fetch_assoc($query)){
			
			$name = $row["Name"];
			$rang = $row["Adminlevel"];
			$bez = "";
			
			if($rang == 2){
				$rang = $this->ticket;
				$bez = "Ticketsupporter";
			}else if($rang == 3){
				$rang = $this->supporter;
				$bez = "Supporter";
			}else if($rang == 4){
				$rang = $this->moderator;
				$bez = "Moderator";
			}else if($rang == 5){
				$rang = $this->admin;
				$bez = "Admin";
			}else if($rang == 6){
				$rang = $this->projektleitung;
				$bez = "Projektleitung";
			}
		
			echo "
			 <tr>
				<td>{$name}</td>
				<td><span class='label label-{$rang}'>{$bez}</span></td>
             </tr>";
		}
		echo "
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
		";
	}
	
	function isFraktion($name){
		$query = mysql_query("SELECT * FROM userdata WHERE Fraktion != '0' AND Name = '$name'") or die(mysql_error());
		$result = mysql_num_rows($query);
		if($result == 0){
			return false;
		}else{
			return true;
		}
	}
	
	function getFraktionID($name){
		$query = mysql_query("SELECT Fraktion FROM userdata WHERE Name = '$name'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$frak = $row["Fraktion"];
		}
		return $frak;
	}
	
	function getFraktionName($id){
		$query = mysql_query("SELECT * FROM fraktionen WHERE ID = '$id'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$name = $row["Name"];
		}
		return $name;
	}
	
	function getFraktionRang($name){
		$query = mysql_query("SELECT FraktionsRang FROM userdata WHERE Name = '$name'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$frak = $row["FraktionsRang"];
		}
		return $frak;
	}
	
	function getFraktionKasse($id){
		$query = mysql_query("SELECT * FROM fraktionen WHERE ID = '$id' OR Name = '$id'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$geld = $row["DepotGeld"];
		}
		return $geld;
	}
	
	function getFraktionDrogen($id){
		$query = mysql_query("SELECT * FROM fraktionen WHERE ID = '$id' OR Name = '$id'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$drogen = $row["DepotDrogen"];
		}
		return $drogen;
	}
	
	function getFraktionMaterials($id){
		$query = mysql_query("SELECT * FROM fraktionen WHERE ID = '$id' OR Name = '$id'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$mats = $row["DepotMaterials"];
		}
		return $mats;
	}
	
	function getFraktionMemberCount($id){
		$query = mysql_query("SELECT * FROM userdata WHERE Fraktion = '$id'") or die(mysql_error());
		$result = mysql_num_rows($query);
		return $result;
	}
	
	function getGangarea(){
		echo "
			<section class='content-header'>
			  <h1>
				Ganggebiete
			  </h1>
			</section>

			<!-- Main content -->
			<section class='content'>
				<div class='callout callout-info'>
					<strong>Ganggebiete</strong>
					<p>Hier werden Ihnen alle Ganggebiete angezeigt</p>
			  </div>
			
			<div class='row'>
			<div class='col-md-12'>
			<div class='box'>
						<div class='box-header'>
					  <h3 class='box-title'>Ganggbiete</h3>
					</div><!-- /.box-header -->
						<table class='table table-bordered table-hover'>
							<thead>
								<tr>
									<th>Name</th>
									<th>Besitzer</th>
									<th>Einnahmen</th>
									
								</tr>
							</thead>
							<tbody>";
	
		$query = mysql_query("SELECT * FROM gangs ORDER BY BesitzerFraktion") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$id = $row["BesitzerFraktion"];
			$name = $row["Name"];
			$einnahmen = $row["Einnahmen"];
			
			
			$fname = $this->getFraktionName($id);
			
			$color = $this->getFraktionColor($fname);
			$label = $this->getFraktionLabel($fname,$color);
			
			echo "<tr><td>{$name}</td><td>{$label}</td><td>{$einnahmen}</td></tr>";
		}
		
		echo "</tbody></table></div></div></div></section>";
	}
	
	function getMyFraktion($name){
		$id = $this->getFraktionID($name);
		
		if($id == 0){
			echo "
			<section class='content-header'>
			  <h1>
				Meine Fraktion
				<small>Zivilist</small>
			  </h1>
			</section>

			<!-- Main content -->
			<section class='content'>
				<div class='callout callout-info'>
					<strong>Hallo {$name}</strong>
					<p>Sie sind Zivilist</p>
			  </div>
			</section>";
		}else{
		
			$fname = $this->getFraktionName($id);
			$rang = $this->getFraktionRang($name);
			$kasse = $this->getFraktionKasse($id);
			$drogen = $this->getFraktionDrogen($id);
			$mats= $this->getFraktionMaterials($id);
			$count = $this->getFraktionMemberCount($id);
			
			if($drogen >= 1000){
				$drogen = $drogen / 1000;
				$drogen = "{$drogen} kg.";
			}else{
				$drogen = "{$drogen} gr.";
			}
			
			
			$members = "";
			
			// get all Members
			$query = mysql_query("SELECT * FROM userdata WHERE Fraktion = '$id'") or die(mysql_error());
			$result_user = mysql_num_rows($query);
			while($row = mysql_fetch_assoc($query)){
				$nname = $row["Name"];
				$rang = $row["FraktionsRang"];
				$members = "{$members} <tr><td>{$nname}</td><td>{$rang}</td></tr>";
			}
			
			$blacklist = "";
			
			// get blacklist
			$query2 = mysql_query("SELECT * FROM blacklist") or die(mysql_error());
			$result_black = mysql_num_rows($query2);
			while($row = mysql_fetch_assoc($query2)){
				$eint = $row["EintraegerUID"];
				$uid = $row["UID"];
				
				if ($uid != "0"){
					$query3 = mysql_query("SELECT * FROM userdata WHERE UID = '$uid'") or die(mysql_error());
					while($row = mysql_fetch_assoc($query3)){
						$test = $row["Name"];
						$uid = $test;
					}
				if ($eint != "0"){
					$query3 = mysql_query("SELECT * FROM userdata WHERE UID = '$eint'") or die(mysql_error());
					while($row = mysql_fetch_assoc($query3)){
						$test2 = $row["Name"];
						$eint = $test2;
					}	
					$blacklist = "{$blacklist} <tr><td>{$uid}</td><td>{$eint}</td></tr>";
					}
				}	
			}
			
			
			
			
			$fkasse = "
				<div class='info-box bg-blue'>
					<span class='info-box-icon'><i class='fa fa-money'></i></span>
					<div class='info-box-content'>
					  <span class='info-box-text'>Fraktionskasse</span>
					  <span class='info-box-number'>{$kasse} $</span>
					  <div class='progress'>
						<div class='progress-bar' style='width: 0%'></div>
					  </div>
					  <span class='progress-description'>
						Es befinden sich {$kasse} $ in der Fraktionskasse
					  </span>
					</div><!-- /.info-box-content -->
				  </div><!-- /.info-box -->
			";
			
			$fdrogen = "
				<div class='info-box bg-blue'>
					<span class='info-box-icon'><i class='fa fa-leaf'></i></span>
					<div class='info-box-content'>
					  <span class='info-box-text'>Fraktionsdrogen</span>
					  <span class='info-box-number'>{$drogen}</span>
					  <div class='progress'>
						<div class='progress-bar' style='width: 0%'></div>
					  </div>
					  <span class='progress-description'>
						Es befinden sich {$drogen} Drogen im Depot
					  </span>
					</div><!-- /.info-box-content -->
				  </div><!-- /.info-box -->
			";
			
			$fmats = "
				<div class='info-box bg-blue'>
					<span class='info-box-icon'><i class='fa fa-industry'></i></span>
					<div class='info-box-content'>
					  <span class='info-box-text'>Fraktionsmaterialien</span>
					  <span class='info-box-number'>{$mats}</span>
					  <div class='progress'>
						<div class='progress-bar' style='width: 0%'></div>
					  </div>
					  <span class='progress-description'>
						Es befinden sich {$mats} Materialien im Depot
					  </span>
					</div><!-- /.info-box-content -->
				  </div><!-- /.info-box -->
			";
			
			$fcount = "
				<div class='info-box bg-green'>
					<span class='info-box-icon'><i class='fa fa-users'></i></span>
					<div class='info-box-content'>
					  <span class='info-box-text'>Mitglieder</span>
					  <span class='info-box-number'>{$count}</span>
					  <div class='progress'>
						<div class='progress-bar' style='width: 0%'></div>
					  </div>
					  <span class='progress-description'>
						Es befinden sich {$count} Spieler in der Fraktion
					  </span>
					</div><!-- /.info-box-content -->
				  </div><!-- /.info-box -->
			";
			
			echo "
			<section class='content-header'>
			  <h1>
				Meine Fraktion
				<small>{$fname}</small>
			  </h1>
			</section>

			<!-- Main content -->
			<section class='content'>
				<div class='callout callout-info'>
					<strong>Hallo {$name}</strong>
					<p>Sie sind Mitglied der Fraktion {$fname}, Ihr aktueller Rang ist {$rang}</p>
			  </div>
			  <div class='row'>
				<div class='col-md-6'>
					<div class='box'>
						<div class='box-header'>
					  <h3 class='box-title'>Unsere Mitglieder ({$result_user})</h3>
					</div><!-- /.box-header -->
						<table class='table table-bordered table-hover'>
							<thead>
								<tr>
									<th>Name</th>
									<th>Rang</th>
								</tr>
							</thead>
							<tbody>
								{$members}
							</tbody>
						</table>
					</div>
					<div class='box'>
						<div class='box-header'>
					  <h3 class='box-title'>Blacklist ({$result_black})</h3>
					</div><!-- /.box-header -->
						<table class='table table-bordered table-hover'>
							<thead>
								<tr>
									<th>Name</th>
									<th>eingetragen von</th>
								</tr>
							</thead>
							<tbody>
								{$blacklist}
							</tbody>
						</table>
					</div>
				</div>
				<div class='col-md-6'>
					{$fkasse}
					{$fdrogen}
					{$fmats}
					{$fcount}
				</div>
			</section>
			";
		}
		
	}
	
	function getMyVehicleCount($name){
		$query = mysql_query("SELECT * FROM vehicles WHERE Besitzer = '$name'") or die(mysql_error());
		$result = mysql_num_rows($query);
		return $result;
	}
	
	function getMyVehicle($name){
		$query = mysql_query("SELECT * FROM userdata WHERE Name = '$name'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$max = $row["MaximumCars"];
			$uid = $row["UID"];
		}
		
		$veh = "";
		
		$query2 = mysql_query("SELECT * FROM vehicles WHERE UID = '$uid'") or die(mysql_error());
		$count = mysql_num_rows($query2);
		
		while($row = mysql_fetch_assoc($query2)){
			$typ = $row["Typ"];
			$farbe = $row["Farbe"];
			$benzin = round($row["Benzin"]);
			$licht = $row["Lights"];
			$farbe = $row["Farbe"];
			$x = $row["Spawnpos_X"];
			$y = $row["Spawnpos_Y"];
			
			$farbea = explode('|',$farbe);
			
			$lichta = explode('|',$licht);
			
			$img = "http://weedarr.wdfiles.com/local--files/veh/{$typ}.png";
			
			$veh = "{$veh}
				<div class='row'>
					<div class='col-md-3'>
						 <a href='#' class='thumbnail'>
							<img src='{$img}' style='width:100%;'></img>
						</a>
					</div>
					<div class='col-md-9'>
						<div class='box'>
							<div class='box-body no-padding'>
								<table class='table'>
									<tbody>
										<tr>
											<td>Typ</td>
											<td>{$typ}</td>
										</tr>
										<tr>
											<td>Benzin</td>
											<td>{$benzin} Liter</td>
										</tr>
										<tr>
											<td>Farbe</td>
											<td><div style='background-color:rgb({$farbea[1]},{$farbea[2]},{$farbea[3]});width:100%;height:auto;'>{$farbea[1]},{$farbea[2]},{$farbea[3]}</div></td>
										</tr>
										<tr>
											<td>Licht</td>
											<td><div style='background-color:rgb({$lichta[1]},{$lichta[2]},{$lichta[3]});width:100%;height:auto;'>{$lichta[1]},{$lichta[2]},{$lichta[3]}</div></td>
										</tr>
										<tr>
											<td>Orten</td>
											<td><a href='framework/map.php?x={$x}&y={$y}'>Lage</a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			";
			
			$lichta = "";
		}
		
		$max_be = $count * 10;
		
		$car = "
			<div class='info-box bg-green'>
                <span class='info-box-icon'><i class='fa fa-car'></i></span>
                <div class='info-box-content'>
                  <span class='info-box-text'>Fahrzeuge</span>
                  <span class='info-box-number'>{$count} Fahrzeuge</span>
                  <div class='progress'>
                    <div class='progress-bar' style='width: {$max_be}%'></div>
                  </div>
                  <span class='progress-description'>
                    Sie haben schon {$count} von {$max} Fahrzeugen gekauft.
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
		";
		
		echo "
		<section class='content-header'>
          <h1>
            Meine Fahrzeuge
            <small>Übersicht</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class='content'>
			<div class='callout callout-info'>
				<strong>Hallo {$name}</strong>
				<p>Sie befinden sich hier auf ihrer Fahrzeug Seite, hier werden Ihnen alle Informationen über ihre Fahrzeuge angezeigt.</p>
          </div>
		  <div class='row'>
			<div class='col-md-12'>
				{$car}
			</div>
		  </div>
		  {$veh}
		</section>
		";
	}
	
	function getMyAccount($name){
		$query = mysql_query("SELECT * FROM userdata WHERE Name = '$name'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$wanteds = $row["Wanteds"];
			$auto = $row["Autofuehrerschein"];
			$motorrad = $row["Motorradtfuehrerschein"];
			$lkw = $row["LKWfuehrerschein"];
			$heli = $row["Helikopterfuehrerschein"];
			$fluga = $row["FlugscheinKlasseA"];
			$flugb = $row["FlugscheinKlasseB"];
			$motor = $row["Motorbootschein"];
			$segel = $row["Segelschein"];
			$angel = $row["Angelschein"];
			$perso = $row["Perso"];
			//$kills = $row["Kills"];
			//$tode = $row["Tode"];
			$geld = $row["Geld"];
			$bank = $row["Bankgeld"];
			
			$uid = $row["UID"];
		}
		
		$query2 = mysql_query("SELECT * FROM bonustable WHERE UID = '$uid'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query2)){
			$lunge = $row["Lungenvolumen"];
			$muskeln = $row["Muskeln"];
			$kondition = $row["Kondition"];
			$boxen = $row["Boxen"];
			$kungfu = $row["KungFu"];
			$street = $row["Streetfighting"];
			$pistolen = $row["PistolenSkill"];
			$deagle = $row["DeagleSkill"];
			$shotgun = $row["ShotgunSkill"];
			$assault = $row["AssaultSkill"];
			$mp = $row["MP5Skills"];
		}
		
		// Skills
		if($lunge == ""){
			$lunge = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$lunge = "<span class='label label-danger'>{$lunge}</span>";
		}
		
		if($muskeln == ""){
			$muskeln = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$muskeln = "<span class='label label-danger'>{$muskeln}</span>";
		}
		
		if($kondition == ""){
			$kondition = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$kondition = "<span class='label label-danger'>{$kondition}</span>";
		}
		
		if($boxen == ""){
			$boxen = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$boxen = "<span class='label label-danger'>{$boxen}</span>";
		}
		
		if($kungfu == ""){
			$kungfu = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$kungfu = "<span class='label label-danger'>{$kungfu}</span>";
		}
		
		if($street == ""){
			$street = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$street = "<span class='label label-danger'>{$street}</span>";
		}
		
		if($pistolen == ""){
			$pistolen = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$pistolen = "<span class='label label-danger'>{$pistolen}</span>";
		}
		
		if($deagle == ""){
			$deagle = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$deagle = "<span class='label label-danger'>{$deagle}</span>";
		}
		
		if($shotgun == ""){
			$shotgun = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$shotgun = "<span class='label label-danger'>{$shotgun}</span>";
		}
		
		if($assault == ""){
			$assault = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$assault = "<span class='label label-danger'>{$assault}</span>";
		}
		
		if($mp == ""){
			$mp = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$mp = "<span class='label label-danger'>{$mp}</span>";
		}
		
		$char = "
		<div class='box'>
			<table class='table table-bordered table-hover'>
				<thead>
					<tr>
						<th>Charakter</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Lungenvolumen</td>
						<td>{$lunge}</td>
					</tr>
					<tr>
						<td>Muskeln</td>
						<td>{$muskeln}</td>
					</tr>
					<tr>
						<td>Kondition</td>
						<td>{$kondition}</td>
					</tr>
				</tbody>
			</table>
		</div>
		"; 
		
		$fight = "
		<div class='box'>
			<table class='table table-bordered table-hover'>
				<thead>
					<tr>
						<th>Kampfstil</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Boxen</td>
						<td>{$boxen}</td>
					</tr>
					<tr>
						<td>KungFu</td>
						<td>{$kungfu}</td>
					</tr>
					<tr>
						<td>Streetfight</td>
						<td>{$street}</td>
					</tr>
				</tbody>
			</table>
		</div>
		"; 
		
		$skills = "
		<div class='box'>
			<table class='table table-bordered table-hover'>
				<thead>
					<tr>
						<th>Skill</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Pistolenskill</td>
						<td>{$pistolen}</td>
					</tr>
					<tr>
						<td>Deagleskill</td>
						<td>{$deagle}</td>
					</tr>
					<tr>
						<td>Shotungskill</td>
						<td>{$shotgun}</td>
					</tr>
					<tr>
						<td>Assaultskill</td>
						<td>{$assault}</td>
					</tr>
					<tr>
						<td>MP5skill</td>
						<td>{$mp}</td>
					</tr>
				</tbody>
			</table>
		</div>
		";
		
		// Bar
		$bar = "
			   <div class='info-box bg-green'>
                <span class='info-box-icon'><i class='fa fa-money'></i></span>
                <div class='info-box-content'>
                  <span class='info-box-text'>Bargeld</span>
                  <span class='info-box-number'>{$geld} $</span>
                  <div class='progress'>
                    <div class='progress-bar' style='width: 0%'></div>
                  </div>
                  <span class='progress-description'>
                    Sie haben {$geld} $ Bar dabei
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
		";
		
		// Bank
		$bank = "
               <div class='info-box bg-green'>
                <span class='info-box-icon'><i class='fa fa-money'></i></span>
                <div class='info-box-content'>
                  <span class='info-box-text'>Bankgeld</span>
                  <span class='info-box-number'>{$bank} $</span>
                  <div class='progress'>
                    <div class='progress-bar' style='width: 0%'></div>
                  </div>
                  <span class='progress-description'>
                    Sie haben {$bank} $ auf Ihrem Konto
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
		";

		
		// Wanteds
		if($wanteds >= 1){
			$progress = 100/6;
			$pr_wa = $progress * $wanteds;
			
			$star = "";
			for($i=0;$i<$wanteds;$i++){
				$star = "{$star} <i class='fa fa-star'></i>";
			}
			
			$s_wanted = "
			 <div class='info-box bg-red'>
                <span class='info-box-icon'><i class='fa fa-frown-o'></i></span>
                <div class='info-box-content'>
                  <span class='info-box-text'>Wanteds</span>
                  <span class='info-box-number'>{$star}</span>
                  <div class='progress'>
                    <div class='progress-bar' style='width: {$pr_wa}%'></div>
                  </div>
                  <span class='progress-description'>
                    Sie haben {$wanteds} Wanteds
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
			";
		}else{
			$s_wanted = "
			 <div class='info-box bg-green'>
                <span class='info-box-icon'><i class='fa fa-smile-o'></i></span>
                <div class='info-box-content'>
                  <span class='info-box-text'>Wanteds</span>
                  <span class='info-box-number'>{$wanteds}</span>
                  <div class='progress'>
                    <div class='progress-bar' style='width: 0%'></div>
                  </div>
                  <span class='progress-description'>
                    Sie haben keine Wanteds
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
			";
		}
		
		// Scheine
		if($auto == 0){
			$auto = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$auto = "<span class='label label-success'>vorhanden</span>";
		}
		
		if($motorrad == 0){
			$motorrad = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$motorrad = "<span class='label label-success'>vorhanden</span>";
		}
		
		if($lkw == 0){
			$lkw = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$lkw = "<span class='label label-success'>vorhanden</span>";
		}
		
		if($heli == 0){
			$heli = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$heli = "<span class='label label-success'>vorhanden</span>";
		}
		
		if($fluga == 0){
			$fluga = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$fluga = "<span class='label label-success'>vorhanden</span>";
		}
		
		if($flugb == 0){
			$flugb = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$flugb = "<span class='label label-success'>vorhanden</span>";
		}
		
		if($motor == 0){
			$motor = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$motor = "<span class='label label-success'>vorhanden</span>";
		}
		
		if($segel == 0){
			$segel = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$segel = "<span class='label label-success'>vorhanden</span>";
		}
		
		if($angel == 0){
			$angel = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$angel = "<span class='label label-success'>vorhanden</span>";
		}
		
		if($perso == 0){
			$perso = "<span class='label label-danger'>nicht vorhanden</span>";
		}else{
			$perso = "<span class='label label-success'>vorhanden</span>";
		}
		
		
		$scheine = "
		<div class='box'>
			<table class='table table-bordered table-hover'>
				<thead>
					<tr>
						<th>Lizenz</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Autoführerschein</td>
						<td>{$auto}</td>
					</tr>
					<tr>
						<td>Motorradführerschein</td>
						<td>{$motorrad}</td>
					</tr>
					<tr>
						<td>Lkwführerschein</td>
						<td>{$lkw}</td>
					</tr>
					<tr>
						<td>Helikopterschein</td>
						<td>{$heli}</td>
					</tr>
					<tr>
						<td>Flugschein Klasse A</td>
						<td>{$fluga}</td>
					</tr>
					<tr>
						<td>Flugschein Klasse B</td>
						<td>{$flugb}</td>
					</tr>
					<tr>
						<td>Motorbootschein</td>
						<td>{$motor}</td>
					</tr>
					<tr>
						<td>Segelschein</td>
						<td>{$segel}</td>
					</tr>
					<tr>
						<td>Angelschein</td>
						<td>{$angel}</td>
					</tr>
					<tr>
						<td>Personalausweis</td>
						<td>{$perso}</td>
					</tr>
				</tbody>
			</table>
		</div>
		";
		
		
		echo "
		<section class='content-header'>
          <h1>
            Mein Account
            <small>Allgemein</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class='content'>
			<div class='callout callout-info'>
				<strong>Hallo {$name}</strong>
				<p>Sie befinden sich hier auf ihrer Account Seite, hier werden Ihnen alle Informationen über ihren Account angezeigt.</p>
          </div>
		  <div class='row'>
			<div class='col-md-6'>
				{$bar}
				{$bank}
				{$char}
				{$fight}
				{$skills}
			</div>
			<div class='col-md-6'>
				{$s_wanted}
				{$scheine}
				
			</div>
		</section>
		";
	}
	
	function getImmo(){
		$query = mysql_query("SELECT * FROM houses WHERE UID = '0' ORDER BY Preis") or die(mysql_error());
		$result = mysql_num_rows($query);
		
		if($result == 0){
			
			echo "
			<section class='content-header'>
			  <h1>
				Immobilien Markt 24
				<small>kaufe Immobilien</small>
			  </h1>
			</section>

			<!-- Main content -->
			<section class='content'>
				<div class='callout callout-info'>
					<strong>Hallo {$_SESSION["acc"]}</strong>
					<p>Sie können sich hier freie Immobilien anschauen.</p>
			  </div>
			  <div class='row'>
				<div class='col-md-12'>
					<div class='alert alert-danger' role='alert'>Es sind momentan keine Immobilien zum verkauf.</div>
				</div>
			</section>
			
			";
		
		}else{
		
			$house = "";
			
			while($row = mysql_fetch_assoc($query)){
				$preis = $row["Preis"];
				$interior = $row["CurrentInterior"];
				$kasse = $row["Kasse"];
				$miete = $row["Miete"];
				$x = $row["SymbolX"];
				$y = $row["SymbolY"];
				$house = "{$house} <tr><td>{$preis} $</td><td>3 Stunden</td><td>{$interior}</td><td>{$kasse} $</td><td>{$miete} $</td><td><a href='framework/map.php?x={$x}&y={$y}'>Lage</a></td></tr>";
			}
			
			echo "
			<section class='content-header'>
			  <h1>
				Immobilien Markt 24
				<small>kaufe Immobilien</small>
			  </h1>
			</section>

			<!-- Main content -->
			<section class='content'>
				<div class='callout callout-info'>
					<strong>Hallo {$_SESSION["acc"]}</strong>
					<p>Sie befinden sich hier auf ihrer Immobilien Seite, hier werden Ihnen alle Informationen über ihre Immobilie angezeigt.</p>
			  </div>
			  <div class='row'>
				<div class='col-md-12'>
					<div class='box'>
							<div class='box-header'>
						  <h3 class='box-title'>freie Immobilien ({$result})</h3>
						</div><!-- /.box-header -->
							<table class='table table-bordered table-hover'>
								<thead>
									<tr>
										<th>Preis</th>
										<th>Mindestspielzeit</th>
										<th>Interior</th>
										<th>Kasse</th>
										<th>Miete</th>
										<th>Lage</th>
									</tr>
								</thead>
								<tbody>
									{$house}
								</tbody>
							</table>
						</div>
				</div>
			</section>
			
			";
		
		}
	}
	
	function getMyImmo($name){
		$query = mysql_query("SELECT * FROM userdata WHERE Name = '$name'") or die(mysql_error());
		while($row = mysql_fetch_assoc($query)){
			$uid = $row["UID"];
		}
		$query2 = mysql_query("SELECT * FROM houses WHERE UID = '$uid'") or die(mysql_error());
		$result = mysql_num_rows($query2);
		
		if($result == 0){
			
			echo "
			<section class='content-header'>
			  <h1>
				Meine Immobilie
				<small>my home is my castle</small>
			  </h1>
			</section>

			<!-- Main content -->
			<section class='content'>
				<div class='callout callout-info'>
					<strong>Hallo {$name}</strong>
					<p>Sie befinden sich hier auf ihrer Immobilien Seite, hier werden Ihnen alle Informationen über ihre Immobilie angezeigt.</p>
			  </div>
			  <div class='row'>
				<div class='col-md-12'>
					<div class='alert alert-danger' role='alert'>Sie haben noch keine Immobilie</div>
				</div>
			</section>
			
			";
		
		}else{
	
			while($row = mysql_fetch_assoc($query2)){
				$preis = $row["Preis"];
				$interior = $row["CurrentInterior"];
				$kasse = $row["Kasse"];
				$miete = $row["Miete"];
				$x = $row["SymbolX"];
				$y = $row["SymbolY"];
			}
	
			echo "
			<section class='content-header'>
			  <h1>
				Meine Immobilie
				<small>my home is my castle</small>
			  </h1>
			</section>

			<!-- Main content -->
			<section class='content'>
				<div class='callout callout-info'>
					<strong>Hallo {$name}</strong>
					<p>Sie befinden sich hier auf ihrer Immobilien Seite, hier werden Ihnen alle Informationen über ihre Immobilie angezeigt.</p>
			  </div>
			  <div class='row'>
				<div class='col-md-12'>
					<div class='box'>
							<div class='box-header'>
						  <h3 class='box-title'>Meine Immobilie</h3>
						</div><!-- /.box-header -->
							<table class='table table-bordered table-hover'>
								<tbody>
									<tr>
										<td>Preis</td>
										<td>{$preis} $</td>
									</tr>
									<tr>
										<td>Mindestzeit</td>
										<td>3 Stunden</td>
									</tr>
									<tr>
										<td>Interior</td>
										<td>{$interior}</td>
									</tr>
									<tr>
										<td>Kasse</td>
										<td>{$kasse} $</td>
									</tr>
									<tr>
										<td>Miete</td>
										<td>{$miete} $</td>
									</tr>
									<tr>
										<td>Lage</td>
										<td><a href='framework/map.php?x={$x}&y={$y}'>Lage</a></td>
									</tr>
								</tbody>
							</table>
						</div>
				</div>
			</section>
			
			";
		}
	}
	
	function tAdmin(){
		
		$query = mysql_query("SELECT * FROM cp_ticket WHERE isclosed != '1'");
		$result = mysql_num_rows($query);
		
		echo "<section class='content-header'>
			  <h1>
				<i class='fa fa-ticket'></i> Tickets ({$result})
			  </h1>
			</section>
			<section class='content'>
				<div class='row'>
					<div class='col-md-12'>
			";
			
		// get all Tickets
		$query2 = mysql_query("SELECT * FROM cp_ticket ORDER by ID DESC");
		while($row = mysql_fetch_assoc($query2)){
		
				$msg = nl2br($row["msg"]);
				$date = $row["date"];
				$close = $row["isclosed"];
				$id = $row["ID"];
				
				if($close == 1){
					$color = "danger";
					$stat = "close";
				}else{
					$color = "success";
					$stat = "check";
				}
				
				$query3 = mysql_query("SELECT * FROM cp_ticket_ans WHERE ticket_id = '$id' ");
				$result3 = mysql_num_rows($query3);
				
				if($result3 != 0){
				
					while($row = mysql_fetch_assoc($query3)){
						$msg2 = nl2br($row["msg"]);
						$admin = $row["username"];
						$date2 = $row["date"];
						
						$string = "Team Mitglied: {$admin} <small>- {$date}</small>";
						
						$color2 = "success";
						$stat2 = "check";
					}
				
				}else{
				
					date_default_timezone_set('Europe/Berlin');
					$date = date('j F Y H:i:s');
					$color2 = "danger";
					$stat2 = "close";
					$msg2 = "
							<form class='form-horizontal' method='post' action='ticket_ans.php'>
								<input type='hidden' value='{$id}' name='id'>
								<div class='form-group'>
									<label for='inputName' class='col-sm-2 control-label'>Username</label>
									<div class='col-sm-10'>
										<input type='text' value='{$_SESSION["acc"]}' class='form-control' disabled id='inputName' name='name'>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputDate' class='col-sm-2 control-label'>Datum</label>
									<div class='col-sm-10'>
										<input type='text' value='{$date}' class='form-control' disabled id='inputDate' name='date'>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputMsg' class='col-sm-2 control-label'>Nachricht</label>
									<div class='col-sm-10'>
										<textarea class='form-control' id='inputMsg' required name='msg' rows='4'></textarea>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-offset-2 col-sm-10'>
										<button type='submit' class='btn btn-primary'>auf Ticket antworten</button>
									</div>
								</div>
							</form>
					";
					$admin = "";
					$date2 = "";
					$string = " Schreiben Sie eine Antwort";
					
				}
				
				echo "
				<div class='panel panel-{$color}'>
					<div class='panel-heading'><i class='fa fa-{$stat}'></i> Ticket ID: {$id} <small>- {$date}</small></div>
					<div class='panel-body'>
						<p>{$msg}</p>
						
						<div class='panel panel-{$color2}'>
							<div class='panel-heading'><i class='fa fa-{$stat2}'></i> {$string}</div>
							<div class='panel-body'>
								{$msg2}
							</div>
						</div>
						
					</div>
				</div>
				";
		
		}
		
		echo "
				</div>
			</div>
		</section>
		";
	}

	function getMyTickets($user){
	
		$query = mysql_query("SELECT * FROM cp_ticket WHERE username = '$user' ORDER by ID DESC");
		$result = mysql_num_rows($query);
		
		echo "<section class='content-header'>
			  <h1>
				<i class='fa fa-ticket'></i> Meine Tickets ({$result})
			  </h1>
			</section>";
			
		if($result != 0){
		
			echo "
			<section class='content'>
				<div class='row'>
					<div class='col-md-12'>
			";
		
			while($row = mysql_fetch_assoc($query)){
				$msg = nl2br($row["msg"]);
				$date = $row["date"];
				$close = $row["isclosed"];
				$id = $row["ID"];
				
				if($close == 1){
					$color = "danger";
					$stat = "close";
				}else{
					$color = "success";
					$stat = "check";
				}
				
				$query2 = mysql_query("SELECT * FROM cp_ticket_ans WHERE ticket_id = '$id' ");
				$result2 = mysql_num_rows($query2);
				
				if($result2 != 0){
				
					while($row = mysql_fetch_assoc($query2)){
						$msg2 = nl2br($row["msg"]);
						$admin = $row["username"];
						$date2 = $row["date"];
						
						$string = "Team Mitglied: {$admin} <small>- {$date}</small>";
						
						$color2 = "success";
						$stat2 = "check";
					}
				
				}else{
					
					$color2 = "danger";
					$stat2 = "close";
					$msg2 = "Der Support hat noch keine Nachricht hinterlassen";
					$admin = "";
					$date2 = "";
					$string = " keine Antwort";
					
				}
				
				echo "
				<div class='panel panel-{$color}'>
					<div class='panel-heading'><i class='fa fa-{$stat}'></i> Ticket ID: {$id} <small>- {$date}</small></div>
					<div class='panel-body'>
						<p>{$msg}</p>
						
						<div class='panel panel-{$color2}'>
							<div class='panel-heading'><i class='fa fa-{$stat2}'></i> {$string}</div>
							<div class='panel-body'>
								{$msg2}
							</div>
						</div>
						
					</div>
				</div>
				";
				
			}
			
			echo "
					</div>
				</div>
			</section>
			";
		
		}else{
			echo "
				<!-- Main content -->
			<section class='content'>
			  <div class='callout callout-info'>
					<strong>Hallo {$user}</strong>
					<p>Sie haben noch keine Tickets erstellt.</p>
			  </div>
			</section>
			";
		}
		
	}
	
	function createTicket($user){
	
		date_default_timezone_set('Europe/Berlin');
		$date = date('j F Y H:i:s');
		
		echo "<section class='content-header'>
				  <h1>
					<i class='fa fa-plus'></i> Ticket erstellen
				  </h1>
				</section>
				<section class='content'>
					<div class='row'>
						<div class='col-md-12'>
							<form class='form-horizontal' method='post' action='ticket_cr.php'>
								<div class='form-group'>
									<label for='inputName' class='col-sm-2 control-label'>Username</label>
									<div class='col-sm-10'>
										<input type='text' value='{$user}' class='form-control' disabled id='inputName' name='name'>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputDate' class='col-sm-2 control-label'>Datum</label>
									<div class='col-sm-10'>
										<input type='text' value='{$date}' class='form-control' disabled id='inputDate' name='date'>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputMsg' class='col-sm-2 control-label'>Nachricht</label>
									<div class='col-sm-10'>
										<textarea class='form-control' id='inputMsg' required name='msg' rows='4'></textarea>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-offset-2 col-sm-10'>
										<button type='submit' class='btn btn-primary'>Ticket erstellen</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
		";
	
	}
	
	function getBankTransfer($user){
	
		$query = mysql_query("SELECT * FROM cp_bank WHERE empfanger = '$user' OR absender = '$user' ORDER By ID DESC");
		$result = mysql_num_rows($query);
		
		if($result == 0){
		
			echo "
				<div class='alert alert-warning' role='alert'>Keine Transaktionen vorhanden</div>
			";
		
		}else{
	
			echo "<section class='content-header'>
					  <h1>
						<i class='fa fa-university'></i> Transaktionen
					  </h1>
					</section>
					<section class='content'>
						<div class='row'>
							<div class='col-md-12'>
								<div class='box'>
									<table class='table table-bordered table-hover'>
										<thead>
											<tr>
												<th>Absender</th>
												<th>Empfänger</th>
												<th>Verwendungszweck</th>
												<th>Datum</th>
												<th>Summe</th>
											</tr>
										</thead>
										<tbody>";
			
										while($row = mysql_fetch_assoc($query)){
											$absender = $row["absender"];
											$empfanger = $row["empfanger"];
											$betrag = $row["betrag"];
											$betreff = $row["betreff"];
											$date = $row["date"];
											
											if($absender == $user){
												$betrag = "<span class='label label-danger'>- {$betrag} $</span>";
											}else{
												$betrag = "<span class='label label-success'>{$betrag} $</span>";
											}
											
											echo "
												<tr>
													<td>{$absender}</td>
													<td>{$empfanger}</td>
													<td>{$betreff}</td>
													<td>{$date}</td>
													<td>{$betrag}</td>
												</tr>
											";
											
										}
			
									
			echo	"						</tbody>
									</table>
								</div>
							</div>
						</div>
					</section>
			";
		
		}
		
	}
	
	function getBanku($user){
	
		date_default_timezone_set('Europe/Berlin');
		$date = date('j F Y H:i:s');
		
		$query_money = mysql_query("SELECT Bankgeld FROM userdata WHERE Name = '$user'");
		while($row = mysql_fetch_assoc($query_money)){
			$user_money = $row["Bankgeld"];
		}
		
		echo "<section class='content-header'>
				  <h1>
					<i class='fa fa-credit-card'></i> Überweisung
				  </h1>
				</section>
				<section class='content'>
					<div class='row'>
						<div class='col-md-12'>
							<div class='info-box bg-green'>
							<span class='info-box-icon'><i class='fa fa-money'></i></span>
							<div class='info-box-content'>
							  <span class='info-box-text'>Bankgeld</span>
							  <span class='info-box-number'>{$user_money} $</span>
							  <div class='progress'>
								<div class='progress-bar' style='width: 0%'></div>
							  </div>
							  <span class='progress-description'>
								Sie haben {$user_money} $ auf Ihrem Konto
							  </span>
							</div><!-- /.info-box-content -->
						  </div><!-- /.info-box -->
							<form class='form-horizontal' method='post' action='bank.php'>
								<div class='form-group'>
									<label for='inputName' class='col-sm-2 control-label'>Empfänger</label>
									<div class='col-sm-10'>
										<select name='empfanger' class='form-control' id='inputName' required>
										";
									
										$query = mysql_query("SELECT Name FROM players");
										while($row = mysql_fetch_assoc($query)){
											$name = $row["Name"];
											
											echo "<option value='{$name}'>{$name}</option>";
											
										}
										
										
									echo"</select></div>
								</div>
								<div class='form-group'>
									<label for='inputMoney' class='col-sm-2 control-label'>Betrag</label>
									<div class='col-sm-10'>
										<input type='number' class='form-control' id='inputMoney' name='money' min='1' max='{$user_money}' required>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputDate' class='col-sm-2 control-label'>Datum</label>
									<div class='col-sm-10'>
										<input type='text' value='{$date}' class='form-control' disabled id='inputDate' name='date'>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputVer' class='col-sm-2 control-label'>Verwendungszweck</label>
									<div class='col-sm-10'>
										<input type='text' class='form-control' id='inputVer' name='betreff' required>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-offset-2 col-sm-10'>
										<button type='submit' class='btn btn-primary'>Überweisung tätigen</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
			";
	
	}
	
	function cAdmin(){
	
		date_default_timezone_set('Europe/Berlin');
		$date = date('j F Y H:i:s');
		
		echo "<section class='content-header'>
				  <h1>
					<i class='fa fa-history'></i> Changelog erstellen
				  </h1>
				</section>
				<section class='content'>
					<div class='row'>
						<div class='col-md-12'>
							<form class='form-horizontal' method='post' action='changelog_admin.php'>
								<div class='form-group'>
									<label for='inputName' class='col-sm-2 control-label'>Username</label>
									<div class='col-sm-10'>
										<input type='text' value='{$_SESSION["acc"]}' class='form-control' disabled id='inputName' name='name'>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputDate' class='col-sm-2 control-label'>Datum</label>
									<div class='col-sm-10'>
										<input type='text' value='{$date}' class='form-control' disabled id='inputDate' name='date'>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputHead' class='col-sm-2 control-label'>Betreff</label>
									<div class='col-sm-10'>
										<input type='text' class='form-control' id='inputHead' name='head' required>
									</div>
								</div>
								<div class='form-group'>
									<label for='inputMsg' class='col-sm-2 control-label'>Nachricht</label>
									<div class='col-sm-10'>
										<textarea class='form-control' id='inputMsg' required name='msg' rows='4'></textarea>
									</div>
								</div>
								<div class='form-group'>
									<div class='col-sm-offset-2 col-sm-10'>
										<button type='submit' class='btn btn-primary'>Changelog erstellen</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</section>
		";
	
	}
	
	function getCompanys(){
	
		$query = mysql_query("SELECT * FROM biz ORDER by Kasse DESC");
		$result = mysql_num_rows($query);
		$ges = 0;
		
		$mquery = mysql_query("SELECT Kasse FROM biz");
		while($row = mysql_fetch_assoc($mquery)){
			$kasse = $row["Kasse"];
			$ges = $ges + $kasse;
		}
		
		echo "<section class='content-header'>
				  <h1>
					<i class='fa fa-building'></i> Firmen ({$result})
				  </h1>
				</section>
				<section class='content'>
					<div class='row'>
						<div class='col-md-12'>
							<div class='info-box bg-green'>
								<span class='info-box-icon'><i class='fa fa-money'></i></span>
								<div class='info-box-content'>
								  <span class='info-box-text'>Gesamt Umsatz</span>
								  <span class='info-box-number'>{$ges} $</span>
								  <div class='progress'>
									<div class='progress-bar' style='width: 0%'></div>
								  </div>
								  <span class='progress-description'>
									Gesamt Umsatz {$ges} $
								  </span>
								</div><!-- /.info-box-content -->
							  </div><!-- /.info-box -->
						</div>
					</div>";
			
		while($row = mysql_fetch_assoc($query)){
			$kasse = $row["Kasse"];
			$preis = $row["Preis"];
			$besitzer = $row["UID"];
			$name = $row["Name"];
			
			
			if($besitzer == "0"){
			$besitzer = "Niemand";
			}elseif ($besitzer != "0"){
			$query2 = mysql_query("SELECT * FROM players WHERE UID = '$besitzer'");
			while($row = mysql_fetch_assoc($query2)){
			$test = $row["Name"];
			$besitzer = $test;
			}
			}
			
			$um = $kasse / $ges;
			$um = $um * 100;
			$um = round($um);
			
			echo "
			<div class='row'>
				<div class='col-md-12'>
					<div class='info-box'>
						<span class='info-box-icon bg-red'><i class='fa fa-building'></i></span>
						<div class='info-box-content'>
							<span class='info-box-number'>{$name}</span>
							<span class='info-box-text'>Besitzer: {$besitzer}</span>
							<span class='info-box-text'>Umsatz: {$kasse}$ ({$um} %)</span>
						</div>
					</div>
				</div>
			</div>
			";
				
		}
				
		echo"
				</section>
		";
	
	}
	
}

?>