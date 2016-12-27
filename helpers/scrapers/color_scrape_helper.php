<?php
function scrape_color($scraping_model, $doc, $params, $desc = '') {
    if (is_subclass_of($scraping_model, 'Common_Model')) {
        $scraping_model->load->helper(array('scraping', 'color'));
    } else {
        require_once APPPATH.'/helpers/color_helper.php';
    }
    
    extract($params);
    switch ($brand_lower) {
        case 'bcbg':
            $element = element_by_selector($doc, 'ul.swatches.color li.selected-value');
            if ($element && !empty(($color_name = dom_format_text($element)))) {
                break;
            }
            $element = element_by_selector($doc, 'a.swatchanchor');
            if ($element) {
                $color_name = $element->getAttribute('title');
                break;
            }
            $color_name = NULL;
            break;
        case 'vince':
            $element = element_by_selector($doc, 'span.selected-value.color');
            if (!empty(($color_name = dom_format_text($element)))) {
                break;
            }
            $element = element_by_selector($doc, 'li.available a.swatchanchor');
            if ($element) {
                $color_name = $element->getAttribute('title');
                break;
            }
            $color_name = NULL;
            break;
        case 'luisaviaroma':
            $json_script = element_by_selector($doc, 'script[type="application/ld+json"]');
            if ($json_script) {
                try {
                    $product_info = json_decode($json_script->textContent);
                    $color_name = $product_info->color;
                    break;
                } catch (Exception $e) {
                    log_message('error', "Error parsing json: $json_script");
                }
            }
            $color_name = NULL;
            break;
        case 'hm':
            $element = element_by_selector($doc, 'span#text-selected-article');
            if ($element) {
                $color_name = dom_format_text($element);
                break;
            }
            $element = element_by_selector($doc, 'div.product-colors input[name=product-color][checked]');
            $color_name = $element ? $element->getAttribute('value') : NULL;
            break;
        case 'heels':
            $meta = element_by_selector($doc, 'meta[property="og:title"]');
            if ($meta) {
                $color_name = array_pop(explode('-', $meta->getAttribute('content')));
            } else {
                $color_name = NULL;
            }
            break;
        case 'thredup':
        case 'drjays':
        //case 'nordstrom':
        case 'viviennewestwood':
            $color_dict = $js_evals['color'];
            $color_name = is_array($color_dict) ? array_values($color_dict) : $color_dict;
            break;
        case 'mytheresa':
        case 'unionandfifth':
        // case 'italist':
        case 'boohoo':
        case 'christianlouboutin':
        case 'chicwish':
        case 'bysymphony':
            // selector + regex
            $rules = array(
                // 'drjays' => array('div#column2-pdp h2', '/^by\s+(.+)$/i'),
                // 'asos' => array('div.brand-description > h2', '/^ABOUT\s+(.+?)(\s+BRAND)?$/i')
                'mytheresa' => array('p.product-description~ul.featurepoints', '/^\s*Designer colour name:(.+)$/im'),
                'unionandfifth' => array('ul.tab-content > li[data-tab=details] ul', '/Color:\s*([^\\n\\r]+)/i'),
                // 'italist' => array('div#selected_option span.selected_option_color', '/^([^|]+)|/'),
                'boohoo' => array('div.js-attribute-color option[data-atttext], div#attributeInputs th.js-rowtitleY', '/^(.+?)(\s+-\s+In\s+stock)?$/i'), // for small screen only
                'christianlouboutin' => array('p.content', '/^\s*Color\s*:\s+(.+)\s*$/im'),
                'chicwish' => array('h1[itemprop=name]', '/in\s+(.+?)$/i'),
                'bysymphony' => array('div[itemprop=description]', '/^\s*Colour\s*:\s+(.+)\s*$/im')

            );
            $rule = $rules[$brand_lower];
            $element = element_by_selector($doc, $rule[0]);
            if ($element) {
                // echo '------'.dom_format_text($element).'<br/>';
                if (preg_match($rule[1], dom_format_text($element), $matches)) {
                    $color_name = trim($matches[1]);
                    break;
                }
            }
            $color_name = '';
            break;
        case 'mango':
        case 'anthropologie':
        // case 'boutiquetoyou':
        case 'hugoboss':
        case 'marcjacobs':
            // span|p[itemprop=color]
            $element = element_by_selector($doc, 'span[itemprop=color], p[itemprop=color]');
            $color_name = dom_format_text($element);
            break;
        case 'maykool':
            $jsNodes = query_selector($doc, 'script[type="text/javascript"]');
            $json_script;
            foreach ($jsNodes as $node) {
                if (strpos(dom_format_text($node), 'Product.Config(')) {
                    $json_info_arr = explode('Product.Config(', dom_format_text($node));
                    $json_script = substr($json_info_arr[1], 0, strpos($json_info_arr[1], ')'));
                    break;
                }
            }
            if ($json_script) {
                try {
                    $json_arr = json_decode($json_script, TRUE);
                    if (count($json_arr['attributes']['92']['options'])) {
                        $color_name = $json_arr['attributes']['92']['options'][0]['label'];
                    }
                    break;
                } catch (Exception $e) {
                    log_message('error', "Error parsing json: $json_script");
                }
            }
            break;
            
        case 'riverisland':
        // case 'anthropologie':
        case 'alternativeapparel':
        case 'americanapparel':
        case 'solesociety':
        case 'freepeople':
        case 'allsaints':
        case 'selfridges':
        case 'macys':
        case 'louisvuitton':
        case 'valentino':
        case 'lanecrawford':
        case 'abercrombie':
        case 'loefflerrandall':
        case 'tradesy':
        case 'trade-mark':
        case 'tobi':
        case 'antonioli':
            $selectors = array(
                // 'maykool' => array('ul#ul-attribute92 li.swatchContainer', 'title'),
                'riverisland' => array('ul#swatches li.active img', 'alt'),
                // 'anthropologie' => array('a.color-swatch.selected', 'title'),
                'alternativeapparel' => array('img.swatch-img.selected', 'title'),
                'americanapparel' => array('div.colors li.color.selected', 'data-name'),
                'solesociety' => array('div.swatches li.active img', 'title'),
                'freepeople' => array('meta[property="og:color"]', 'content'),
                'allsaints' => array('meta[itemprop=colour]', 'content'),
                'selfridges' => array('form[name=OrderItemAddForm]', 'data-preselect'),
                'macys' => array('meta[itemprop=color]', 'content'),
                'louisvuitton' => array('ul.paletteContainer.Color img.currentPalette', 'alt'),
                'valentino' => array('meta[name="twitter:data2"]', 'content'),
                'lanecrawford' => array('input[name=color-picker][checked]', 'data-displayname'),
                'abercrombie' => array('meta[property="product:color"]', 'content'),
                'loefflerrandall' => array('span.swatch-active > img', 'alt'),
                'tradesy' => array('meta[itemprop=color]', 'content'),
                'trade-mark' => array('div.entry-colors li.selected img', 'alt'),
                'tobi' => array('li.color-swatch.is-selected img', 'alt'),
                'antonioli' => array('p[itemprop=model]', 'content')
            );
            if (array_key_exists($brand_lower, $selectors)) {
                list($selector, $attr) = $selectors[$brand_lower];
                $element = element_by_selector($doc, $selector);
                $color_name = $element ? $element->getAttribute($attr) : NULL;
            } else {
                $color_name = NULL;
            }
            break;
//This is added by silonghu

	case 'nordstromrack':
/*
            $element = element_by_selector($doc, 'dd[class="sku-option__selected-value"]');
	    if ($element) {
                $color_name = dom_format_text($element);
		//$color_name = "white";
            } else {
                $color_name = NULL;
            }
*/
	    $elements = query_selector($doc, 'dd[class=sku-option__selected-value]');
                foreach ($elements as $element) {
                    $color_name .= dom_format_text($element);
                }
	    break;

        default:
            $selectors = array(
                'saksfifthavenue' => 'dd.product-variant-attribute-label__selected-value, li.product-variant-attribute-value--swatch > span',
                'zappos' => 'select#color option[selected]',
                'aritzia' => 'div.attribute-color > div.value li.selected > a > span',
                'yoox' => 'span#selectedColor',
                'agacistore' => 'div#product-content ul.swatches.Color > li.selected > a',
                'baublebar' => 'input[type=radio][checked]+label.color',
                'dailylook' => 'div.product-variant-name > span[data-product-hook=subcategoryIDName]',
                'sephora' => 'span.InfoRow-color span.InfoRow-value span:last-child',
                'designsbystephene' => 'ul#colorchoices > li.selected span',
                'italist' => 'div#selected_option span.selected_option_color',
                'kohls' => 'span.sel-color-swatch',
                'urbanoutfitters' => '.product-swatches span',
                '6pm' => 'select#color > option[selected], li#colors p.note',
                'shopbop' => 'span.selectedColor',
                'revolve' => 'span.selectedColor',
                'katespade' => 'ul.swatches.Color > li.selected > span.title',
                'anntaylor' => 'fieldset.colors label.active',
                'gap' => 'span.label-value[data-bind*="k_selectedColorName"]',
                'toryburch' => 'li.selected span.swatchDispName',
                'asos' => 'div.colour option[selected]',
                'loft' => 'fieldset.colors label.active',
                'vestiairecollective' => 'li#couleur',
                'finishline' => 'div#styleColors > span.description',
                'solesociety' => 'h2#swatch_title',
                'bodenusa' => 'div.pdpAddToBagBoxColor',
                // 'chicwish' => 'h1[itemprop=name]',
                'monnierfreres' => 'div.breadcrumbs > ul > li:nth-last-of-type(2)',
                'chicos' => 'div.selected-color-name',
                'terijon' => 'div.color > span.fontgmd',
                'nike' => 'div.colorText, span.colorText',
                'intermixonline' => 'div.ml-product-optionNameColor > span.ml-product-optionName',
                'jcrew' => 'span.color-name',
                // 'henribendel' => 'div.swatches.color span.selectedvarval', // for phantomjs
                'henribendel' => 'ul.swatchesdisplay > li.selected > a',
                'lordandtaylor' => 'div.selectedColor > div.colorName > span',
                'theoutnet' => 'div#colours > h3 > span',
                'boutiquetoyou' => 'li.selected > a[onclick*=SelectColorId] > span',
                'forever21' => 'span#spanSelectedColorName',
                'express' => 'span#selected-color-display',
                'neimanmarcus' => 'select.colorSelectBox > option[selected]',
                'bergdorfgoodman' => 'select.colorSelectBox > option[selected]',
                // 'selfridges' => 'fieldset[data-attribute=Colour] p.activeSelection',
                'ninewest' => 'div#currentColor',
                // 'macys' => 'div.colorsSection span.selectedColorName',
                'bloomingdales' => 'div.pdp_member_color span.pdpColorDesc',
                'ralphlauren' => 'span#color-title',
                'michaelkors' => 'div.product_color_labels > span.product_color_swatch',
                'versace' => 'ul.swatchesdisplay > li.selected > a.swatchanchor',
                // 'hm' => 'span#text-selected-article',
                'zara' => 'label._color > input[name=color][checked] ~ span.color-description',
                'fendi' => 'div.fd-product-info > span.color > strong',
                'prada' => 'div.colorSelect > span',
                // 'valentino' => 'div.colorSel > span.selection',
                'robertocavalli' => 'span#color-name, div#itemSelection span.selection',
                'tomford' => 'div.attribute.color > span.selected-value',
                'guess' => 'div.productInformation .selectedColor',
                'burberry' => 'h3.color-title > span.color-name',
                'topshop' => 'div#productInfo li.product_colour > span',
                'clubmonaco' => 'li.swatch.selected',
                //'nordstromrack' => 'div.label-color > span[data-bind]',
	        //'nordstromrack' => 'span.selectedColor',
                'charlotterusse' => 'li.swatch.selected > div.swatch-hover',
                'target' => 'span.selImgCol',
                'amazon' => 'div#variation_color_name span.selection',
                'anntaylor' => 'fieldset.colors label.active',
                'loft' => 'fieldset.colors label.active',
                'armani' => 'a.selectyzeValue[rel!=Size]',
                'dollskill' => 'select#attribute80 > option',
                'aeo' => 'div.psp-product-txt.psp-product-color, p.aeo-pdp-procol',
                'madewell' => 'span.color-name',
                'talbots' => 'div.saleColors span',
                'calvinklein' => 'span#colorValue',
                'needsupply' => 'li#attribute451 a.label',
                'fwrd' => 'div.color_dd div.title',
                'draperjames' => 'span.color-name-holder',
                'uniqlo' => 'span.pdp-color-name',
                'vanmildert' => 'div#divColour select > option[selected]',
                'puma' => 'label[itemprop=color] > span[itemprop=name]',
                'gucci' => 'span.color-material-name',
                'adidas' => 'span.product-color-clear',
                'brooksbrothers' => 'h3.ColorSwatchesHeader > span.displayvalue',
                'wonhundred' => 'div.field-name-field-product-color div.field-item',
                'buckle' => 'div.color-info span.color-type',
                'lastcall' => 'select.colorSelectBox > option[selected]',
                'rebeccataylor' => 'div#displaycolor',
                'johnlewis' => 'div#prod-product-colour div.detail-pair > p',
                'pacsun' => 'div.swatches.color li.selected',
                'dkny' => 'div.swatches.color li.selected-value',
                'dolcegabbana' => 'ul#colorsContainer > li.itemColor.selected',
                'gilt' => 'dd.sku-attribute-selected-value',
                'coach' => 'span.selected-color span.color-name'
            );
            if (array_key_exists($brand_lower, $selectors)) {
                $element = element_by_selector($doc, $selectors[$brand_lower]);
                $color_name = dom_format_text($element);
            } else {
                $color_name = NULL;
                // $color_name = '-- Not implemented --';
            }
    }

    switch ($brand_lower) {
        case 'macys':
        case 'bloomingdales':
        case 'abercrombie':
            // skip swatch sprites
            break;
//Silonghu Added
	case 'nordstromrack':
            $swatch_img = element_by_selector($doc, "img[alt=\"$color_name\"]");
            $swatch_src = $swatch_img ? $swatch_img->getAttribute('src') : NULL;
            break;

        case 'guess':
            $swatch_img = element_by_selector($doc, "ul.colors li.active img, ul.colors li img[alt=\"$color_name\"]");
            $swatch_src = $swatch_img ? $swatch_img->getAttribute('src') : NULL;
            break;
        case 'boohoo':
            if ($color_name) {
                $swatch_element = element_by_selector($doc, "div#attributeInputs td[data-attvalue2=$color_name] div.js-gridImage");
                $swatch_src = css_background_image($swatch_element);
            } else {
                $swatch_src = NULL;
            }
            break;
        case 'lanecrawford':
            $swatch_element = element_by_selector($doc, 'input[name=color-picker][checked] ~ span[style*=background]');
            $swatch_src = css_background_image($swatch_element);
            break;
        case 'mango':
            $color_id_input = element_by_selector($doc, 'input#id_colorId_hidden');
            if ($color_id_input) {
                $swatch_color_id = $color_id_input->getAttribute('value');
                $swatch_img = element_by_selector($doc, "img[data-quick=$swatch_color_id]");
                $swatch_src = $swatch_img ? $swatch_img->getAttribute('src') : NULL;
            }
            break;
        case 'maykool':
            $jsNodes = query_selector($doc, 'script[type="text/javascript"]');
            $json_script;
            foreach ($jsNodes as $node) {
                if (strpos(dom_format_text($node), 'Product.Config(')) {
                    $json_info_arr = explode('Product.Config(', dom_format_text($node));
                    $json_script = substr($json_info_arr[1], 0, strpos($json_info_arr[1], ')'));
                    break;
                }
            }
            if ($json_script) {
                try {
                    $json_arr = json_decode($json_script, TRUE);
                    if (count($json_arr['attributes']['92']['options'])) {
                        $color_id = 'swatch' . $json_arr['attributes']['92']['options'][0]['id'];
                    }
                    $swatch_img = element_by_selector($doc, "img#$color_id");
                    if ($swatch_img) {
                        $swatch_src = $swatch_img->getAttribute('src');
                    }
                    
                    break;
                } catch (Exception $e) {
                    log_message('error', "Error parsing json: $json_script");
                }
            }
        // case 'bloomingdales':
        //     $swatch_img = element_by_selector($doc, 'div.colors li.selected img[style*=background]');
        //     $swatch_src = $swatch_img ? css_background_image($swatch_img) : NULL;
        //     break;
        default:
            // exact selectors
            $selectors = array(
                // 'maykool' => 'ul#ul-attribute92 img',
                'revolve' => 'li.product-swatches__swatch.is-toggled img',
                'gap' => 'span.swatches--underlined img',
                'henribendel' => 'ul.swatchesdisplay > li.selected img:not([src*=noimage])',
                'selfridges' => 'label[itemprop=color] img',
                'ralphlauren' => 'ul#color-swatches > li.active > img',
                'hm' => 'div.product-colors input[name=product-color][checked] ~ div.detailbox-pattern img',
                'zara' => 'label._color > input[name=color][checked] ~ img',
                // 'lanecrawford' => 'input[name=color-picker][checked] ~ img',
                'target' => 'a.variator--option-color[aria-checked=true] img.variator--option--swatch--image',
                'draperjames' => 'div.color-select li.active img',
                'vanmildert' => 'li.variantHighlight img',
                'gucci' => 'span.color-material img',
                'tobi' => 'li.color-swatch.is-selected img'
            );
            if (array_key_exists($brand_lower, $selectors)) {
                if ( ($swatch_img = element_by_selector($doc, $selectors[$brand_lower])) ) {
                    $swatch_src = $swatch_img->getAttribute('src');
                }
                break; // NOTE: Not sure if always breaking at this line will cause some sites to not get swatch image.
            }

            // generalized selector
            $parent_elements = array('ul', 'dl', 'div', 'fieldset', 'section');
            $parent_contain_classes = array('colo', 'Colo', 'watch');
            $child_elements = array('li', 'dd', 'span', 'a', 'label', 'div', 'img');
            $child_contain_classes = array('sel', 'Sel', /*'watch', */'urrent', 'ctive');
            // .//*[self::ul|self::div][contains(./@class, 'colo') or contains(./@class, 'watch')]/*[self::li|self::span][contains(./@class, 'sel') or contains(./@class, 'active')]
            $map_element = function($element) { return 'self::'.$element; };
            $map_contain_class = function($contain_class) { return "contains(./@class, '$contain_class')"; };
            $map_contain_id = function($contain_id) { return "contains(./@id, '$contain_id')"; };

            $swatch_xpath = sprintf('descendant-or-self::*[%s][%s or %s]/descendant-or-self::*/*[%s][%s]',
                implode('|', array_map($map_element, $parent_elements)),
                implode(' or ', array_map($map_contain_class, $parent_contain_classes)),
                implode(' or ', array_map($map_contain_id, $parent_contain_classes)),
                implode('|', array_map($map_element, $child_elements)),
                implode(' or ', array_map($map_contain_class, $child_contain_classes)));
            $xpath = new DOMXpath($doc);
            $elements = $xpath->query($swatch_xpath.'/descendant-or-self::img');
            // echo "---$swatch_xpath---<br/>";
            // echo $elements->length;
            $swatch_img = $elements->length ? $elements->item(0) : NULL;
            if ($swatch_img && ($swatch_src = $swatch_img->getAttribute('src'))) {
                break;
            }

            // Try extracting color from css background
            $elements = $xpath->query($swatch_xpath.'/descendant-or-self::*[contains(./@style, \'background\')]');
            $swatch_element = $elements->length ? $elements->item(0) : NULL;
            if (($swatch_src = css_background_image($swatch_element)) === NULL) {
                $swatch_rgb = css_background_color($swatch_element);
            }
    }

    switch ($brand_lower) {
        case 'saksfifthavenue':
            $element = element_by_selector($doc, 'div.s7thumb[state=selected]');
            $thumb_src = css_background_image($element);
            break;
        case 'aeo':
            $element = element_by_selector($doc, 'li.carousel-thumbs.active');
            $thumb_src = css_background_image($element);
            break;
        default:
            $selectors = array(
                'zappos' => 'div#productImages a.active img',
                'mytheresa' => 'ul.product-image-thumbs li img',
                'agacistore' => 'div.rsThumb.rsNavSelected > img',
                'baublebar' => 'img.pdp--selectedThumb',
                'dailylook' => 'div.thumb-container.active > img',
                'italist' => 'div#product_image_thumbs a.active img',
                'nastygal' => 'img.pagination-thumb.selected',
                'anntaylor' => 'div.active img.thumbnail',
                'henribendel' => 'li.thumb.z-active img.productthumbnail',
                'modcloth' => 'ul#product-image-thumbnails > li.first > img',
                'harrods' => 'li.active img',
                'bysymphony' => 'ul.thumbnails > li.first img',
                'stylebop' => 'div.select_product_image img',
                'lanecrawford' => 'div.slick-active img.hero-carousel__img',
                'amazon' => 'div#imageBlock li.item.selected img',
                'gap' => 'li.pagination--item.active img',
                'armani' => 'img.thumb.selected',
                'dollskill' => 'div#wrap img',
                'abercrombie' => 'li.selected-thumbnail img',
                'vince' => 'li.thumb.selected img',
                'blueandcream' => 'img.rsTmb',
                'therealreal' => 'img.product-content-thumbnails__thumbnail--active',
                'needsupply' => 'ul.thumbs img:first-of-type',
                'fwrd' => 'img.product-detail-image',
                'tradesy' => 'div#idp-thumb div.sync img',
                'puma' => 'li.thumb.selected img',
                'adidas' => 'li.pdp-image-carousel-active-item img',
                'zimmermannwear' => 'div.sliderThumb a.showmainImg img',
                'brooksbrothers' => 'li.thumb.selected img',
                'wonhundred' => 'div.slide-navigation-dot.active img, div.field-name-uc-product-image img',
                'trade-mark' => 'div.product-image.current',
                'modaoperandi' => 'div.thumb-selected img'
            );
            if (array_key_exists($brand_lower, $selectors)) {
                $thumb_img = element_by_selector($doc, $selectors[$brand_lower]);
            }
            if (!isset($thumb_img)) {
                $thumb_img = element_by_selector($doc, 'img[itemprop=image]');
            }
            $thumb_src = $thumb_img ? $thumb_img->getAttribute('src') : NULL;
    }

    if (empty($thumb_src)) {
        $img_meta = element_by_selector($doc, 'meta[property="og:image"], meta[itemprop=image]');
        if ($img_meta) {
            $thumb_src = $img_meta->getAttribute('content');
        }

        if (empty($thumb_src) && ($thumb_img = element_by_selector($doc, 'img[itemprop=image]'))) {
            $thumb_src = $thumb_img->getAttribute('src');
        }
    }

    if (is_subclass_of($scraping_model, 'Common_Model')) {
        $master_colors = $scraping_model->fetchData(COLOR_MASTER);
        $known_colors = array_column($master_colors, 'Name');
        $color_ids = array_combine($known_colors, array_column($master_colors, 'ColorID'));
    } else {
        // for testing outside codeigniter
        $known_colors = array('Other', 'Brown', 'Gold', 'Yellow', 'Orange', 'Purple', 'Red', 'Pink', 'Black', 'Green', 'Blue', 'Turquoise', 'White', 'Grey', 'Beige', 'Silver', 'Multicolor', 'Light Blue');
        $color_ids = array_flip($known_colors);
    }
    $palette = array_map('name_to_color', $known_colors);

    $is_multicolor = FALSE;
    $color_source = array();
    $swatch_colors = array();

    // Handle color swatch text that contains multiple colors
    if (is_string($color_name)) {
        $color_names = preg_split('/[:;,|\/\\\\]+/', $color_name, -1, PREG_SPLIT_NO_EMPTY);
    } else {
        $color_names = $color_name;
    }

    // Extract color values from color swatch text
    if (is_array($color_names)) {
        foreach ($color_names as $color_name) {
            // echo "swatch_title $color_name<br/>";
            // Special case for "multi" in color field
            if (stripos($color_name, 'multi') !== FALSE) {
                $is_multicolor = TRUE;
                continue;
            }
            $color_name = str_extract_colors($color_name);
            if (!empty($color_name)) {
                if ($color_name[0] === 'multicolor') {
                    $is_multicolor = TRUE;
                } else if (($color_hex = name_to_color($color_name[0])) >= 0) {
                    $swatch_colors[] = $color_hex;
                }
            }
        }
        if ($is_multicolor || !empty($swatch_colors)) {
            $color_source[] = 'swatch_title';
        }
    }

    // Extract colors from description
    // echo 'Extracting color names from description<br/>';
    $omit_desc_sites = array('dailylook', 'katespade');
    if (!in_array($brand_lower, $omit_desc_sites) && $desc &&
        !empty($desc_color_names = str_extract_colors($desc))) {
        foreach ($desc_color_names as $color_name) {
            if ($color_name === 'multicolor') {
                $is_multicolor = TRUE;
            } else if (($color_hex = name_to_color($color_name)) >= 0) {
                $swatch_colors[] = $color_hex;
            }
        }
        if (is_array($color_names)) {
            $color_names = array_merge($color_names, $desc_color_names);
        } else {
            $color_names = $desc_color_names;
        }
        $color_source[] = 'description';
    }

    // Also extract dominant from swatch image
    if (isset($swatch_rgb)) {
        // echo "Found rgb value from swatch image background!<br/>";
        $swatch_colors[] = $swatch_rgb;
        $color_source[] = 'swatch_rgb';
    } else if ($swatch_src) {
        // echo "Extracting color from swatch image: <img src=\"$swatch_src\"/><br/>";
        $swatch_src = $scraping_model->makeUrl($swatch_src, $url, $doc);
        $swatch_path = $scraping_model->download($swatch_src, APPPATH.'/../uploads/item/');
        // Extract colors from a small area of the image in the center
        try {
            list($img_w, $img_h) = getimagesize($swatch_path);
            $crop_ratio_w = $crop_ratio_h = 0.8;
            $cropped_w = $img_w * $crop_ratio_w;
            $cropped_h = $img_h * $crop_ratio_h;
            $rgb_palette = ColorThief\ColorThief::getPalette($swatch_path, 5, 3, array(
                'x' => ($img_w - $cropped_w)/2.0,
                'y' => ($img_h - $cropped_h)/2.0,
                'w' => $cropped_w,
                'h' => $cropped_h
            ));
            // $rgb_palette = ColorThief\ColorThief::getPalette($swatch_path, 5, 3);
            foreach (array_slice($rgb_palette, 0, 3) as $index => $rgb) {
                list($r, $g, $b) = $rgb;
                $swatch_colors[] = rgb2hex($r, $g, $b);
                // echo sprintf('<div class="swatch" style="background-color:#%02x%02x%02x">%d</div>', $r, $g, $b, $index);
                // echo '<br/>';
            }
            // list($r, $g, $b) = $rgb_palette[0];
            // $swatch_colors[] = rgb2hex($r, $g, $b);
            $color_source[] = 'swatch_image';
        } catch(Exception $e) {
            log_message('error', 'Exception: '.$e->getMessage());
        }
        @unlink($swatch_path);
    }

    if (!$is_multicolor && empty($swatch_colors) && $thumb_src) {
        // echo "Extracting color from thumb image: <img src=\"$thumb_src\"/><br/>";
        $thumb_src = $scraping_model->makeUrl($thumb_src, $url, $doc);
        $thumb_path = $scraping_model->download($thumb_src, APPPATH.'/../uploads/item/');
        // Extract colors from a small area of the image in the center
        try {
            list($img_w, $img_h) = getimagesize($thumb_path);
            $crop_ratio_w = $crop_ratio_h = 0.3;
            $cropped_w = $img_w * $crop_ratio_w;
            $cropped_h = $img_h * $crop_ratio_h;
            $rgb_palette = ColorThief\ColorThief::getPalette($thumb_path, 5, 3, array(
                'x' => ($img_w - $cropped_w)/2.0,
                'y' => ($img_h - $cropped_h)/2.0,
                'w' => $cropped_w,
                'h' => $cropped_h
            ));
            foreach (array_slice($rgb_palette, 0, 3) as $index => $rgb) {
                list($r, $g, $b) = $rgb;
                $swatch_colors[] = rgb2hex($r, $g, $b);
            }
            // list($r, $g, $b) = $rgb_palette[0];
            // $swatch_colors[] = rgb2hex($r, $g, $b);
            $color_source[] = 'thumb_image';
        } catch(Exception $e) {
            log_message('error', 'Exception: '.$e->getMessage());
        }
        @unlink($thumb_path);
    }

    // print_r($swatch_colors);

    if ($is_multicolor) {
        $matched_colors = array(
            array(
                'Name' => 'Multicolor',
                'ColorID' => $color_ids['Multicolor'],
                'Value' => 0xFFFFFF
            )
        );
    } else {
        $matched_colors = array();
    }

    if (!empty($swatch_colors)) {
        $threshold = 0.2;
        $w = array('hue' => 3, 'sat' => 1, 'val' => 1);
        $palette_colors = array();
        foreach ($swatch_colors as $color_hex) {
            $color = new Color($color_hex);
            $palette_colors = array_merge($palette_colors,
                array_slice(close_colors($color, $palette, $threshold, $w), 0, 2));
            // $match_index = closest_palette_color($color, $palette);
            // $match_color = $known_colors[$match_index];
        }
        $palette_colors = array_unique($palette_colors);
        $matched_colors = array_merge($matched_colors,
            array_map(function($index)
                use($known_colors, $color_ids, $palette) {
                $name = $known_colors[$index];
                return array(
                    'Name' => $name,
                    'ColorID' => $color_ids[$name],
                    'Value' => $palette[$index]
                );
            }, $palette_colors));
    }

    return array(
        'Name' => implode(',', $color_names),
        'Source' => implode('+', $color_source),
        'SwatchImageSource' => $swatch_src,
        'ThumbImageSource' => $thumb_src,
        'PaletteColors' => $matched_colors
    );
}
?>
