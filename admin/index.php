<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['User_name'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['User_name'], $_SESSION['User_roles'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
.h1 {
	color: red;
}
#docs-internal-guid-afce80f1-f0b4-6774-c825-d962f36b2bc4 {
	color: #FFF;
}
.s {
	color: #FFFFFF;
}
#docs-internal-guid-afce80f1-f0a6-b9b6-d8cb-814b244bde1a {
	color: #FFF;
}
.f {
	color: #FFF;
}
.h1 strong {
	font-size: xx-large;
}
.h1 strong {
	font-size: larger;
}
.h1 strong {
	font-size: larger;
}
</style>
</head>

<body>
<h1 align="center"><span class="h1"><strong>نظام
 دارس</strong></span><strong><br />

 للتعليم الالكتروني</strong></h1>
<p align="left"><a href="logout.php">logout</a></p>
<div align="center">
  <table width="1048" border="1">
    <tr>
      <td colspan="3" bgcolor="#FF6600"><div align="center">
        <h2><strong id="docs-internal-guid-afce80f1-f0a6-b9b6-d8cb-814b244bde1a">الهيكل الاكاديمى والمحتوى العلمى</strong></h2>
      </div></td>
    </tr>
    <tr>
      <td width="405" bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-afce80f1-f0a7-7556-b2ea-dd8d0bf1cef6">بنوك الاسئلة والاختبارات</strong></h3>
      </div></td>
      <td width="327" bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-afce80f1-f0a7-4bf1-ee8b-b11cbf03a866">الهيكل</strong></h3>
      </div></td>
      <td width="294" bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-afce80f1-f0a7-25a7-70f6-e293e4ac3d28">المواد</strong></h3>
      </div></td>
    </tr>
    <tr>
      <td><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0a9-34a3-154d-16647ffcd4a2">انواع الاسئلة</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"> <strong id="docs-internal-guid-afce80f1-f0a9-34a3-154d-16647ffcd4a2">&nbsp;بنك الاسئلة والاجابات</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0a9-34a3-154d-16647ffcd4a2"> انواع الاختبارات </strong></p>
          </li>
          <li dir="rtl">
            <div align="center"><strong id="docs-internal-guid-afce80f1-f0a9-34a3-154d-16647ffcd4a2">تقارير</strong>            </div>
          </li>
        </ol>      </td>
      <td><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0a9-11cf-e547-cd3b65906daf">الكليه</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"> <strong id="docs-internal-guid-afce80f1-f0a9-11cf-e547-cd3b65906daf">&nbsp;السنوات الدراسية </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0a9-11cf-e547-cd3b65906daf">الفصول الدراسية</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0a9-11cf-e547-cd3b65906daf">التخصصات</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0a9-11cf-e547-cd3b65906daf">المواد</strong></p>
          </li>
        </ol>      </td>
      <td><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0a8-bcee-7778-21a84b870ed2">الوحدات</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0a8-bcee-7778-21a84b870ed2">الدروس </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0a8-bcee-7778-21a84b870ed2">العناصر </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0a8-bcee-7778-21a84b870ed2">تقارير</strong></p>
          </li>
        </ol>      </td>
    </tr>
  </table>
</div>
<p>&nbsp;</p>
<div align="center">
  <table width="1058" border="1">
    <tr>
      <td colspan="3" bgcolor="#FF6600"><div align="center">
        <h2><strong id="docs-internal-guid-afce80f1-f0b4-6774-c825-d962f36b2bc4">العمليات <span class="s">والتشغيل</span></strong></h2>
      </div></td>
    </tr>
    <tr>
      <td bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-afce80f1-f0b4-ddea-fb24-8b910be36570">الاختبارات</strong></h3>
      </div></td>
      <td bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-afce80f1-f0b4-c8fb-10f6-88fa313c16b6">القبول</strong></h3>
      </div></td>
      <td bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-afce80f1-f0b4-b2d8-ef4d-1872a7eed23b">الدارسة</strong></h3>
      </div></td>
    </tr>
    <tr>
      <td><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-4941-cde3-6f05284acaae">انشاء الاختبار </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-4941-cde3-6f05284acaae"> انشاء xml </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-4941-cde3-6f05284acaae"> كنترول الحضور ورفع الاجابات وحالات الغش</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-4941-cde3-6f05284acaae"> تصحيح </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-4941-cde3-6f05284acaae">رصد الورقى والكنترول</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-4941-cde3-6f05284acaae"> اعدادات (الرافة &nbsp;...) </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-4941-cde3-6f05284acaae"> تطبيق الرأفة والاعزار و الاستثناءات &nbsp;نتيجة</strong></p>
          </li>
          <li dir="rtl">
            <div align="center"><strong id="docs-internal-guid-afce80f1-f0b5-4941-cde3-6f05284acaae">تقارير</strong></div>
          </li>
        </ol>      </td>
      <td><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-2aa1-103f-0e859d9f9e1e">مراحل القبول </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-2aa1-103f-0e859d9f9e1e"> توقيتات القبول واعداداتها </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-2aa1-103f-0e859d9f9e1e"> ادارة المراحل من حيث الترتيب والارتباطات والرسائل </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-2aa1-103f-0e859d9f9e1e"> عمليات القبول وتغير حالات الطلاب ومراسلتهم </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-2aa1-103f-0e859d9f9e1e"> مرحلة طالب منتظم</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-2aa1-103f-0e859d9f9e1e">تقارير</strong></p>
          </li>
        </ol></td>
      <td><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-056d-79cb-15c97f73e065"> الابحار فى المواد</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-056d-79cb-15c97f73e065"> الفصول الافتراضية</strong></p>
          </li>
          </ol>
          <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-056d-79cb-15c97f73e065">- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ادارة الشعب - ادارة المحاضرين - &nbsp;ادارة اللقاءات</strong></p>
          <ol start="3">
            <li dir="rtl">
              <p align="center" dir="rtl"><strong id="docs-internal-guid-afce80f1-f0b5-056d-79cb-15c97f73e065"> الانشطة</strong></p>
            </li>
            <li dir="rtl">
              <div align="center"><strong id="docs-internal-guid-afce80f1-f0b5-056d-79cb-15c97f73e065">تقارير</strong></div>
            </li>
          </ol>      </td>
    </tr>
    <tr>
      <td colspan="3" bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-afce80f1-f0b5-8c94-7d57-b9f5e507c13c">الادارة</strong></h3>
      </div></td>
    </tr>
    <tr>
      <td colspan="3"><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b">اعدادات العام الجامعى والتوقيتات - تسجيل</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b">ادارة جدول الاختبارات و المراكز -امتحانات</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b">ادارة اعذار الاختبارات والفصول الافتراضية والتظلمات - امحانات واكاديمية</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b"> تسجيل المواد للطلاب وتعديلها - تسجيل</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b"> معادلة المواد -تسجيل واكاديمية</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b"> قواعد النجاح والرسوب والاسثناءات والرأفه - امتحانات</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b"> التاجيل والانسحاب - تسجيل </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b"> مراقبة الردود على شكاوى الطلبه - دعم فنى</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b"> استبانات و الاختبارات الثابتة (المراكز والتخصصوالفصول )</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b"> التنبيهات </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b5-f9ff-4e18-da0465db338b">تقارير </strong></p>
          </li>
        </ol>      </td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-4a019d52-f0b7-0d98-deb1-058545fa6a6d">لخدمات الطلابية</strong></h3>
      </div></td>
      <td bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-4a019d52-f0b6-ed07-5de5-ec4629c3e89c">الماليات</strong></h3>
      </div></td>
    </tr>
    <tr>
      <td colspan="2"><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-4662-6082-331e1e45714a">طلبات الكترونية (التاجيل &nbsp;الانسحاب &nbsp;الافادات ) </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-4662-6082-331e1e45714a"> السجل الالكترونى للطالب </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-4662-6082-331e1e45714a"> السجل الاكاديمى للطالب </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-4662-6082-331e1e45714a"> اكتب لنا (انواعها ) بغرض اعادة التوجية </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-4662-6082-331e1e45714a">– الاستفتاءات</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-4662-6082-331e1e45714a"> اشعارات</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-4662-6082-331e1e45714a">سجل الانشطة والحضور و ...</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-4662-6082-331e1e45714a">تقارير</strong></p>
          </li>
        </ol></td>
      <td><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-29f8-9710-8dc468abc7ff">انواع الفاتوره </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-29f8-9710-8dc468abc7ff"> انشاء فاتوره </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-29f8-9710-8dc468abc7ff"> دفع </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-29f8-9710-8dc468abc7ff"> اسقاط فاتوره </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-29f8-9710-8dc468abc7ff"> حساب الطالب تقارير </strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-29f8-9710-8dc468abc7ff"> الية الدفع ( الكترونى &nbsp;... )</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0b7-29f8-9710-8dc468abc7ff">تقارير</strong></p>
          </li>
          </ol>      </td>
    </tr>
  </table>
</div>
<p align="center">&nbsp;</p>
<div align="center">
  <table width="1067" border="1">
    <tr>
      <td colspan="3" bgcolor="#FF6600"><div align="center">
        <h2><strong class="f" id="docs-internal-guid-4a019d52-f0cb-bc62-ca9f-56fe6e0ce2ea">ادارة الموقع والمستخدمين</strong></h2>
      </div></td>
    </tr>
    <tr>
      <td width="331" bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-4a019d52-f0cc-4466-c414-ea209a8fb1fd">الدعم الفنى</strong></h3>
      </div></td>
      <td width="387" bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-4a019d52-f0cc-1f3a-e09a-7067b3b40c22">ادارة المستخدمين والصلاحيات</strong></h3>
      </div></td>
      <td width="327" bgcolor="#FF6666"><div align="center">
        <h3><strong id="docs-internal-guid-4a019d52-f0cb-f7c3-6d0b-e045df59a547">ادارة الموقع</strong></h3>
      </div></td>
    </tr>
    <tr>
      <td><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0cc-b0fd-e6a3-9781159ee119">الرد على الشكاوى</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0cc-b0fd-e6a3-9781159ee119">تغير بيانات مثل كلمة المرور…</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0cc-b0fd-e6a3-9781159ee119">تسجيل بيانات الاتصال</strong></p>
          </li>
          <li dir="rtl">
            <div align="center"><strong id="docs-internal-guid-4a019d52-f0cc-b0fd-e6a3-9781159ee119">اشعارات بالمستجدات و المتطلبات</strong></div>
          </li>
        </ol>      </td>
      <td><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0cc-9138-11e7-f80f92b55e80">اضافة وحذف وتعديل مستخدمين</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0cc-9138-11e7-f80f92b55e80">اضافة وحذف وتعديل مجموعات</strong></p>
          </li>
          <li dir="rtl">
            <div align="center"><strong id="docs-internal-guid-4a019d52-f0cc-9138-11e7-f80f92b55e80">الصلاحيات</strong></div>
          </li>
        </ol>      </td>
      <td><ol>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0cc-6937-6478-dcaa8f68af3d">ادلة وارشادات</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0cc-6937-6478-dcaa8f68af3d">اعلانات عامه</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0cc-6937-6478-dcaa8f68af3d">برامج مسانده</strong></p>
          </li>
          <li dir="rtl">
            <p align="center" dir="rtl"><strong id="docs-internal-guid-4a019d52-f0cc-6937-6478-dcaa8f68af3d">المنتديات</strong></p>
          </li>
        </ol>      </td>
    </tr>
  </table>
</div>
<p>&nbsp;</p>
</body>
</html>