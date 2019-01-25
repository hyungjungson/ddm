<?php include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";?>
<?php include $_SERVER['DOCUMENT_ROOT']."/admin/user/user_calc.php";?>
<?

//게임룰설정 가져오기
$sql = "SELECT * FROM mng_game_rule WHERE idx = 1";
$row = $db->get_row($sql);

$user_cash_min = $row->user_cash_min;
			

//////////////////////////////////////////////실시간 //////////////////////////////////////

// 사이트 총 회원수
$sql = "SELECT count(*) FROM user WHERE user_status = 'Y'";
$user_cnt = $db->get_var($sql);

// 사이트 총 회원수(보유금 설정금액 이상)
$sql = "SELECT count(*) FROM user WHERE user_status = 'Y' AND user_cash >= '{$user_cash_min}'";
$user_cash_cnt = $db->get_var($sql);


//총 보유금
$sql = "SELECT sum(user_cash) FROM user WHERE user_status = 'Y'";
$ttl_user_cash = $db->get_var($sql);

//총 포인트
$sql = "SELECT sum(user_point) FROM user WHERE user_status = 'Y'";
$ttl_user_point = $db->get_var($sql);

//총 배팅
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y'";
$ttl_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y'";
$ttl_bet_cnt = $db->get_var($sql);

//승무패 배팅
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'cross' AND b.betting_folder = '1'";
$ttl_win_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'cross' AND b.betting_folder = '1'";
$ttl_win_bet_cnt = $db->get_var($sql);

//handy 배팅
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'handy' AND b.betting_folder = '1'";
$ttl_handy_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'handy' AND b.betting_folder = '1'";
$ttl_handy_bet_cnt = $db->get_var($sql);

//special 배팅
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'special' AND b.betting_folder = '1'";
$ttl_sp_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'special' AND b.betting_folder = '1'";
$ttl_sp_bet_cnt = $db->get_var($sql);

//live 배팅
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'live' AND b.betting_folder = '1'";
$ttl_live_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'live' AND b.betting_folder = '1'";
$ttl_live_bet_cnt = $db->get_var($sql);

//folder 배팅
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE bet_main_yn = 'Y' AND b.bet_game_idx = g.game_idx AND b.betting_folder > 1";
$ttl_folder_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE bet_main_yn = 'Y' AND b.bet_game_idx = g.game_idx AND b.betting_folder > 1";
$ttl_folder_bet_cnt = $db->get_var($sql);

//////////////////////////////////////////////실시간 끝 //////////////////////////////////////


//오늘 뽑기
$today = date("Y-m-d",time());
$today_s = $today." 00:00:00";
$today_e = $today." 23:59:59";

$preweek = date("Y-m-d",time()-24*60*60*1);
$preweek_s = $preweek." 00:00:00";

$preweek = date("Y-m-d",time()-24*60*60*0);
$preweek_e = $preweek." 00:00:00";

$first_day = date("Y-m",time())."-01";
$first_day_s = $first_day." 00:00:00";


$s_date = $_REQUEST['s_date'];
$e_date = $_REQUEST['e_date'];

if($s_date) $s_date = $s_date." 00:00:00";
if($e_date) $e_date = $e_date." 23:59:59";

//사이트 통계부분/////////////////////////

//충전건수/금액
$DATE_SQL = " AND regdate >= '$today_s' AND regdate < '$today_e'";
$sql = "SELECT IFNULL(sum(money),0) FROM user_charge_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$day_charge = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_charge_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$day_charge_cnt = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$preweek_s' AND regdate < '$preweek_e'";
$sql = "SELECT IFNULL(sum(money),0) FROM user_charge_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$week_charge = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_charge_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$week_charge_cnt = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$s_date' AND regdate < '$e_date'";
$sql = "SELECT IFNULL(sum(money),0) FROM user_charge_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$month_charge = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_charge_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$month_charge_cnt = $db->get_var($sql);


//환전
$DATE_SQL = " AND regdate >= '$today_s' AND regdate < '$today_e'";
$sql = "SELECT IFNULL(sum(money),0) FROM user_change_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$day_change = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_change_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$day_change_cnt = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$preweek_s' AND regdate < '$preweek_e'";
$sql = "SELECT IFNULL(sum(money),0) FROM user_change_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$week_change = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_change_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$week_change_cnt = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$s_date' AND regdate < '$e_date'";
$sql = "SELECT IFNULL(sum(money),0) FROM user_change_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$month_change = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_change_apply WHERE 1 = 1 AND status = 'Y' {$DATE_SQL}";
$month_change_cnt = $db->get_var($sql);


//배팅
$DATE_SQL = " AND bet_date >= '$today_s' AND bet_date < '$today_e'";
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status != '1' {$DATE_SQL}";
$day_bet = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status != '1' {$DATE_SQL}";
$day_bet_cnt = $db->get_var($sql);

$DATE_SQL = " AND bet_date >= '$preweek_s' AND bet_date < '$preweek_e'";
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status != '1' {$DATE_SQL}";
$week_bet = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status != '1' {$DATE_SQL}";
$week_bet_cnt = $db->get_var($sql);

$DATE_SQL = " AND bet_date >= '$s_date' AND bet_date < '$e_date'";
$sql = "SELECT IFNULL(sum(bet_money),0) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status != '1' {$DATE_SQL}";
$month_bet = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status != '1' {$DATE_SQL}";
$month_bet_cnt = $db->get_var($sql);

//배팅진행중
$DATE_SQL = " AND bet_date >= '$today_s' AND bet_date < '$today_e'";

$sql = "SELECT IFNULL(sum(bet_money),0) FROM (SELECT * FROM betting b WHERE bet_status != '3' {$DATE_SQL} GROUP BY betting_time_idx)tb";
$day_betting = $db->get_var($sql);
$sql = "SELECT count(*) FROM (SELECT * FROM betting b WHERE bet_status != '3' {$DATE_SQL} GROUP BY betting_time_idx)tb";
$day_betting_cnt = $db->get_var($sql);

$DATE_SQL = " AND bet_date >= '$preweek_s' AND bet_date < '$preweek_e'";
$sql = "SELECT IFNULL(sum(bet_money),0) FROM (SELECT * FROM betting b WHERE bet_status != '3' {$DATE_SQL} GROUP BY betting_time_idx)tb";
$week_betting = $db->get_var($sql);
$sql = "SELECT count(*) FROM (SELECT * FROM betting b WHERE bet_status != '3' {$DATE_SQL} GROUP BY betting_time_idx)tb";
$week_betting_cnt = $db->get_var($sql);
//echo $sql;

$DATE_SQL = " AND bet_date >= '$s_date' AND bet_date < '$e_date'"; 
$sql = "SELECT IFNULL(sum(bet_money),0) FROM (SELECT * FROM betting b WHERE bet_status != '3' {$DATE_SQL} GROUP BY betting_time_idx)tb";
$month_betting = $db->get_var($sql);
$sql = "SELECT count(*) FROM (SELECT * FROM betting b WHERE bet_status != '3' {$DATE_SQL} GROUP BY betting_time_idx)tb";
$month_betting_cnt = $db->get_var($sql);

//당첨
$DATE_SQL = " AND regdate >= '$today_s' AND regdate < '$today_e'";
$sql = "SELECT IFNULL(sum(cash),0) FROM user_cash WHERE 1 = 1 AND cash_desc LIKE '%당첨%' {$DATE_SQL}";
$day_dang = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_cash WHERE 1 = 1 AND cash_type ='dang' {$DATE_SQL}";
$day_dang_cnt1 = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_cash WHERE 1 = 1 AND cash_type ='dang_re' {$DATE_SQL}";
$day_dang_cnt2 = $db->get_var($sql);

$day_dang_cnt = $day_dang_cnt1 - $day_dang_cnt2;

$DATE_SQL = " AND regdate >= '$preweek_s' AND regdate < '$preweek_e'";
$sql = "SELECT IFNULL(sum(cash),0) FROM user_cash WHERE 1 = 1 AND cash_desc LIKE '%당첨%' {$DATE_SQL}";
$week_dang = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_cash WHERE 1 = 1 AND cash_type ='dang' {$DATE_SQL}";
$week_dang_cnt1 = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_cash WHERE 1 = 1 AND cash_type ='dang_re' {$DATE_SQL}";
$week_dang_cnt2 = $db->get_var($sql);

$week_dang_cnt = $week_dang_cnt1 - $week_dang_cnt2;


$DATE_SQL = " AND regdate >= '$s_date' AND regdate < '$e_date'"; 

$sql = "SELECT IFNULL(sum(cash),0) FROM user_cash WHERE 1 = 1 AND cash_desc LIKE '%당첨%' {$DATE_SQL}";
$month_dang = $db->get_var($sql);

$sql = "SELECT count(*) FROM user_cash WHERE 1 = 1 AND cash_type ='dang' {$DATE_SQL}";
$month_dang_cnt1 = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_cash WHERE 1 = 1 AND cash_type ='dang_re' {$DATE_SQL}";
$month_dang_cnt2 = $db->get_var($sql);

$month_dang_cnt = $month_dang_cnt1 - $month_dang_cnt2;


//낙첨
$DATE_SQL = " AND bet_date >= '$today_s' AND bet_date < '$today_e'";
$sql = "SELECT IFNULL(sum(bet_money),0) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status = '3' AND bet_result = 'X' {$DATE_SQL}";
$day_nac = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status = '3' AND bet_result = 'X' {$DATE_SQL}";
$day_nac_cnt = $db->get_var($sql);

$DATE_SQL = " AND bet_date >= '$preweek_s' AND bet_date < '$preweek_e'";
$sql = "SELECT IFNULL(sum(bet_money),0) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status = '3' AND bet_result = 'X' {$DATE_SQL}";
$week_nac = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status = '3' AND bet_result = 'X' {$DATE_SQL}";
$week_nac_cnt = $db->get_var($sql);

$DATE_SQL = " AND bet_date >= '$s_date' AND bet_date < '$e_date'";
$sql = "SELECT IFNULL(sum(bet_money),0) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status = '3' AND bet_result = 'X' {$DATE_SQL}";
$month_nac = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE b.bet_game_idx = g.game_idx AND b.bet_main_yn = 'Y' AND bet_status = '3' AND bet_result = 'X' {$DATE_SQL}";
$month_nac_cnt = $db->get_var($sql);


//지급포인트
$DATE_SQL = " AND regdate >= '$today_s' AND regdate < '$today_e'";
$sql = "SELECT IFNULL(sum(point),0) FROM user_point WHERE 1 = 1  AND point_desc != '포인트 전환' {$DATE_SQL}";
$day_point = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_point WHERE 1 = 1  AND point_type = 'nac_per' {$DATE_SQL}";
$day_point_cnt1 = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_point WHERE 1 = 1  AND point_type = 'nac_per_re' {$DATE_SQL}";
$day_point_cnt2 = $db->get_var($sql);

$day_point_cnt = $day_point_cnt1 - $day_point_cnt2;

$DATE_SQL = " AND regdate >= '$preweek_s' AND regdate < '$preweek_e'";
$sql = "SELECT IFNULL(sum(point),0) FROM user_point WHERE 1 = 1 AND point_desc != '포인트 전환' {$DATE_SQL}";
$week_point = $db->get_var($sql);

$sql = "SELECT count(*) FROM user_point WHERE 1 = 1  AND point_type = 'nac_per' {$DATE_SQL}";
$week_point_cnt1 = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_point WHERE 1 = 1  AND point_type = 'nac_per_re' {$DATE_SQL}";
$week_point_cnt2 = $db->get_var($sql);

$week_point_cnt = $week_point_cnt1 - $week_point_cnt2;

$DATE_SQL = " AND regdate >= '$s_date' AND regdate < '$e_date'";
$sql = "SELECT IFNULL(sum(point),0) FROM user_point WHERE 1 = 1 AND point_desc != '포인트 전환' {$DATE_SQL}";
$month_point = $db->get_var($sql);

$sql = "SELECT count(*) FROM user_point WHERE 1 = 1  AND point_type = 'nac_per' {$DATE_SQL}";
$month_point_cnt1 = $db->get_var($sql);
$sql = "SELECT count(*) FROM user_point WHERE 1 = 1  AND point_type = 'nac_per_re' {$DATE_SQL}";
$month_point_cnt2 = $db->get_var($sql);

$month_point_cnt = $month_point_cnt1 - $month_point_cnt2;



//총판포인트???????
$DATE_SQL = " AND date >= '$today_s' AND date < '$today_e'";
$sql = "SELECT IFNULL(sum(ch),0) FROM selling WHERE 1 = 1 {$DATE_SQL}";
$day_ch = $db->get_var($sql);

$DATE_SQL = " AND date >= '$preweek_s' AND date < '$preweek_e'";
$sql = "SELECT IFNULL(sum(ch),0) FROM selling WHERE 1 = 1 {$DATE_SQL}";
$week_ch = $db->get_var($sql);
//echo "<br><br>".$sql;
$DATE_SQL = " AND date >= '$s_date' AND date < '$e_date'";
$sql = "SELECT IFNULL(sum(ch),0) FROM selling WHERE 1 = 1 {$DATE_SQL}";
$month_ch = $db->get_var($sql);

/*
$DATE_SQL = " AND regdate >= '$today_s' AND regdate < '$today_e'";
$sql = "SELECT IFNULL(sum(point),0) FROM selling_master_history WHERE 1 = 1 {$DATE_SQL}";
$day_ch = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$preweek_s' AND regdate < '$preweek_e'";
$sql = "SELECT IFNULL(sum(point),0) FROM selling_master_history WHERE 1 = 1 {$DATE_SQL}";
$week_ch = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$s_date' AND regdate < '$e_date'";
$sql = "SELECT IFNULL(sum(point),0) FROM selling_master_history WHERE 1 = 1 {$DATE_SQL}";
$month_ch = $db->get_var($sql);
*/

//사무실??????
/*
$sql = "
SELECT (
	(SELECT IFNULL(sum(money),0) FROM user_charge_apply WHERE status = 'Y') - 
	(SELECT IFNULL(sum(money),0) FROM user_change_apply WHERE status = 'Y') - 
	(SELECT IFNULL(sum(user_cash),0) FROM user) -
	(SELECT IFNULL(sum(user_point),0) FROM user) -
	(SELECT IFNULL(sum(point),0) FROM selling_master_history)
) as ttl_office FROM user ";

$day_office = $db->get_var($sql);
*/
$DATE_SQL = " AND date >= '$today_s' AND date < '$today_e'";
$sql = "SELECT IFNULL(sum(office),0) FROM selling WHERE 1 = 1 {$DATE_SQL}";
$day_office = $db->get_var($sql);

$DATE_SQL = " AND date >= '$preweek_s' AND date < '$preweek_e'";
$sql = "SELECT IFNULL(sum(office),0) FROM selling WHERE 1 = 1 {$DATE_SQL}";
$week_office = $db->get_var($sql);

$DATE_SQL = " AND date >= '$s_date' AND date < '$e_date'";
$sql = "SELECT IFNULL(sum(office),0) FROM selling WHERE 1 = 1 {$DATE_SQL}";
$month_office = $db->get_var($sql);

//충전금 - 환전금 - 보유포인트- 보유머니 - 총판손익 



// 고액배팅?///////////
$DATE_SQL = " AND regdate >= '$today_s' AND regdate < '$today_e'";
$sql = "SELECT IFNULL(sum(money),0) FROM high_betting WHERE 1 = 1 {$DATE_SQL}";
$day_high_bet = $db->get_var($sql);
$sql = "SELECT count(*) FROM high_betting WHERE 1 = 1 {$DATE_SQL}";
$day_high_bet_cnt = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$preweek_s' AND regdate < '$preweek_e'";
$sql = "SELECT IFNULL(sum(money),0) FROM high_betting WHERE 1 = 1 {$DATE_SQL}";
$week_high_bet = $db->get_var($sql);
$sql = "SELECT count(*) FROM high_betting WHERE 1 = 1 {$DATE_SQL}";
$week_high_bet_cnt = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$s_date' AND regdate < '$e_date'";
$sql = "SELECT IFNULL(sum(money),0) FROM high_betting WHERE 1 = 1 {$DATE_SQL}";
$month_high_bet = $db->get_var($sql);
$sql = "SELECT count(*) FROM high_betting WHERE 1 = 1 {$DATE_SQL}";
$month_high_bet_cnt = $db->get_var($sql);


//가입자 
$DATE_SQL = " AND regdate >= '$today_s' AND regdate < '$today_e'";
$sql = "SELECT count(*) FROM user WHERE 1 = 1 {$DATE_SQL}";
$day_join_cnt = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$preweek_s' AND regdate < '$preweek_e'";
$sql = "SELECT count(*) FROM user WHERE 1 = 1 {$DATE_SQL}";
$week_join_cnt = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$s_date' AND regdate < '$e_date'";
$sql = "SELECT count(*) FROM user WHERE 1 = 1 {$DATE_SQL}";
$month_join_cnt = $db->get_var($sql);

//접속자
$DATE_SQL = " AND regdate >= '$today_s' AND regdate < '$today_e'";
$sql = "SELECT count(*) FROM counter WHERE 1 = 1 {$DATE_SQL}";
$day_visit_cnt = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$preweek_s' AND regdate < '$preweek_e'";
$sql = "SELECT count(*) FROM counter WHERE 1 = 1 {$DATE_SQL}";
$week_visit_cnt = $db->get_var($sql);

$DATE_SQL = " AND regdate >= '$s_date' AND regdate < '$e_date'";
$sql = "SELECT count(*) FROM counter WHERE 1 = 1 {$DATE_SQL}";
$month_visit_cnt = $db->get_var($sql);

//승무패 배팅
$DATE_SQL = " AND b.bet_date >= '$today_s' AND b.bet_date < '$today_e'";
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'cross' AND b.betting_folder = '1' {$DATE_SQL}";
$win_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'cross' AND b.betting_folder = '1' {$DATE_SQL}";
$win_bet_cnt = $db->get_var($sql);

//handy 배팅
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'handy' AND b.betting_folder = '1' {$DATE_SQL}";
$handy_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'handy' AND b.betting_folder = '1' {$DATE_SQL}";
$handy_bet_cnt = $db->get_var($sql);

//special 배팅
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'special' AND b.betting_folder = '1' {$DATE_SQL}";
$sp_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'special' AND b.betting_folder = '1' {$DATE_SQL}";
$sp_bet_cnt = $db->get_var($sql);

//live 배팅
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'live' AND b.betting_folder = '1' {$DATE_SQL}";
$live_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE 1 = 1 AND b.bet_game_idx = g.game_idx AND g.game_type = 'live' AND b.betting_folder = '1' {$DATE_SQL}";
$live_bet_cnt = $db->get_var($sql);

//folder 배팅
$sql = "SELECT IFNULL(sum(b.bet_money),0) FROM betting b, game g WHERE bet_main_yn = 'Y' AND b.bet_game_idx = g.game_idx AND b.betting_folder > 1 {$DATE_SQL}";
$folder_bet_money = $db->get_var($sql);
$sql = "SELECT count(*) FROM betting b, game g WHERE bet_main_yn = 'Y' AND b.bet_game_idx = g.game_idx AND b.betting_folder > 1 {$DATE_SQL}";
$folder_bet_cnt = $db->get_var($sql);


///////////////////////// 목록부분 ////////////////////////

// 충전신청
$lst_sql    = "
SELECT * FROM (
	SELECT b.*,a.user_lev, a.user_nick, a.user_name, a.user_tel1, a.user_tel2, a.user_tel3
	FROM user a, user_charge_apply b
	WHERE a.user_id = b.user_id
	) tb
WHERE 1 = 1
".$SRCH_SQL;


$lst_today = $lst_sql." AND regdate >= '$today_s' AND regdate < '$today_e'";
$charge_cnt_today  = $db->query($lst_today);

$lst_sql .= " ORDER BY regdate desc";
$lst_sql .= " LIMIT 0,10";

$res_charge = $db->get_results($lst_sql);

//echo $lst_sql;

// 환전신청
$lst_sql    = "
SELECT * FROM (
	SELECT b.*,a.user_lev, a.user_nick, a.user_name, a.user_tel1, a.user_tel2, a.user_tel3, a.user_cash
	FROM user a, user_change_apply b
	WHERE a.user_id = b.user_id
	) tb
WHERE 1 = 1
".$SRCH_SQL;

$lst_today = $lst_sql." AND regdate >= '$today_s' AND regdate < '$today_e'";
$change_cnt_today  = $db->query($lst_today);

$lst_sql .= " ORDER BY regdate desc";
$lst_sql .= " LIMIT 0,10";

$res_change = $db->get_results($lst_sql);


// 자유게시판

$lst_sql    = "
SELECT * FROM (
	SELECT *
	FROM board
	WHERE bd_type = 'free'
	AND notice_yn = 'N'
	) tb
WHERE 1 = 1
".$SRCH_SQL;

$board_cnt  = $db->query($lst_sql);

$lst_today = $lst_sql." AND regdate >= '$today_s' AND regdate < '$today_e'";
$board_today_cnt  = $db->query($lst_today);


$lst_sql .= " ORDER BY regdate desc";
$lst_sql .= " LIMIT 0,10";

$res_board = $db->get_results($lst_sql);


// 자유게시판

$lst_sql    = "
SELECT * FROM (
	SELECT *
	FROM board
	WHERE bd_type = 'center'
	AND notice_yn = 'N'
	) tb
WHERE 1 = 1
".$SRCH_SQL;

$lst_today = $lst_sql." AND regdate >= '$today_s' AND regdate < '$today_e'";
$center_today_cnt  = $db->query($lst_today);


$lst_sql .= " ORDER BY regdate desc";
$lst_sql .= " LIMIT 0,10";

$res_center = $db->get_results($lst_sql);


?>
<script>
$(function(){
    $('#s_date').datepicker();
    $('#e_date').datepicker();
});

setTimeout("calc_proc()",1000);

function calc_proc(){
	window.open("main_calc_start.php","calc1","width=200, height=200, toolbar=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no");
}

</script>
<form name="frm" action="<?=$_SERVER['PHP_SELF']?>" method="get" class="frm" id="frm">
<h1>실시간 내역</h1>
<table class="tbl_wrt2" cellpadding="0" cellspacing="0">
<tr>
<th>보유금</th>
<th>포인트</th>
<th>배팅내역</th>
<th>승무패</th>
<th>핸디캡</th>
<th>스페셜</th>
<th>라이브</th>
<th>복조배팅</th>
</tr>
<tr>
<td>
<?=number_format($ttl_user_cash)?> 원 / <?=$user_cash_cnt?> 명
</td>
<td>
<?=number_format($ttl_user_point)?> P / <?=$user_cnt?> 명
</td>
<td>
<?=number_format($ttl_bet_money)?> 원 / <?=$ttl_bet_cnt?> 건
</td>
<td>
<?=number_format($ttl_win_bet_money)?> 원 / <?=$ttl_win_bet_cnt?> 건
</td>
<td>
<?=number_format($ttl_handy_bet_money)?> 원 / <?=$ttl_handy_bet_cnt?> 건
</td>
<td>
<?=number_format($ttl_sp_bet_money)?> 원 / <?=$ttl_sp_bet_cnt?> 건
</td>
<td>
<?=number_format($ttl_live_bet_money)?> 원 / <?=$ttl_live_bet_cnt?> 건
</td>
<td>
<?=number_format($ttl_folder_bet_money)?> 원 / <?=$ttl_folder_bet_cnt?> 건
</td>
</tr>
</table>
<br />
<br />
<h1>사이트 통계</h1>
<table class="tbl_wrt2" cellpadding="0" cellspacing="0">
<tr>
    <th></th>
    <th></th>
    <th>충전</th>
    <th>환전</th>
    <th>총배팅</th>
    <th>진행중배팅</th>
    <th>당첨</th>
    <th>낙첨</th>
    <th>지급한포인트</th>
    <th>총판</th>
    <th>사무실</th>
    <th>고액배팅</th>
    <th>가입자</th>
    <th>방문자</th>
</tr>
<tr>
	<th rowspan="2">1일<br />오늘</th>
    <td>건수</td>
    <td>
	<?=$day_charge_cnt?>
    </td>
    <td>
    <?=$day_change_cnt?>
    </td>
    <td>
    <?=$day_bet_cnt?>
    </td>
    <td>
    <?=$day_betting_cnt?>
    </td>
    <td>
    <?=$day_dang_cnt?>
    </td>
    <td>
    <?=$day_nac_cnt?>
    </td>
    <td>
    <?=$day_point_cnt?>
    </td>
    <td rowspan="2">
	<?=number_format($day_ch)?>
    </td>
    <td rowspan="2">
    <?=number_format($day_office)?>
    </td>
    <td>
    <?=$day_high_bet_cnt?>
    </td>
    <td rowspan="2">
    <?=$day_join_cnt?>
    </td>
    <td rowspan="2">
    <?=$day_visit_cnt?>
    </td>    
</tr>
<tr>
	<td>금액</td>
    <td>
	<?=number_format($day_charge)?>
    </td>
    <td>
    <?=number_format($day_change)?>
    </td>
    <td>
    <?=number_format($day_bet)?>
    </td>
    <td>
    <?=number_format($day_betting)?>
    </td>
    <td>
    <?=number_format($day_dang)?>
    </td>
    <td>
    <?=number_format($day_nac)?>
    </td>
    <td>
    <?=number_format($day_point)?>
    </td>
    <td>
    <?=number_format($day_high_bet)?>
    </td>
    
</tr>
<tr>
	<th rowspan="2">어제</th>
    <td>건수</td>
    <td>
	<?=$week_charge_cnt?>
    </td>
    <td>
    <?=$week_change_cnt?>
    </td>
    <td>
    <?=$week_bet_cnt?>
    </td>
    <td>
    <?=$week_betting_cnt?>
    </td>
    <td>
    <?=$week_dang_cnt?>
    </td>
    <td>
    <?=$week_nac_cnt?>
    </td>
    <td>
    <?=$week_point_cnt?>
    </td>
    <td rowspan="2">
	<?=number_format($week_ch)?>
    </td>
    <td rowspan="2">
    <?=number_format($week_office)?>
    </td>
    <td>
    <?=$week_high_bet_cnt?>
    </td>
    <td rowspan="2">
    <?=$week_join_cnt?>
    </td>
    <td rowspan="2">
    <?=$week_visit_cnt?>
    </td>    
</tr>
<tr>
	<td>금액</td>
    <td>
	<?=number_format($week_charge)?>
    </td>
    <td>
    <?=number_format($week_change)?>
    </td>
    <td>
    <?=number_format($week_bet)?>
    </td>
    <td>
    <?=number_format($week_betting)?>
    </td>
    <td>
    <?=number_format($week_dang)?>
    </td>
    <td>
    <?=number_format($week_nac)?>
    </td>
    <td>
    <?=number_format($week_point)?>
    </td>
    <td>
    <?=number_format($week_high_bet)?>
    </td>
    
</tr>

<tr>
	<th rowspan="2" style="width:130px; line-height:1.6; text-align:left; padding-left:10px"><input type='text' name='s_date' id='s_date' class='tbl_wrt_text' style="width:70px;" value='<?=$s_date?>'/>
~<br />
    <input type='text' name='e_date' id='e_date' class='tbl_wrt_text' style="width:70px;" value='<?=$e_date?>'/>
    <span class="button"><button type="submit">검색</button></span>    </th>
    <td>건수</td>
    <td>
	<?=$month_charge_cnt?>
    </td>
    <td>
    <?=$month_change_cnt?>
    </td>
    <td>
    <?=$month_bet_cnt?>
    </td>
    <td>
    <?=$month_betting_cnt?>
    </td>
    <td>
    <?=$month_dang_cnt?>
    </td>
    <td>
    <?=$month_nac_cnt?>
    </td>
    <td>
    <?=$month_point_cnt?>
    </td>
    <td rowspan="2">
	<?=number_format($month_ch)?>
    </td>
    <td rowspan="2">
    <?=number_format($month_office)?>
    </td>
    <td>
    <?=$month_high_bet_cnt?>
    </td>
    <td rowspan="2">
    <?=$month_join_cnt?>
    </td>
    <td rowspan="2">
    <?=$month_visit_cnt?>
    </td>    
</tr>
<tr>
	<td>금액</td>
    <td>
	<?=number_format($month_charge)?>
    </td>
    <td>
    <?=number_format($month_change)?>
    </td>
    <td>
    <?=number_format($month_bet)?>
    </td>
    <td>
    <?=number_format($month_betting)?>
    </td>
    <td>
    <?=number_format($month_dang)?>
    </td>
    <td>
    <?=number_format($month_nac)?>
    </td>
    <td>
    <?=number_format($month_point)?>
    </td>
    <td>
    <?=number_format($month_high_bet)?>
    </td>
    
</tr>

</table>
<br />
<br />

<div style="float:left">
<h1>충전신청</h1>
</div>
<div style="float:right; padding-top:10px; font-weight:bold">
일간 건수 : <?=$charge_cnt_today?> 건 / 
미처리 건수 : <?=$charge_apply_cnt?> 건
</div>
<table cellpadding="0" cellspacing="0" border="0" class="tbl_list">
<colgroup>
<col /><col /><col /><col />
<col /><col /><col /><col /><col /> 
<col /><col />
</colgroup>
<thead>
<tr>
<th>ID</th>
<th>닉네임</th>
<th>이름</th>
<th>전화</th>
<th>충전신청금액</th>
<th>신청시간</th>
<th>처리시간</th>
<th>상태</th>

</tr>
</thead>
<tbody>
<?
    if ($res_charge)
    {
        $i = 0;
        foreach ($res_charge as $data)
        {
            $idx = $data->idx;
			$money = $data->money;
			$bank_user = $data->bank_user;
			$status = $data->status;
			$user_nick = $data->user_nick;
			$user_name = $data->user_name;
			$bank_user = $data->bank_user;
			$user_id = $data->user_id;
			$user_lev = $data->user_lev;
			$user_tel1 = $data->user_tel1;
			$user_tel2 = $data->user_tel2;
			$user_tel3 = $data->user_tel3;
			$regdate = $data->regdate;
			$up_date = $data->up_date;
			if($status == "N"){
				$status_txt = "대기";	
			} else if($status == "X"){
				$status_txt = "취소";
			} else { 
				$status_txt = "처리완료";	
			}
            
            //$money *= 10000;

?>
<tr>
    <td align="center"><a href="/admin/user/pop_user.php?id=<?=$user_id?>" class="popup"><?=$user_id?></a></td>
    <td align="center"><?=$user_nick?></td>
    <td align="center"><?=$user_name?></td>
    <td align="center"><?=$user_tel1?> - <?=$user_tel2?> - <?=$user_tel3?></td>
    <td align="center"><?=number_format($money)?> 원</td>
    <td align="center"><?=$regdate?></td>
    <td align="center"><?=$up_date?></td>
    <td align="center"><?=$status_txt?></td>
    
</tr>
<!-- s:data area -->
<?
		$i++;
        }
    } else {
?>
<tr>
    <td colspan="12" align="center">충전신청내역이 없습니다.</td>
</tr>

<? } ?>
<!-- e:data area -->
</tbody>
</table>

<br />
<br />


<div style="float:left">
<h1>환전신청</h1>
</div>
<div style="float:right; padding-top:10px; font-weight:bold">
일간 건수 : <?=$change_cnt_today?> 건 / 
미처리 건수 : <?=$change_apply_cnt?> 건
</div>
<table cellpadding="0" cellspacing="0" border="0" class="tbl_list">
<colgroup>
<col /><col /><col /><col />
<col /><col /><col /><col /><col /> 
<col /><col />
</colgroup>
<thead>
<tr>
<th>ID</th>
<th>닉네임</th>
<th>이름</th>
<th>전화</th>
<th>환전신청금액</th>
<th>신청시간</th>
<th>처리시간</th>
<th>상태</th>

</tr>
</thead>
<tbody>
<?
    if ($res_change)
    {
        $i = 0;
        foreach ($res_change as $data)
        {
            $idx = $data->idx;
			$money = $data->money;
			$bank_user = $data->bank_user;
			$status = $data->status;
			$user_nick = $data->user_nick;
			$user_name = $data->user_name;
			$bank_user = $data->bank_user;
			$user_id = $data->user_id;
			$user_lev = $data->user_lev;
			$user_tel1 = $data->user_tel1;
			$user_tel2 = $data->user_tel2;
			$user_tel3 = $data->user_tel3;
			$regdate = $data->regdate;
			$up_date = $data->up_date;
			if($status == "N"){
				$status_txt = "대기";	
			} else if($status == "X"){
				$status_txt = "취소";
			} else { 
				$status_txt = "처리완료";	
			}
            
            //$money *= 10000;

?>
<tr>
    <td align="center"><a href="/admin/user/pop_user.php?id=<?=$user_id?>" class="popup"><?=$user_id?></a></td>
    <td align="center"><?=$user_nick?></td>
    <td align="center"><?=$user_name?></td>
    <td align="center"><?=$user_tel1?> - <?=$user_tel2?> - <?=$user_tel3?></td>
    <td align="center"><?=number_format($money)?> 원</td>
    <td align="center"><?=$regdate?></td>
    <td align="center"><?=$up_date?></td>
    <td align="center"><?=$status_txt?></td>
    
</tr>
<!-- s:data area -->
<?
		$i++;
        }
    } else {
?>
<tr>
    <td colspan="12" align="center">환전신청내역이 없습니다.</td>
</tr>

<? } ?>
<!-- e:data area -->
</tbody>
</table>

<br />
<br />


<div style="float:left">
<h1>자유게시판</h1>
</div>
<div style="float:right; padding-top:10px; font-weight:bold">
일간 게시글수 : <?=$board_today_cnt?> 건 / 
누적 : <?=$board_cnt?> 건
</div>
<table cellpadding="0" cellspacing="0" border="0" class="tbl_list">
<colgroup>
<col /><col /><col /><col />
<col /><col />
</colgroup>
<thead>
<tr>
<th>제목</th>
<th>글쓴이</th>
<th>날짜</th>

<th>조회</th>

</tr>
</thead>
<tbody>
<?
    if ($res_board)
    {
        $i = 0;
        foreach ($res_board as $data)
        {
			$bd_idx = $data->bd_idx;
            $title = $data->title;
            $view_cnt = $data->view_cnt;
			$bd_cate = $data->bd_cate;
            $write_id = $data->write_id;
            $write_nick = $data->write_nick;
            $write_name = $data->write_name;
            $regdate = $data->regdate;
			
			$title_color = $data->title_color;
			if(!$title_color) $title_color = "#333";
			
			
?>
<tr>
    <td class="bd_left"><div class="title"><nobr>[<?=$bd_cate?>] <a href="./board/view.php?idx=<?=$bd_idx?>" style="color:<?=$title_color?>"><?=$title?></a></nobr></div></td>
    <td align="center"><a href="/admin/user/pop_user.php?id=<?=$write_id?>" class="popup"><?=$write_nick?></a></td>
    <td align="center"><?=$regdate?></td>
    <td align="center"><?=$view_cnt?></td>
</tr>
<!-- s:data area -->
<?
		$i++;
        }
    } else {
?>
<tr>
    <td colspan="6" align="center">게시글이 없습니다.</td>
</tr>

<? } ?>
<!-- e:data area -->
</tbody>
</table>


<br />
<br />


<div style="float:left">
<h1>고객센터</h1>
</div>
<div style="float:right; padding-top:10px; font-weight:bold">
일간 문의수 : <?=$center_today_cnt?> 건 / 
미답변수 : <?=$board_center_cnt?> 건
</div>
<table cellpadding="0" cellspacing="0" border="0" class="tbl_list">
<colgroup>
<col /><col /><col /><col />
<col /><col />
</colgroup>
<thead>
<tr>
<th>제목</th>
<th>글쓴이</th>
<th>날짜</th>
<th>답변여부</th>

</tr>
</thead>
<tbody>
<?
    if ($res_center)
    {
        $i = 0;
        foreach ($res_center as $data)
        {
			$bd_idx = $data->bd_idx;
            $title = $data->title;
            $view_cnt = $data->view_cnt;
			$bd_cate = $data->bd_cate;
            $write_id = $data->write_id;
            $write_nick = $data->write_nick;
            $write_name = $data->write_name;
			$answer_yn = $data->answer_yn;
            $regdate = $data->regdate;
			
			if($answer_yn == "Y"){
				$answer_txt = '<span class="button small blue"><a href="./board/center_modi.php?idx='.$bd_idx.'">답변완료</a></span>';
			} else {
				$answer_txt = '<span class="button small red"><a href="./board/center_modi.php?idx='.$bd_idx.'">답변하기</a></span>';
			}
			
			
?>
<tr>
    <td class="bd_left"><div class="title"><nobr>[<?=$bd_cate?>] <a href="./board/center_modi.php?idx=<?=$bd_idx?>" style="color:<?=$title_color?>"><?=$title?></a></nobr></div></td>
    <td align="center"><a href="/admin/user/pop_user.php?id=<?=$write_id?>" class="popup"><?=$write_nick?></a></td>
    <td align="center"><?=$regdate?></td>
    <td align="center"><?=$answer_txt?></td>
</tr>
<!-- s:data area -->
<?
		$i++;
        }
    } else {
?>
<tr>
    <td colspan="6" align="center">게시글이 없습니다.</td>
</tr>

<? } ?>
<!-- e:data area -->
</tbody>
</table>
</form>

<?php include $_SERVER['DOCUMENT_ROOT']."/admin/footer.php";?>
