<?php 
// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

if(!function_exists('generate_pagination')) {
  function generate_pagination($targetpage ="index.php",$total=0,$per_page=20,$page=null) {

    if($total<=$per_page) echo "";
    global $ecss_lang;
    $adjacents = 3;
//$per_page = 12; //how many items to show per page
    if(empty($page)) $page = !empty($_GET['page']) ? $_GET['page'] : 1;

    if($page){ 
$start = ($page - 1) * $per_page; //first item to display on this page
}else{
  $start = 0;
}

/* Setup page vars for display. */
if ($page == 0) $page = 1; //if no page var is given, default to 1.
$prev = $page - 1; //previous page is current page - 1
$next = $page + 1; //next page is current page + 1
$lastpage = ceil($total/$per_page); //lastpage.
$lpm1 = $lastpage - 1; //last page minus 1

/** add elements from query string */
$query_vars = $_GET;
unset($query_vars['page']);

$query_vars = http_build_query($query_vars);
/** end add element from query string */

/* CREATE THE PAGINATION */
$counter = 0;
$pagination = "";
if($lastpage > 1)
{ 
  $pagination .= "<div id='pagination'> <ul class='pagination'>";
  if ($page > $counter+1) {
    $pagination.= "<li><a href=\"$targetpage?page=$prev&$query_vars\">".$ecss_lang['PREV']."</a></li>"; 
  }

  if ($lastpage < 7 + ($adjacents * 2)) 
  { 
    for ($counter = 1; $counter < $lastpage; $counter++)
    {
      if ($counter == $page)
        $pagination.= "<li class='active'><a href='#' >$counter</a></li>";
      else
        $pagination.= "<li><a href=\"$targetpage?page=$counter&$query_vars\">$counter</a></li>"; 
    }
  }
elseif($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
{
//close to beginning; only hide later pages
  if($page < 1 + ($adjacents * 2)) 
  {
    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
    {
      if ($counter == $page)
        $pagination.= "<li class='active'><a href='#' >$counter</a></li>";
      else
        $pagination.= "<li><a href=\"$targetpage?page=$counter&$query_vars\">$counter</a></li>"; 
    }
    $pagination.= "<li><a>...</a></li>";
    $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
    $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>"; 
  }
//in middle; hide some front and some back
  elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
  {
    $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
    $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
    $pagination.= "<li><a>...</a></li>";
    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
    {
      if ($counter == $page)
        $pagination.= "<li class='active'><a href='#' >$counter</a></li>";
      else
        $pagination.= "<li><a href=\"$targetpage?page=$counter&$query_vars\">$counter</a></li>"; 
    }
    $pagination.= "<li><a>...</a></li>";
    $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
    $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>"; 
  }
//close to end; only hide early pages
  else
  {
    $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
    $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
    $pagination.= "<li><a>...</a></li>";
    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; 
      $counter++)
    {
      if ($counter == $page)
        $pagination.= "<li class='active'><a href='#' >$counter</a></li>";
      else
        $pagination.= "<li><a href=\"$targetpage?page=$counter&$query_vars\">$counter</a></li>"; 
    }
  }
}

//next button
if ($page < $counter - 1) 
  $pagination.= "<li><a href=\"$targetpage?page=$next\">".$ecss_lang['NEXT']."</a></li>";
else
  $pagination.= "";
$pagination.= "</ul></div>\n"; 
}

echo $pagination;
}

}

function generate_breadcrumbs($links) {
  if(!is_array($links)) echo "";
  global $config;
  $breadcrumb = '<div class="row">
            <ol class="breadcrumb">';
  $level=1;
  foreach($links as $title=>$href):
    if($level==count($links))
    $breadcrumb .=  '<li class="active">'.$title.'</li>';
    else
    $breadcrumb .= '<li><a href="'.$config['http_base_url'].$href.'">'.$title.'</a></li>';

  $level++;
  endforeach;
             
  $breadcrumb .='</ol>
          </div>';

  echo $breadcrumb;
}

function trans($path) {
  global $ecss_lang;
  $path = strtoupper($path);
  $path_array = explode('.',$path);
 return get_array_value($ecss_lang ,$path_array);
}

function get_array_value($array, $indexes)
{
  if (count($indexes) == 1)
  {
    return $array[$indexes[0]];
  }

  $index = array_shift($indexes);

  return get_array_value($array[$index], $indexes);
}