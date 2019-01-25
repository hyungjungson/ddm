<?php
//특정 이미지파일(gif, jpg, png 만 지원)의 경로로 부터 이미지 리소스를 받아온다. 리턴값은 성공시에는 이미지리소스와 이미지 정보가 담긴 배열을 반환, 실패시에는 빈 배열을 반환
function get_image_resource_from_file ($path_file){ 

  if (!is_file($path_file)) {//파일이 아니라면

    $GLOBALS['errormsg'] = $path_file . '은 파일이 아닙니다.';

    return Array();
  }
   
  $size = @getimagesize($path_file);
  if (empty($size[2])) {//이미지 타입이 없다면

    $GLOBALS['errormsg'] = $path_file . '은 이미지 파일이 아닙니다.';

    return Array();
  }

  if ($size[2] != 1 && $size[2] != 2 && $size[2] != 3) {//지원하는 이미지 타입이 아니라면

    $GLOBALS['errormsg'] = $path_file . '은 gif 나 jpg, png 파일이 아닙니다.';

    return Array();
  }

  switch($size[2]){

    case 1 : //gif

      $im = @imagecreatefromgif($path_file);

      break;  

    case 2 : //jpg

      $im = @imagecreatefromjpeg($path_file);

      break;  

    case 3 : //png

      $im = @imagecreatefrompng($path_file);

      break;
  }

  if ($im === false) {//이미지 리소스를 가져오기에 실패하였다면

    $GLOBALS['errormsg'] = $path_file . ' 에서 이미지 리소스를 가져오는 것에 실패하였습니다.';

    return Array();
  }
  else {//이미지 리소스를 가져오기에 성공하였다면

    $return = $size;
    $return[0] = $im;
    $return[1] = $size[0];//너비
    $return[2] = $size[1];//높이
    $return[3] = $size[2];//이미지타입
    $return[4] = $size[3];//이미지 attr

    return $return;
  }
}

//인수로 받아온 이미지 리소스와 파일 저장 경로를 가지고 이미지를 저장한다. 성공시 true, 실패시 false 반환
function save_image_from_resource ($im, $path_save_file){

  $path_save_dir = dirname($path_save_file);
  if (!is_dir($path_save_dir)) {

    $GLOBALS['errormsg'] = $path_save_dir . '은 디렉토리가 아닙니다.';
    return false;
  }

  if (!is_writable($path_save_dir)){

    $GLOBALS['errormsg'] = $path_save_dir . '에 이미지를 저장할 권한이 없습니다.';
    return false;
  }

  if (is_file($path_save_file) || is_dir($path_save_file)) {

    $GLOBALS['errormsg'] = $path_save_file . '은 이미 존재하는 파일이거나 디렉토리입니다.';
    return false;
  }

  $extension = strtolower(substr($path_save_file, strrpos($path_save_file, '.') + 1));

  switch($extension){

    case 'gif' :
      $result_save = @imagegif($im, $path_save_file);
      break;

    case 'jpg' :
    case 'jpeg' :
      $result_save = @imagejpeg($im, $path_save_file);
      break;

    default : //확장자 png 또는 확장자가 없는 경우, 정의되지 않는 확장자인 경우는 모두 png로 저장
      $result_save = @imagepng($im, $path_save_file);
  }

  if ($result_save === false) {//이미지 저장에 실패

    $GLOBALS['errormsg'] = $path_save_file . '의 저장에 실패하였습니다.';
    return false;
  }
  else {//이미지 저장에 성공

    return true;
  }
}

//원본의 너비, 원본의 높이, 리사이즈 너비나 높이, 기준값을 받아 기준값을 토대로 정비율의 값을 구함
//성공시 정비율의 값을 반환, 실패시 false를 반환
//기준값은 width 나 height, 기준값은 생략 가능하며 생략시 자동으로 width가 된다.
function get_size_by_rule($src_w, $src_h, $dst_size, $rule='width'){

  if (!is_int($src_w) || $src_w < 1 || !is_int($src_h) || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

    $GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }

  if (!is_int($dst_size) || $dst_size < 1){//리사이즈 될 사이즈가 0보다 큰 정수가 아닐경우

    $GLOBALS['errormsg'] = "리사이즈될 사이즈가 0보다 큰 정수가 아닙니다. ($dst_size)";
    return false;
  }

  if ($rule != 'height') {//기준값이 너비일 경우

    return ceil($dst_size / $src_w * $src_h);
  }
  else {//기준값이 높이일 경우

    return ceil($dst_size / $src_h * $src_w);
  }
}


//원본의 너비나 높이, 썸네일 너비, 썸네일 높이, 기준값을 받아 기준값을 토대로 정비율의 값을 구함
//성공시 정비율의 값을 반환, 실패시 false를 반환
//기준값은 width 나 height, 기준값은 생략 가능하며 생략시 자동으로 width가 된다.
function get_bigsize_by_rule($src_size, $dst_w, $dst_h, $rule='width'){

  if (!is_int($src_size) || $src_size < 1){//원본의 사이즈가 0보다 큰 정수가 아닐경우

    $GLOBALS['errormsg'] = "원본의 사이즈가 0보다 큰 정수가 아닙니다. ($src_size)";
    return false;
  }

  if (!is_int($dst_w) || $dst_w < 1 || !is_int($dst_h) || $dst_h < 1){//썸네일의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

    $GLOBALS['errormsg'] = "썸네일의 너비와 높이가 0보다 큰 정수가 아닙니다. ($dst_w, $dst_h)";
    return false;
  }

  if ($rule != 'height') {//기준값이 너비일 경우

    return ceil($src_size / $dst_w * $dst_h);
  }
  else {//기준값이 높이일 경우

    return ceil($src_size / $dst_h * $dst_w);
  }
}


//원본의 리소스, 원본의 너비, 원본의 높이, 크롭리사이즈 너비, 높이를 받아 이미지 크롭 후 리사이즈 처리
//성공시 리사이즈된 이미지의 리소스를 반환, 실패시 false를 반환
function get_image_cropresize($src, $src_w, $src_h, $dst_w, $dst_h=0){

  if (empty($src))  {//원본의 리소스가 빈값일 경우

    $GLOBALS['errormsg'] = '원본 리소스가 없습니다.';
    return false;
  }

  //정수형이 아니라면 정수형으로 강제 형변환
  if (!is_int($src_w)) settype($src_w, 'int');
  if (!is_int($src_h)) settype($src_h, 'int');
  if (!is_int($dst_w)) settype($dst_w, 'int');
  if (!is_int($dst_h)) settype($dst_h, 'int');

  if ($src_w < 1 || $src_h < 1){//원본의 너비와 높이가 둘중에 하나라도 0보다 큰 정수가 아닐경우

    $GLOBALS['errormsg'] = "원본의 너비와 높이가 0보다 큰 정수가 아닙니다. ($src_w, $src_h)";
    return false;
  }

  if (empty($dst_w) && empty($dst_h)) {//리사이즈될 너비와 높이 둘다 없을 경우

    $GLOBALS['errormsg'] = '리사이즈될 너비와 높이는 둘중에 하나는 반듯이 있어야 합니다.';
    return false;
  }

  if (!empty($dst_w) && $dst_w < 1){//리사이즈 될 너비가 존재하는데 0보다 큰 정수가 아닐경우

    $GLOBALS['errormsg'] = "리사이즈될 너비가 0보다 큰 정수가 아닙니다. ($dst_w)";
    return false;
  }

  if (!empty($dst_h) && $dst_h < 1){//리사이즈 될 높이가 존재하는데 0보다 큰 정수가 아닐경우

    $GLOBALS['errormsg'] = "리사이즈될 높이가 0보다 큰 정수가 아닙니다. ($dst_h)";
    return false;
  }

  //리사이즈 될 너비와 높이가 둘중에 하나가 없는 경우에는 정비율을 의미하며, 비율데로 너비와 높이를 결정한다.
  if (empty($dst_w) || empty($dst_h)) {

    if (empty($dst_h)) $dst_h = get_size_by_rule($src_w, $src_h, $dst_w, 'width');
    else $dst_w = get_size_by_rule($src_w, $src_h, $dst_h, 'height');
  }

  //만들어질 $dst_w , $dst_h 크기의 이미지 리소스를 생성한다.
  $dst = @imagecreatetruecolor ($dst_w , $dst_h);
  if ($dst === false) {

    $GLOBALS['errormsg'] = "$dst_w , $dst_h 크기의 썸네일 이미지의 리소스를 생성하지 못했습니다.";
    return false;
  }

  //먼저 리사이즈 너비를 기준으로 정비율 리사이즈 높이를 계산한다.
  $s_w = $dst_w;
  $s_h = get_size_by_rule($src_w, $src_h, $s_w, 'width');

  if ($dst_h == $s_h) {//높이가 같을 경우, 즉 정비율 리사이즈일경우

    $result_resize = imagecopyresampled ($dst , $src , 0 , 0 , 0 , 0 , $dst_w , $dst_h , $src_w , $src_h );
    if ($result_resize === false) {

      $GLOBALS['errormsg'] = "$dst_w , $dst_h 크기로 리사이즈에 실패하였습니다.";
      return false;
    }
  }
  else if ($dst_h < $s_h) {//지정된 높이가 정비율 높이 보다 작을경우, 높이를 기준으로 가운데를 크롭

    //썸네일의 높이를 기준으로 정비율의 원본 높이를 구한다.
    $src_nh = get_bigsize_by_rule($src_w, $dst_w, $dst_h, 'width');

    $src_x = 0;
    $src_y = ceil(($src_h - $src_nh) / 2);

    $result_resize = imagecopyresampled ($dst , $src , 0 , 0 , $src_x , $src_y , $dst_w , $dst_h , $src_w , $src_nh );
    if ($result_resize === false) {

      $GLOBALS['errormsg'] = "$dst_w , $dst_h 크기로 리사이즈에 실패하였습니다.";
      return false;
    }
  }
  else {//지정된 높이가 정비율 높이 보다 큰경우, 너비를 기준으로 가운데를 크롭

    //썸네일의 너비를 기준으로 정비율의 원본 너비를 구한다.
    $src_nw = get_bigsize_by_rule($src_h, $dst_w, $dst_h, 'height');

    $src_x = ceil(($src_w - $src_nw) / 2);
    $src_y = 0;

    $result_resize = imagecopyresampled ($dst , $src , 0 , 0 , $src_x , $src_y , $dst_w , $dst_h , $src_nw , $src_h );
    if ($result_resize === false) {

      $GLOBALS['errormsg'] = "$dst_w , $dst_h 크기로 리사이즈에 실패하였습니다.";
      return false;
    }
  }

  return $dst;
}
?>