<?php
$urls = isset($_REQUEST['urls']) ? preg_split('/[\r\n\t]+/', $_REQUEST['urls'], -1, PREG_SPLIT_NO_EMPTY) : NULL;
// $urls = array(
//   'http://www.gap.com/browse/product.do?pid=239058002&tid=gpsh000007',
//   // 'http://store.nike.com/us/en_us/pd/air-jordan-xxx-basketball-shoe/pid-10967587/pgid-11067600',
//   // 'http://store.nike.com/us/en_us/product/lebron-xiii-id/?piid=42592&pbid=872968232#?pbid=872968232'
// );
ob_start();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Data Scraping Test</title>
  <style type="text/css">
    div.swatch {
      width: 40px;
      height: 40px;
      display: inline-block;
      font-size: xx-small;
      vertical-align: middle;
      border: 1px solid grey;
    }
    img.swatch {
      max-width: 40px;
      max-height: 40px;
      vertical-align: middle;
      border: 1px solid grey;
    }
    div.table {
      display: table;
    }
    div.row {
      /*border: 1px solid black;*/
      display: table-row;
      font-size: small;
    }
    div.row > div {
      border: 1px solid black;
      display: table-cell;
    }
    div.row > div:empty, div.row > div.empty {
      border: 1px solid red;
    }
    div.row > div.debug {
      display: none;
    }
    div.row-head {
      font-weight: bold;
    }
    div.output {
      max-width: 100px;
      max-height: 50px;
      overflow: auto;
    }
  </style>
</head>

<body>
<?php if ($urls): ?>
<div class="table">
<div class="row row-head">
  <div class="debug">Debug</div><div>Url</div><div>Brand</div><div>Title</div><div>Description</div><div>ColorS</div><div>Size</div><div>Time</div><div>Output</div>
</div>
<?php
flush();
ob_flush();

require_once 'scraping_model_top.php';

$scraping_model = new Scraping_model();

$urls = array_filter($urls, function($url) {
  return $url[0] !== '#';
});

foreach ($urls as $url) {
  $url = trim($url);
  echo '<div class="row"><div class="debug">';
  $host = parse_url($url,PHP_URL_HOST);
  $start = microtime(TRUE);
  $data = $scraping_model->getDataFromUrl($url);
  extract($data);


  echo '</div>';
  echo "<div title=\"Url\"><a href=\"$url\" target=\"_blank\">$host</a> <a href=\"?urls=".urlencode($url)."\" target=\"_blank\">Rerun</a></div>";

//SilongHu split Brand
  $Brands = explode("|", $Brand);
  $brand = $Brands[0];
  #$ty = gettype($Brands[0]);
  $title = $Brands[1];
  echo "<div title=\"Brand\"> $brand</div>";
//Added by Silonghu
  echo "<div title=\"Title\">$title</div>";

  $desc_class = empty($Description) ? 'empty' : '';
  echo "<div class=\"$desc_class\"><textarea title=\"Description\">$Description</textarea></div>";
  //$ty = gettype($ColorID);
  //echo "<div title=\"ColorS\">${ColorS['Name']}</div>";

  echo "<div title=\"Colors\">${Colors['Name']}";
  if ($Colors['Source']) {
    echo " (${Colors['Source']}) ";
  }
  foreach ($Colors['PaletteColors'] as $color) {
?><div class="swatch" style="background-color: #<?=sprintf('%06x', $color['Value'])?>">
<?="${color['Name']}<br/>#${color['ColorID']}"?></div><?php
  }
  if ($Colors['SwatchImageSource']) {
    echo "<img class=\"swatch\" src=\"${Colors['SwatchImageSource']}\"/>";
  }
  if ($Colors['ThumbImageSource']) {
    echo "<img class=\"swatch\" src=\"${Colors['ThumbImageSource']}\"/>";
  }

  echo '</div>';
//silonghu
 
  $count = count($Sizes);

  echo "<div title=\"Size\"> ";
  $obj = new ArrayObject( $Sizes );

  $it = new RecursiveIteratorIterator( new RecursiveArrayIterator($Sizes));

  foreach ($it as $key=>$val)
  echo "Available Size:".$val."\n";
  echo "</div>";
//
  echo '<div title="Time">'.(microtime(TRUE) - $start).'</div>';
  echo '<div><textarea>'.print_r($data, TRUE).'</textarea></div>';
  echo '</div>'.PHP_EOL;
  flush();
  ob_flush();
}
flush();
ob_end_flush();
?>
</div>
<?php endif;
if (!$urls) {
  $urls = array(
    'https://www.nordstromrack.com/shop/product/1804134/soprano-sparkle-cami-dress?color=BLK%20GOLD',
    //'http://www.bodenusa.com/en-US/Womens-Shorts/WJ037/Womens-Linen-Shorts.html',
    //'http://www.heels.com/womens-shoes/lovina-silver-metallic-pu.html',
    //'http://www.chicwish.com/marigold-and-frills-organza-skater-skirt.html',
    //'http://www.monnierfreres.com/Wedding-Bouquet-Secret-Garden-Necklace-HEU003006-us.html',
    //'http://www.chicos.com/store/product/regan-striped-dress/570143893?color=003&catId=cat40004&fromSearch=true&scPos=1-2622-3391',
    // 'http://www.terijon.com/shop/the-little-black-dress/black-scuba-dress-with-feathers-at-the-bottom/pid/2130/9',
    // 'http://bananarepublic.gap.com/browse/product.do?cid=94275&vid=1&pid=402090002',
    // 'http://bananarepublic.gap.com/browse/product.do?cid=94275&vid=1&pid=404292012',
    //'https://www.theoutnet.com/en-US/product/Rick-Owens/Wool-paneled-leather-jacket/765491',
    //'http://www.boohoo.com/usa/shirts/short-sleeve-western-denim-shirt/invt/mzz79220',
    //'http://www.finishline.com/store/product?A=39689&categoryId=cat306120&productId=prod786290',
    //'http://www.anntaylor.com/short-sleeve-sweater/399509?skuId=21117817&defaultColor=3102&colorExplode=false&catid=cata000011',
    //'http://www.loft.com/modern-kick-crop-jeans-in-white/396870?skuId=20187910&defaultColor=9000&colorExplode=false&catid=catl000015',
    // 'http://www.mytheresa.com/en-de/printed-bandeau-bikini-422438.html',
    //'http://us.topshop.com/en/tsus/product/new-era-9forty-cap-5617498',
    //'http://store.americanapparel.net/en/tri-blend-tank_tr408?c=Athletic%20Grey',
    //'http://www.farfetch.com/shopping/men/closed-chino-shorts-item-11473622.aspx?storeid=9058&from=listing&rnkdmnly=1&ffref=lp_pic_3_5_',
    //'http://www.lordandtaylor.com/webapp/wcs/stores/servlet/en/lord-and-taylor/womens-apparel/june-extraordinary-sale-dresses-rompers/zinnia-ruched-maxi-dress',
  );
}

?>
<form method="POST" action="scraping_test_top.php">
  <textarea rows=50 cols=100 name="urls"><?=implode(PHP_EOL, array_map('htmlspecialchars', $urls))?></textarea><br/>
  <button type="submit">Run!</button>
</form>
</body>
</html>
