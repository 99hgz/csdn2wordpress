<?php
error_reporting(E_ALL);
require 'QueryList/vendor/autoload.php';

use QL\QueryList;


$links=array("http://blog.csdn.net/yuyaohekai/article/details/73691847","http://blog.csdn.net/yuyaohekai/article/details/73610377","http://blog.csdn.net/yuyaohekai/article/details/73189242","http://blog.csdn.net/yuyaohekai/article/details/73189235","http://blog.csdn.net/yuyaohekai/article/details/73189228","http://blog.csdn.net/yuyaohekai/article/details/73189216","http://blog.csdn.net/yuyaohekai/article/details/73189211","http://blog.csdn.net/yuyaohekai/article/details/73187559","http://blog.csdn.net/yuyaohekai/article/details/73182025","http://blog.csdn.net/yuyaohekai/article/details/72874413","http://blog.csdn.net/yuyaohekai/article/details/72853062","http://blog.csdn.net/yuyaohekai/article/details/72844028","http://blog.csdn.net/yuyaohekai/article/details/72843797","http://blog.csdn.net/yuyaohekai/article/details/72843715","http://blog.csdn.net/yuyaohekai/article/details/72835157","http://blog.csdn.net/yuyaohekai/article/details/72835075","http://blog.csdn.net/yuyaohekai/article/details/72834974","http://blog.csdn.net/yuyaohekai/article/details/72834728","http://blog.csdn.net/yuyaohekai/article/details/72834514","http://blog.csdn.net/yuyaohekai/article/details/72834172","http://blog.csdn.net/yuyaohekai/article/details/72832871","http://blog.csdn.net/yuyaohekai/article/details/72765917","http://blog.csdn.net/yuyaohekai/article/details/72746627","http://blog.csdn.net/yuyaohekai/article/details/72744514","http://blog.csdn.net/yuyaohekai/article/details/72661623","http://blog.csdn.net/yuyaohekai/article/details/72639166","http://blog.csdn.net/yuyaohekai/article/details/72628593","http://blog.csdn.net/yuyaohekai/article/details/72575476","http://blog.csdn.net/yuyaohekai/article/details/72568630","http://blog.csdn.net/yuyaohekai/article/details/72550874","http://blog.csdn.net/yuyaohekai/article/details/72528740","http://blog.csdn.net/yuyaohekai/article/details/72528480","http://blog.csdn.net/yuyaohekai/article/details/72510221","http://blog.csdn.net/yuyaohekai/article/details/72490999","http://blog.csdn.net/yuyaohekai/article/details/72468774","http://blog.csdn.net/yuyaohekai/article/details/72452959","http://blog.csdn.net/yuyaohekai/article/details/72235417","http://blog.csdn.net/yuyaohekai/article/details/72235339","http://blog.csdn.net/yuyaohekai/article/details/70837483","http://blog.csdn.net/yuyaohekai/article/details/70820847","http://blog.csdn.net/yuyaohekai/article/details/50364524","http://blog.csdn.net/yuyaohekai/article/details/50364523","http://blog.csdn.net/yuyaohekai/article/details/50364522","http://blog.csdn.net/yuyaohekai/article/details/50364521","http://blog.csdn.net/yuyaohekai/article/details/50364520","http://blog.csdn.net/yuyaohekai/article/details/50364517","http://blog.csdn.net/yuyaohekai/article/details/50364516","http://blog.csdn.net/yuyaohekai/article/details/50364515","http://blog.csdn.net/yuyaohekai/article/details/50364514","http://blog.csdn.net/yuyaohekai/article/details/50364513","http://blog.csdn.net/yuyaohekai/article/details/50364512","http://blog.csdn.net/yuyaohekai/article/details/50364510","http://blog.csdn.net/yuyaohekai/article/details/50364509","http://blog.csdn.net/yuyaohekai/article/details/50364508","http://blog.csdn.net/yuyaohekai/article/details/50364507","http://blog.csdn.net/yuyaohekai/article/details/50364505","http://blog.csdn.net/yuyaohekai/article/details/50364504","http://blog.csdn.net/yuyaohekai/article/details/50359771","http://blog.csdn.net/yuyaohekai/article/details/50359724");
/*文章链接数组*/

for($j=0;$j<count($links);$j++){
$html = file_get_contents($links[$j]);

$data = QueryList::Query($html,array(
    'page' => array('.link_title>a','text')
    ))->data;

$title=$data[0]['page'];
echo $title;


$data = QueryList::Query($html,array(
    'page' => array('.markdown_views','html')
    ))->data;
//print_r($data);
$page=$data[0]['page'];
$page2=$page;
$html=$page;
$data = QueryList::Query($html,array(
    'div' => array('.MathJax_SVG','html')
    ))->data;
for ($i=0; $i < count($data); $i++) { 
	//echo strpos($page2,$data[$i]['div']);
    $page2=str_replace($data[$i]['div'],"",$page2,$count);
}

$data = QueryList::Query($html,array(
    'div' => array('.MathJax','html')
    ))->data;
for ($i=0; $i < count($data); $i++) { 
	//echo strpos($page2,$data[$i]['div']);
    $page2=str_replace($data[$i]['div'],"",$page2,$count);

}

$data = QueryList::Query($html,array(
    'div' => array('.MathJax_SVG_Display','html')
    ))->data;
for ($i=0; $i < count($data); $i++) { 
    $page2=str_replace($data[$i]['div'],"",$page2);
}

$data = QueryList::Query($html,array(
    'div' => array('script','html'),
    'id' => array('script','id')
    ))->data;
for ($i=0; $i < count($data); $i++) { 
	$t=$data[$i]['div'];
	$t=str_replace('（','(',$t);
	$t=str_replace('）',')',$t);
    $page2=str_replace('<script type="math/tex; mode=display" id="'.$data[$i]['id'].'">'.$data[$i]['div'].'</script>','\['.$t.'\]',$page2);
	$page2=str_replace('<script type="math/tex" id="'.$data[$i]['id'].'">'.$data[$i]['div'].'</script>','$'.$t.'$',$page2);
	//echo '<script type="math/tex" id="'.$data[$i]['id'].'">'.$data[$i]['div'].'</script>';
}

$data = QueryList::Query($html,array(
    'div' => array('.prettyprint','html'),
    ))->data;
for ($i=0; $i < count($data); $i++) { 
    $page2=str_replace($data[$i]['div'],'</pre><pre class="lang:c++ decode:true " >'.strip_tags($data[$i]['div']),$page2);

}
$page2=str_replace('<pre class="prettyprint"></pre>','',$page2);

/*保存位置*/
$file=fopen('d:/csdn2wordpress/'.$j.'.txt','w');
fwrite($file,$title."\n".'[latexpage]'."\n".$page2);
fclose($file);


sleep(1);
}
?>