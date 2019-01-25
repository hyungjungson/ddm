<?php
date_default_timezone_set('Asia/Seoul');


$title_main = "TACGLOBAL Homepage";

$title_list = array("","환자 병력,소견","검사","진단치료","질문 혹은 후속 논의");

$sex_array = array("","여자","남자");

$level_array = array("준회원","가입신청 준회원","정회원","","","최고회원","","준관리자","","","최고관리자");

$acc_array = array("","사진","팩스","이메일","전화");

define('MAIN_TITLE', $title_main);
define('ADMIN_TITLE', $title_main." :: 관리자");



//define(COUPON_REUSE, 3);

//global configuration
//define(MAIN_TITLE, "쇼부");
//define(ADMIN_TITLE, "쇼부 :: 관리자");
define('SERVICE_DOMAIN', $_SERVER['SERVER_NAME']);
define('SERVICE_URL', "http://".$_SERVER['SERVER_NAME']);

//define('SMS_ID', "smsid");
//define(SMS_PWD, "smspw");
//define(SND_NUMBER, "0212341234"); // sender number only number

/* FCK Path: /fckeditor/filemanager/php/*.php  */
//define(FCK_USER_FILE_PATH, "/userfile/");
//define(FCK_FILE_PATH, "\\userfile\\"); // IBM 환경
//define(FCK_FILE_PATH, "/userfile/"); // IBM 환경

// NICE신용평가정보 실명인증
//define(NICE_ID, "12001236");
//define(NICE_PW, "77270770");

// IP to latitude/longitude 
//define(GEOIPKEY, "b9ffe7004c83b16882eab1bd5bc209929d16dd27df3fb1a859a3f8cbca2f5bde");

$DIR_CGIMAGE = $_SERVER['DOCUMENT_ROOT']."/fileupload/category/image/";

$array_bank = array(
"국민은행"
, "신한은행"
, "농협"
, "우리은행"
, "기업은행"
, "하나은행"
, "외환은행"
, "경남은행"
, "광주은행"
, "대구은행"
, "도이치"
, "부산은행"
, "산림조합"
, "산업은행"
, "상호저축"
, "새마을"
, "수협"
, "신협"
, "시티"
, "우체국"
, "전북"	
, "제주"
, "지역농축협"
, "BOA"
, "HSBC"
, "JP모간"
, "SC"
, "BNP파라바"	
);

$array_mail = array(
	"nate.com"
	, "daum.net"
	, "naver.com"
	, "hanmail.net"
	, "empal.com"
	, "google.com"
	, "hotmail.com"
	, "freechal.com"
	, "hanafos.com"
	, "hotmail.com"
	, "korea.com"
	, "lycos.co.kr"
	, "netian.com"
	, "netsgo.com"
	, "paran.com"
	, "dreamwiz.com"
	, "yahoo.co.kr"
);

$array_phone = array("010", "011", "016", "017", "018", "019");

$array_tel = array(
    "02","031", "032", "033"
	 , "041", "042", "043", "051"
	 , "052", "053", "054", "055"
	 , "061", "062", "063", "064"
	 , "070", "080", "0502", "0505"
	 , "0506","0303"
 );

// KCP paymethod
$arr_pay_method = array(
    "100000000000"=>"신용카드",
    "000010000000"=>"핸드폰결제",
    "010000000000"=>"실시간계좌이체"
);

// 영문 국가명
$arr_country = array(
    "American Samoa",
    "Andorra",
    "Angola",
    "Anguilla",
    "Antarctica",
    "Antigua and Barbuda",
    "Argentina",
    "Armenia",
    "Aruba",
    "Australia",
    "Austria",
    "Azerbaijan",
    "A…land Islands",
    "Bahamas",
    "Bahrain",
    "Bangladesh",
    "Barbados",
    "Belarus",
    "Belgium",
    "Belize",
    "Benin",
    "Bermuda",
    "Bhutan",
    "Bolivia",
    "Bosnia and Herzegovina",
    "Botswana",
    "Bouvet Island",
    "Brazil",
    "British Indian Ocean Territory",
    "Brunei Darussalam",
    "Bulgaria",
    "Burkina Faso",
    "Burundi",
    "Cambodia",
    "Cameroon",
    "Canada",
    "Canary Islands",
    "Cape Verde",
    "Cayman Islands",
    "Central African Republic",
    "Ceuta",
    "Chad",
    "Chile",
    "China",
    "Christmas Island",
    "Cocos (Keeling) Islands",
    "Colombia",
    "Comoros",
    "Congo, Dem. Republic",
    "Congo, Republic",
    "Cook Islands",
    "Costa Rica",
    "Cote d'Ivoire",
    "Croatia",
    "Cyprus",
    "Cyprus (unregulated area)",
    "Czech Republic",
    "Denmark",
    "Djibouti",
    "Dominica",
    "Dominican Republic",
    "East-Timor",
    "Ecuador",
    "Egypt",
    "El Salvador",
    "Equatorial Guinea",
    "Eritrea",
    "Estonia",
    "Ethiopia",
    "Falkland Islands",
    "Faroe Islands",
    "Fiji",
    "Finland",
    "France",
    "French Guiana",
    "French Polynesia",
    "French Southern Territories",
    "Gabon",
    "Gambia",
    "Georgia",
    "Germany",
    "Ghana",
    "Gibraltar",
    "Greece",
    "Greenland",
    "Grenada",
    "Guadeloupe",
    "Guam",
    "Guatemala",
    "Guernsey",
    "Guinea",
    "Guinea-Bissau",
    "Guyana",
    "Haiti",
    "Heard Island and McDonald Islands",
    "Honduras",
    "Hong Kong",
    "Hungary",
    "Iceland",
    "India",
    "Indonesia",
    "Iraq",
    "Ireland",
    "Isle Of Man",
    "Israel",
    "Italy",
    "Jamaica",
    "Japan",
    "Jersey",
    "Jordan",
    "Kazakhstan",
    "Kenya",
    "Kiribati",
    "Korea, South",
    "Kuwait",
    "Kyrgyzstan",
    "Laos",
    "Latvia",
    "Lebanon",
    "Lesotho",
    "Liberia",
    "Liechtenstein",
    "Lithuania",
    "Luxembourg",
    "Macau",
    "Macedonia (Former Yugoslav Republic)",
    "Madagascar",
    "Malawi",
    "Malaysia",
    "Maldives",
    "Mali",
    "Malta",
    "Marshall Islands",
    "Martinique",
    "Mauritania",
    "Mauritius",
    "Mayotte",
    "Melilla",
    "Mexico",
    "Micronesia",
    "Moldova",
    "Monaco",
    "Mongolia",
    "Montenegro",
    "Montserrat",
    "Morocco",
    "Mozambique",
    "Myanmar",
    "Namibia",
    "Nauru",
    "Nepal",
    "Netherlands",
    "Netherlands Antilles",
    "New Caledonia",
    "New Zealand",
    "Nicaragua",
    "Niger",
    "Nigeria",
    "Niue",
    "Norfolk Island",
    "Northern Mariana Islands",
    "Norway",
    "Oman",
    "Pakistan",
    "Palau",
    "Palestinian Territory",
    "Panama",
    "Papua New Guinea",
    "Paraguay",
    "Peru",
    "Philippines",
    "Pitcairn Islands",
    "Poland",
    "Portugal",
    "Puerto Rico",
    "Qatar",
    "Reunion",
    "Romania",
    "Russia",
    "Rwanda",
    "Samoa",
    "San Marino",
    "Sao Tome and Principe",
    "Saudi Arabia",
    "Senegal",
    "Serbia",
    "Seychelles",
    "Sierra Leone",
    "Singapore",
    "Slovakia",
    "Slovenia",
    "Solomon Islands",
    "Somalia",
    "South Africa",
    "South Georgia and Sandwich Islands",
    "Spain",
    "Sri Lanka",
    "St. Helena",
    "St. Kitts and Nevis",
    "St. Lucia",
    "St. Pierre and Miquelon",
    "St. Vincent and the Grenadines",
    "Suriname",
    "Svalbard",
    "Swaziland",
    "Sweden",
    "Switzerland",
    "Taiwan",
    "Tajikistan",
    "Tanzania",
    "Thailand",
    "Togo",
    "Tokelau",
    "Tonga",
    "Trinidad and Tobago",
    "Tunisia",
    "Turkey",
    "Turkmenistan",
    "Turks and Caicos Islands",
    "Tuvalu",
    "Uganda",
    "Ukraine",
    "United Arab Emirates",
    "United Kingdom",
    "Unknown",
    "Uruguay",
    "US Minor Outlying Islands",
    "USA",
    "Uzbekistan",
    "Vanuatu",
    "Vatican City State",
    "Venezuela",
    "Viet Nam",
    "Virgin Islands (British)",
    "Virgin Islands (U.S.)",
    "Wallis and Futuna",
    "Western Sahara",
    "Yemen",
    "Zambia",
    "Zimbabwe"
);

$arr_pw_q = array(
    "A" => "가장 존경하는 인물은?",
    "B" => "나만의 신체 비밀은?",
    "C" => "가장 감명깊게 본 영화는?",
    "D" => "가장 인상깊게 읽은 책은?",
    "E" => "가장 친한 친구이름은?",
    "F" => "어릴적 별명은?",
    "G" => "초등학교때 나의 꿈은?",
    "H" => "좋아하는 과일은?",
    "I" => "좋아하는 스포츠팀은?",
    "J" => "자신의 인생 좌우명은?",
    "K" => "자신의 보물 1호는?",
    "L" => "선물 중에 가장 기억에 남는 것은?"
);
?>