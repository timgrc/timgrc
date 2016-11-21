<?php
if (!isset($base)) {
	require '../pages/base.php';
}

$array_projects = array();
foreach (lireBD('projects') as $key => $data) {
	$array_projects[$data['name']] = $data['title'];
}

if(isset($_GET['concerts'])){
	$index = "";
	if (isset($_GET['concerts_index'])) {
		if ($_GET['concerts_index'] == "last") {
			$index = ' AND i=' . dernierId('concerts');
		} elseif (intval($_GET['concerts_index']) != 0)  {
			$index = ' AND i=' . intval($_GET['concerts_index']);
		}
	}
	$sql = 'SELECT * FROM concerts WHERE date>=' . date('Ymd') . $index . ' ORDER BY date';

	switch ($_GET['concerts']) {
		case 'to_change':
			if (isset($_GET['concerts_index'])) {
				if(intval($_GET['concerts_index']) != 0) {
					foreach (lireBD('concerts', false, false, false, $sql) as $key => $data) {
						$concert_info = array(
							'i' => $data['i'],
							'project' => $data['project'],
							'date' => $data['date'],
							'titrefr' => $data['titrefr'],
							'titreen' => $data['titreen'],
							'heure' => $data['heure'],
							'lieufr' => $data['lieufr'],
							'lieuen' => $data['lieuen'],
							'url' => $data['url']
						);
					}
				}
			} else {
				$concert_info = array(
					'i' => 0,
					'project' => '',
					'date' => date('Ymd'),
					'titrefr' => '',
					'titreen' => '',
					'heure' => '20h00',
					'lieufr' => '',
					'lieuen' => '',
					'url' => ''
				);
			}
		    $heure = $concert_info['heure'];
		    $concert_hour = substr($concert_info['heure'], 0, 2);
		    $concert_min = substr($concert_info['heure'], 3, 5);
		    $date = $concert_info['date'];
		    $concertsNumJour = substr($date, 6, 2);
		    $concertsNumMois = substr($date, 4, 2);
		    $concertsNumAnnee = substr($date, 0, 4);
			?>
			<div class="dates-concerts container-resp" state="modif" bdtable="concerts" bdid="<?php echo $concert_info['i']; ?>">
				<div class="dates-concerts-gauche">
					<h3 class="dates-concerts-jour">
						<select class="ajout-concerts-jour date-concerts-jour-ajout" onfocusout="insert_day_value(this)"><?php
							for($i = 1; $i <= 28; $i++){
								if($i<=9){$value='0'.$i;}
								else{$value=$i;}
								if($i==intval($concertsNumJour)) { $selected='selected'; }
								else{$selected='';}
								echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
							}
							$selected = '29' == $concertsNumJour ? 'selected' : ''; ?>
							<option class="jour29" value="29" <?php echo $selected; ?>>29</option>
							<?php $selected = '30' == $concertsNumJour ? 'selected' : ''; ?>
							<option class="jour30" value="30" <?php echo $selected; ?>>30</option>
							<?php $selected = '31' == $concertsNumJour ? 'selected' : ''; ?>
							<option class="jour31" value="31" <?php echo $selected; ?>>31</option>
						</select>
					</h3>
					<p class="dates-concerts-mois-annee">
						<select class="ajout-concerts-mois date-concerts-mois-annee-ajout" onfocusout="insert_month_value(this)"><?php
							for($i = 1; $i <= 12; $i++){
								if($i<=9){$value='0'.$i;}
								else{$value=$i;}
								if($i==intval($concertsNumMois)) { $selected='selected'; }
								else{$selected='';}
								echo '<option value="'.$value.'" '.$selected.'>'.$mois[$lang][$value].'</option>';
							} ?>
						</select>
						<select class="ajout-concerts-annee date-concerts-mois-annee-ajout" onfocusout="insert_year_value(this)"><?php
							for($i = 0; $i <= 9; $i++){
								$value=date("Y")+$i;
								if($i==intval($concertsNumAnnee) - date("Y")) { $selected='selected'; }
								else{$selected='';}
								echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
							} ?>
						</select>
					</p>
					<div class="invisible-mode" bdcol="date"><?php echo $date; ?></div>
				</div>
				<div class="dates-concerts-droite">
          <?php if($concert_info['i'] == 0) { ?>
            <div class="project-concerts" style="padding-top: 10px; padding-bottom: 0px; margin-bottom: 0px;">AJOUTER UN CONCERT</div>
          <?php } ?>
					<div class="project-concerts" style="padding-top: 10px; padding-bottom: 0px; margin-bottom: 0px;">
					<select class="ajout-project" onfocusout="insert_project_value(this)"><?php
						foreach(lireBD('projects') as $key => $data){
							$selected = $data['name'] == $concert_info['project'] ? 'selected' : '';
							echo '<option value="' . $data['name'] . '" ' . $selected . '>' . $data['title'] . '</option>';
						}
						$selected = '' == $concert_info['project'] ? 'selected' : '';
						echo '<option value="" ' . $selected . '></option>'; ?>
					</select>
						<div class="invisible-mode" bdcol="project"><?php echo $concert_info['project']; ?></div>
					</div>
					<h3 class="dates-concerts-titre dates-concerts-titre-admin" style="padding-left:31px; padding-bottom:0px;background-image: url('../img/fr.png');"><span class="modifiable texte-initial padding5-modif pas-de-bouton-enregistre" id="ajout-concerts-titrefr<?php echo $concert_info['i']; ?>" bdcol="titrefr" style="line-height: 2.4em; margin-top: 0;" texteInitial="Titre" onfocus="focus_modifiable_texte_initial(this)" onfocusout="focusout_modifiable_texte_initial(this)" onkeyup="keyup_modifiable(this)"><?php echo $concert_info['titrefr']; ?></span></h3>
					<h3 class="dates-concerts-titre dates-concerts-titre-admin" style="padding-left:31px;padding-top:0px;background-image: url('../img/en.png');background-position: 0px 3px;"><span class="modifiable texte-initial padding5-modif pas-de-bouton-enregistre" bdcol="titreen" style="line-height: 2.4em;" texteInitial="Title" id="ajout-concerts-titreen<?php echo $concert_info['i']; ?>" onfocus="focus_modifiable_texte_initial(this)" onfocusout="focusout_modifiable_texte_initial(this)" onkeyup="keyup_modifiable(this)"><?php echo $concert_info['titreen']; ?></span></h3>
					<div class="dates-concerts-p">
						<div class="dates-concerts-heure"><i class="fa fa-clock-o" onclick="hide_concert_time(this)" style="cursor: pointer;"></i>&nbsp;<span class="form-hour-admin
            <?php if ($heure != '' && $concert_info['i'] != 0) echo "invisible-mode"; ?>">
							<select id="ajout-concerts-heure" class="ajout-concerts-lheure" onfocusout="insert_hour_value(this)"><?php
								for($i = 0; $i <= 23; $i++){
									if($i<=9){$value='0'.$i;}
									else{$value=$i;}
									if($i == intval($concert_hour)) { $selected='selected'; }
									else{$selected='';}
									echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
								} ?>
							</select>&nbsp;h&nbsp;<select id="ajout-concerts-minutes" class="ajout-concerts-lheure" onfocusout="insert_min_value(this)"><?php
								for($i = 0; $i <= 11; $i++){
									$j=5*$i;
									if($j <= 9) { $value='0'.$j; }
									else{ $value=$j; }
									if($j == intval($concert_min)) { $selected='selected'; }
									else{$selected='';}
									echo '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
								} ?>
							</select>
							</span>
							<div class="invisible-mode" bdcol="heure"><?php echo $heure; ?></div>
						</div>
						<div class="dates-concerts-adresse dates-concerts-adresse-admin" style="clear:both;background-image: url('img/fr.png');"><i class="fa fa-map-marker"></i>&nbsp;<span style="line-height: 2.6em;" class="modifiable padding5-modif texte-initial pas-de-bouton-enregistre" texteInitial="Lieu" id="ajout-concerts-lieufr<?php echo $concert_info['i']; ?>" bdcol="lieufr" onfocus="focus_modifiable_texte_initial(this)" onfocusout="focusout_modifiable_texte_initial(this)" onkeyup="keyup_modifiable(this)"><?php echo $concert_info['lieufr']; ?></span></div>
						<div class="dates-concerts-adresse dates-concerts-adresse-admin" style="clear:both;background-image: url('img/en.png');"><i class="fa fa-map-marker"></i>&nbsp;<span style="line-height: 2.6em;" class="modifiable padding5-modif texte-initial pas-de-bouton-enregistre" texteInitial="Place" id="ajout-concerts-lieuen<?php echo $concert_info['i']; ?>" bdcol="lieuen" onfocus="focus_modifiable_texte_initial(this)" onfocusout="focusout_modifiable_texte_initial(this)" onkeyup="keyup_modifiable(this)"><?php echo $concert_info['lieuen']; ?></span></div>
						<div class="dates-concerts-adresse" style="clear:both;padding-top:0;"><i class="fa fa-rocket"></i>&nbsp;<span style="line-height: 2.6em;" class="modifiable padding5-modif pas-panel texte-initial" texteInitial="Lien URL" id="ajout-concerts-lien<?php echo $concert_info['i']; ?>" bdcol="url" onfocus="focus_modifiable_texte_initial(this)" onfocusout="focusout_modifiable_texte_initial(this)" onkeyup="keyup_modifiable(this)"><?php echo $concert_info['url']; ?></span></div>
					</div>
				</div>
				<?php if($concert_info['i'] == 0){ ?>
          <div class="add-button bouton-reserver bouton-concerts-ajouter" style="" id="bouton"><i class="fa fa-plus-circle"></i></div>
        <?php }else{ ?>
          <div class="bouton-reserver bouton-gauche-concerts bouton-concerts-validate-modif" onclick="modif_form_DB(this, 'Concert modifié !')"><i class="fa fa-save"></i></div>
          <div class="bouton-reserver bouton-droite-concerts bouton-concerts-undo" onclick="quit_modif_mode()"><i class="fa fa-arrow-circle-o-left"></i></div>
        <?php } ?>
			</div>
			<?php
		break;

		case 'to_see':
			foreach (lireBD('concerts', false, false, false, $sql) as $key => $data) {
				$project = $data['project'];
				$titre_lang = theLeastEmpty($data['titre'.$lang], $data['titre'.$lang_barre[$lang]]);
				$titre = array();
				if ($project != "") array_push($titre, $array_projects[$project]);
				if ($titre_lang != "") array_push($titre, $titre_lang);
			    $titre = implode(" - ", $titre);
			    $heure = $data['heure'];
			    $concerts_lieu = theLeastEmpty($data['lieu'.$lang], $data['lieu'.$lang_barre[$lang]]);
			    $date = $data['date'];
			    $lienUrl = array();
			    if ($data['url'] == "") {
			    	$lienUrl[0] = "../inside-projects/?p=$project";
			    	$lienUrl[1] = "lien-cliquable";
			    } else {
				    $lienUrl[0] = $data['url'];
				    $lienUrl[1] = "lien-cliquable-ext";
			    }
			    $concertsNumJour = substr($date, 6, 2);
			    $concertsNumMois = substr($date, 4, 2);
			    $concertsNumAnnee = substr($date, 0, 4);
		   	?>
			<div class="dates-concerts container-resp dates-concerts<?php echo $data['i'];?>" state="show" bdtable="concerts" bdid="<?php echo $data['i']; ?>">
				<div class="dates-concerts-gauche" date="<?php echo $date;?>">
					<h3 class="dates-concerts-jour"><?php echo $concertsNumJour;?></h3>
					<p class="dates-concerts-mois-annee"><?php echo $mois[$lang][$concertsNumMois] . ' ' . $concertsNumAnnee;?></p>
				</div>
				<div class="dates-concerts-droite">
					<h3 class="dates-concerts-titre"><?php if ($titre != "") {
						echo strtoupperFr($titre);
					} else {
						?>&nbsp;<?php
					} ?></h3>
					<div class="dates-concerts-p">
						<?php
						if ($heure == "" AND $concerts_lieu == "") { ?>
							<div class="dates-concerts-heure">&nbsp;</div>
						<?php } else {
							if ($heure != "") { ?>
								<div class="dates-concerts-heure"><i class="fa fa-clock-o"></i>&nbsp;<?php echo $heure; ?></div>
							<?php }
							if ($concerts_lieu != "") { ?>
								<div class="dates-concerts-adresse"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $concerts_lieu; ?></div>
							<?php }
						} ?>
					</div>
				</div>
				<?php if($adminadmin){ ?>
					<div class="bouton-reserver bouton-gauche-concerts bouton-concerts-modifier go-to-modif-button" onclick="go_to_modif(this)"><i class="fa fa-edit"></i></div>
					<div class="bouton-reserver bouton-droite-concerts bouton-concerts-supprimer" onclick="supprElement(this, 'Souhaites-tu vraiment supprimer cette date de concerts ?')"><i class="fa fa-trash"></i></div>
				<?php }else{ ?>
					<div class="bouton-reserver <?php echo $lienUrl[1]; ?>" lien="<?php echo $lienUrl[0]; ?>"><i class="fa fa-plus-circle"></i> <?php echo $lair_infos[$lang]; ?></div>
				<?php } ?>
			</div>
			<?php } ?>
			</div>
		<?php break;
	}
}
?>
