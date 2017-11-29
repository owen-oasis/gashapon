<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
        
<button onclick="share()">點此分享</button> 























<?php
/*
 * 經典的概率算法，
 * $proArr是一個預先設置的數組，
 * 假設數組為：array(100,200,300，400)，
 * 開始是從1,1000 這個概率範圍內篩選第一個數是否在他的出現概率範圍之內， 
 * 如果不在，則將概率空間，也就是k的值減去剛剛的那個數字的概率空間，
 * 在本例當中就是減去100，也就是說第二個數是在1，900這個範圍內篩選的。
 * 這樣 篩選到最終，總會有一個數滿足要求。
 * 就相當於去一個箱子裏摸東西，
 * 第一個不是，第二個不是，第三個還不是，那最後一個一定是。
 * 這個算法簡單，而且效率非常高，
 * 這個算法在大數據量的項目中效率非常棒。
 */
function get_rand($proArr) { 
  $result = '';
  $proSum = array_sum($proArr); 
  foreach ($proArr as $key => $proCur) { 
    $randNum = mt_rand(1, $proSum); 
    if ($randNum <= $proCur) { 
        print_r($proCur);
      $result = $key; 
      break; 
    } else { 
      $proSum -= $proCur; 
    }    
  } 
  unset ($proArr); 
  return $result; 
} 

$prize_arr = array( 
  '0' => array('id'=>1,'prize'=>'住宿券(宜蘭)','v'=>1), 
  '1' => array('id'=>2,'prize'=>'住宿券(台北)','v'=>1), 
  '2' => array('id'=>3,'prize'=>'住宿券(台中)','v'=>1), 
  '3' => array('id'=>4,'prize'=>'住宿券(南投)','v'=>1), 
  '4' => array('id'=>5,'prize'=>'住宿券(日月潭)','v'=>1), 
  '5' => array('id'=>6,'prize'=>'住宿券(墾丁)','v'=>1), 
  '6' => array('id'=>7,'prize'=>'住宿券(台南)','v'=>1), 
  '7' => array('id'=>8,'prize'=>'住宿券(高雄)','v'=>1), 
  '8' => array('id'=>9,'prize'=>'住宿券(台東)','v'=>1), 
  '9' => array('id'=>10,'prize'=>'住宿券(花蓮)','v'=>1), 
  '10' => array('id'=>11,'prize'=>'住宿券(綠島)','v'=>1), 
  '11' => array('id'=>12,'prize'=>'住宿券(澎湖)','v'=>1), 
  '12' => array('id'=>13,'prize'=>'住宿券(小琉球)','v'=>1), 
  '13' => array('id'=>14,'prize'=>'住宿券(金門)','v'=>1), 
  '14' => array('id'=>15,'prize'=>'電影票','v'=>5), 
  '15' => array('id'=>16,'prize'=>'義大遊樂世界門票','v'=>5), 
  '16' => array('id'=>17,'prize'=>'全家百元禮券','v'=>15), 
  '17' => array('id'=>18,'prize'=>'萊爾富百元禮券','v'=>15), 
  '18' => array('id'=>19,'prize'=>'OK超商百元禮券','v'=>15), 
  '19' => array('id'=>20,'prize'=>'7-11百元禮券','v'=>15), 
  '20' => array('id'=>21,'prize'=>'21世紀風味館兌換券','v'=>15), 
  '21' => array('id'=>22,'prize'=>'摩斯漢堡兌換券','v'=>15), 
  '22' => array('id'=>23,'prize'=>'Häagen-Dazs哈根達斯迷你杯冰淇淋兌換券','v'=>15), 
  '23' => array('id'=>24,'prize'=>'COLD STONE商品禮券','v'=>15), 
  '24' => array('id'=>25,'prize'=>'TripMatch紅利點數100點','v'=>15), 
  '25' => array('id'=>26,'prize'=>'銘謝惠顧','v'=>1000),
); 
 
foreach ($prize_arr as $key => $val) { 
  $arr[$val['id']] = $val['v']; 
} 
$rid = get_rand($arr); //根據概率獲取獎項id 
 
$res = $prize_arr[$rid-1]['prize']; //中獎項 
print_r($res); 
?>












<script>
window.fbAsyncInit = function() {
FB.init({
appId      : '318148005295496',
xfbml      : true,
version    : 'v2.9'
});
};

(function(d, s, id){
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) {return;}
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>



<script>
    

function share()
{
   FB.ui(
    {
        // method: 'feed',
        // name: "names",
        // link: "https://active.tripmatch.net",
        // picture: "https://stackexchange.com/users/flair/557969.png",  
        // caption: 'An example caption',
        // description: "123"


  method: 'share',
  href: 'https://active.tripmatch.net',
  quote: '賀凱大帥哥'
    
    },
    // callback
    function(response) {
        console.log(response)
      if (response&&response !== 'undefined') {
        alert('分享成功後再抽一次!');
      } else {
        alert('沒有分享成功');
      }
    }
  )
};


</script>
    </body>
</html>
