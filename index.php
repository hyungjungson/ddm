<?php
   header("Pragma: no-cache");
   header("Cache-Control: no-store, no-cache, must-revalidate");
   header('Content-Type: text/html; charset=UTF-8');
   define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]."/");
   require_once(ROOT_PATH."admin/session.php");
   require_once(ROOT_PATH."config/global_config.php");
   require_once(ROOT_PATH."lib/DB.php");
   require_once(ROOT_PATH."lib/function.php");

   //공지사항
   $lst_sql = "SELECT * FROM notice WHERE del_yn = 'N' ORDER BY idx DESC LIMIT 6";
   $res_notice = $db->get_results($lst_sql);

   //접속 로그
   $accessSql = "INSERT INTO access_log ( ip, indatetime) VALUES ( '". $_SERVER['REMOTE_ADDR'] ."', now())";
   $accessRes = $db->query($accessSql);

   //백서
   $paperSql = "SELECT * FROM paper ORDER BY p_type DESC, sort ASC";
   $paperRes = $db->get_results($paperSql);
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="TAC">
    <meta name="keyword" content="TAC">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/ionicons.min.css">

    <!--reset-->
    <link rel="stylesheet" type="text/css" href="css/common.css" />

    <!--custom-->
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive_tablet.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive_mobile.css" />

    <!--webfonts_kor-->
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
    <link href='https://cdn.jsdelivr.net/font-kopub/1.0/kopubdotum.css' rel='stylesheet' type='text/css'>
    <!--webfonts_eng-->
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://github.com/fontfen/myriad-pro/blob/master/stylesheet.css" rel="stylesheet">
   
</head>

<body>

    <!--header-->
    <div class="header" id="header">
        <div class="logo">
            <h1><a href="/"><img src="images/logo.png" alt="tac" /></a></h1>
            <ul class="gnb">
                <li><a href="#">KOR</a></li>
            </ul>
        </div>
        <!--nav-->
        <nav class="nav clearfix navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" id="btn" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav-menu nav navbar-nav">
                        <li><a class="nav-menu-item" href="#section-2">INTRODUCATION</a></li>
                        <li><a class="nav-menu-item" href="#section-3">WHY TAC PLATFORM</a></li>
                        <li><a class="nav-menu-item" href="#section-5">TAC ECOSYSTEM</a></li>
                        <li><a class="nav-menu-item" href="#section-6">CASETAC</a></li>
                        <li><a class="nav-menu-item" href="#section-7">TOKEN ALLOCATION</a></li>
                        <li><a class="nav-menu-item" href="#section-8">ICO SCHEDULE</a></li>
                        <li><a class="nav-menu-item" href="#section-9">TEAM</a></li>
                        <li><a class="nav-menu-item" href="#section-10">CONTACT US</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--//header-->

    <!--intro-->
    <div class="section">
        <section id="section-1">
            <div class="title01">
                <h2>WHY TAC PLATFORM</h2>
                <p class="txt01">TOKEN ATTRACTS CUSTOMERS</p>
                <p class="txt02">
                    소상공인이 살아야 대한민국이 웃는다<br>
                    블록체인 분산 네트워크에 참여하는 사람들과 소상공인들을 위한 플랫폼
                </p>
            </div>
        </section>
        <!--//intro-->
        <!--contents-->
        <div class="box_wrap">
            <div class="box1">
                <img src="images/box/box01.png" alt="TAC 토큰 결제" />
                <p>TAC 토큰 결제</p>
            </div>
            <div class="box2">
                <img src="images/box/box02.png" alt="명동 TAC PLATFORM" />
                <p>명동 TAC PLATFORM</p>
            </div>
            <div class="box3">
                <img src="images/box/box03.png" alt="TAC 토큰 결제" />
                <p>BIG DATA 분석</p>
            </div>
        </div>
        <!--//content-->

        <!--INTRODUCATION-->
        <section id="section-2">
            <div class="title02">
                <h3><span class="blackline"></span>INTRODUCATION</h3>
                <p>소상공인이 살아야 대한민국이 웃는다</p>
                <!--contents-->
                <div class="contents_box">
                    <div class="left_box">
                        <img src="images/thumnail/intro01.jpg" alt="image">
                    </div>
                    <div class="right_box">
                        <h4>소상공인이란?</h4>
                        <p>
                            소기업중 상시 근로자수가 5 명미만도.소매업, 음식업, 숙박업, 서비스업등, 혹은10명미만제조업,
                            건설업 및 운수 업사업자를 말한다.이러한소상공인들의경제활동이대한민국경제에주요한위치를
                            차지하고있음에도불구하고이들을위한사회적관심과지원은열악하다.
                        </p>
                        <p>
                            소상공인들은대부분1인~5인미만의소규모영업으로빈약한구조를벗어나지못하고있을뿐더러,
                            대규모의복합쇼핑몰들이점점더골목에들어설수록소상공인들의부익부빈익빈현상으로인한사회적
                            양극화는심해진다.
                        </p>
                        <p>
                            이들을지원하기위한정부와지원기관들의노력과함께대한민국사회의관심이필요하다.
                            소상공인들이삶의어려움과아픔을함께소통하고,그들의사업의활성화를위해더광범위한인적물적
                            지원이절실히필요한시점이다. 소상공인이살아야대한민국국민이웃는다.

                        </p>
                    </div>
                </div>
                <!--//contents-->


                <!--contents-->
                <div class="contents_box2">

                    <div class="right_box">
                        <h4>Token Attracts Customers</h4>
                        <p>
                            Token Attracts Customers ‘토큰으로고객을이끌다’는뜻으로출발한
                            TAC Platform(플랫폼)은대한민국소상공인들을위한블록체인기반사업지원솔루션을제공한다.
                        </p>
                       <p>
                            블록체인은분산된네트워크안에서네트워크에참여하는많은사람들과소상공인들의편리하고적극적
                            인소통을위한플랫폼을제공한다.
                        </p>
                        <p>
                            이로인하여소상공인들은고객들의필요에적극적으로변화할수있으며, 더나은서비스를개발하여
                            전문화되고고급화된상품을제공할수있을것으로예상한다.
                            TAC 생태계가구축되어나갈수록대한민국소상공인들의경제가함께성장하는비전을제안한다.
                        </p>
                    </div>
                    <div class="left_box">
                        <img src="images/thumnail/intro02.jpg" alt="image">
                    </div>
                </div>


                <!--모바일 레이아웃 변경-->
                <div class="mcontents_box2">
                    <div class="left_box">
                        <img src="images/thumnail/intro02.jpg" alt="image">
                    </div>
                    <div class="right_box">
                        <h4>Token Attracts Customers</h4>
                        <p>
                            Token Attracts Customers ‘토큰으로고객을이끌다’는뜻으로출발한
                            TAC Platform(플랫폼)은대한민국소상공인들을위한블록체인기반사업지원솔루션을제공한다.
                        </p>
                        <p>
                            블록체인은분산된네트워크안에서네트워크에참여하는많은사람들과소상공인들의편리하고적극적
                            인소통을위한플랫폼을제공한다.
                        </p>
                        <p>
                            이로인하여소상공인들은고객들의필요에적극적으로변화할수있으며, 더나은서비스를개발하여
                            전문화되고고급화된상품을제공할수있을것으로예상한다.
                            TAC 생태계가구축되어나갈수록대한민국소상공인들의경제가함께성장하는비전을제안한다.
                        </p>
                    </div>
                </div>
                <!--//contents-->

                <!--contents-->
                <div class="contents_box3">
                    <div class="left_box">
                        <img src="images/thumnail/intro03.jpg" alt="image">
                    </div>
                    <div class="right_box">
                        <h4>서울의 관광1번지 명동으로 시작</h4>
                        <p>
                            TAC 플랫폼은서울의관광1번지명동을시작으로그진가를발휘하게된다.
                        </p>
                        <p>
                            명동을찾는관광객과명동내소상공인을연결하는새로운패러다임을선보일것이다.
                            소상공인들은TAC플랫폼에서서비스와상품을소개할수있고,명동을찾는관광객들은 TAC플랫폼
                            안에서관광여정,숙박, 쇼핑, 가격비교, 맛집, 이벤트안내등다양한서비스를한번에이용할수있다.
                            뿐만아니라블록체인거래증명방식을도입하여해외관광객들에게TAC Token을통한간편한결제
                            솔루션까지제공한다.
                        </p>
                        <p>
                            명동은 소상공인과 해외 관광객들이 날마다 소통 하는공간 으로서 TAC의 생태계를 구축하기에
                            최적의장소다.
                        </p>
                    </div>
                </div>
                <!--//contents-->
            </div>
        </section>
        <!--//INTRODUCATION-->

        <!--PLATFORM-->
        <section id="section-3">
            <div class="title03">
                <span class="blackline"></span>
                <h3>WHY TAC PLATFORM</h3>
                <p>왜 TAC이 필요한가? </p>
            </div>

            <!--contents-->
            <div class="contents_box3">
                <div class="left_box">
                    <img src="images/thumnail/intro04.jpg" alt="image">
                </div>
                <div class="right_box">
                    <h4>부익부빈익빈양극화</h4>
                    <p>
                        통계청조사에따르면, 2010년부터현재까지연간소상공인의소규모사업체는점점늘어나는것으로
                        집계되었다. 특히업종별로분류해보면전체대한민국전체사업자수(약310만사업자) 중에숙박및음
                        식업도매업에종사하는 소상공인의비율은70%에육박한다. 하지만이들의매출의규모는대기업,
                        대형소매업자들에비하여턱없이모자란수치를보여준다.
                    </p>
                    <p>
                        이유는무엇일까?
                        대형유통점이나기업형슈퍼마켓의확산에따라골목상권이잠식당하고있으며, 전통시장및상점가등
                        이상품및마케팅경쟁력에서 점점밀리고있는것이현실이다.
                        더불어소비자들은점점더온라인검색에익숙해져가고있으며, 상품정보검색에능숙한고객들은
                        가격비교를통해서저가이면서도품질이우수 한상품들을찾는현명함을갖고있다.
                        이에발빠르게반응하기위해서소상공인들이경쟁해야하는상대는대기업이다.
                    </p>
                </div>
            </div>
            <!--//contents-->

            <!--contents-->
            <div class="contents_box2">
                <div class="right_box">
                    <h4>사업운영자금마련의어려움</h4>
                    <p>
                        소상공인들이사업을통해서벌어들인소득으로만사업과생계를유지하는것은굉장히어렵다.
                        이는개인사업자들의부채규모를통해유추할수있다. 2017년10월말잔액기준으로개인사업자들의
                        부채규모는약521조에달했다.
                    </p>
                    <p>
                        생계형소상공인들은 직원월급과 임대료비용과같은 고정비외에도 식당운영을위한식재료를사거나,
                        도매상에서자재를구입해 올비용을지출해야되기때문에상시현금이필요하다.
                    </p>
                    <p>
                        하지만, 하루매출로발생한수익은카드정산시간으로인해실제로현금화되기까지 평균적으로1-4일정도
                        소요된다. 급한자금이필요할경우, 소상공인들이대출에의존하지않은채 현금을마련할방안이많지않다.
                        신용도가낮은소상공인일경우, 비금융권의고금리대출을이용하거나 불법대부업체를통해서
                        법정최고금리24% 이상을이자로지불하면서 사업과생계를이어가고있다.
                        초기자본마련과고용을위한자금이필요한데, 당장자금마련의단계부터난관에 부딪힌다.
                    </p>
                </div>
                <div class="left_box">
                    <img src="images/thumnail/intro05.jpg" alt="image">
                </div>
            </div>
            <!--//contents-->

            <!--mcontents-->
            <div class="mcontents_box2">
                <div class="left_box">
                    <img src="images/thumnail/intro05.jpg" alt="image">
                </div>
                <div class="right_box">
                    <h4>사업운영자금마련의어려움</h4>
                    <p>
                        소상공인들이사업을통해서벌어들인소득으로만사업과생계를유지하는것은굉장히어렵다.
                        이는개인사업자들의부채규모를통해유추할수있다. 2017년10월말잔액기준으로개인사업자들의
                        부채규모는약521조에달했다.
                    </p>
                    <p>
                        생계형소상공인들은 직원월급과 임대료비용과같은 고정비외에도 식당운영을위한식재료를사거나,
                        도매상에서자재를구입해 올비용을지출해야되기때문에상시현금이필요하다.
                    </p>
                    <p>
                        하지만, 하루매출로발생한수익은카드정산시간으로인해실제로현금화되기까지 평균적으로1-4일정도
                        소요된다. 급한자금이필요할경우, 소상공인들이대출에의존하지않은채 현금을마련할방안이많지않다.
                        신용도가낮은소상공인일경우, 비금융권의고금리대출을이용하거나 불법대부업체를통해서
                        법정최고금리24% 이상을이자로지불하면서 사업과생계를이어가고있다.
                        초기자본마련과고용을위한자금이필요한데, 당장자금마련의단계부터난관에 부딪힌다.
                    </p>
                </div>
            </div>
            <!--//mcontents-->

          <!--platformBox-->
            <div class="plat_box">
                <h4>소상공인을위한솔루션TAC 플랫폼</h4>
                <p>TAC 플랫폼은 소상공인들에게 더쉽고 편리하게 사업지원을받으며, <br>
                    고객과 소통하고 서비스를발전시켜나갈수있는 솔루션을 제공하고자 탄생한 블록 체인 기반 플랫폼<br>
                    TAC 플랫폼이 소상공인들에게 제공하는것</p>
                <img src="images/platform/platform01.jpg" alt="platform_img" />
            </div>
            <!--//platformBox-->
        </section>
        <!--//PLATFORM-->

        <!--Introduction-->
        <section id="section-4">
            <div class="title04">
                <span class="blackline"></span>
                <h3>INTRODUCATION</h3>
                <p>소상공인이 살아야 대한민국이 웃는다</p>
            </div>
            <!--contents-->
            <ul class="intro_box">
                <li>
                    <a href="#">
                        <p><img src="images/thumnail/intro06.jpg" alt="Introduction_img" /></p>
                        <p>명동에서시작되는TAC 플랫폼</p>
                        <p>
                            - 명동은 해외 관광객들이 소통하는공간 으로 TAC생태계를 구축<br>
                            - 한류스타가 사용한 패션 미용상품들이 주요한쇼핑 타겟<br>
                            - 소비자들의 평가와 경험 DATA 기반으로 플랫폼이 구축<br>
                            - QR코드 스캔을 통하여 간편한 결제 가능<br>
                            - 블록체인이 제공하는 참여자 리워드 지급
                        </p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <p><img src="images/thumnail/intro07.jpg" alt="Introduction_img" /></p>
                        <p>명동에서 TAC 토큰으로 결제하기</p>
                        <p>
                            - 거리에서 AC 토큰으로 간편하게 쇼핑, 식사가 가능 <br>
                            - QR 코드 스캔방식의 결제시스템을 도입 <br>
                            - TAC 토큰을 쉽게 App안에 충전하고( 월렛서비스) 결제<br>
                            - 혹시나 발생할 가격 변동성에대한 리스크 관리가 가능 <br>
                        </p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <p><img src="images/thumnail/intro08.jpg" alt="Introduction_img" /></p>
                        <p>명동에서시작되는TAC 플랫폼</p>
                        <p>
                            - 주간/월간/연간 분석 자료제공 <br>
                            - 가맹된 상가들과 상점주들은 서로 의고객의 Pool을 공유 <br>
                            - 고객들의후기, 투표, 실제 구매 경향들을 분석한 전문리포트 구매 <br>
                            - DATA를 이용하여 운영 및 판매 컨설팅을 받을수있다
                        </p>
                    </a>
                </li>
            </ul>
            <!--//contents-->
        </section>
        <!--//Introduction-->

        <!--TAC Ecosystem-->
        <section id="section-5">
            <div class="title05">
                <span class="blackline"></span>
                <h3>TAC ECOSYSTEM</h3>
                <p>Token Attract Customers 라는 TAC의 이름에 맞게<br>
                    ACToken 암호화페를 통하여 더 많은 고객들이 소상공인들의 제공하는 서비스에 매력을 느낄수 있도록 하며,<br>
                    제품구매 뿐 아니라 투자및 후원도 적극적으로 이루어지도록 하는 시스템
                </p>
                <img src="images/platform/platform02.jpg" alt="ecosystem_img">
            </div>
            <!--contents-->
            <div class="contents_box3">
                <div class="left_box">
                    <img src="images/thumnail/intro09.jpg" alt="image">
                </div>
                <div class="right_box">
                    <h4>TAC Token을얻을수있는방법?</h4>
                    <p>
                        TAC Token은 TAC 플랫폼Dapp 안에서 쉽게 충전이가능 하며(Fiat/BTC/ETH 등으로구매),
                        TAC이 상장된 암호화 폐거래소에서도 쉽게 구매할수있다.
                    </p>
                    <p>
                        TAC을얻는또다른한가지방법은플랫폼에기여하고리워드(Reward)를받는것이다.
                        활동들을할때마다특정Reward Token이지급될것이며, TAC이거래되는거래소에서 언제든
                        지현금화할수있다.
                    </p>
                    <p>
                        TAC 플랫폼에 가입하는 소상공인들도 사업장에서 판매되는 물건, 실제구매현황, 고객들의
                        반응등을 플랫폼에서 공유 할수있으며 소중한 정보를 공유하고 소통한것에 대한 대가로
                        TAC Token을 보상으로받을수있다.
                    </p>
                </div>
            </div>
            <!--//contents-->

            <!--contents-->
            <div class="contents_box2">

                <div class="right_box">
                    <h4>TAC 플랫폼을 사용하는 방법? </h4>
                    <p>
                        TAC 플랫폼은블록체인네트워크와온라인인터넷네트워크를융합하여탄생한 Dapp
                        ( Decentralized Application )이다.
                    </p>
                    <p>
                        TAC 플랫폼은 손쉽게 스마트폰 어플리케이션(App)의형태로 서비스된다.
                        기존어플리케이션을 다운로드하는 방식과 같은방식으로 스마트폰유저들은 쉽게
                        다운로드하여설치하고사용할수있다.
                    </p>
                    <p>
                        TAC Dapp을 다운로드하여 사용하는 이용자들은 별도의 과금없이
                        언제든 무료로 TAC 플랫폼이 제공하는 서비스를 이용할수있다
                    </p>
                </div>

             <div class="left_box">
                    <img src="images/thumnail/intro10.jpg" alt="image">
                </div>

            </div>
            <!--//contents-->

            <!--모바일에서 보임-->
            <div class="mcontents_box2">
                <div class="left_box">
                    <img src="images/thumnail/intro10.jpg" alt="image">
                </div>
                <div class="right_box">
                    <h4>TAC 플랫폼을 사용하는 방법? </h4>
                    <p>
                        TAC 플랫폼은블록체인네트워크와온라인인터넷네트워크를융합하여탄생한 Dapp
                        ( Decentralized Application )이다.
                    </p>
                    <p>
                        TAC 플랫폼은 손쉽게 스마트폰 어플리케이션(App)의형태로 서비스된다.
                        기존어플리케이션을 다운로드하는 방식과 같은방식으로 스마트폰유저들은 쉽게
                        다운로드하여설치하고사용할수있다.
                    </p>
                    <p>
                        TAC Dapp을 다운로드하여 사용하는 이용자들은 별도의 과금없이
                        언제든 무료로 TAC 플랫폼이 제공하는 서비스를 이용할수있다
                    </p>
                </div>
            </div>
            <!--//모바일에서 보임-->

        </section>
        <!--//TAC Ecosystem-->

        <!--TAC Ecosystem Token Attract Customers-->
        <section id="section-6">
            <div class="bg">
                <div class="title06">
                    <h3>
                        TAC ECOSYSTEM<br>
                        TOKEN ATTRACT CUSTOMERS
                    </h3>
                </div>

            </div>
            <!--case tac-->
            <div class="title07">
                <span class="blackline"></span>
                <h3>CASE TAC</h3>
                <p>TAC 토큰의 사용처
                </p>
            </div>
            <!--//case tac-->
            <!--contents-->
            <div class="contents_box">
                <div class="left_box">
                    <img src="images/thumnail/intro11.jpg" alt="image">
                </div>
                <div class="right_box">
                    <h4>크라우드펀딩</h4>
                    <p>
                        크라우드펀딩에 참여하는 개인투자자들은 거래소에서 TAC 토큰을 구매하여 소상공인들을
                        위하여 TAC 플랫폼에 등록된 매장에후원, 투자, 기부할수있다.
                    </p>
                    <p>
                        각 소상공인들의 업종및 사업 로드맵에 따라 펀딩에대한 보상은 다양할것이며,
                        TAC 을 이용한 펀딩이 증가할수록 소상공인 자금순환이 활발해지고
                        TAC 생태계도 활성화 될것이다.
                    </p>
                </div>
            </div>
            <!--//contents-->
            <!--contents-->
            <div class="contents_box2">
                <div class="right_box">
                    <h4>경영 컨설팅 &amp; 교육</h4>
                    <p>
                        소상공인들은매장의정보와구매경향등을TAC플랫폼에공유할수있다.
                        (매출정보및고객구매내역은개인정보보호가되는범위내에정보공유)
                    </p>
                    <p>
                        이런 소중한 정보들을 TAC 플랫폼에서 통합하여 전문 경영컨설턴트들에게 제공하고
                        그의 대가로 소상공인들에게 Token 보상과 경영 및 재무, 마케팅등 전문적 사업컨설팅을
                        무료 또는 소액으로 지원받을수 있도록한다.
                    </p>
                </div>

                <div class="left_box">
                    <img src="images/thumnail/intro12.jpg" alt="image">
                </div>
            </div>
            <!--//contents-->
            <!--mcontents-->
            <div class="mcontents_box2">
                <div class="left_box">
                    <img src="images/thumnail/intro12.jpg" alt="image">
                </div>
                <div class="right_box">
                    <h4>경영 컨설팅 &amp; 교육</h4>
                    <p>
                        소상공인들은매장의정보와구매경향등을TAC플랫폼에공유할수있다.
                        (매출정보및고객구매내역은개인정보보호가되는범위내에정보공유)
                    </p>
                    <p>
                        이런 소중한 정보들을 TAC 플랫폼에서 통합하여 전문 경영컨설턴트들에게 제공하고
                        그의 대가로 소상공인들에게 Token 보상과 경영 및 재무, 마케팅등 전문적 사업컨설팅을
                        무료 또는 소액으로 지원받을수 있도록한다.
                    </p>
                </div>
            </div>
            <!--//mcontents-->
            <!--contents-->
            <div class="contents_box3">
                <div class="left_box">
                    <img src="images/thumnail/intro13.jpg" alt="image">
                </div>
                <div class="right_box">
                    <h4>마케팅 PR</h4>
                    <p>
                        소상공인들은 간편하게 매장에대한 홍보와 상품에대한 PR을 TAC 플랫폼안에서
                        진행할수있으며, 기존Viral 마케팅, 오프라인 홍보의 비용보다 훨씬 저렴한 비용으로제공이된다.
                        이과정에서 플랫폼 이용소비자들이 자발적인 이용후기, 투표, 평가들이 이루어질수 있도록
                        TAC Token 리워드정책을 운영할것이며 이를통하여 소상공인들은 매장개선과 서비스 개발에
                        소중한 정보들을 얻게된다.
                    </p>
                </div>
            </div>
            <!--//contents-->
            <!--contents-->
            <div class="contents_box4">
                <div class="right_box">
                    <h4>니치 (Niche) 마켓 공유</h4>
                    <p>
                        니치 마켓이란 새로운 판로나 유통의 새로운 바운더리안에서, 지역의 특성상품이나
                        브랜드를 함께 구축하고 지역축제나 특별전 같은행사들을 기획하고 고객들의 접근성을
                        높이고 홍보효과를 창출하는 마케팅전략이다.
                    </p>
                    <p>
                        쉽게말해서 가로수길같은 특정브랜드가 없는패션매장들이 300개이상 드러서있지만
                        함께브랜드가치를 홍보하는형태의 ‘트랜드거리’를 만든것이예시다.
                    </p>
                    <p>
                        소상공인들의 지역별로 함께 소통하고 협업 시스템을 구축하여 함께 니치마켓을 형성하고
                        소비자들을 함께 공유하는니치마켓 공유가 TAC 플랫폼에 의해서 촉진 되도록한다.
                    </p>
                </div>

                <div class="left_box">
                    <img src="images/thumnail/intro14.jpg" alt="image">
                </div>

            </div>
            <!--//contents-->

            <!--mcontents-->
            <div class="mcontents_box4">
                <div class="left_box">
                    <img src="images/thumnail/intro14.jpg" alt="image">
                </div>
                <div class="right_box">
                    <h4>니치 (Niche) 마켓 공유</h4>
                    <p>
                        니치 마켓이란 새로운 판로나 유통의 새로운 바운더리안에서, 지역의 특성상품이나
                        브랜드를 함께 구축하고 지역축제나 특별전 같은행사들을 기획하고 고객들의 접근성을
                        높이고 홍보효과를 창출하는 마케팅전략이다.
                    </p>

                    <p>
                        쉽게말해서 가로수길같은 특정브랜드가 없는패션매장들이 300개이상 드러서있지만
                        함께브랜드가치를 홍보하는형태의 ‘트랜드거리’를 만든것이예시다.
                    </p>
                    <p>
                        소상공인들의 지역별로 함께 소통하고 협업 시스템을 구축하여 함께 니치마켓을 형성하고
                        소비자들을 함께 공유하는니치마켓 공유가 TAC 플랫폼에 의해서 촉진 되도록한다.
                    </p>
                </div>
            </div>
            <!--//mcontents-->
            <!--contents-->
            <div class="contents_box5">
                <div class="left_box">
                    <img src="images/thumnail/intro15.jpg" alt="image">
                </div>
                <div class="right_box">
                    <h4>TAC 토큰의 부가기능</h4>
                    <p>
                        TAC 플랫폼에 참여하는 소상공인들의 가맹점에서는 언제든지 TAC 토큰으로 간편하게옷과
                        화장품을 구입하고 먹고 싶은음식을 살수있게 될것이다.
                    </p>
                    <p>
                        특히, 외국인 관광객 소비자들에게 더익숙한 QR 코드스캔방식의 결제시스템을 도입하여
                        한층간편하고 익숙한 UX/UI 를 선사할것이다.
                        외국인고객들에게 TAC토큰 결제의 최고의장점은, 환전없이 TAC 토큰을 쉽게 App안에 충전하고
                        (월렛서비스) 결제한다는것에있다.
                    </p>
                    <p>
                        플랫폼과 가맹되어있는 가맹점에서 언제든지 이용이 가능하며, 가맹점은 결제받은 TAC 토큰을
                        플렛폼안에서 Fiat 포인트로 바로 전환이 가능하여 혹시나 발생할 가격 변동성에 대한 리스크
                        관리가 가능하게한다.
                    </p>
                </div>
            </div>
            <!--//contents-->
        </section>
        <!--//TAC Ecosystem Token Attract Customers-->

        <!--Token Allocation-->
        <section id="section-7">
            <div class="title07">
                <span class="blackline"></span>
                <h3>TOKEN ALLOCATION</h3>
            </div>
            <div class="graph">
                <div class="ledt_graph">
                    <img src="images/allocation/graph01.jpg" alt="tac" />
                </div>
                <div class="right_graph">
                    <!--table-->
                    <table>
                        <caption>TOKEN ALLOCATION</caption>
                        <thead>
                            <tr>
                                <th scope='col' colspan="2">총 발행량</th>
                                <th scope='col'>토큰타입</th>
                                <th scope='col'>Symbol</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope='row' colspan="2">5,000,000,000 TAC</td>
                                <td>ERC-20</td>
                                <td>TAC</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td scope='row'><img src="images/allocation/graph02.jpg" alt="50%" /></td>
                                <td><img src="images/allocation/graph03.jpg" alt="20%" /></td>
                                <td><img src="images/allocation/graph04.jpg" alt="15%" /></td>
                                <td><img src="images/allocation/graph05.jpg" alt="15%" /></td>
                            </tr>
                            <tr>
                                <td scope='row'>세일</td>
                                <td>보상</td>
                                <td>마케팅&amp;바운티</td>
                                <td>팀</td>
                            </tr>
                        </tfoot>
                    </table>
                    <!--table-->
                </div>

                <!--m_table-->
                <div class="mright_graph">
                    <table>
                        <caption>TOKEN ALLOCATION</caption>
                        <thead>
                            <tr>
                                <th scope='col' colspan="1">총 발행량</th>
                                <td scope='row' colspan="3">5,000,000,000 TAC</td>
                            </tr>

                            <tr>
                                <th scope='col' colspan="1">토큰타입</th>
                                <td colspan="3">ERC-20</td>
                            </tr>

                            <tr>
                                <th scope='col' colspan="1">Symbol</th>
                                <td colspan="3">TAC</td>

                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <td scope='row'><img src="images/allocation/graph02.jpg" alt="50%" /></td>

                                <td><img src="images/allocation/graph03.jpg" alt="20%" /></td>
                                <td><img src="images/allocation/graph04.jpg" alt="15%" /></td>
                                <td><img src="images/allocation/graph05.jpg" alt="15%" /></td>
                            </tr>
                            <tr>
                                <td scope='row'>세일</td>

                                <td>보상</td>
                                <td>마케팅&amp;바운티</td>
                                <td>팀</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!--m_table-->

            </div>
        </section>
        <!--//Token Allocation-->

        <!--ICO 스케쥴-->
        <section id="section-8">
            <div class="title08">
                <h3>ICO 스케쥴</h3>
                <p>하드캡 / 소프트캡 : 500억원 / 50억원</p>
                <!--date-->
                <ul class="date">
                    <li>2018년 12월</li>
                    <li>2019년 1월</li>
                    <li>2019년 2~3월</li>
                    <li>2019년 4월</li>
                </ul>
                <img src="images/roadmap/circle.png" class="circle" alt="circle" />

                <ul class="date">
                    <li>PRIVATE SALE 0.02$</li>
                    <li>PRE-SALE 0.03$</li>
                    <li>ICO 0.035$</li>
                    <li>IEO 0.04$</li>
                </ul>
            </div>
            <!--m_roadmap-->
            <div class="mtitle08">
                <h3>ICO 스케쥴</h3>
                <p>하드캡 / 소프트캡 : 500억원 / 50억원</p>
                <!--date-->
                <ul class="date">
                    <li>2018년 12월</li>
                    <li>PRIVATE SALE 0.02$</li>
                </ul>

                <ul class="date">
                    <li>2019년 1월</li>
                    <li>PRE-SALE 0.03$</li>
                </ul>
                <ul class="date">
                    <li>2019년 2~3월</li>
                    <li>ICO 0.035$</li>
                </ul>
                <ul class="date">
                    <li>2019년 4월</li>
                    <li>IEO 0.04$</li>
                </ul>

            </div>
            <!--//m_roadmap-->
        </section>
        <!--//ICO 스케쥴-->


        <!--team-->
        <section id="section-9">
            <div class="title09">
                <span class="blackline"></span>
                <h3>TEAM</h3>
            </div>
            <!--member-->
            <ul class="member">
                <!--memberlist-->
                <li>
                    <a href="#">
                        <p class="photo"><img src="http://placehold.it/225x230?text=TeamMember" alt="member" /></p>
                        <p class="name">홍길동</p>
                        <p class="description">
                            가나다라마바사가나다라마바사
                            가나다라마바사 가나다라마바사
                        </p>
                    </a>
                </li>
                <!--memberlist-->
                <!--memberlist-->
                <li>
                    <a href="#">
                        <p class="photo"><img src="http://placehold.it/225x230?text=TeamMember" alt="member" /></p>
                        <p class="name">홍길동</p>
                        <p class="description">
                            가나다라마바사가나다라마바사
                            가나다라마바사 가나다라마바사
                        </p>
                    </a>
                </li>
                <!--memberlist-->
                <!--memberlist-->
                <li>
                    <a href="#">
                        <p class="photo"><img src="http://placehold.it/225x230?text=TeamMember" alt="member" /></p>
                        <p class="name">홍길동</p>
                        <p class="description">
                            가나다라마바사가나다라마바사
                            가나다라마바사 가나다라마바사
                        </p>
                    </a>
                </li>
                <!--memberlist-->
                <!--memberlist-->
                <li>
                    <a href="#">
                        <p class="photo"><img src="http://placehold.it/225x230?text=TeamMember" alt="member" /></p>
                        <p class="name">홍길동</p>
                        <p class="description">
                            가나다라마바사가나다라마바사
                            가나다라마바사 가나다라마바사
                        </p>
                    </a>
                </li>
                <!--memberlist-->
                <!--memberlist-->
                <li>
                    <a href="#">
                        <p class="photo"><img src="http://placehold.it/225x230?text=TeamMember" alt="member" /></p>
                        <p class="name">홍길동</p>
                        <p class="description">
                            가나다라마바사가나다라마바사
                            가나다라마바사 가나다라마바사
                        </p>
                    </a>
                </li>
                <!--memberlist-->
                <!--memberlist-->
                <li>
                    <a href="#">
                        <p class="photo"><img src="http://placehold.it/225x230?text=TeamMember" alt="member" /></p>
                        <p class="name">홍길동</p>
                        <p class="description">
                            가나다라마바사가나다라마바사
                            가나다라마바사 가나다라마바사
                        </p>
                    </a>
                </li>
                <!--memberlist-->
                <!--memberlist-->
                <li>
                    <a href="#">
                        <p class="photo"><img src="http://placehold.it/225x230?text=TeamMember" alt="member" /></p>
                        <p class="name">홍길동</p>
                        <p class="description">
                            가나다라마바사가나다라마바사
                            가나다라마바사 가나다라마바사
                        </p>
                    </a>
                </li>
                <!--memberlist-->
                <!--memberlist-->
                <li>
                    <a href="#">
                        <p class="photo"><img src="http://placehold.it/225x230?text=TeamMember" alt="member" /></p>
                        <p class="name">홍길동</p>
                        <p class="description">
                            가나다라마바사가나다라마바사
                            가나다라마바사 가나다라마바사<br>
                        </p>
                    </a>
                </li>
                <!--memberlist-->

            </ul>
            <!--//member-->
        </section>

        <!--//team-->

        <!--contact-->
        <section id="section-10">
            <div class="title10">
                <span class="blackline"></span>
                <h3>Contact Us</h3>
            </div>

            <div class="contact_us">
                <!--address-->
                <div class="left_contact">
                    <h4>Address</h4>
                    <address>&middot; Korea : 06163 서울특별시 강남구 봉은사로 82길 13 (삼성동)</address>
                    <h4>Phone</h4>
                    <p class="phone_num">&middot; +82-2-565-5471</p>
                    <p class="phone_num">&middot; +82-10-5208-5955</p>
                </div>

                <!--form_mail-->
                <div class="right_contact">
                    <!--Copy Other M2O Sites-->
                    <form role="form" id="contact_form" class="contact-form" method="post" onsubmit="send_contact(); return false;">
                        <ul class="row nolist-style">
                            <li class="col-sm-12 fromTopIn" data-scroll="toggle(.fromTopIn, .fromTopOut)">
                                <label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Your Name"
                                        data-langnum="151">
                                </label>
                            </li>
                            <li class="col-sm-12 fromTopIn" data-scroll="toggle(.fromTopIn, .fromTopOut)">
                                <label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Your E-mail"
                                        data-langnum="152">
                                </label>
                            </li>
                            <li class="col-sm-12 fromTopIn" data-scroll="toggle(.fromTopIn, .fromTopOut)">
                                <label>
                                    <textarea class="form-control" name="message" id="message g-recaptcha" rows="5"
                                        placeholder="Your Message" data-langnum="153"></textarea>
                                </label>
                            </li>
                            <li class="col-sm-12 fromTopIn" data-scroll="toggle(.fromTopIn, .fromTopOut)">
                                <button type="submit" class="btn btn-inverse" value="submit" id="btn_submit"
                                    data-langnum="154">Send Message</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </section>
        <!--//contact-->
    </div>
    <!--footer-->
    <footer>
        <div class="foot">

            <!--copyright-->
            <p>COPYRIGHT 2018. TAC TAC.LTD.ALL RIGHTS RESERVED.</p>
            <div class="sns_wrap">
                <a class="sns_ico" href="#"><img src="images/sns_ico/sns01.jpg" alt="facebook" /></a>
                <a class="sns_ico" href="#"><img src="images/sns_ico/sns02.jpg" alt="tweeter" /></a>
                <a class="sns_ico" href="#"><img src="images/sns_ico/sns03.jpg" alt="sns" /></a>
                <a class="sns_ico" href="#"><img src="images/sns_ico/sns04.jpg" alt="sns" /></a>
                <a class="sns_ico" href="#"><img src="images/sns_ico/sns05.jpg" alt="telegram" /></a>
            </div>
        </div>

        <!--mobile-->
        <div class="mfoot">
            <div class="sns_wrap">
                <a class="sns_ico" href="#"><img src="images/sns_ico/sns01.jpg" alt="facebook" /></a>
                <a class="sns_ico" href="#"><img src="images/sns_ico/sns02.jpg" alt="tweeter" /></a>
                <a class="sns_ico" href="#"><img src="images/sns_ico/sns03.jpg" alt="sns" /></a>
                <a class="sns_ico" href="#"><img src="images/sns_ico/sns04.jpg" alt="sns" /></a>
                <a class="sns_ico" href="#"><img src="images/sns_ico/sns05.jpg" alt="telegram" /></a>
            </div>
            <!--copyright-->
            <p>COPYRIGHT 2018. TAC TAC.LTD.ALL RIGHTS RESERVED.</p>
        </div>
        <!--mobile-->
    </footer>


    <!-- GO TO TOP -->
    <a href="#home" class="cd-top">
        <i class="ion-chevron-up"></i>
    </a>
    <!-- GO TO TOP End -->

    <!--script--> 
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
     
    <script type="text/javascript" src="js/custom.js"></script>
    <!--<script type="text/javascript" src="js/scrollspy.js"></script>-->
    <script type="text/javascript" src="js/jquery.sticky.js"></script>
	<script type="text/javascript" src="js/main.js?1"></script>
    <script type="text/javascript" src="js/lang.js?1"></script>


    <!--scrollreigger_script-->
    <script src="js/skrollr.min.js"></script>
    <script src="js/ScrollTrigger.min.js"></script>
    <!--//scrollreigger_script-->

    <!--//script-->

</body>

</html> 
