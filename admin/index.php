<?php
require_once('../Connections/boot.php');

$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";



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
$pageTitle = 'الادارة';
require_once $config['base_url'].'/admin/template/includes/header.php'; ?>
?>
<div class="right_col" role="main">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel" style="min-height:600px;">
      <div class="x_title">
        <h2>الهيكل الاكاديمى والمحتوى العلمى</h2>
        <div class="clearfix"></div>
      </div>

      <table class='table table-striped table-bordered'>

        <tr>
          <th width="405" >
           بنوك الاسئلة والاختبارات</th>
           <th width="327" >الهيكل</th>
           <th >
            المواد
          </th>
        </tr>
        <tr>
          <td><ol>
            <li >
              انواع الاسئلة
            </li>
            <li >
             &nbsp;بنك الاسئلة والاجابات
           </li>
           <li >
             انواع الاختبارات 
           </li>
           <li >
             تقارير
           </li>
         </ol>      </td>
         <td><ol>
          <li >
            الكليه
          </li>
          <li >
           &nbsp;السنوات الدراسية 
         </li>
         <li >
          الفصول الدراسية
        </li>
        <li >
          التخصصات
        </li>
        <li >
          المواد
        </li>
      </ol>      </td>
      <td><ol>
        <li >
          الوحدات
        </li>
        <li >
          الدروس 
        </li>
        <li >
          العناصر 
        </li>
        <li >
          تقارير
        </li>
      </ol>      </td>
    </tr>
  </table>



  <table class='table table-striped table-bordered'>
    <tr>
      <td colspan="3">
        العمليات والتشغيل
      </td>
    </tr>
    <tr>
      <td >
        الاختبارات
      </td>
      <td >
        القبول
      </td>
      <td >
        الدارسة
      </td>
    </tr>
    <tr>
      <td><ol>
        <li >
          انشاء الاختبار 
        </li>
        <li >
         انشاء xml 
       </li>
       <li >
         كنترول الحضور ورفع الاجابات وحالات الغش
       </li>
       <li >
         تصحيح 
       </li>
       <li >
        رصد الورقى والكنترول
      </li>
      <li >
       اعدادات (الرافة &nbsp;...) 
     </li>
     <li >
       تطبيق الرأفة والاعزار و الاستثناءات &nbsp;نتيجة
     </li>
     <li >
      تقارير
    </li>
  </ol>      </td>
  <td><ol>
    <li >
      مراحل القبول 
    </li>
    <li >
     توقيتات القبول واعداداتها 
   </li>
   <li >
     ادارة المراحل من حيث الترتيب والارتباطات والرسائل 
   </li>
   <li >
     عمليات القبول وتغير حالات الطلاب ومراسلتهم 
   </li>
   <li >
     مرحلة طالب منتظم
   </li>
   <li >
    تقارير
  </li>
</ol></td>
<td><ol>
  <li >
   الابحار فى المواد
 </li>
 <li >
   الفصول الافتراضية
 </li>
</ol>
- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ادارة الشعب - ادارة المحاضرين - &nbsp;ادارة اللقاءات
<ol start="3">
  <li >
   الانشطة
 </li>
 <li >
   تقارير
 </li>
</ol>      </td>
</tr>
<tr>
  <td colspan="3" >
    الادارة
  </td>
</tr>
<tr>
  <td colspan="3"><ol>
    <li >
      اعدادات العام الجامعى والتوقيتات - تسجيل
    </li>
    <li >
      ادارة جدول الاختبارات و المراكز -امتحانات
    </li>
    <li >
      ادارة اعذار الاختبارات والفصول الافتراضية والتظلمات - امحانات واكاديمية
    </li>
    <li >
     تسجيل المواد للطلاب وتعديلها - تسجيل
   </li>
   <li >
     معادلة المواد -تسجيل واكاديمية
   </li>
   <li >
     قواعد النجاح والرسوب والاسثناءات والرأفه - امتحانات
   </li>
   <li >
     التاجيل والانسحاب - تسجيل 
   </li>
   <li >
     مراقبة الردود على شكاوى الطلبه - دعم فنى
   </li>
   <li >
     استبانات و الاختبارات الثابتة (المراكز والتخصصوالفصول )
   </li>
   <li >
     التنبيهات 
   </li>
   <li >
    تقارير 
  </li>
</ol>      </td>
</tr>
<tr>
  <td colspan="2" >
    لخدمات الطلابية
  </td>
  <td >
    الماليات
  </td>
</tr>
<tr>
  <td colspan="2"><ol>
    <li >
      طلبات الكترونية (التاجيل &nbsp;الانسحاب &nbsp;الافادات ) 
    </li>
    <li >
     السجل الالكترونى للطالب 
   </li>
   <li >
     السجل الاكاديمى للطالب 
   </li>
   <li >
     اكتب لنا (انواعها ) بغرض اعادة التوجية 
   </li>
   <li >
    – الاستفتاءات
  </li>
  <li >
   اشعارات
 </li>
 <li >
  سجل الانشطة والحضور و ...
</li>
<li >
  تقارير
</li>
</ol></td>
<td><ol>
  <li >
    انواع الفاتوره 
  </li>
  <li >
   انشاء فاتوره 
 </li>
 <li >
   دفع 
 </li>
 <li >
   اسقاط فاتوره 
 </li>
 <li >
   حساب الطالب تقارير 
 </li>
 <li >
   الية الدفع ( الكترونى &nbsp;... )
 </li>
 <li >
  تقارير
</li>
</ol>      </td>
</tr>
</table>


<table class='table table-striped table-bordered'>
  <tr>
    <td colspan="3">
      ادارة الموقع والمستخدمين</td>
    </tr>
    <tr>
      <td width="331" >
        الدعم الفنى
      </td>
      <td width="387" >
        ادارة المستخدمين والصلاحيات
      </td>
      <td width="327" >
        ادارة الموقع
      </td>
    </tr>
    <tr>
      <td><ol>
        <li >
          الرد على الشكاوى
        </li>
        <li >
          تغير بيانات مثل كلمة المرور…
        </li>
        <li >
          تسجيل بيانات الاتصال
        </li>
        <li >
          اشعارات بالمستجدات و المتطلبات
        </li>
      </ol>      </td>
      <td><ol>
        <li >
          اضافة وحذف وتعديل مستخدمين
        </li>
        <li >
          اضافة وحذف وتعديل مجموعات
        </li>
        <li >
          الصلاحيات
        </li>
      </ol>      </td>
      <td><ol>
        <li >
          ادلة وارشادات
        </li>
        <li >
          اعلانات عامه
        </li>
        <li >
          برامج مسانده
        </li>
        <li >
          المنتديات
        </li>
      </ol>      </td>
    </tr>
  </table>
</div>
</div>
</div>
</div>


<?php require_once $config['base_url'].'/admin/template/includes/footer.php'; ?>