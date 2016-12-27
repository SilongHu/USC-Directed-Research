<?php 

    function scrape_price($page, $url) {
            $page = str_replace(',', '', $page);
            $page = str_replace('EUR', '€', $page);
            $page = str_replace('GBP', '£', $page);
            $page = str_replace('USD', '$', $page);
            $page = str_replace('US$', '$', $page);

            $doc = new DOMDocument();
            @$doc->loadHTML($page);
            $xpath = new DOMXpath($doc);
        
            $price;
            $saleFlag = 0;
        
            $nodes = $xpath->query('//div | //td | //span | //p | //li |//h5 |//h2');
            
            //keywords for class/id name
            $keywords = array('price', 'pricing', 'precio', 'money', 'product-price');
            $attributes = array('class', 'itemprop', 'id');
            
            /*** Special Scenarios ***/
            //get from meta tags
            if (strpos($url, 'net-a-porter.com') !== FALSE) {
                $nodes = $xpath->query('//meta[@class="product-data"]');
                $price = $nodes[0]->getAttribute('data-price') / 100;
                $fullPrice = $nodes[0]->getAttribute('data-price-full') / 100;
                if ($fullPrice != $price)
                    $saleFlag = 1;
            }
            else if (strpos($url, 'allsaints.com') !== FALSE ) {
                $nodes = $xpath->query('//meta[@itemprop="price"]');
                $price = $nodes[0]->getAttribute('content');
                if ( $xpath->query('//span[@class="price-was"]')->length != 0)
                    $saleFlag = 1;
            }
            else if ( strpos($url, 'ssense.com') !== FALSE ) {
                $nodes = $xpath->query('//meta[@itemprop="price"]');
                $price = $nodes[0]->getAttribute('content');
                if ( $xpath->query('//span[@class="price sale"]')->length != 0)
                    $saleFlag = 1; 
            }
            else if ( strpos($url, 'kohls.com') !== FALSE ) {
                $nodes = $xpath->query('//meta[@itemprop="price"]');
                $price = $nodes[0]->getAttribute('content');
                $nodes = $xpath->query('//meta[@property="og:price:standard_amount"]');
                if ( $nodes[0]->getAttribute('content') != $price)
                    $saleFlag = 1; 
            }
            else if (strpos($url, 'marcjacobs.com') !== FALSE) {
                $nodes = $xpath->query('//meta[@property="product:price:amount"]');
                $price = $nodes[0]->getAttribute('content');
            }
            else if ( strpos($url, 'calvinklein.com') !== FALSE) {
                $nodes = $xpath->query('//meta[@property="og:price:amount"]');
                $price = $nodes[0]->getAttribute('content');
                $nodes = $xpath->query('//meta[@property="og:price:standard_amount"]');
                if ( $nodes[0]->getAttribute('content') != $price)
                    $saleFlag = 1; 
            }
            
            //get from specific div or span
            else if (strpos($url, 'harrods.com') !== FALSE) {
                $nodes = $xpath->query('//span[@class="prices price"]');
                foreach ($nodes as $node) {
                    preg_match_all('/[\$\£\€](\d+(?:\.\d\d)?)/', preg_replace('/ |\n|\t|,/', '', $node->nodeValue), $matches);
                    if ( isset ($matches[1][1]) ) {//if there is sale price
                        $price = min($matches[1][1], $matches[1][0]);
                        $saleFlag = 1;
                    }
                    else
                        $price = $matches[1][0];
                    break;
                }
            }
            else if (strpos($url, 'shoptiques.com') !== FALSE ) {
                $nodes = $xpath->query('//span[@itemprop="price"]');
                $price = $nodes[0]->getAttribute('content');
                $nodes = $xpath->query('//meta[@property="og:price:amount"]');
                if ( $nodes[0]->getAttribute('content') != $price)
                    $saleFlag = 1; 
            }
            else if ( strpos($url, 'antonioli.eu') !== FALSE) {
                $nodes = $xpath->query('//span[@itemprop="price"]');
                $price = $nodes[0]->getAttribute('content');
                if ( $xpath->query('//span[@class="discount_rate"]')->length != 0)
                    $saleFlag = 1; 
            }
            else if (strpos($url, 'fendi.com') !== FALSE) {         
                $nodes = $xpath->query('//span[@id="price_value"]');
                if ( $nodes->length != 0 ) 
                    $price = preg_replace('/\$|\£|\€| /', '', $nodes[0]->nodeValue);
                
                $nodes = $xpath->query('//span[@id="price_salevalue"]');
                if ( $nodes->length != 0 ) 
                    $salePrice = preg_replace('/\$|\£|\€| /', '', $nodes[0]->nodeValue);
                
                if ( isset($salePrice) && $salePrice != '' ) {
                    $price = $salePrice;
                    $saleFlag = 1;
                }
            }
            else if (strpos($url, 'valentino.com') !== FALSE) {
                $nodes = $xpath->query('//div[@itemprop="price"]');
                $price = $nodes[0]->getAttribute('content');
                if ( trim($xpath->query('//div[@class="discountPct"]')[0]->nodeValue) != '' )
                     $saleFlag = 1;
            }
            else if (strpos($url, 'lastcall.com') !== FALSE ) {
                $nodes = $xpath->query('//span[@itemprop="price"]');
                $price = preg_replace('/\$|\£|\€| /', '', $nodes[0]->nodeValue);
                $saleFlag = 1; //always on sale if it's last call
            }
            else if ( strpos($url, 'gilt.com') !== FALSE ) {
                $nodes = $xpath->query('//span[@itemprop="price"]');
                $price = preg_replace('/\$|\£|\€| /', '', $nodes[0]->nodeValue);
                if ($xpath->query('//div[@class="product-price-msrp"]')->length != 0)
                    $saleFlag = 1;
            }
            else if ( strpos($url, 'johnlewis.com') !== FALSE ) {
                $nodes = $xpath->query('//span[@itemprop="price"]');
                $price = preg_replace('/\$|\£|\€| /', '', $nodes[0]->nodeValue);
                if ( strpos(strtolower($xpath->query('//div[@id="prod-price"]')[0]->nodeValue), 'now') !== FALSE)
                    $saleFlag = 1; 
            }
            else if (strpos($url, 'modaoperandi.com') !== FALSE) {
                $nodes = $xpath->query('//div[@class="prod-price pdp__product-info--brand-price"]');
                preg_match_all('/[\$\£\€](\d+(?:\.\d\d)?)/', preg_replace('/ |\n|\t|,/', '', $nodes[0]->nodeValue), $matches);
                $price = $matches[1][0];
                if ( isset($matches[1][1]) )
                    $saleFlag = 1;
            }
            else if (strpos($url, 'uniqlo.com') !== FALSE) {
                $nodes = $xpath->query('//div[@class="pdp-price-current"]');
                $price = $nodes[0]->nodeValue;
                $split = explode('"discount_flg":"',$page);
                $saleFlag = substr($split[1], 0, strpos($split[1], '"')); 
            }
            else if (strpos($url, 'zappos.com') !== FALSE) {
                $nodes = $xpath->query('//div[@id="priceSlot"]');
                preg_match_all('/[\$\£\€](\d+(?:\.\d\d)?)/', preg_replace('/ |\n|\t|,/', '', $nodes[0]->nodeValue), $matches);
                $price = trim($matches[1][0]);
                if ( isset($matches[1][1]) )
                    $saleFlag = 1;
            }
            else if (strpos($url, 'mytheresa.com') !== FALSE) { //This website has strange price display: $ 1.000 for one thousand
                $nodes = $xpath->query('//div[@class="price-box"]');
                foreach ($nodes as $node) {
                    preg_match_all('/[\$\£\€]((\d+)\.?(\d+)?)/', preg_replace('/ |\n|\t|,/', '', $node->nodeValue), $matches);
                    if ( isset ($matches[1][1]) ) {//if there is sale price
                        $price = min(str_replace('.', '', $matches[1][1]), str_replace('.', '', $matches[1][0]));
                        $saleFlag = 1;
                    }
                    else
                        $price = str_replace('.', '', $matches[1][0]);
                    break;
                }
            }
            else if (strpos($url, 'dailylook.com') !== FALSE) {
                $nodes = $xpath->query('//div[@itemprop="price"]');
                preg_match_all('/[\$\£\€](\d+(?:\.\d\d)?)/', preg_replace('/ |\n|\t|,/', '', $nodes[0]->nodeValue), $matches);
                $price = trim($matches[1][0]);
                $nodes = $xpath->query('//div[@itemprop="standardPrice"]');
                if ( $nodes[0]->nodeValue != '')
                    $saleFlag = 1;
            }
            else if (strpos($url, 'urbanoutfitters.com') !== FALSE) {
                $nodes = $xpath->query('//span[@class="salePrice ng-scope ng-binding"]');
                $saleFlag = 1;
                if ($nodes->length == 0){
                    $nodes = $xpath->query('//span[@class="salePrice ng-scope ng-binding promo-pricing"]');
                }
                if ($nodes->length == 0){
                    $nodes = $xpath->query('//span[@class="mainPrice ng-scope ng-binding"]');
                    $saleFlag = 0;
                }
                $price = $nodes[0]->nodeValue;
            }
            else if (strpos($url, 'anntaylor.com') !== FALSE || strpos($url, 'loft.com') !== FALSE) {
                $nodes = $xpath->query('//span[@itemprop="price"]');
                $price = $nodes[0]->nodeValue;
                $nodes = $xpath->query('//del');
                if ($nodes->length != 0)
                    $saleFlag = 1;
            }
            else if (strpos($url, 'chicos.com') !== FALSE) {
                $nodes = $xpath->query('//span[@class="regular-price product-price-regular"]');
                $price = str_replace('$', '', $nodes[0]->nodeValue);
                $nodes = $xpath->query('//span[@class="sale-price product-price-sale"]');
                $salePrice =str_replace('$', '', $nodes[0]->nodeValue);
                if ($salePrice != '') {
                    $price = $salePrice;
                    $saleFlag = 1;
                }
            }
            else if (strpos($url, 'terijon.com') !== FALSE) {
                $nodes = $xpath->query('//span[@itemprop="price"]');
                $price = str_replace('$', '', $nodes[0]->nodeValue);
            }
            else if (strpos($url, 'brooksbrothers.com') !== FALSE) {
                $nodes = $xpath->query('//span[@class="price-value"]');
                $price = str_replace('$', '', $nodes[0]->nodeValue);
                if ($nodes->length >= 2 && ($nodes[0]->nodeValue != $nodes[1]->nodeValue)) {
                    $saleFlag = 1;
                }
                // $nodes = $xpath->query('//div[@class="promotion-callout"]');
                // if ($nodes->length && trim($nodes[0]->nodeValue) !== "") {
                //     $saleFlag = 1;
                // }
            }
            
            //get from javascript
            else if (strpos($url, 'zara.com') !== FALSE) {
                $split = explode('"price":',$page);
                $price = substr($split[1], 0, strpos($split[1], '"'))/100;
                if (strpos($url, 'sale') !== FALSE)
                    $saleFlag = 1;
            }
            else if (strpos($url, 'thredup.com') !== FALSE) {
                $split = explode('"product_list_price":["',$page);
                $price = substr($split[1], 0, strpos($split[1], '"'));
                $saleFlag = 1;
            }             
            else if (strpos($url, 'gap.com') !== FALSE) {
                $split = explode('"regularMinPrice":"',$page);
                $price = str_replace('$', '', substr($split[1], 0, strpos($split[1], '"')));
                $split = explode('"currentMinPrice":"',$page);
                $salePrice = str_replace('$', '', substr($split[1], 0, strpos($split[1], '"')));
                if ($salePrice != $price) {
                    $price = $salePrice;
                    $saleFlag = 1;
                }
            }
            else if (strpos($url, 'talbots.com') !== FALSE) {
                $split = explode('customerAmount&quot;:&quot;',$page);
                $price = substr($split[1], 0, strpos($split[1], '&quot;'));
                $split = explode('originalAmount&quot;:&quot;',$page);
                $regPrice = substr($split[1], 0, strpos($split[1], '&quot;'));
                if ($regPrice != $price)
                    $saleFlag = 1;
            }
            else if (strpos($url, 'lordandtaylor.com') !== FALSE) {
                $split = explode('"offerPrice" : "',$page);
                $price = str_replace('$', '', substr($split[1], 0, strpos($split[1], '"'))); 
                $split = explode('"listPrice" : "',$page);
                $regPrice = str_replace('$', '', substr($split[1], 0, strpos($split[1], '"')));
                if ($regPrice != $price)
                    $saleFlag = 1;
            }
            else if (strpos($url, 'express.com') !== FALSE) {
                $split = explode('price:',$page);
                $price = substr($split[1], 0, strpos($split[1], 'q')); 
                $split = explode('listPrice:',$page);
                $regPrice = substr($split[1], 0, strpos($split[1], 'o')); 
                if ($regPrice != $price)
                    $saleFlag = 1;
            }
            else if (strpos($url, 'ninewest.com') !== FALSE) {
                $split = explode('"product_price":["',$page);
                $price = substr($split[1], 0, strpos($split[1], '"')); 
                $split = explode('"product_original_price":["',$page);
                $regPrice = substr($split[1], 0, strpos($split[1], '"'));
                if ($regPrice != $price)
                    $saleFlag = 1;
            }
            else if (strpos($url, 'luisaviaroma.com') !== FALSE) {
                $split = explode('"FinalPrice":',$page);
                $price = substr($split[1], 0, strpos($split[1], '"')); 
                $split = explode('"ListPrice":',$page);
                $regPrice = substr($split[1], 0, strpos($split[1], '"'));
                if ($regPrice != $price)
                    $saleFlag = 1;
            }
            
            else if (strpos($url, 'needsupply.com') !== FALSE) {
                $split = explode('"productPrice":',$page);
                $price = substr($split[1], 0, strpos($split[1], '"')); 
                $split = explode('"productOldPrice":',$page);
                $regPrice = substr($split[1], 0, strpos($split[1], '"'));
                if ($regPrice != $price)
                    $saleFlag = 1;
            }
            
            else if (strpos($url, 'asos.com') !== FALSE) {
                $split = explode('"current":',$page);
                $price = substr($split[1], 0, strpos($split[1], '"')); 
                $split = explode('"previous":',$page);
                $prevPrice = substr($split[1], 0, strpos($split[1], '"'));     
                if ($prevPrice != 0.0){
                    $saleFlag = 1;
                }
            }
            
            /*** Common Scenario ***/
            else {          
                foreach ($nodes as $node) { 
                    if (preg_match_all('/[\$\£\€](\d+(?:\.\d\d)?)/', preg_replace('/ |\n|\t|,/', '', $node->nodeValue), $matches) != 0) {
                        foreach ($keywords as $keyword) {
                            foreach ($attributes as $attr) {
                                if (strpos(strtolower($node->getAttribute($attr)), $keyword) !== FALSE) {         
                                    // try to match 2 or 3 prices so that we find a sale price
                                    if ($matches[1][2] != null) { //if there are three matches
                                        $price = min($matches[1][0], $matches[1][1], $matches[1][2]);
                                        $saleFlag = 1;
                                    }
                                    else if ($matches[1][1] != null) {  //if there are two matches
                                        $price = min($matches[1][0], $matches[1][1]);
                                        $saleFlag = 1;
                                    }
                                    else
                                        $price = trim($matches[1][0]);
                                    if ($price != 0)
                                        break 3;
                                }
                            }
                        }
                    }
                }
            }
        
            /*** if still no match, loose the dollar sign requirement   ***/
            if ($price == null) {
                foreach ($nodes as $node) { 
                    if (preg_match_all('/\d+(?:\.\d\d)?/', preg_replace('/ |\n|\t|,/', '', $node->nodeValue), $matches) != 0) {
                        foreach ($keywords as $keyword) {
                            foreach ($attributes as $attr) {
                                if (strpos(strtolower($node->getAttribute($attr)), $keyword) !== FALSE) {          
                                    if ($matches[0][1] != null) { //if there are two matches
                                        $price = min($matches[0][0], $matches[0][1]);
                                        $saleFlag = 1;
                                    }
                                    else
                                        $price = trim($matches[0][0]);
                                    if ($price != 0)
                                        break 3;
                                }
                            }
                        }
                    }
                }
            }
        
            $result['price'] = $price;
            $result['saleFlag'] = $saleFlag;
            return $result;
    }