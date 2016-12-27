<?php
/************** price scrapping function ***************/
    function scrape_size($page, $url, $httpCodeStatus) {
        $doc = new DOMDocument();
        @$doc->loadHTML($page);
        $xpath = new DOMXpath($doc);
        $result = array();
        
        if ( !$httpCodeStatus ) {
            // echo "httpCode = " . $httpCode . "-------bad entry || 404NotFound || hostNotFound";
            return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);
        }


        if ( strpos($url, 'saksfifthavenue') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="product-size-options"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes[3], array('unavailable')); 
            }   
        }        
        else if ( strpos($url, 'riverisland') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@id="SizeKey"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('out of stock')); 
            }   
        }        
        else if ( strpos($url, 'zappos') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@id="dimension-size"]');
            // echo "number of Childnodes: ";
            // echo $nodes->item(0)->childNodes->length;
            if ($nodes->length > 0 && $nodes->item(0)->childNodes->length < 4) {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes->item(1), NULL); 
            } else if ( $xpath->query('//div[@id="wereSorry"]')->length != 0 ) {
                $result = array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            } else {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } 
        }        
        else if ( strpos($url, 'mytheresa') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="size-chooser"]');
            if ($nodes->length != 0 ) {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes->item(3), array("wishlist"));
            } else if ( $xpath->query('//div[@id="catalog-product-404-hint"]')->length != 0 ) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            } else {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);   
            }   
        }        
        else if ( strpos($url, 'farfetch') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="dropdown customdropdown dropdown-no-border sizedropdown"]');
            if ($nodes->item(0)->childNodes->length < 3 ) {
                return sizeNodeTravesal($nodes->item(0)->childNodes[1], array('unavailable'));  
            }
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => FALSE);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes[3], array('unavailable')); 
            }   
            // $result = sizeNodeTravesal($nodes->item(0), 'out of stock'); 
        }        
        else if ( strpos($url, 'baublebar') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="page_pdp-productAttributes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('color', 'unavailable', 'input'=>'input')); 
                if ($result['inStock'] == false) {
                    $result['size'] = 'One Size';
                    $result['inStock'] = true;
                }
            }   
        }        
        else if ( strpos($url, 'mango') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@class="selecciona_tu_talla span6 priceSelector__select  select-size-js"]');
            if ($nodes->length == 0 ) {
                $nodes = $xpath->query('//select[@class="selecciona_tu_talla span6 priceSelector__select singleSize select-size-js"]');                
            }
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('not available')); 
            }   
        }        
        else if ( strpos($url, 'aritzia') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@class="swatches swatches-size clearfix"]');
            $result = sizeNodeTravesal($nodes->item(0), array('unavailable')); 
        }        
        else if ( strpos($url, 'yoox') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@class="colorsizelist"]');
            if ($nodes->length < 2 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);     
            } else {
                $result = sizeNodeTravesal($nodes[1], NULL);    
            }
        }
        else if ( strpos($url, 'thredup') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            $nodes = $xpath->query('//h2[@class="item-title item-size"]');
            $value = $nodes->item(0)->nodeValue;
            if (strpos(strtolower($value), 'size') !== false && strtolower(trim($value)) !== 'one size')  $value = substr($value, strpos(strtolower($value), 'size') + 5);
            $size[$value] = $value;
            $inStock = true;
            $result = array('size' => $size, 'inStock' => $inStock);
        }        
        else if ( strpos($url, 'agacistore') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@class="swatches size clearfix"]');
            $result = sizeNodeTravesal($nodes->item(0), array('unselectable')); 
        }        
        else if ( strpos($url, 'baublebar') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
        }        
        else if ( strpos($url, 'dailylook') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="product-variant-swatches floatContainer optionsID"]');
            if (trim($nodes->item(0)->nodeValue) == '') {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);       
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('out-of-stock'));                 
            }
        }        
        else if ( strpos($url, 'sephora') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="SwatchGroup-selector SwatchGroup-selector--flush"]');
            
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);   
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('ngrepeat')); 
            }            
        }        
        else if ( strpos($url, 'drjays') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="djdd_menu"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);   
            } else {
                $result = sizeNodeTravesal($nodes[1], NULL); 
            }                       
        }        
        else if ( strpos($url, 'unionandfifth') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="col5 meta"]');
            if (strpos($nodes->item(0)->childNodes[2]->childNodes[1]->nodeValue, 'been sold')) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }

            $value = $nodes->item(0)->childNodes[1]->childNodes[0]->childNodes[0]->nodeValue;
            if (strpos(strtolower($value), 'size') !== false && strtolower(trim($value)) !== 'one size')  $value = substr($value, strpos(strtolower($value), 'size') + 5);
            $size[$value] = $value;
            $inStock = true;
            $result = array('size' => $size , 'inStock' => true);  
        }        
        else if ( strpos($url, 'designsbystephene') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            if ($xpath->query('//div[@class="sold-out-details"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }

            $nodes = $xpath->query('//ul[@id="sizechoices"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('notavailable')); 
            }   
        }        
        else if ( strpos($url, 'net-a-porter') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            if ($xpath->query('//div[@class="sold-out-details"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }

            $nodes = $xpath->query('//select[@class="style-scope select-dropdown small"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('sold out')); 
            }   
        } 
        else if ( strpos($url, 'italist') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@id="sizes_cnt"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), NULL); 
            }   
        }        
        else if ( strpos($url, 'nordstrom.com') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            if ($xpath->query('//div[@class="unavailable-alert nui-alert error"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//ul[@class="swatches medium"]');
            if ($nodes->length == 0 ) {
                $nodes = $xpath->query('//ul[@class="swatches small"]');
            }
            if ($nodes->length == 0 ) {
                $nodes = $xpath->query('//ul[@class="swatches large"]');
            }
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('unavailable')); 
            }   
        }        
        else if ( strpos($url, 'kohls') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="pdp-waist-size_info clearfix"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('unavailable')); 
            }   
        }        
        else if ( strpos($url, 'urbanoutfitters') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="size-selector-mobile dropdowner ng-scope ng-hide"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes[3], array('unavailable')); 
            }   
        }        
        else if ( strpos($url, 'nastygal') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="product-sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('disabled', 'input'=>'input')); 
            }   
        }        
        else if ( strpos($url, '6pm') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@class="btn secondary" and @name="dimensionValues"]');
            if ($nodes->length == 0 ) {
                $nodes = $xpath->query('//li[@class="dimensions"]');
                if ($nodes->length != 0 ) {
                    $value = $nodes->item(0)->childNodes->item(4)->nodeValue;
                    $result = array('size' => $size = array($value => $value ), 'inStock' => true);  
                } else {
                    $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
                }
            } else {
                $result = sizeNodeTravesal($nodes->item(0), NULL); 
            }   
        }        
        else if ( strpos($url, 'boohoo') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            if ( strpos($xpath->query('//div[@class="wrapper"]')[0]->nodeValue, 'Product Unavailable') !== false ) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//div[@id="attributeInputs"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                // echo $nodes->item(0)->childNodes[1]->childNodes[1]->nodeName;
            // echo $nodes->length."......".$doc->saveHTML($nodes->item(0));
                // foreach ($nodes->item(0)->childNodes[1]->childNodes as $child) {
                    // echo $child->nodeName;
                    // echo "<br/>";
                // }die;
                // echo $nodes->item(0)->childNodes[1]->childNodes[1]->childNodes[1]->nodeName;
                // echo $nodes->item(0)->childNodes[1]->childNodes[1]->childNodes[1]->nodeName;
                $result = sizeNodeTravesal($nodes->item(0)->childNodes[0]->childNodes[0]->childNodes[1], NULL); 
            }   
        }        
        else if ( strpos($url, 'shopbop') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@id="sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('unavailable')); 
            }   
        }        
        else if ( strpos($url, 'revolve') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            if ($xpath->query('//div[@class="u-line-height--sm product-badges__oos"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//ul[@id="size-ul" and @class="ui-list"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('oos')); 
            }   
        }        
        else if ( strpos($url, 'katespade') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            if ($xpath->query('//p[@class="not-available-msg"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//ul[@class="swatches size "]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('unselectable')); 
            }   
        }        
        else if ( strpos($url, 'anntaylor') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ($xpath->query('//div[@class="sold-out-details"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//fieldset[@class="sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes[2], array('disabled')); 
            }   
        }        
        else if ( strpos($url, 'gap') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            if ($xpath->query('//div[@class="soldOutDiv"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }

            $nodes = $xpath->query('//div[@data-bind="foreach: {data: sizes}, attr: { \'aria-labeledby\': label }" and @class="swatches--list"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => 'One Size', 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('ko')); 
                $nodes = $xpath->query('//svg[@class="swatch--outOfStockIndicator"]');
                $inputNodes = array();
                foreach ($nodes as $node) {
                    // echo "in the else if loop <br/>";
                    // echo "..." . $node->parentNode->nodeValue . "...";
                    $inputNodes[] = $node->parentNode;
                }
                $result = clearUnavail($result, $inputNodes);
            }   
        }        
        else if ( strpos($url, 'toryburch') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="dropdownselect table-cell"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes->item(0), array('not available')); 
            }   
        }        
        else if ( strpos($url, 'marketplace') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="variantselect"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes->item(1), array('unavailable')); 
            }   
        }        
        else if ( strpos($url, 'loft') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ($xpath->query('//div[@class="sold-out-details"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            if ($xpath->query('//div[@class="product-out-of-stock"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//fieldset[@class="sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes->item(1), array('disable')); 
            }   
        }        
        else if ( strpos($url, 'anthropologie') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ($xpath->query('//div[@class="error clearfix ng-scope"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//select[@class="size-dropdown ng-pristine ng-valid"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('sold out')); 
            }   
        }        
        else if ( strpos($url, 'ralphlauren') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@class="size-swatches"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('disable')); 
            }   
        }        
        else if ( strpos($url, 'vestiairecollective') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ($xpath->query('//span[@class="sold-out"]')->length != 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//div[@class="prd-sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $value = $nodes->item(0)->childNodes->item(1)->nodeValue;
                if (strpos(strtolower($value), 'size') !== false && strtolower(trim($value)) !== 'one size')  $value = substr($value, strpos(strtolower($value), 'size') + 5);

                $result = array('size' => $size = array($value => $value ), 'inStock' => true);  
            }   
        }        
        // else if ( strpos($url, 'alternativeapparel') !== FALSE ) {
        //     $nodes = $xpath->query('//div[@class="product-sizes js-size-button-wrapper"]');
        //     if ($nodes->length == 0 ) {
        //         $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
        //     } else {
        //         $result = sizeNodeTravesal($nodes->item(0), "disable"); 
        //     }   
        // }        
        else if ( strpos($url, 'americanapparel') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ( strpos($url, 'error.jsp')) 
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            if ( strpos($xpath->query('//div[@class="inventory-status"]')[0]->nodeValue, 'Unavailable') !== FALSE ) 
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  

            $nodes = $xpath->query('//div[@id="product-sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes->item(1), NULL); 
            }   
        }        
        // same as gap
        // if ( strpos($url, 'bananarepublic') !== FALSE ) {
        //     $nodes = $xpath->query('//div[@data-bind="foreach: {data: sizes}, attr: { \'aria-labeledby\': label }" and @class="swatches--list"]');
        //     if ($nodes->length == 0 ) {
        //         $result = array('size' => 'One Size', 'inStock' => true);  
        //     } else {
        //         $result = sizeNodeTravesal($nodes->item(0), "ko"); 
        //         $nodes = $xpath->query('//svg[@class="swatch--outOfStockIndicator"]');
        //         $inputNodes = array();
        //         foreach ($nodes as $node) {
        //             $inputNodes[] = $node->parentNode;
        //         }
        //         $result = clearUnavail($result, $inputNodes);
        //     }   
        // }        
        else if ( strpos($url, 'finishline') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@id="productSizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('unavailable')); 
            }   
        }        
        else if ( strpos($url, 'solesociety') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            // if ( $xpath->query('//div[@id="soldout-cart-btn"]')->length != 0 ) {
            //     return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            // }
            $nodes = $xpath->query('//ul[@id="sizes-handlebars"]');
            if ($nodes->length == 0 || !$nodes->item(0)->hasChildNodes() ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('na')); 
            }   
        }        
        else if ( strpos($url, 'bodenusa') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="pdpSCBoxes pdpSizeChart"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes->item(1), array('notavailable')); 
            }   
        }        
        else if ( strpos($url, 'heels.com') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ( $xpath->query('//h4[@class="soldout"]')->length != 0 ) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//ul[@class="sizes list-unstyled list-inline"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('x')); 
            }   
        }        
        else if ( strpos($url, 'chicwish') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ( $xpath->query('//img[@class="aw_avail_stock_label"]')->length != 0 && trim($xpath->query('//img[@class="aw_avail_stock_label"]')[0]->getAttribute('alt')) == '' ) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//select[@class=" required-entry product-custom-option"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), NULL); 
            }   
        }        
        else if ( strpos($url, 'monnierfreres') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ( $xpath->query('//p[@class="availability out-of-stock"]')->length != 0 ) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//select[@class="required-entry super-attribute-select"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), NULL); 
            }   
        }        
        else if ( strpos($url, 'chicos') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ( $xpath->query('//div[@class="product-no-inventory"]')->length != 0 ) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//div[@class="btn-group bootstrap-select product-size form-control checkRequired"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes->item(1)->childNodes->item(0), NULL); 
            }   
        }        
        else if ( strpos($url, 'asos') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            // page.url.indexOf(testUrl) !== 0
            $nodes = $xpath->query('//select[@name="ctl00$ContentMainPage$ctlSeparateProduct$drpdwnSize"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('not available')); 
            }   
        }        
        else if ( strpos($url, 'terijon') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            // page.url.indexOf(testUrl) !== 0
            $nodes = $xpath->query('//ul[@class="size-list" and @id="size_selection"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), NULL); 
            }   
        }        
        else if ( strpos($url, 'nike.com') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="exp-pdp-size-dropdown-container nsg-form--drop-down--option-container selectBox-options nsg-form--drop-down exp-pdp-size-dropdown exp-pdp-dropdown two-column-dropdown selectBox-dropdown-menu"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes[0], array('not-in-stock')); 
            }   
        }        
        else if ( strpos($url, 'intermixonline') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="ml-optionType-Size"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), NULL); 
            }   
        }        
        else if ( strpos($url, 'jcrew') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ( strpos($xpath->query('//div[@class="sold-out"]')[0]->nodeValue, 'sold out') !== FALSE ) 
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  

            $nodes = $xpath->query('//section[@class="sizes" and @id="sizes0"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('unavailable')); 
            }   
        }        
        else if ( strpos($url, 'terijon') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@class="size-list" and @id="size_selection"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), NULL); 
            }   
        }        
        else if ( strpos($url, 'henribendel') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ( $xpath->query('//div[@class="notfound"]')->length != 0 ) 
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            
            $nodes = $xpath->query('//ul[@class="size-list" and @id="size_selection"]');
            $parentNode = $nodes->item(0);
            if ($nodes->length == 0 ) {
                $nodes = $xpath->query('//ul[@class="swatchesdisplay"]');
                $parentNode = $nodes[1];
            }

            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($parentNode, NULL); 
            }   
        }     
        else if ( strpos($url, 'lordandtaylor') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@class="detail_size"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('disable')); 
            }   
        }     
        else if ( strpos($url, 'theoutnet') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@id="sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes[3], array('sold-out')); 
            }   
        }     
        else if ( strpos($url, 'freepeople') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="size-options clearfix"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('disabled', 'sizes hidden')); 
            }   
        }     
        else if ( strpos($url, 'allsaints') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@id="available_sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('input'=>'input', 'OUT OF STOCK')); 
            }   
        }     
        else if ( strpos($url, 'modcloth') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $outOfStockNode = $xpath->query('//p[@class="product-archived-message"]');
            if ( $outOfStockNode->length != 0 && strpos($outOfStockNode[0]->nodeValue, "isn't available") !== false ) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            $nodes = $xpath->query('//div[@class="ui-variant-container"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('out-of-stock')); 
            }   
        }     
        else if ( strpos($url, 'shoptiques') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="btn-group-size"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes[1], array('disable')); 
            }   
        }     
        else if ( strpos($url, 'tradesy') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="item-size"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('sold-out')); 
            }   
        }     
        else if ( strpos($url, 'zimmermannwear') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@class="sbOptions"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('sold out')); 
            }   
        }     
        else if ( strpos($url, 'wonhundred') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@id="edit-attributes-2"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('sold-out')); 
            }   
        }        
        else if ( strpos($url, 'trade-mark') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="entry-sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0)->childNodes[2], array('disable')); 
            }   
        }        
        else if ( strpos($url, 'buckle') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@class="dropdown-menu inner﻿"]');
            // echo $nodes->item(0)->nodeName;
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), NULL); 
            }   
        }        
        else if ( strpos($url, 'lastcall') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@class="variationDD OneLinkNoTx gutter-bottom-half sizeSelectBox"]');
            // echo $nodes->item(0)->childNodes->length;
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), NULL); 
            }   
        }     
        else if ( strpos($url, 'rebeccataylor') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@class="attribute_att2"]');
            // echo $nodes->item(0)->childNodes->length;
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), NULL); 
            }   
        }        
        else if ( strpos($url, 'alternativeapparel') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="product-sizes js-size-button-wrapper"]');
            // echo $nodes->item(0)->childNodes->length;
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('disabled')); 
            }   
        }        
//////////Lucy's work        
        else if ( strpos($url, 'mytheresa.com') !== FALSE) {
            $nodes = $xpath->query('//ul[@class="sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), array('wishlist')); 
            }     
        }
        else if ( strpos($url, 'neimanmarcus') !== FALSE ) {
            // echo "httpCode is..." . $httpCode . "...<br/>";

            if ( strpos($xpath->query('//div[@class="cannotorder"]')[0]->nodeValue, 'not available') !== FALSE ) 
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  

            $nodes = $xpath->query('//select[@class="variationDD OneLinkNoTx gutter-bottom-half sizeSelectBox"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal($nodes->item(0), array('unavailable')); 
            }   
        }        
        else if ( strpos($url, 'freepeople.com') !== FALSE) {
            $nodes = $xpath->query('//div[@class="size-options clearfix"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), array('disabled', 'hidden'));
            }   
        }
        else if ( strpos($url, 'allsaints.com') !== FALSE) {
            $nodes = $xpath->query('//div[@id="available_sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), array('disabled'));
            } 
        }
        else if ( strpos($url, 'ninewest.com') !== FALSE) {
            if ( strpos($xpath->query('//span[@class="soldOut"]')[0]->nodeValue, 'SOLD OUT') !== FALSE || strpos($xpath->query('//div[@id="errorNote"]')[0]->nodeValue, 'have walked away') !== FALSE) 
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  

            $nodes = $xpath->query('//div[@id="sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), array('notAvailable'));
            } 
        }
        else if ( strpos($url, 'macys.com') !== FALSE) {
            $nodes = $xpath->query('//ul[@class="swatchesList"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes[1], array('disabled'));
            } 
        }
        else if ( strpos($url, 'hm.com') !== FALSE) {
            $nodes = $xpath->query('//ul[@id="options-variants"]');
            $parentNode = $nodes->item(0);

            if ($nodes->length == 0 ) {
                $nodes = $xpath->query('//div[@class="product-sizes"]');
                $parentNode = $nodes->item(0)->childNodes[5];
            } 

            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($parentNode, array('soldOut', 'unavailable'));
            } 
        }
        else if ( strpos($url, 'nastygal.com') !== FALSE) {
            $nodes = $xpath->query('//div[@class="product-sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), array('disabled'));
            }
        }
        else if ( strpos($url, 'zara.com') !== FALSE) {
            $nodes = $xpath->query('//div[@class="size-select"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0)->childNodes[0], array('disabled'));
            }
        }
        else if ( strpos($url, 'prada.com') !== FALSE) {
            // echo "httpCode is ...".$httpCode;

            $nodes = $xpath->query('//ul[@id="sizeListDesktop"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0)->childNodes[0]->childNodes[0], array('unavailable'));
            }
        }
        else if ( strpos($url, 'robertocavalli.com') !== FALSE) {
            $nodes = $xpath->query('//div[@class="swatch_item"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes[1], NULL);
            }
        }
        else if ( strpos($url, 'viviennewestwood.com') !== FALSE) {
            $nodes = $xpath->query('//div[@id="edit-attributes-field-product-size"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), NULL);
            }
        }
        else if ( strpos($url, 'christianlouboutin.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="size"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0)->childNodes[7], array('out-of-stock'));
            }    
        }
        else if ( strpos($url, 'topshop.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="product_size_buttons"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), array('disabled'));
            }  
        }
        else if ( strpos($url, 'bysymphony.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@id="attribute242"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), array('Sold Out'));
            }           
        }
        else if ( strpos($url, 'mytheresa.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="size-chooser"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), array('add to Wishlist'));
            }        
        }
        else if ( strpos($url, 'lanecrawford.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@id="product_sizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), array('disabled'));
            }        
        }
        else if ( strpos($url, 'nordstromrack.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
//silonghu
	    /*$elements = query_selector($doc, 'dd[class=product-details-section__definition]');
                foreach ($elements as $element) {
                    $available .= ' ' . dom_format_text($element);
                }*/
	    //$meta = element_by_selector($doc, 'label[class="sku-item sku-item--available sku-item--text"]');
            //$available = $meta ? $meta->getAttribute('value') : '';
            $nodes = $xpath->query('//div[@class="sku-option__items"]');
//silonghu
	    //$nodes = $xpath->query('//label[@class="sku-item sku-item--available sku-item--text"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
//silonghu
		$result = sizeNodeTravesal($nodes->item(0)->childNodes[0], array('sku-item--sold-out')); 
                /*
		$tempRs = array();
                $tempRs = sizeNodeTravesal ($nodes[0], array('new-selector--sold-out'));
                $result['inStock'] = $tempRs['inStock'];
                foreach ($tempRs['size'] as $k => $v) {
                    $sizeIndex = substr($v, 0, strpos($v, ' ') - 1);
                    $result['size'][$sizeIndex] = $sizeIndex;
                }*/
            }        
        }
        else if ( strpos($url, 'shein.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@id="goods_size"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('' => "" ), 'inStock' => false);  
            } 
            if ($nodes->length == 1 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            }
            else {
                $result = sizeNodeTravesal ($nodes[0], array(''));
            }
        }
        else if ( strpos($url, 'oldnavy.gap.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="swatches--list"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result['size'] = array();
                $sizes = explode(' ', trim($nodes->item(0)->nodeValue));
                foreach ($sizes as $size) {
                    if (trim($size) == '')
                        continue;
                    $result['size'][$size] = $size;
                }
                $result['inStock'] = true;
            }
        } 
        else if ( strpos($url, 'dollskill.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@id="attribute125"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), NULL);
            }
        }
        else if ( strpos($url, 'vince.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="small-24 columns attribute-two"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0)->childNodes[0], array('js-Not_Available'));
            }   
        }
        else if ( strpos($url, 'blueandcream.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@name="Product_Attributes[1]:value"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), NULL);
            } 
        }
        else if ( strpos($url, 'talbots.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="productSizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0)->childNodes[1], NULL);
            }
        }
        else if ( strpos($url, 'etsy.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@class="variation"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), NULL);
            }
        }
        else if ( strpos($url, 'therealreal.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="product-title__size"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result[ 'size' ] = $nodes->item(0)->nodeValue;
                $result[ 'inStock' ] = true; //not items shown are not in stock
            }
        }
        else if ( strpos($url, 'bcbg.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@id="va-size"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), NULL);
            }
        }
        else if ( strpos($url, 'draperjames.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//div[@class="select select-size"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0)->childNodes[0]->childNodes[0], array('SOLD OUT'));
            }
        }
        else if ( strpos($url, 'uniqlo.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//ul[@class="pdp-options group"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), NULL);
            }
        }
        else if ( strpos($url, 'barneys') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//input[@id="fp_availableSizes"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $sizestr = $nodes[0]->getAttribute('value');
                $trimsizestr = substr($sizestr,1,strlen($sizestr)-2);
                $tempsizes = explode(",", $trimsizestr);
                $sizes = array();
                foreach($tempsizes as $size){
                    $sizes[trim($size,'\"')]=trim($size,'\"');
                }
                $inStock = FALSE;
                if(count(sizes) !== 0){
                    $inStock = TRUE;
                }
                $result = array('size' => $sizes, 'inStock' => $inStock);
            }
        }
        else if ( strpos($url, 'vanmildert.com') !== FALSE) {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            $nodes = $xpath->query('//select[@name="dnn$ctr176041$ViewTemplate$ctl00$ctl08$sizeDdl"]');
            if ($nodes->length == 0 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes->item(0), NULL);
            } 
        }
        else if ( strpos($url, 'selfridges.com') !== FALSE) {
            // echo "inthere";
            // echo "httpCode is..." . $httpCode . "...<br/>";
            if ( $xpath->query('//div[@class="outOfStockMessages stockAvailability"]')->length !== 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }

            $nodes = $xpath->query('//ul[@class="basic"]');
            if ($nodes->length < 2 ) {
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  
            } else {
                $result = sizeNodeTravesal ($nodes[1], array('outofstock'));
            } 
        }
        else if ( strpos($url, 'antonioli') !== FALSE ) {
            if ($xpath->query('//div[@class="availability available_now"]')->length === 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);
            }
            $nodes = $xpath->query('//div[@class="product-variants"]');
            $result = sizeNodeTravesal($nodes[0], NULL);
            $newSize = array();
            $i = 0;
            foreach ($result['size'] as $k => $v) {
                if ($i++ % 2 == 0) {
                    continue;
                } else {
                    $newSize[$k] = $v;
                }
            }
            $result['size'] =  $newSize;
        }
        else if ( strpos($url, 'maykool.com') !== FALSE) {
            if ($xpath->query('//div[@class="product-outofstock"]')->length > 0) {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);
            }
            $jsonInfoArr = explode('Product.Config(', $page);
            $json = substr($jsonInfoArr[1], 0, strpos($jsonInfoArr[1], ');'));
            $jsonArr = json_decode($json, TRUE);
            $availableSize = array();
            foreach ($jsonArr['attributes']['134']['options'] as $v) {
                $availableSize[$v['label']] = $v['label'];
            }
            if (count($availableSize)) {
                $result['size'] = $availableSize;
                $result['inStock'] = TRUE;
            } else {
                return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);
            }
        
        }
        else {
            // echo "httpCode is..." . $httpCode . "...<br/>";
            // echo 'Site not in the special case list';
            
            $nodes = $xpath->query('//ul |//select');
            $attributes = array('class', 'id');
            $keywords = array('size');
            $bannedwords = array('sold out', 'disabled', 'unavailable', 'unselectable', 'not available', 'waiting list', 'wishlist', 'out-of-stock', 'outofstock');
            
            foreach ($nodes as $node) {
                foreach ($keywords as $keyword) {
                    foreach ($attributes as $attr) {
                        if (strpos(strtolower($node->getAttribute($attr)), $keyword) !== FALSE) {
                            $result = sizeNodeTravesal ($node, $bannedwords);
                            if (isset($result['size']))
                                break 3;
                        }
                    }
                }
            }
            
            // return one size if no size found
            if ( !isset($result['size']) )
                $result = array('size' => $size = array('One Size' => "One Size" ), 'inStock' => true);  

            // trivial cases for inStock
            if ( strpos($url, 'harrods.com') !== FALSE) {
                if ( strpos($xpath->query('//div[@class="outofstock"]')[0]->nodeValue, 'Out of Stock') !== FALSE) 
                    return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            else if ( strpos($url, 'valentino.com') !== FALSE) {
                if ( strpos($xpath->query('//span[@class="soldOutLabel"]')[0]->nodeValue, 'sold out') !== FALSE) 
                    return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            else if ( strpos($url, 'tomford.com') !== FALSE) {
                if ( strpos($xpath->query('//div[@claninewestss="content-asset"]')[0]->nodeValue, 'page was not found') !== FALSE ) 
                    return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
            else if ( strpos($url, 'guess.com') !== FALSE) {
                // echo "inthere";
                if ( strpos($xpath->query('//div[@class="noStock"]')[0]->nodeValue, 'Out of Stock') !== FALSE || strpos($xpath->query('//div[@class="header-big searchHeaderItem"]')[0]->nodeValue, 'SORRY') !== FALSE ) 
                    return array('size' => $size = array('Out of Stock' => 'Out of Stock'), 'inStock' => false);  
            }
        
        }

        return $result;
    }
    

    // delete unavailable sizes 
    function clearUnavail ($result, $nodes) {
        $size = $result['size'];

        foreach ($nodes as $childNode) {
            // echo "in the cleanup <br/>";
            // echo "...".$size[trim($childNode->nodeValue)]."...";
            unset($size[trim($childNode->nodeValue)]);
        }
        $result['size'] = $size;   
        return $result;
    }

        // returns value of all child nodes in an array.
    function sizeNodeTravesal ($parentNode, $bannedwords) {
        $size = array();
        $inStock = false;

        // echo "parentNode is...".$parentNode->nodeName."...<br/>";
        // echo "parentNode name is...".$parentNode->getAttribute('id')."...<br/>";
        
        if ( $parentNode === NULL) {
            // echo "parentNode is NULL";
            $result = array('size' => 'Out of Stock', 'inStock' => false);
            return $result;      
        }
            
        // Visit each node 
        if ($parentNode->hasChildNodes()) {
                
            foreach ($parentNode->childNodes as $child) {

                // echo "nodeValue is...".$child->nodeValue."...before crop<br/>";
                // echo "nodeName is...".$child->nodeName."...before crop<br/>";
                
                // get rid of the node that has empty text
                if ( strpos($child->nodeName, '#') !== FALSE ) {
                    continue;
                }
                // get rid of the node that is javascript
                if ( $child->nodeName == 'script') {
                    continue;
                }
                
                // get rid of the child that is like 'choose the size' or empty nodes
                if (preg_match_all('/choose|fits|select |select$|end|chart|quick|hide|\.\.\./i', trim($child->nodeValue), $matches)|| ( strlen(trim($child->nodeValue)) < 1 && !$child->hasAttribute('value')) || ($child->hasAttribute('class') && strpos(strtolower($child->getAttribute('class')), 'hide') !== FALSE)  ) 
                    continue;
                
                // get rid of the child that is unavailable size
                foreach($bannedwords as $keyword) {


                    // echo "Class value is..." . $child->getAttribute('class') . "...<br/>"; 
                    if ( strpos(strtolower($child->nodeValue), strtolower($keyword)) !== FALSE )
                        continue 2;
                    
                    if ( $child->hasAttribute('class') ) {
                        if ( strpos(strtolower($child->getAttribute('class')), strtolower($keyword)) !== FALSE ) {
                            // echo "diediedie";
                            // die;
                            continue 2;
                        }
                    }

                    // specifically for Lanecrawford 
                    // if ( $child->childNodes->length > 2 ) {
                    //     if ( $child->childNodes[2]->nodeName != '#text' ) {
                    //         if ( $child->childNodes[2]->hasAttribute('class') ) {
                    //             if ( strpos(strtolower($child->childNodes[2]->getAttribute('class')), strtolower($keyword)) !== FALSE ){
                                    // echo "jumpout";
                    //                 continue 2;

                    //             }
                    //         }
                    //     }
                    // }
                    // specifically for lordandtaylor
                    $curNode = $child;
                    $nodeList = new SplQueue();
                    $nodeList->enqueue($curNode);
            // echo htmlspecialchars($curNode->ownerDocument->saveHTML($curNode)) . "<br/>";
                    while( !$nodeList->isEmpty() ) {
                        $curNode = $nodeList->dequeue();
                        foreach ($curNode->childNodes as $childNode) {
                            if ( strpos($childNode->nodeName, '#') !== FALSE )
                                continue;
                            if ( $childNode->hasAttribute('class') ) {
                                if ( strpos(strtolower($childNode->getAttribute('class')), strtolower($keyword)) !== FALSE ){
                                    // echo "ERROR HERE<br/>";
                                    // echo $childNode->nodeName;
                                    continue 4;

                                }
                            }
                            $nodeList->enqueue($childNode);
                        }
                    }
                }

                $value = trim($child->nodeValue);
                // echo "here is  the value..." . $value . "...<br/>";

                if ( $child->hasAttribute('value') && empty($value) && !isset($bannedwords['input']) ) 
                    $value = $child->getAttribute('value');
                
                // Crop the value, get rid of irrelavent part
                if (trim($value) == '') 
                    continue;
                if (strpos($value, '- ') !== false) {
                    if (preg_match('/^EU|^XXS|^XS|^S|^M|^L|^XL|^XXL/', substr($value, strpos($value, '- ') + 2)) == 0) {
                        $value = substr($value, 0, strpos($value, '- ') - 1);
                    }
                }
                if (strpos(strtolower($value), 'only') !== false ) 
                    $value = substr($value, 0, strpos(strtolower($value), 'only') - 1);
                if (strpos(strtolower($value), 'selected') !== false ) 
                    $value = substr($value, 0, strpos(strtolower($value), 'selected') );
                if (strpos(strtolower($value), 'in stock') !== false ) 
                    $value = substr($value, 0, strpos(strtolower($value), 'in stock') - 1);
                if (strpos(strtolower($value), 'low') !== false ) 
                    $value = substr($value, 0, strpos(strtolower($value), 'low') - 1);
                if (strpos($value, '— ') !== false ) 
                    $value = substr($value, 0, strpos($value, '— ') - 1);
                if (strpos(strtolower($value), 'size') !== false && strcmp(strtolower(trim($value)), 'one size') === FALSE)
                    $value = substr($value, strpos(strtolower($value), 'size') + 5);
                if (strpos($value, 'out') !== false ) 
                    $value = substr($value, 0, strpos($value, 'out') - 1);
                if (strpos($value, 'shopping') !== false ) 
                    $value = substr($value, 0, strpos($value, 'shopping') - 1);
                if (strpos($value, '$') !== false ) 
                    $value = substr($value, 0, strpos($value, '$'));
                if (strpos($value, ' ( Last Piece )') !== false ) 
                    $value = substr($value, 0, strpos($value, ' ( Last Piece )'));
                
                $size[trim($value)] = trim($value);
                $inStock = true;
                
            }
                
        }
//silonghu
	$result = array('size' => $size, 'inStock' => $inStock);
        //$result = array('size' => $size, 'inStock' => $inStock);
        return $result;
    }
/************** price scrapping function ***************/

?>
