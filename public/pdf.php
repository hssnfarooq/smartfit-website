<?php
/// must have /////////////////////////////////////
session_start();
include_once 'mySiteAdmin/includes/db.inc.php';
require_once 'mySiteAdmin/includes/preference.php';
include_once 'mySiteAdmin/includes/funkcije.php';
//include_once 'shop/config.php';
//$chunker = GetChunker();

include_once 'inc/classes/user.php';
require 'inc/funkcije.php';
/*
require 'inc/login_check.php';
if($lb_user == 0) die('PLEASE LOGIN');*/
///////////////////////////////////////////////////

if(isset($_GET['fts'])){
	$tmp_id = decrypt($_GET['fts']);
    if(is_numeric($tmp_id) && $tmp_id > 0){        
        
        $sql = 'select * from users where ID = '.$tmp_id;
        $rs = mysqli_query($mysqli, $sql);

        if($rs && mysqli_num_rows($rs) > 0){  
            if($row = mysqli_fetch_array($rs)){
                $lb_user_podaci = $row;
                $lb_user = $row['id']; 
                $lb_user_dozvole = $row['dozvole']; 
                $lb_user_research_ids = $row['research_id'];
            }
        }
    }
}


$research_id = isset($_GET['i']) ? decrypt($_GET['i']) : 'jok';

if(is_numeric($research_id)){

    $sql = "SELECT * FROM research_project WHERE id = $research_id";
    $result = mysqli_query($mysqli, $sql);
    if($result && mysqli_num_rows($result) > 0){
        if($row = mysqli_fetch_assoc($result)){
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $row['naslov'] ?></title>


<style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                size: A4;
                margin: 1cm 1cm 0cm 1cm;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;

                /** Extra personal styles **/
                color: black;
                text-align: center;
                line-height: 1.5cm;
                font-size: 11px;
            }

          /*  #content {
                display: table;
            }

            #pageFooter {
                display: table-footer-group;
            }
*/
            #pageFooter::after {
                counter-increment: pagebased;
                content: counter(page);
            }
        </style>

</head>
<body style="padding-top:30px; font-family:Arial, Helvetica, sans-serif; font-size:14px">

<footer>
  <div id="pageFooter">Page </div>
</footer>

<div style="width:69%; float:left">
    <table>
        <tr>
            <td style="font-size: 18px;">
            NBS Research and Knowledge Exchange Bank
            <hr style="margin: 5px 0px;">
            Case Study Report
            </td>
        </tr>
    </table>
</div>
<div style="width:30%; float:right">
    <table>
        <tr>
            <td style="padding:5px; background:#990d70; border-radius: 8px;"><img class="img-fluid for-dark" src="https://<?= $current_domain ?>/img/logo1.png" alt="looginpage" style="width: 100%;"></td>
        </tr>
    </table>
</div>

<div style="clear: both; height:20px"></div>

<div>
    <table>
        <tr>
        <td style="padding:10px 5px; background:#f7f7f7; color:#000; text-align:left;border-radius: 8px; border:1px solid #000">
            <?php
            if($lb_user_dozvole != 2){
            ?><button class="btn btn-lg btn-primary mb-2">Rating: <strong><?= $ocjene_dd[$row['ocjena']]['naslov'] ?></strong></button><?php
                if(!empty($row['ocjena_ts']))
                    echo '<button class="btn btn-lg btn-primary mb-2" style="border:none; background:none">by '.$row['ocjena_ts'].'</button>';

                    ?><div style="margin-bottom: 20px;"></div><?php
            }
            ?>           
            <h2 style="margin-top: 0;"><?= $row['naslov'] ?></h2>
            <h4><?= $row['title_of_case_study'] ?></h4>

            <button class="btn btn-lg btn-primary">Research Lead: <?= DajIzTablice('users', $row['research_leader'], 'naslov') ?></button>
            </td>
        </tr>
    </table>
</div>



<div style="clear: both;"></div>

<?php     
//normalna polja

$sql = "SELECT polje, naslov, tip FROM a_field_definition WHERE tbl = 'research_project'";
$rs = mysqli_query($mysqli, $sql);
if($rs && mysqli_num_rows($rs) > 0){
    while($ajtem = mysqli_fetch_assoc($rs)){
        if (!in_array($ajtem['polje'], $nemoj)) {
            ?>
            <div style="padding:10px; background: #990d70; color:#fff; font-size:24px; border-radius: 8px 8px 0 0; margin-top:30px"><?= $ajtem['naslov'] ?></div>
            <div style="padding: 15px; border: 1px solid #ccc; border-radius: 0 0 8px 8px; background:#f7f7f7">  
                <?php
                if($ajtem['polje'] == 'research_leader')
                    echo DajIzTablice('users', $row['research_leader'], 'naslov');    
                else         
                    echo $row[$ajtem['polje']];
                ?>
            </div>
            <?php
        }
    }
}



//Research Contributors

$sql = "SELECT * FROM users WHERE INSTR(CONCAT(',',research_id,','), CONCAT(',','$research_id',',')) > 0  ORDER BY naslov";
$result2 = mysqli_query($mysqli, $sql);
if($result2 && mysqli_num_rows($result2) > 0){
?>
<div style="padding:10px; background: #990d70; color:#fff; font-size:24px; border-radius: 8px 8px 0 0; margin-top:30px">Research Contributors</div>
<div style="padding: 15px; border: 1px solid #ccc; border-radius: 0 0 8px 8px; background:#f7f7f7">  
    <?php 
    $br = 0;
    while($row2 = mysqli_fetch_assoc($result2)){
        $br++;
        echo ($br > 1 ? ', ' : '').$row2['naslov'];
    }         
    ?>
</div>     
<?php
}



/// logic chain
$sql = "SELECT naslov, id FROM logic_chain WHERE research_id = $research_id";
//echo $sql;
$rs = mysqli_query($mysqli, $sql);
if($rs && mysqli_num_rows($rs) > 0){  
    if($ajtem = mysqli_fetch_assoc($rs)){
        
        //pitanja
        $sql = "SELECT naslov, pitanje, id FROM pitanja ORDER BY rbr";
        $rs_pitanja = mysqli_query($mysqli, $sql);
        if($rs_pitanja && mysqli_num_rows($rs_pitanja) > 0){
            while($pitanja = mysqli_fetch_assoc($rs_pitanja)){
            ?>
            <div style="padding:10px; background: #990d70; color:#fff; font-size:24px; border-radius: 8px 8px 0 0; margin-top:30px"><?= $pitanja['naslov'] ?><br><span style="font-size:16px"><?= $pitanja['pitanje'] ?></span></div>
            <div style="padding: 15px; border: 1px solid #ccc; border-radius: 0 0 8px 8px; background:#f7f7f7">  
            <?php
             $sql = "SELECT * FROM odgovori WHERE obrisan = false AND logic_chain = ".$ajtem['id']." AND pitanje = ".$pitanja['id']." ORDER BY rbr";
                //$sql = "SELECT * FROM odgovori WHERE parentID = 0 AND logic_chain = ".$ajtem['id']." ORDER BY rbr";
                $rs_odgovori = mysqli_query($mysqli, $sql);
                if($rs_odgovori && mysqli_num_rows($rs_odgovori) > 0){ 
                    while($odgovori = mysqli_fetch_assoc($rs_odgovori)){

                        $tmp_odgovor = !empty($odgovori['odgovor']) ? $odgovori['odgovor'] : '-';
                        $tmp_odgovor_id = $odgovori['id'];

                        //uploadi
                        $upload_slot = 2;
                        $upload_tbl = 'odgovori';
                        $upload_id = $tmp_odgovor_id;
                        $fajlovi_arr = dajIzMediaSlota($upload_tbl, 0, $upload_slot, $upload_id);
                        $dokumenti_ispis = '';
                        if(!empty($fajlovi_arr)){
                            $dokumenti_ispis = '<br><br>Files:';
                            $br = 0;
                            foreach($fajlovi_arr as $fajl){
                                $br++;
                                $dokumenti_ispis .= '<br><a href="https://'.$current_domain.'/upload_fajlova/$upload_tbl/'.$fajl['fajl'].'" target="_blank">'."$current_domain/upload_fajlova/$upload_tbl/".$fajl['fajl'].'</a>';
                               
                            }
                        }

                        echo '<h6>'.$odgovori['naslov'].'</h6><div style="padding-bottom: 30px;">'.$tmp_odgovor.$dokumenti_ispis.'</div>';

                    }
                }else echo '-';
                echo '</div>';
            }
        }
        ?>
        </div>
       
        <?php
    }
}
?>

</table>



</body>
</html>
<?php
        }
    }
}
?>