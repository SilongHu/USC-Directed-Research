<?php

function scrape_image($response,$url){
	$curl_sites=array('hugoboss','topshop','stylebop','barneys','shein','charlotterusse','dollskill','abercrombie','ae.com','madewell','vince','etsy','calvinklein','therealreal','needsupply','bcbg','fwrd','uniqlo','revolve','vestiairecollective','monnierfreres','fishline','hm.com','prada','thredup','revolveassets','amazon.com','gucci.com','brooksbrothers');

	$data_href_largeImage_sites=array('monnierfreres');
	$data_large_image_sites=array('nike.com');
	$data_zoom_url_sites=array('bergdorfgoodman.com');
	$data_large_sites=array('anntaylor.com');
	$data_zoom_image_sites=array('dailylook.com','puma.com');
	$data_zoom_sites=array('baublebar.com','adidas.com','nastygal');
	$data_src_sites = array('mango.com','romwe.com','shein.com','calvinklein.com','ssense.com','buckle.com');
	$data_detailurl = array('versace.com');
	$data_imgrul_sites=array('jcrew.com');
	$data_imageSourceMob = array('valentino.com');
	$data_href_sites=array('zappos','italist.com','boohoo.com','katespade.com','modcloth.com','theoutnet.com','forever21.com','express.com','harrods.com','zara.com','tomford.com','topshop.com','bysymphony.com','therealreal.com','bcbg.com','uniqlo.com','vanmildert.com','shoptiques.com','tradesy.com','fendi.com','brooksbrothers','heels.com'); 
	$data_sites=array('drjays.com');
	$banned_strings = array('loader', 'logo', 'facebook', 'twitter', 'tweet', 'instagram', 'google', 'googleplus', 'gplus', 'header', 'footer', 'banner', '.gif', 'flag', 'pinterest','gravatar','promo','category_page','recently_viewed','measure','email','chat','icon','bing','msn','BAN_Dropdown','home','related','subscribe','weibo','qrcode','background','cover_','image/480x720/','blog','marketing_asset','MW-SIZE-FIT','slash_white','free_retour','payment','resizer/233x350/','cms/ops','Cash_30off','Refresh_StoreLocator','CrossSellProductPage','deal','megamenu','guide-thumb','glamour-thumb','insiders-thumb','Holidays-thumb','cat_splash','_lifestyle_dt','shopstarter','_summer','fashion_show','img_sellerquiz','img_payout','designer_','collection_main_image','New_emag_Flyout','global-sprite_bluebeacon','compshipcaveat','/optinization/');
	$proxy_websites=array("lordandtaylor.com","saksfifthavenue.com",'michaelkors.com','zara.com','adidas.com');

	$response=str_replace("&lt;","<",$response);
	$response=str_replace("&gt;",">",$response);
	$response=str_replace("&amp;","&",$response);
	$response=str_replace("&quot;","\"",$response);
	$page=$response;		
		
			
    $doc = new DOMDocument();
    @$doc->loadHTML($page); 
    $images_src = array();
			
			if(strpos($url,'draperjames.com')!==FALSE){
				$scriptLists=$doc->getElementsByTagName('script');
				$product='';
				
				foreach($scriptLists as $script){ 
				    
					if($script->getAttribute('type')=='text/javascript'){ 
						if(strpos($script->nodeValue,'tree')!==false){
							$product=$script->nodeValue;
						
						
						}
					}
						
				}
				$start=strpos($product,"{");
				$product=substr($product,$start,(strpos($product,';')-$start)); 
				$jsonId=json_decode($product);
				$jsonList=$jsonId->children;
				
				$tmpId;
				foreach($jsonList as $idx=>$tmp){
					
						$jsonTmp=$jsonList->$idx->children;
						foreach($jsonTmp as $idxEx=>$tmpEx){
							
								$jsonTmp=$jsonTmp->$idxEx->children;
								foreach($jsonTmp as $idxEx=>$tmpEx){
									$tmpId=$idxEx;
									break 3;
								}
						}	
				}
				$images_src=array();
				/* $tmpId;
				foreach($inputs as $input){
					if($input->getAttribute('name')=='id'){
						$tmpId=$input->getAttribute('value')-1;
					}
				} */
				$page = $html = file_get_contents("http://www.draperjames.com/catalog/product/mediaJson/product_id/".$tmpId."/medias/%7B%22medias%22:[%7B%22x%22:%20%22672%22,%22y%22:%20%22896%22,%22r%22:%20%22248%22,%22g%22:%20%22248%22,%22b%22:%20%22248%22%7D,%7B%22x%22:%20%22270%22,%22y%22:%20%22360%22,%22r%22:%20%22255%22,%22g%22:%20%22255%22,%22b%22:%20%22255%22%7D,%7B%22x%22:%20%222100%22,%22y%22:%20%222800%22,%22r%22:%20%22248%22,%22g%22:%20%22248%22,%22b%22:%20%22248%22%7D]%7D"); 
                $pageData = json_decode($page);
				$galleries=$pageData->media_gallery;
				foreach($galleries as $gallery){
					$images_src[]=$gallery->x672y896r248g248b248;
				}
				
			}else if(strpos($url,'amazon.com')!==false){ 
				$images_src=array();
				$scriptLists=$doc->getElementsByTagName('script');
				$product=array();
				foreach($scriptLists as $script){ 
					if($script->getAttribute('type')=='text/javascript'){
						$des=$script->nodeValue;
						if(strpos($des,'colorImages')!==false){
							$product[]=$des;
						}
						
					}
						
				}
				
			    $start=strpos($product[0],'data = '); 
				$part=substr($product[0],$start);
				$end=strpos($part,';'); 
				$json=substr($part,0,$end);
				$json=str_replace("data = ",'',$json);
				$json=str_replace("'",'"',$json); 
				$pageData = json_decode($json); 
				$images=$pageData->colorImages->initial;
				
				foreach($images as $img){
					$images_src[]=$img->hiRes;
				}
				
			}
			elseif(strpos($url, 'saksfifthavenue') !== FALSE){
				$scriptLists=$doc->getElementsByTagName('script');
				$product='';
				$images_src=array();
				foreach($scriptLists as $script){ 
				    //print_r($script);die;
					if($script->getAttribute('type')=='application/json'){
						$product=$script->nodeValue;
						break;
					}
						
				}
				
				$pageData = json_decode($product);
				$productInfo=$pageData->ProductDetails->main_products; 
				$media=$productInfo[0]->media; 
				$hostUrl=$media->images_server_url.$media->images_path;
				
				foreach($media->images as $image){
					
					$images_src[]=$hostUrl.$image;
					
				}
				
				
			}elseif(strpos($url,'finishline')!==false){
				$images_src=array();
				$divs=$doc->getElementsByTagName('div');
				foreach($divs as $div){
					$url=$div->getAttribute('data-large');
					$images_src[]=$url;
				}
				
			}else if(strpos($url,'etsy.com')!==false){
				$images_src=array();
				$lis=$doc->getElementsByTagName('li');
				foreach($lis as $li){
					$url=$li->getAttribute('data-full-image-href');
					$images_src[]=$url;
				}
				
				
			}else if(strpos($url,'luisaviaroma.com')!==false){ 
				$images_src=array();
				$Uls=$doc->getElementsByTagName('ul');
				$finalUl;
				foreach($Uls as $Ui){ 
					if($Ui->getAttribute('id')=='sp_ul_slides'){
						$finalUl=$Ui;
						break;
					}
				}
				$lis=$finalUl->getElementsByTagName('li');
				foreach($lis as $li){ 
					$oriUrl=$li->getAttribute('data-cloudzoom');
					if($oriUrl!==false){
						$start=strpos($oriUrl,"//",strpos($oriUrl,'zoomImage'));
						
						$images_src[]=substr($oriUrl,$start,strpos($oriUrl,"', galleryEvent")-$start);
					}
				}
				
			}else if(strpos($url,'gilt.com')!==false){
				$images_src=array();
				$divs=$doc->getElementsByTagName('div');
				foreach($divs as $div){
					$url=$div->getAttribute('data-zoom-src');
					$images_src[]=$url;
				}
				
			}
			elseif(strpos($url, 'ae.com') !== FALSE){
				$images_src = array();
				$pictures=$doc->getElementsByTagName('picture'); 
				foreach($pictures as $pic){
					$images_src[]='https:'.$pic->getAttribute('data-image').'?$pdp-main$';
					
				}
				
			}
			
			else if (strpos($url, 'uniqlo.com') !== FALSE && strpos($url, 'uk') !== FALSE) {
			    $images_src = array();
			    $meta = element_by_selector($doc, 'meta[property="og:image"]');
			    $images_src[] = format_meta_content($meta);
			    $split = explode('"goodsSubImageList":"', $page);
			    $subImgStr = substr($split[1], 0, strpos($split[1], '"'));
			    $goodId = substr($subImgStr, 0, strpos($subImgStr, '_'));
			    $subImgArr = explode(';', $subImgStr);
			    if (count($subImgArr)) {
    			    $miniPreUrl = "http://im.uniqlo.com/images/uk/pc/goods/" . "$goodId" . "/sub/";
    			    $miniPostUrl = "_mini.jpg";
    			    foreach ($subImgArr as $subImg) {
    			        $images_src[] = $miniPreUrl . "$subImg" . $miniPostUrl;
    			    }
			    }
			}
			
			else {
                if( strpos($url, 'loft') !== FALSE || strpos($url, 'lordandtaylor') !== FALSE ||strpos($url,'michaelkors')!==FALSE||strpos($url,'guess.com')!==FALSE) { 
                    $metas = $doc->getElementsByTagName('meta'); 
                    for ($i = 0; $i < $metas->length; $i++)
                    { 
                        $meta = $metas->item($i);
                        if($meta->getAttribute('property') == 'og:image') {
                           if(strpos($url, 'lordandtaylor') !== FALSE) {
                                $main= trim(str_replace(array('$THUMBLARGE$'), array(''), $meta->getAttribute('content')));
                                $alt1=str_replace('_main','_alt1',$main);
                                $alt2=str_replace('_main','_alt2',$main);							
								$alt3=str_replace('_main','_alt3',$main);	
								array_push($images_src,$main,$alt1,$alt2,$alt3);
								
                            }else if(strpos($url,'michaelkors')!==FALSE){ 
								$main=trim($meta->getAttribute('content')); 
								$alt1=str_replace('_IS','_1',$main);
								$alt2=str_replace('_IS','_2',$main);
								$alt4=str_replace('_IS','_4',$main);
								$alt7=str_replace('_IS','_7',$main);
								array_push($images_src,$alt1,$alt2,$alt4,$alt7);
							}else if(strpos($url,'guess.com')!==FALSE){
								$main=trim($meta->getAttribute('content')); 
								$end=strpos($main,'?$');
								$alt1=substr($main,0,$end).'-ALT1'.substr($main,$end);
								$alt2=substr($main,0,$end).'-ALT2'.substr($main,$end);
								$alt3=substr($main,0,$end).'-ALT3'.substr($main,$end);
								array_push($images_src,$main,$alt1,$alt2,$alt3);
							}
							
                            else {
                                $images_src[] = trim($meta->getAttribute('content'));
                            }
                        } 
						
                    }
//THIS IS WHERE ZARA.COM, MANGO.COM SITE STRUCTURE IMAGE DATA IS GATHERED
                } else {
					$flag=true;
                    $images = $doc->getElementsByTagName('img'); 
                    $attr = 'src';
                    $images_src = array(); 
					foreach ($data_href_sites as $site){
						 if(strpos($url,$site) !== FALSE){
							$href_list=$doc->getElementsByTagName('a'); 
							$images_src=fetchHref($href_list,$images_src,$url);
							$flag=false;
						 }
						
					}foreach($data_href_largeImage_sites as $site){
						if(strpos($url,$site) !== FALSE){
							$href_list=$doc->getElementsByTagName('a'); 
							$images_src=fetchHrefImage($href_list,$images_src,$url);
							$flag=false;
						 }

					}
					if($flag){ 
					foreach ($data_large_sites as $site){
						if(strpos($url,$site) !== FALSE){
							$attr='data-large';
						}
						
					}
					foreach ($data_zoom_url_sites as $site){
						if(strpos($url,$site) !== FALSE){
							$attr='data-zoom-url';
						}
						
					}
					foreach ($data_sites as $site){
						if(strpos($url,$site) !== FALSE){
							$attr='data';
						}
						
					}
					foreach($data_zoom_sites as $site){
						if(strpos($url,$site) !== FALSE){
							$attr='data-zoom';
						}
						
					}
					foreach($data_imgrul_sites as $site){
						if(strpos($url,$site) !== FALSE){
							$attr='data-imgurl';
						}
					}
					foreach($data_large_image_sites as $site){
						if(strpos($url,$site) !== FALSE){
							$attr='data-large-image';
						}
					}
                    foreach($data_src_sites as $site) {
                        if(strpos($url,$site) !== FALSE) {//use data-src as the entered site is from the array
                            $attr = 'data-src';
                            break;
                        }
                    }
					
					foreach($data_zoom_image_sites as $site) {
                        if(strpos($url,$site) !== FALSE) {//use data-src as the entered site is from the array
                            $attr = 'data-zoom-image';
                            break;
                        }
                    }
                    foreach($data_detailurl as $site) {
                        if(strpos($url,$site) !== FALSE) {//use data-detailurl as the entered site is from the array
                            $attr = 'data-detailurl';
                            break;
                        }
                    }
					
                    foreach($data_imageSourceMob as $site) {
                        if(strpos($url,$site) !== FALSE) {//use data-detailurl as the entered site is from the array
                            $attr = 'data-imagesourcemob';
                            break;
                        }
                    }
					
                    foreach ($images as $image) {
						
                        $src = $image->getAttribute($attr); 
						
                        if (trim($src) != ''&&strpos($src,'gif')==FALSE&&strpos($src,'svg')==FALSE) { 
                            if (strpos($url, 'henribendel') !== FALSE) { 
                                $src = trim(substr(trim($src), 0, strrpos(trim($src), '?')));
                            } else if (strpos($url, 'sephora') !== FALSE) {
                                $src = str_replace(array('thumb-50','thumb50','Lthumb'), array('hero-300','hero300','hero-300'), trim($src));
								if(strpos($src,'-main-grid')!==false||strpos($src,'+sw.jpg')!==false||strpos($src,'startimage')!==false||strpos($src,'.jpg')===false){
									continue;
								}
								
                            } else if (strpos($url, 'nordstrom.com') !== FALSE) { 
                                $src = str_replace(array('product/Mini'), array('product/Gigantic'), trim($src));
								$src = str_replace('w=60&h=90','w=380&h=583',trim($src));
                            } else if (strpos($url, 'shopbop') !== FALSE) {
                                $src = str_replace(array('_UX37_'), array('_UX530_'), trim($src));
								if(strpos($src,'UX220_QL90')!==false){
									continue;
								}
                            } else if (strpos($url, '6pm') !== FALSE) {
                                $src = str_replace('_THUMBNAILS','',trim($src));
							} else if(strpos($url, 'freepeople') !== FALSE){
								$src = str_replace('$alt-thumbnail$','',trim($src));
							} else if(strpos($url,'allsaints')!==FALSE){
								if(strpos($src,'320')!==FALSE){
								    continue;	
								}
							}else if(strpos($url,'ninewest')!==FALSE||strpos($url,'bloomingdales')!==FALSE){
								if(preg_match('/\.[a-z]{3}\?/',$src)){ 
									$index=strpos($src,'?');
									$src=substr($src,0,$index); 
								}
							}else if(strpos($url,'clubmonaco')!==FALSE){
								$index=strpos($src,'$flyout_main$');
								if($index!==false){
									$main=substr($src,0,$index-1).'?$flyout_main$&iv=6Dnrd0&wid=1650&hei=1650&fit=fit,1';
									if(!in_array($main, $images_src)){
										$alt1=str_replace('lifestyle','alternate1',$main);
										$alt2=str_replace('lifestyle','alternate2',$main);
										$alt3=str_replace('lifestyle','alternate3',$main);
										$alt4=str_replace('lifestyle','alternate4',$main);
										array_push($images_src,$main,$alt1,$alt2,$alt3,$alt4);
										
									}
									
								}else {
									continue;
								}
								
							}else if(strpos($url,'anthropologie')!==FALSE){
								if(strpos($src,'$pdp-detail-thumb$')!==false){
									$src=str_replace('$pdp-detail-thumb$','$redesign-zoom-5x$',$src);
									
								}else{
									continue;
								}
							}
							else if(strpos($url,'bananarepublic.gap')!==false){
								if(strpos($src,'.png')!==false){
									continue;
								}
							}
							else if(strpos($url,'bodenusa.com')!==false){ 
								if(strpos($src,'productSmall')!==false){
									$src=str_replace('productSmall','productLarge',$src);
								}else{
									continue;
								}
								
								
							}else if(strpos($url,'gucci.com')!==false){
								if(strpos($src,'2400')===false){
									continue;
								}
							}
							
							else if(strpos($url,'charlotterusse')!==FALSE){
								if(preg_match('/\?hei=/',$src)){ 
									$index=strpos($src,'?');
									$src=substr($src,0,$index); 	
								}
							}else if(strpos($url,'vince')!==false){
								$alt1=str_replace('medium','malt1',$src);
								$alt2=str_replace('medium','malt2',$src);
								$alt3=str_replace('medium','malt3',$src);
								$alt4=str_replace('medium','malt4',$src);
								array_push($images_src,$alt1,$alt2,$alt3,$alt4);
							}else if(strpos($url,'blueandcream')!==false){
								$src='mm5/'.$src;
							}else if(strpos($url,'calvinklein')!==false){
								if(strpos($src,'main')!==false){
									$begin=strpos($src,'?wid');
									$src=substr($src,0,$begin).'?wid=1280&hei=1687';
								}
								$alt1=str_replace('main','alternate1',$src);
								$alt2=str_replace('main','alternate2',$src);
								$alt3=str_replace('main','alternate3',$src);
								$alt4=str_replace('main','alternate4',$src);
								array_push($images_src,$src,$alt1,$alt2,$alt3,$alt4);
								
							}else if(strpos($url,'needsupply')!==false){
								
								$src=str_replace('thumbnail/70x90','image/610x783',$src);
								if(strpos($src,'thumbnail')!==false){
									continue;
								}
								
							}else if(strpos($url,'riverisland')!==false){
								$src=str_replace('$AltThumbNail$','',$src);
							}
							else if(strpos($url,'selfridges')!==false){ 
								$src=str_replace('?$PDP_TMB$','',$src); 
							}else if(strpos($url,'hm.com')!==false){
								if(strpos($src,'file:/product/style')!==false){
									continue;
								}
								
							}else if(strpos($url,'prada')!==false){
								if(strpos($src,'zoom')!==false){
									continue;
								}
							}
							else if(strpos($url,'boutiquetoyou')!==false){ 
								if(strpos($src,'ProductThumbnail')!==false){ 
									$src=str_replace('ProductThumbnail','ProductLarge',$src); 
								}else{
									continue;
								}
							}else if(strpos($url,'matchesfashion.com')!==false){
								if(strpos($src,'size-fit/WW-SIZE-FIT')!==false||strpos($src,'countryPopup')!==false||strpos($src,'img/product')===false){ 
									continue;
								}
								
							}else if(strpos($url,'madewell.com')!==false){
								if(strpos($src,'?$pdp')!==false){
									$src=substr($src,0,strpos($src,'?$pdp'));
								}
							}else if(strpos($url,'zimmermannwear.com')!==false){ 
								if(strpos($src,'menu/')!==false||strpos($src,'galleryimages')!==false||strpos($src,'work-with-us')!==false){
									continue;
								}
							}else if(strpos($url,'johnlewis.com')!==false){
								if(strpos($src,'$prod_main$')===false){
									continue;
								}else{
									$src=substr($src,0,strpos($src,'?$prod_main$'));
								}
								
							}else if(strpos($url,'dolcegabbana.com')!==false){
								$src=str_replace('_11_','_13_',$src);
								
							}else if(strpos($url,'urbanoutfitters')!==false){
								if(strpos($src,'defaultImage')===false||strpos($src,'/swatches/')!==false){
									continue;
								}
								
							}else if(strpos($url,'nordstromrack.com')!==false){ 
								if(strpos($src,'?interpolation')!==false&&strpos($src,'large')!==false){
									$src=substr($src,0,strpos($src,'?interpolation'));
								}
								
							}else if(strpos($url,'target.com')!==false){
								if(strpos($src,'wid=150&hei=150')!==false||strpos($src,'wid=450&hei=450')!==false){
									continue;
								}
								$src=str_replace('?wid=290&hei=290&qlt=70&fmt=pjpeg','',$src);
							}else if(strpos($url,'marcjacobs.com')!==false){
								if(strpos($src,'_Flyouts_')!==false){
									continue;
								}
								
							}else if(strpos($url,'buckle.com')!==false){
								$src=substr($src,0,strpos($src,'?width'));
							}
                            if (!in_array($src, $images_src)){ 
                                $images_src[] = trim($src);
							}	
                        }
                    }
                    }
                    $cleaned_images = array();
                    for ($j = 0; $j < count($images_src); $j++) {
                        $invalidImage = 0;
                        for ($i = 0; $i < count($banned_strings); $i++) {
                            if (strpos(strtolower($images_src[$j]), strtolower($banned_strings[$i])) !== FALSE) {
								
                                $invalidImage = 1;
                                break;
                            }
                        }
                        if ($invalidImage == 0) {
                            $cleaned_images[] = $images_src[$j];
							
                        }
                    }
                    $images_src = $cleaned_images; 
					
				}
			}
			$rst=array();
			for ($j = 0; $j < count($images_src); $j++) { 
				$image =makeUrl($images_src[$j],$url); 
				$image = str_replace(' ', '%20', $image);
				$rst[]=$image;
			}    
			
			$rst = imageReorder($rst, $url);
             
            return $rst;        
			}
	
	function getBaseUrl($hst){
        $urlData = parse_url ( $hst);
        $baseurl= $urlData['scheme'].'://'.$urlData['host'].'/'; 
        return $baseurl;
    }
	
	
	function makeUrl($ImageUrl,$hst){
		if(strpos($ImageUrl,'myaddrproxy.php')!==false){
			$index=strpos($ImageUrl,'http');
			$ImageUrl=str_replace('http/','http://',substr($ImageUrl,$index));	
		}
        //return $url.'<br>';
        $baseUrl = getBaseUrl($hst); 
        if (trim(substr($ImageUrl,0,2))=='//'){
            return 'http:'.$ImageUrl;

        } else if (substr($ImageUrl,0,1)=='/'){
            $url = trim($ImageUrl,'/');  
            return $baseUrl.$url;

        } else if (strpos($ImageUrl,'http') === false) {
            $url = trim($ImageUrl,'/');
            return $baseUrl.$url;
        } else{
            return $ImageUrl;
        }
        
    }
	function fetchHref($originList,$dstList,$url){
		$i=0;
		foreach($originList as $aHref){
			
			$attr=makeUrl($aHref->getAttribute('href'),$url); 
			$length=strlen($attr)-4;
			if($length>0){
				if(strpos($attr,'.jpg')!==FALSE||strpos($attr,'.png')!=FALSE||strpos($attr,'$')!==FALSE||strpos($attr,'image')!==FALSE||strpos($attr,'img404')!==FALSE){
					if (!in_array(($attr), $dstList)){ 
						$index=strpos($attr,"http://");
						if($index!==FALSE){
							$attr=rtrim(substr($attr,$index),'\');');
						}
						if(strpos($url,'heels.com')!==false){
							if($i===0){
								$i++;
								continue;
							}
							
						}
						array_push($dstList,$attr);
						
					}
				}
			}
			
		}
		
		return $dstList;
		
	}
	function fetchHrefImage($originList,$dstList,$url){
		foreach($originList as $aHref){
			$attr=makeUrl($aHref->getAttribute('largeimage'),$url); 
			array_push($dstList,$attr);

		}
		return $dstList;
		
	}
	
	/**
	 * Reorder scraped image to make main product image return first
	 * @param $image_src_arr : array, array of scraped image source 
	 * @param $url : string, scraping url
	 * @return array, reordered array of image source
	 */
	function imageReorder($image_src_arr, $url) {
	    if (strpos($url, 'matchesfashion.com') !== FALSE) {
	        $productId = strrev(substr(strrev($url), 0, strpos(strrev($url), '-')));
	        foreach ($image_src_arr as $k => $v) {
	            if (strpos($v, '/' . $productId . '_1_large')) {
	                $tmp = $image_src_arr[$k];
	                $image_src_arr[$k] = $image_src_arr[0];
	                $image_src_arr[0] = $tmp;
	            }
	        }
	    }
	    
	    return $image_src_arr;
	}
	
?>