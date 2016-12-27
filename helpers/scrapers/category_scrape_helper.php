<?php

	function scrape_title($doc,$url,$brand){ 
			$finalTitle='';
			if(strpos($url, 'solesociety.com') !== FALSE) {
				$pNodes = $doc->getElementsByTagName('p');
				foreach ($pNodes as $pNode) {
					if ($pNode->getAttribute('class') == 'short-description') {
						$finalTitle = $pNode->nodeValue;
						break;
					}
				}
				if($finalTitle==''){
					$title = $doc->getElementsByTagName('meta');
					foreach ($title as $titleNode) {
						if ($titleNode->getAttribute('property') == 'og:title') { 
							$finalTitle = $titleNode->getAttribute('content'); 
							break;
						}
							
					}
				}
            }else if(strpos($url,'theoutnet.com')!==false||strpos($url,'hugoboss.com')!==false||strpos($url,'tradesy.com')!==false){
				$title=$doc->getElementsByTagName('meta');
				foreach ($title as $titleNode) {
					if(strpos($url,'theoutnet.com')!==false){
						if ($titleNode->getAttribute('name') == 'title'){ 
							$finalTitle=$titleNode->getAttribute('content');				
							break;
						}
					}
					if(strpos($url,'hugoboss.com')!==false||strpos($url,'tradesy.com')!==false){
						if ($titleNode->getAttribute('itemprop') == 'name'){ 
							$finalTitle=$titleNode->getAttribute('content');				
							
						}
					}
							
				}
				
			}else if(strpos($url,'luisaviaroma.com')!==false||strpos($url,'zara.com')!==false){
				$span=$doc->getElementsByTagName('span');
				foreach ($span as $spanNode) {
					if ($spanNode->getAttribute('itemprop') == 'name'||$spanNode->getAttribute('itemprop') == 'title'){ 
							$finalTitle=$spanNode->nodeValue;					
						}
				}
				
			}else if(strpos($url,'bysymphony.com')!==false){
				$pNodes = $doc->getElementsByTagName('p');
				foreach ($pNodes as $pNode) {
					if ($pNode->getAttribute('itemprop') == 'name') {
						$finalTitle = $pNode->nodeValue;
						break;
					}
				}
				
			}else if(strpos($url,'wonhundred.com')!==false){
				$pNodes = $doc->getElementsByTagName('div');
				foreach ($pNodes as $pNode) {
					if ($pNode->getAttribute('property') == 'content:encoded') { 
						$finalTitle = $pNode->nodeValue;
						break;
					}
				}
				
				
			}else if(strpos($url,'antonioli')!==false){
				$pNodes = $doc->getElementsByTagName('meta');
				foreach ($pNodes as $pNode) {
					if ($pNode->getAttribute('name') == 'description') { 
						$finalTitle = $pNode->getAttribute('content');
						$finalTitle=substr($finalTitle,0,strpos($finalTitle,' - '));
						break;
					}
				}
			}else if(strpos($url,'lordandtaylor.com')!==false){
				$pNodes = $doc->getElementsByTagName('meta');
				foreach ($pNodes as $pNode) {
					if ($pNode->getAttribute('name') == 'keyword') { 
						$finalTitle = $pNode->getAttribute('content');
						break;
					}
				}
			}
			else{  
				$title = $doc->getElementsByTagName('h1'); 
				$ti = 0;
				foreach ($title as $titleNode) {
					if((strpos($url,'aeo.com'))!==false||strpos($url,'ae.com')!==false){
						$finalTitle = str_replace('AEO','',$titleNode->nodeValue);
						break;
					}else if(strpos($url,'abercrombie.com')!==false){
						$finalTitle = str_replace('A&F','',$titleNode->nodeValue);
						break;
					}
					else if (strpos($url,'dkny.com')!==false||strpos($url,'gilt.com')!==false||strpos($url,'chicos.com')!==false) {
						if ($titleNode->getAttribute('class') == 'product-name') {
							$finalTitle = $titleNode->nodeValue;
							break;
						}
					}else if(strpos($url,'revolve')!==false){
						if($titleNode->getAttribute('property')=="name"){
							$finalTitle = $titleNode->nodeValue; 
							break;
						}
					} 
					else if (strpos($url, 'saksfifthavenue') !== FALSE) {
						if ($titleNode->getAttribute('class') == 'short-description component component-1') {
							$finalTitle = $titleNode->nodeValue;
							break;
						}
					} else if (strpos($url, 'ralphlauren') !== FALSE) { 
						if ($titleNode->getAttribute('class') == 'prod-title') {
							$finalTitle = $titleNode->nodeValue; 
							break;
						}
					} else if (strpos($url, 'agacistore') !== FALSE||strpos($url,'bcbg.com')!==false||strpos($url, 'vince.com') !== FALSE||strpos($url,'puma.com')!==false||strpos($url, 'rebeccataylor.com') !== FALSE||strpos($url, 'chicwish.com') !== FALSE||strpos($url,'louisvuitton.com')!==false) {
						if ($titleNode->getAttribute('itemprop') == 'name') {
							$finalTitle = $titleNode->nodeValue;
							break;
						}
					} else if (strpos($url, 'robertocavalli') !== FALSE) {
						if ($ti == 2) {
							$finalTitle = $titleNode->nodeValue;
							break;
						}
					} else if(strpos($url, 'gap.com') !== FALSE){
						 if ($titleNode->getAttribute('class') == 'product-title') {
							 $finalTitle = $titleNode->nodeValue;
							 break;
						 }
					}else if (strpos($url, 'henribendel') !== FALSE) {
						if ($ti == 3) {
							$finalTitle = $titleNode->nodeValue;
							break;
						}
					} else if (strpos($url, 'monnierfreres') !== FALSE) {
						$finalTitle = $titleNode->getAttribute('title');
						break;
					} else if(strpos($url, 'dailylook.com') !== FALSE){
						 if ($titleNode->getAttribute('class') == 'header') {
							 $finalTitle = $titleNode->nodeValue;
							 break;
						 }
						
					}else if(strpos($url, 'pacsun.com') !== FALSE||strpos($url,'guess.com')!==false||strpos($url,'dolcegabbana.com')!==false||strpos($url,'amazon.com')!==false||strpos($url,'talbots.com')!==false){
						$finalTitle = $titleNode->nodeValue;
						
						break;
					}
					$ti++;
				}
				if (strpos($url, 'prada') !== FALSE || strpos($url, 'boutiquetoyou') !== FALSE || strpos($url, 'fashionproject') !== FALSE ||  strpos($url, 'chicos') !== FALSE || strpos($url, 'jcrew') !== FALSE || strpos($url, 'italist') !== FALSE || strpos($url, 'ninewest') !== FALSE||strpos($url, 'valentino') !== FALSE||strpos($url, 'hm.com') !== FALSE||strpos($url, 'fendi') !== FALSE||strpos($url,'michaelkors')!==false||strpos($url, 'lanecrawford.com') !== FALSE||strpos($url, 'blueandcream.com') !== FALSE||strpos($url, 'fwrd.com') !== FALSE||strpos($url, 'buckle.com') !== FALSE||strpos($url,'thredup.com')!==false||strpos($url,'shein.com')!==false||strpos($url,'armani.com')!==false||strpos($url,'barneys')!==false) { 
					$ti = 0;
					$titleTag = 'h2';
					if(strpos($url, 'boutiquetoyou') !== FALSE)
						$titleTag = 'h3';
					if(strpos($url, 'fashionproject') !== FALSE || strpos($url, 'chicos') !== FALSE || strpos($url, 'italist') !== FALSE || strpos($url, 'ninewest') !== FALSE||strpos($url, 'buckle.com') !== FALSE)
						$titleTag = 'div';
					if(strpos($url, 'jcrew') !== FALSE ||strpos($url, 'valentino') !== FALSE||strpos($url, 'hm.com')!==false||strpos($url, 'fendi') !== FALSE||strpos($url,'michaelkors')!==false)
						$titleTag = 'meta';
                                        if(strpos($url, 'fwrd') !== FALSE)
						$titleTag = 'p';
							
					$title = $doc->getElementsByTagName($titleTag);
					foreach ($title as $titleNode) {
						if(strpos($url, 'blueandcream.com') !== FALSE){
							if ($titleNode->getAttribute('class') == 'designers text-center') {
								$finalTitle = $titleNode->nodeValue;
								break;
							}
						}else if(strpos($url, 'fwrd.com') !== FALSE){
							if ($titleNode->getAttribute('class') == 'product_name') {
								$preTitle = $titleNode->nodeValue;
                                                                $finalTitle = str_ireplace('Fwrd','',$preTitle);
								break;
							}
						}else if (strpos($url, 'barneys') !== FALSE) {
                                                  if ($titleNode->getAttribute('class') == 'product-title') {
                                                          $finalTitle = $titleNode->nodeValue;
                                                          break;
                                                        }
                                                }
						else if (strpos($url, 'lanecrawford.com') !== FALSE||strpos($url,'thredup.com')!==false) {
							if ($titleNode->getAttribute('itemprop') == 'name') {
								$finalTitle = $titleNode->nodeValue;
								break;
							}
						} else if (strpos($url, 'boutiquetoyou') !== FALSE) {
							if($ti == 2) {
								$finalTitle = trim($titleNode->nodeValue);
								break;
							}
						} else if (strpos($url, 'fashionproject') !== FALSE) {
							if ($titleNode->getAttribute('class') == 'id_title') {
								$finalTitle = $titleNode->nodeValue;
								break;
							}
						} else if (strpos($url, 'italist') !== FALSE||strpos($url, 'buckle.com') !== FALSE) {
							if ($titleNode->getAttribute('itemprop') == 'name') {
								$finalTitle = $titleNode->nodeValue;
								break;
							}
						} else if (strpos($url, 'chicos') !== FALSE) {

							if ($titleNode->getAttribute('id') == 'product-name') {
								$finalTitle = $titleNode->nodeValue;
								break;
							}
						} else if (strpos($url, 'ninewest') !== FALSE) {

							if ($titleNode->getAttribute('class') == 'pNameHOne name') {
								$finalTitle = $titleNode->nodeValue;
								break;
							}
						} else if (strpos($url, 'jcrew') !== FALSE||strpos($url, 'valentino') !== FALSE||strpos($url, 'hm.com') !== FALSE||strpos($url, 'fendi') !== FALSE||strpos($url,'michaelkors')!==false) { 
							if ($titleNode->getAttribute('property') == 'og:title') { 
								$finalTitle = $titleNode->getAttribute('content');  
								break;
							}
						}elseif(strpos($url,'armani.com')!==false){
							if($titleNode->getAttribute('class')=='productName'){
								$finalTitle = $titleNode->nodeValue;
								break;
							}
							
						}
						else if (trim($titleNode->nodeValue) != '') { 
							$finalTitle = trim($titleNode->nodeValue);
							break;
						}
						$ti++;
					} 
				}else if($finalTitle==''){  
					$title = $doc->getElementsByTagName('meta');
					foreach ($title as $titleNode) {
						if(strpos($url,'net-a-porter')!==false){
							if($titleNode->getAttribute('itemprop') == 'name'){
								$finalTitle = $titleNode->getAttribute('content'); 
								break;
							}
						}
                                                if(strpos($url,'asos.com')!==false){
							if($titleNode->getAttribute('property') == 'og:title'){
                                                                $replaceList= array('at asos.com','asos');
								$preTitle = $titleNode->getAttribute('content');
                                                                $replaceTitle = str_ireplace($replaceList,array('',''),$preTitle);
                                                                if(strpos($replaceTitle,'SAVE') !== false){
                                                                    $savePosition = strpos($replaceTitle,'SAVE');
                                                                    $finalTitle = substr($replaceTitle,0,$savePosition);
                                                                }
                                                                else{
                                                                    $finalTitle=$replaceTitle;
                                                                }
                                                                break;
							}
						}
						else { 
							if ($titleNode->getAttribute('property') == 'og:title') { 
								$finalTitle = $titleNode->getAttribute('content'); 
								break;
							}
							if ($titleNode->getAttribute('name') == 'og:title'||$titleNode->getAttribute('name') == 'keywords') { 
								$finalTitle = $titleNode->getAttribute('content'); 
								
							}
						}
					}
					
				}
            }
			if(strpos($url,'hugoboss.com')!==false){
				$start=strpos($finalTitle,' | ');
				if($start!==false){
					$finalTitle = trim(substr($finalTitle,$start+2));
				}
				
			}
			//echo $finalTitle;die;
            if(strpos($finalTitle,' - ')!==false){
				if(strpos($url,'stylebop.com')===false&&strpos($url,'ssense.com')===false&&strpos($url,'heels.com')===false&&strpos($url,'versace.com')===false&&strpos($url,'saksfifthavenue')===false){ 
					$finalTitle=trim(substr($finalTitle,0,strpos($finalTitle,' - '))); 
				}
			}
			
			if(strpos($finalTitle,' | ')!==false){
				if(strpos($url,'fendi.com')===false){ 
					
					$finalTitle = trim(substr($finalTitle,0,strpos($finalTitle,' | ')));
				} 
			}
			//echo $finalTitle;die;
			/* foreach(str_split($finalTitle) as $i=>$d){
						echo $i.' '.$d.'<br/>';
					}die; */
			$title=convertSpecialChars(trim($finalTitle));
			return trimBrand($title,$brand);
            
	}
	function getMenu($doc,$url){
		$xpath = new DOMXpath($doc);
		$result='';
		$nodes=array();
		if(strpos($url,'mytheresa')!==false||strpos($url,'riverisland')!==false){
			$nodes=$xpath->query('//div[@class="breadcrumbs"]');
			$result=$nodes[0]->nodeValue;
		}
		else if(strpos($url,'zappos')!==false){
			$nodes=$xpath->query('//div[@id="breadcrumbs"]');
			$result=$nodes[0]->nodeValue;
		}
		else if(strpos($url,'farfetch')!==false){
			$nodes=$xpath->query('//div[@id="divBreadCrumbInformation"]');
			$result=$nodes[0]->nodeValue;
		}else if(strpos($url,'express.com')!==false){
		    
			$nodes=$xpath->query('//nav[@class="_1HSQ"]');
			$result=$nodes[0]->nodeValue;
		}else if(strpos($url,'clubmonaco.com')!==false){
			$nodes=$xpath->query('//ul[@class="breadcrumbs page-path"]');
			$result=$nodes[0]->nodeValue;
			$result=str_replace('/','',$result);
		}else if(strpos($url,'calvinklein.com')!==false){
			$nodes=$xpath->query('//div[@class="breadcrumb span12 "]');
			$result=$nodes[0]->nodeValue;
			
		}else if(strpos($url,'gucci.com')!==false){
			$nodes=$xpath->query('//nav[@class="breadcrumb category-breadcrumb"]');
			$result=$nodes[0]->nodeValue;
			
		}else if(strpos($url,'zimmermannwear.com')!==false){
			$nodes=$xpath->query('//ol[@class="breadcrumb breadcrumb-muted col-md-10 col-md-offset-1"]');
			$result=$nodes[0]->nodeValue;
		}
		
		
		return $result;
		
		
	}
	 function convertSpecialChars($finalTitle){
		$list = get_html_translation_table(HTML_ENTITIES);
		unset($list['"']);
		unset($list['<']);
		unset($list['>']);
		unset($list['&']);
		$search = array_keys($list);
		$values = array_values($list);
		$search = array_map('utf8_encode', $search);
		$str_out = str_replace($search, $values,$finalTitle);
		return $str_out;
	}

	 function trimBrand($title,$brand){
		if($brand!=='EMPORIO ARMANI'){
			$brand=strtolower(trim($brand));
			$title=strtolower($title); 
		}
		$title=str_replace("&lt;","<",$title);
		$title=str_replace("&gt;",">",$title);
		$title=str_replace("&amp;","&",$title);
		$title=str_replace("&quot;","\"",$title);
		if($brand=='j.o.a.'){
			$brand=substr($brand,0,strlen($brand)-1);
			
		}
		$times=substr_count($title,$brand);
		for($i=0;$i<$times;$i++){ 
			$title=str_replace($brand.' ','',$title);
			$title=str_replace(' '.$brand,'',$title);
		}
		
		$title=trim(str_replace(array('buy ','- ',',','|','||',':','by ','women’s','men’s','womens',"women's",'women',"men's",' mens ',' men ',"boys'","girls'",' by',"/",' for '),'',$title));
		
		$sign=strpos($title,'$');
	    if($sign!==false){
			$title=substr($title,0,$sign);
		}//echo htmlspecialchars($title);die;
		
		$buy=strpos($title,', buy');
		if($buy!=false){ 
			$title=substr($title,0,$buy);
		}
		
		$start;

		
		if(strpos($title,"-")!==false){
			$items=explode("-",$title);
			
			for($i=0;$i<count($items);$i++){
				if($i===0){
					$title=ucwords($items[$i]);
				}
				else{
					$title=$title.'-'.ucwords($items[$i]);
				}
			}
			
		}
		//echo $title;die;
		return trim(ucwords($title));
	}
	function scrape_category($scraping_model, $doc,$url,$description,$brand){
		if (is_subclass_of($scraping_model, 'Common_Model')) {
			$scraping_model->load->helper(array('scraping', 'category'));
		} else {
			require_once APPPATH.'/helpers/category_helper.php';
		} 

		$description=strip_tags($description);
		$description=str_replace("\t",' ',$description);
		$description=str_replace("\n",' ',$description);
		$description=str_replace("\r",' ',$description);
		
		$title=scrape_title($doc,$url,$brand); 
		
		if(strpos($url,'louisvuitton.com')!==false||strpos($url,'zara.com')!==false||strpos($url,'zappos')!==false||strpos($url,'christianlouboutin.com')!==false||strpos($url,'christianlouboutin.com')!==false){
			$description=$description." ".$title;
			
		}else if(strpos($url,'mytheresa.com')!==false||strpos($url,'clubmonaco.com')!==false||strpos($url,'gucci.com')!==false||strpos($url,'zimmermannwear.com')!==false||strpos($url,'calvinklein.com')!==false){
			$description_used=getDescriptionUsed($description);
			$description=$description_used." ".$title." ".getMenu($doc,$url);;
		}else if(strpos($url,'express.com')!==false){
			$description=$title." ".getMenu($doc,$url);
		}else if(strpos($url,'romwe.com')!==false||strpos($url,'shein.com')!==false){
			$description=$title;
		}else if(strpos($url,'theoutnet.com')!==false){
			$elements = query_selector($doc, 'li#details-section div.tab-details li');
            foreach ($elements as $element) {  
				$description=dom_format_text($element).'<br/>';
				break;
            }
			$description=$description.' '.$title;
          
		}else if(strpos($url,'tobi.com')!==false||strpos($url,'trade-mark.com')!==false||strpos($url,'net-a-porter.com')!==false){
			$end=strpos($description,'.',strpos($description,'.')+1);
			$description=substr($description,0,$end).'. '.$title;
		}
		else {
			$description_used=getDescriptionUsed($description);
			$description=$description_used." ".$title;
		}
                
		$category=retriveCategory($description);
		$categoryTmp=array();
		$categoryFinal=array();
		if(in_array('Women > Clothing > Tops',$category)){
			$categoryTmp=retriveCategory($title);
		}
		//print_r($categoryTmp);die;
		if(!in_array('Women > Clothing > Tops',$categoryTmp)){
			foreach($category as $cat){
				if($cat=='Women > Clothing > Tops'){
					continue;
				}
				else {
					$categoryFinal[]=$cat;
				}
			}
		}else {
			$categoryFinal=$category;
		}
                if (count($categoryFinal) == 0) {
                    $title_arr = explode(' ', strtolower($title));
                    foreach ($title_arr as $keyword) {
                        if (strcmp($keyword, 'stud') == 0 || strcmp($keyword, 'studs') == 0) {
                            $categoryFinal[] = 'Women > Accessories > Jewelry > Earrings';
                        }
                    }
                }
		$categoryEx=array();
		
		$categoryGuid=matchCategoryGuid($categoryFinal);
		for($i=0;$i<count($categoryFinal);$i++){
			$categoryEx[]=array('ItemMasterCategoryGuID'=>$categoryGuid[$i], 'Name'=>$categoryFinal[$i]);
		}
		return $categoryEx;
		
		
		
	}
	function scrape_storeID($url){
		$exist=strpos($url,'www.');
		if($exist===false){
			$url=substr($url,0,strpos($url,'//')+2).'www.'.substr($url,strpos($url,'//')+2);
		}
		$start=strpos($url,'.');
		$end=strpos($url,'/',$start+1);
		return ucfirst(substr($url,$start+1,$end-$start-1));
	}
	 function getDescriptionUsed($description){
		preg_match_all('/[0-9]+\.[0-9]+/',$description,$matches);
		$fixMatches=array();
		foreach ($matches as $value) {
			$fixMatches[]=str_replace('.','',$value);
    
		}
		$description=str_replace($matches[0],$fixMatches[0],$description);
		if(strpos($description,'.com')!==false){
			$description=str_replace_limit('.','',$description,1);
		}
		//$periodIndex=strpos($description,".");
		//$exclamationIndex=strpos($description,"!");
                
                $firstPeriod=strpos($description,".");
		$periodIndex=strpos($description,".",$firstPeriod+1);
                
                $firstExclamation=strpos($description,"!");
		$exclamationIndex=strpos($description,"!",$firstExclamation+1);
		
		
		if($periodIndex!==false&&$exclamationIndex!==false){
			$index=min($periodIndex,$exclamationIndex);
		}
		if($periodIndex!==false&&$exclamationIndex===false){
			$index=$periodIndex;
		}
		if($periodIndex===false&&$exclamationIndex!==false){
			$index=$exclamationIndex;
		}
		if($periodIndex===false&&$exclamationIndex===false){
			$index=strlen($description);
		}
		$description_used=substr($description,0,$index+1);
		
		return $description_used; 
		
		
	}
	 function str_replace_limit($search, $replace, $subject, $limit=-1){  
		if(is_array($search)){  
			foreach($search as $k=>$v){  
				$search[$k] = '`'. preg_quote($search[$k], '`'). '`';  
		   }  
		}else{  
			$search = '`'. preg_quote($search, '`'). '`';  
		}  
		return preg_replace($search, $replace, $subject, $limit);  
	}  
	
	function scrape_bot_tags($scraping_model,$doc,$url/*,$title,$content*/){
		if (is_subclass_of($scraping_model, 'Common_Model')) {
			$scraping_model->load->helper(array('scraping', 'category'));
                        //$scraping_model->load->helper(array('scraping', 'brand'));
		} else {
			require_once APPPATH.'/helpers/category_helper.php';
                        //require_once APPPATH.'/helpers/brand_helper.php';
		}
		$tags='';
		$brandCatsMix=array();
		if(strpos($url,'notjessfashion')!==false){
			$elements = query_selector($doc, 'div.post_content p strong,div.post_content p a');
			
			foreach($elements as $element)	{
				$e=$element->nodeValue;
				if(!empty(trim($e))){
					$tags=$tags.'/'.$e;
					
				}
					
						
			
			}
			//echo $tags;die;
			
			$brandCatsMix=brandCatSplit($tags,'/');
		
		}
		else if(strpos($url,'takeaim')!==false){
			$elements = query_selector($doc, 'p a');
			
			foreach($elements as $element)	{	  
					$node=$element->nodeValue;
					if(strpos($node,'http')===false){
						$brandCatsMix[]=$node;
					}
				}
			
			
		}
		else if(strpos($url,'blankitinerary')!==false){
			$elements = query_selector($doc, 'p');
			foreach($elements as $element)	{	  
				$node=$element->nodeValue;
				if(strpos(strtolower($node),'wearing')!==false){
					$tags=$node;
				}
			}
			$brandCatsMix=brandCatSplit($tags,'|');
			
		}
		else if(strpos($url,'somamagazine')!==false){
			$elements = query_selector($doc, 'p.p1');
			$elementsEx=query_selector($doc, 'p.p2,p.p1,div.content p');
			
			foreach($elementsEx as $element)	{
				
				$tmpBrand=array();
				$tmpCat=array();
				foreach($element->childNodes as $e){
					//print_r($e);echo '<br/>';
					if($e->nodeType==1){ 
						if(!empty(trim($e->nodeValue!==''))){
							
							$tmpBrand[]=$e->nodeValue;
						}
					}else { 
						
						$tmpCat[]=$e->nodeValue;
					}
				}
				
				for($i=0,$n=min(count($tmpCat),count($tmpBrand));$i<$n;$i++){ 
					$brandCatsMix[]=$tmpBrand[$i].$tmpCat[$i];
				}
					
			}
			
			
		}
		else if(strpos($url,'thegoldendiamonds')!==false){
			$elements = query_selector($doc, 'p em,section.full p');
			foreach($elements as $element)	{
				
				$node=$element->nodeValue;
				if(strpos($node,'/')!==false){
					$tags=$node;
					break;
				}
					
			}
			$brandCatsMix=brandCatSplit($tags,'/');
			
		}
		else if(strpos($url,'ihateblonde')!==false){
			
			$tmpBrandMixCat = query_selector($doc, 'p em');
		
			foreach($tmpBrandMixCat as $e)	{
				$brandCatsMix[]=$e->nodeValue;

			}
			
				
		}
		else if(strpos($url,'byrdie')!==false){
			$tmpBrandMixCat = query_selector($doc, 'p em a');
		
			foreach($tmpBrandMixCat as $e)	{
				$brandCatsMix[]=$e->nodeValue;

			}
		}
		else if(strpos($url,'itsparadigma')!==false){
			$elements = query_selector($doc, 'p strong');
			foreach($elements as $element)	{	  
				$node=$element->nodeValue;
				$tags=$node;
					
			}
			$brandCatsMix=brandCatSplit($tags,'|');
		}
		else if(strpos($url,'theblondesalad')!==false){
			$elements = query_selector($doc, 'div.entry-content p');
			$tmpBrand=array();
			$tmpCat=array();
			$tmpEle;
			foreach($elements as $element)	{
				foreach($element->childNodes as $e){
					
					if($e->nodeName=='a'&&$element->nodeValue!==''){
						$tmpEle=$element;
						break 2;
					}
					
					
				}
				
					
			}
			if (!empty($tmpEle)) {
				foreach($tmpEle->childNodes as $e){
					if($e->nodeName=='a'){
						$tmpBrand[]=$e->nodeValue;
					}
					else {
						if($e->nodeValue!=='')
							$tmpCat[]=$e->nodeValue;
						}
						
				}
			}
			for($i=0;$i<count($tmpBrand);$i++){
				$brandCatsMix[]=$tmpBrand[$i].$tmpCat[$i];
			}
			
		}
		else if(strpos($url,'aniab')!==false){
			$elements = query_selector($doc, 'p');
			$tags;
			foreach($elements as $element)	{
				
				foreach($element->childNodes as $e){ 
					//print_r($e);
					if($e->nodeName=='strong'){ //print_r($element);die;
						$tags=$element->nodeValue;
						break 2;
					}

				}
				
			}
			$brandCatsMix=brandCatSplit($tags,',');
		}
		else if(strpos($url,'elle')!==false){
			$elements = query_selector($doc, 'div.embedded-image--info div.embedded-image--caption');
			$tmpRst=array();
			foreach($elements as $element)	{
				$tmpVal=$element->nodeValue;
				$arr=explode('.',$tmpVal);
				foreach($arr as $a){
					if(strpos($a,'and')!==false){
						$a=str_replace('and','',$a);
						$end=strpos($a,' by ');
						$backstr=substr($a,$end); 
						$tmpArr=explode(' ',$a);
						foreach($tmpArr as $t){
							if($t=='by'){
								break;
							}
							if($t!==''){
								$tmpRst[]=$t.' '.$backstr;
							}
							
						}
					}else if($a!==''){
						$tmpRst[]=$a;
					}
				}
				
			}
			$brandCatsMix=$tmpRst;
			
		}else if(strpos($url,'kryzuy')!==false){
			$elements = query_selector($doc, 'h5,p strong');
			foreach($elements as $element)	{	  
				$node=$element->nodeValue; 
				if(strpos($node,' (')!==false){ 
					$brandCatsMix[]=substr($node,0,strpos($node,' ('));
				}
				else {
					$brandCatsMix[]=$node;
				}	
			}
			$brandCatsMix=brandCatSplit(implode(',',$brandCatsMix),',');
		}
		else if(strpos($url,'peonylim')!==false){
			$elements = query_selector($doc, 'div.type-outfit div.content:not(.has-thumbnail) p');
			foreach($elements as $element)	{	  
				$node=$element->nodeValue; 
					if(trim($node)!=='')
						$brandCatsMix[]=$node;
				
			}
			
		}
		$queryFinal = array();
		$categoryFinal=array();
                $brandNameArr=$scraping_model->fetchData(BRAND_MASTER,array(),array('BrandName'),false);
		$brandFinal=array();
                /*
		$storedBrandName=$scraping_model->fetchData(BRAND_MASTER,array(),array('BrandName'),false);
                $brandNameDic = refineBrandName($storedBrandName);
		$brandFinal=array();
                //$brandNamePositionArr = 
                        retrieveBrand($brandNameDic, $title, $content);die;
                //print_r($brandNamePositionArr);die;
		//file_put_contents("/var/www/html/uploads/badword.txt",print_r($brandCatsMix,true));
                */
		foreach($brandCatsMix as $mix){
			$mix=mb_convert_encoding($mix, "UTF-8");
			$tmpMix=strtolower($mix);
			$flag=true;
			$categoryTmp=retriveCategory($mix);
			if(count($categoryTmp)==0){
				
				continue;
			}
			$categoryFinal[]=matchCategoryGuid($categoryTmp);
			$queryFinal[] = $mix;
			
			foreach($brandNameArr as $brand){
				$brandLowerCase=strtolower($brand['BrandName']);
				if(strpos($brand['BrandName'],'&')!==false){
					$brandEx=str_replace('&','and',$brandLowerCase);// h and m
					$brandEx1=str_replace(' & ','',$brandLowerCase);  // hm
					$brandEx2=str_replace(' & ',' ',$brandLowerCase); // h m 
					$brandEx3=str_replace(' & ','&',$brandLowerCase); // h m 
					if(strpos($tmpMix,$brandEx.' ')!==false||strpos($tmpMix,$brandEx1.' ')!==false||strpos($tmpMix,$brandEx2.' ')!==false||strpos($tmpMix,$brandLowerCase.' ')!=false||strpos($tmpMix,$brandEx3.' ')!==false){
						$brandFinal[]=$brand['BrandName'];
						$flag=false;
						break;
					}
					
				}else{
					if(strpos($tmpMix,$brandLowerCase.' ')!==false){
						$brandFinal[]=$brand['BrandName'];
						$flag=false;
						break;
					}
					
					
						
					
				}
			}
			if($flag){
				$brandFinal[]='brand not exist';
			}
			
			
			
			
		}
		$rst=array();
		//file_put_contents("/var/www/html/uploads/brand.txt",print_r($brandFinal,true));
		//file_put_contents("/var/www/html/uploads/cat.txt",print_r($categoryFinal,true));
		for($i=0;$i<count($categoryFinal);$i++){
			sort($categoryFinal[$i]); // Do we have to sort?
			$key = sprintf('%s;%s', $brandFinal[$i], implode(',', $categoryFinal[$i]));
			if (array_key_exists($key, $rst)) {
				// prevent duplicates
				$rst[$key]['query'] .= '/'.$queryFinal[$i];
			} else {
				$rst[$key] = array(
					'brand'=>$brandFinal[$i],
					'category'=>$categoryFinal[$i],
					'query'=>$queryFinal[$i]
				);
			}
		}
		// file_put_contents("/var/www/uploads/mix.txt",print_r($rst,true));
		return array_values($rst);
		
		
		
		
	}
	function brandCatSplit($usedContent,$symbol){
		
		$brandAndCat=explode($symbol,convertSpecialChars($usedContent));
		$brandCatArr = array();
		foreach($brandAndCat as $mix){
			if(empty(trim($mix))||strpos(strtolower($mix),'wearing')!==false){
					continue;
			}
			$brandCatArr[]=trim($mix);
		}
		return $brandCatArr;
	}
	
	
	function matchCategoryGuid($cat){
	$GUIDlist=array(
		'Women > Clothing > Dresses > Day' => '5780203c5f9ca',
		'Women > Clothing > Dresses > Cocktail' => '5780203c5fb60',
		'Women > Clothing > Dresses > Gowns' => '5780203c5fcce',
		'Women > Clothing > Dresses > Maxi' => '5780203c5fe7b',
		'Women > Clothing > Dresses' => '54daf1ce2c659',
		'Women > Clothing > Tops > T-shirts' => '54daf1ce2c9ea',
		'Women > Clothing > Tops > Tank tops' => '578026b02fbd9',
		'Women > Clothing > Tops > Blouses' => '578026b02fdac',
		'Women > Clothing > Tops > Shirts' => '578026b02feff',
		'Women > Clothing > Tops > Tunics' => '578026b030049',
		'Women > Clothing > Tops > Cardigans' => '578026b0301a0',
		'Women > Clothing > Tops > Sweaters' => '54daf1ce2c934',
		'Women > Clothing > Tops > Sweatshirts & Hoodies' => '578026b0302f8',
		'Women > Clothing > Tops' => '54daf1ce2c9ae',
		'Women > Clothing > Outerwear > Coats'  => '5780298cf1053',
		'Women > Clothing > Outerwear > Jackets' => '54daf1ce2c6d1',
		'Women > Clothing > Outerwear > Vests' => '5780298cf134c',
		'Women > Clothing > Outerwear > Capes' => '5780298cf14d8',
		'Women > Clothing > Outerwear' => '54daf1ce2c786',
		'Women > Clothing > Skirts > Mini' => '57802c9e29684',
		'Women > Clothing > Skirts > Knee-length' => '57802c9e299c8',
		'Women > Clothing > Skirts > Long' => '57802c9e29b66',
		'Women > Clothing > Skirts' => '54daf1ce2c8b8',
		'Women > Clothing > Shorts' => '54daf1ce2c87c',
		'Women > Clothing > Skorts' => '57802d6205124',
		'Women > Clothing > Jeans > Bootcut' => '57802ee565f81',
		'Women > Clothing > Jeans > Boyfriend' => '57802ee566276',
		'Women > Clothing > Jeans > Flared' => '57802ee5663ff',
		'Women > Clothing > Jeans > Cropped' => '57802ee56655f',
		'Women > Clothing > Jeans > Skinny' => '57802ee5666ba',
		'Women > Clothing > Jeans > Straight Leg' => '57802ee566811',
		'Women > Clothing > Jeans > Wide Leg' => '57802ee56694e',
		'Women > Clothing > Jeans' => '57802e7091c01',
		'Women > Clothing > Pants > Capri & Cropped' => '57803197ebc04',
		'Women > Clothing > Pants > Leggings' => '57803197ebf25',
		'Women > Clothing > Pants > Straight Leg' => '57803197ec0a4',
		'Women > Clothing > Pants > Wide Leg' => '57803197ec206',
		'Women > Clothing > Pants > Skinny' => '57803197ec35e',
		'Women > Clothing > Pants > Flared' => '57803197ec4bb',
		'Women > Clothing > Pants > Boot Cut' => '57803197ec698',
		'Women > Clothing > Pants > Culottes' => '57803197ec7e2',
		'Women > Clothing > Pants > Sweats' => '57803197ec931',
		'Women > Clothing > Pants' => '54daf1ce2c7c3',
		'Women > Clothing > Rompers & Jumpsuits' => '5780375b5ba41',
		'Women > Clothing > Overalls' => '5780375b5bd26',
		'Women > Clothing > Intimates > Bras' => '5780408e92579',
		'Women > Clothing > Intimates > Camisoles' => '5780408e92873',
		'Women > Clothing > Intimates > Chemises' => '5780408e929f5',
		'Women > Clothing > Intimates > Hosiery' => '5780408e92b65',
		'Women > Clothing > Intimates > Sleepwear' => '5780408e92c93',
		'Women > Clothing > Intimates > Panties & Thongs' => '5780408e92de3',
		'Women > Clothing > Intimates > Robes' => '5780408e92f31',
		'Women > Clothing > Intimates' => '54daf1ce2c695',
		'Women > Clothing > Swimwear > Bikinis > Tops' => '5780429546f55',
		'Women > Clothing > Swimwear > Bikinis' => '5780429546be5',
		'Women > Clothing > Swimwear > Bikinis > Bottoms' => '5780429547100',
		'Women > Clothing > Swimwear > One-Piece' => '57804295472f5',
		'Women > Clothing > Swimwear > Cover Up' => '578042954746c',
		'Women > Clothing > Swimwear' => '54daf1ce2c970',
		'Women > Clothing > Activewear' => '54daf1ce2c598',
		'Women > Clothing > Bridal' => '54daf1ce2c5d6',
		'Women > Clothing > Costumes' => '578043420ade0',
		'Women > Clothing > Petite' => '578043420b0d2',
		'Women > Clothing > Plus' => '54daf1ce2c840',
		'Women > Clothing > Suits' => '54daf1ce2c8f4',
		'Women > Shoes > Athletic' => '54daf1ced726b',
		'Women > Shoes > Boots' => '54daf1ced72a7',
		'Women > Shoes > Mules & Clogs' => '54daf1ced7319',
		'Women > Shoes > Flats' => '54daf1ced72e0',
		'Women > Shoes > Loafers & Moccasins' => '578043420b23b',
		'Women > Shoes > Oxfords' => '578043420b3ad',
		'Women > Shoes > Heels' => '54daf1ced738b',
		'Women > Shoes > Sandals' => '54daf1ced73c4',
		'Women > Shoes > Wedges' => '54daf1ced7436',
		'Women > Shoes > Platforms' => '54daf1ced7352',
		'Women > Shoes > Sneakers' => '54daf1ced73fd',
		'Women > Shoes' => '54daf1cec8c6e',
		'Women > Accessories > Belts' => '578043420b510',
		'Women > Accessories > Eyewear > Sunglasses' => '57804ac5445dc',
		'Women > Accessories > Eyewear > Eyeglasses' => '57804ac544861',
		'Women > Accessories > Eyewear' => '54daf1ce961ed',
		'Women > Accessories > Hats' => '57804ac5449f2',
		'Women > Accessories > Gloves' => '57804ac544b77',
		'Women > Accessories > Hair' => '57804ac544cc4',
		'Women > Accessories > Scarves' => '57804ac544dff',
		'Women > Accessories > Tech' => '57804ac544f40',
		'Women > Accessories > Umbrellas' => '57804ac54508c',
		'Women > Accessories > Bags > Backpacks' => '5784010a18494',
		'Women > Accessories > Bags > Wallets' => '5784010a185f5',
		'Women > Accessories > Bags > Luggage' => '5784010a18749',
		'Women > Accessories > Bags > Handbags > Clutches' => '54daf1cebcbe3',
		'Women > Accessories > Bags > Handbags > Shoulder Bags' => '57840349e43f5',
		'Women > Accessories > Bags > Handbags > Duffles & Totes' => '57840349e4550',
		'Women > Accessories > Bags > Handbags > Satchels' => '54daf1cebcc92',
		"Women > Accessories > Bags > Handbags > Cross Body's" => '57840349e46ba',
		'Women > Accessories > Bags > Handbags > Hobos' => '54daf1cebcc57',
		'Women > Accessories > Bags > Handbags' => '54daf1cea8659',
		'Women > Accessories > Bags' => ' 5784010a18340 ',
		'Women > Accessories > Jewelry > Necklaces' => '578405a524cbd',
		'Women > Accessories > Jewelry > Earrings' => '54daf1ce96170',
		'Women > Accessories > Jewelry > Bracelets & Bangles' => '578405a524e60',
		'Women > Accessories > Jewelry > Brooches' => '578405a524fae',
		'Women > Accessories > Jewelry > Charms & Pendants' => '578405a52510d', 
		'Women > Accessories > Jewelry > Rings' => '578405a525260',
		'Women > Accessories > Jewelry > Watches' => '54daf1ce96265',
		'Women > Accessories > Jewelry' => '54daf1ce9622a',
		'Women > Accessories' => '54daf1ce44ce8',
		'Women > Beauty > Makeup' => '57840985ea11d',
		'Women > Beauty > Skincare' => '57840985ea28c',
		'Women > Beauty > Fragrances' => '54daf1ce9629f',
		'Women > Beauty > Bath & Body' => '57840985ea5da',
		'Women > Beauty > Hair' => '57840985ea72a',
		'Women > Beauty > Nails' => '57840985ea89b',
		'Women > Beauty > Sets & Kits' => '57840985eaa03',
		'Women > Beauty > Bags & Cases' => '57840985eab5e',
		);
	$finalGuid=array();
	foreach($cat as $c){
		$finalGuid[]=$GUIDlist[$c];
	}
	return $finalGuid;

 }
    

?>