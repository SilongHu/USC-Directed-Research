<?php
function scrape_brand($scraping_model, $doc, $params) {
    if (is_subclass_of($scraping_model, 'Common_Model')) {
        $scraping_model->load->helper('scraping');
    }
    
    extract($params);
    switch ($brand_lower) {
        case 'armani':
            $element = element_by_selector($doc, 'div.divisionLogo a.image.logo');
            if ($element) {
                $brand_href = trim($element->getAttribute('href'));
                $brand_name = array_pop(preg_split('/\//', $brand_href, -1, PREG_SPLIT_NO_EMPTY));
                $brand_name = trim(str_ireplace('ARMANI', ' ARMANI ', strtoupper($brand_name)));
            } else {
                $brand_name = 'Armani';
            }
            break;
        case 'pacsun':
            $element = element_by_selector($doc, 'div.brandLogo img');
            $brand_name = $element ? $element->getAttribute('title') : 'Pacsun';
            break;
        case 'dollskill':
            $element = element_by_selector($doc, 'div.product-brand.desk');
            $brand_name = dom_format_text($element);
            if (empty($brand_name)) {
                $brand_name = 'Dolls Kill';
            }
            break;
        case 'versace':
            $brand_name = element_by_selector($doc, 'span.versus-mark') ?
                'Versus by Versace' : 'Versace';
            break;
        case 'topshop':
            // find "by {{brand_name}}" in description where brand_name is in title
            $title_element = element_by_selector($doc, 'div.product_details > h1:first-of-type');
            $title_text = dom_format_text($title_element);
            if ($title_text) {
                $title_words = preg_split('/\s+/', $title_text, 5);
                for ($i = min(4, count($title_words)); $i > 0; $i--) {
                    $prefix = implode(' ', array_slice($title_words, 0, $i));
                    if (preg_match("/\s+by\s+($prefix)/i", $desc, $matches)) {
                        $brand_name = $matches[1];
                        break;
                    }
                }
                if ($i > 0) {
                    break;
                }
            }
            $brand_name = 'TOPSHOP';
            break;
        case 'amazon':
            // a#brand or find brand name in a#brand[href]
            $element = element_by_selector($doc, 'a#brand');
            $brand_name = dom_format_text($element);
            if (empty($brand_name)) {
                if (preg_match('/\Wfield-lbr_brands_browse-bin=([^&$]+)/',
                    $element->getAttribute('href'), $matches)) {
                    $brand_name = urldecode($matches[1]);
                }
            }
            break;
        case 'designsbystephene':
            // <link itemprop="brand" href="BRAND NAME" />
            $element = element_by_selector($doc, 'link[itemprop=brand]');
            $brand_name = $element ? $element->getAttribute('href') : '';
            break;
        case 'gap':
            // check subdomain to see if it's bananarepublic
            $domain_parts = explode('.', parse_url($url,PHP_URL_HOST));
            $num_parts = count($domain_parts);
            $subdomain = $num_parts >= 3 ? strtolower($domain_parts[$num_parts - 3]) : 'www';
            if ($subdomain === 'bananarepublic') {
                $brand_name = 'Banana Republic';
            } else if ($subdomain === 'oldnavy') {
                $brand_name = 'Old Navy';
            } else {
                $brand_name = 'Gap';
            }
            break;
        case 'guess':
            //check subdomain to see if it's guess by marciano
            $domain_parts = explode('.', parse_url($url, PHP_URL_HOST));
            $num_parts = count($domain_parts);
            $subdomain = $num_parts >= 3 ? strtolower($domain_parts[$num_parts - 3]) : 'www';
            if ($subdomain === 'guessbymarciano') {
                $brand_name = 'GUESS by Marciano';
            }
            else{
                $brand_name = 'GUESS';
            }
            break;
        case 'urbanoutfitters':
        case 'finishline':
        case 'chicos':
        case 'vanmildert':
            // js brand
            $brand_name = trim($js_evals['brand']);
            break;
        case 'lordandtaylor':
            $brand_name = trim($js_evals['brand']);
            if (empty($brand_name)) {
                $element = element_by_selector($doc, 'h2.detial');
                if ($element) {
                    // 0xC2 0xA0 = &#194;&#160; = &nbsp;
                    $nbsp = html_entity_decode('&nbsp;');
                    if (preg_match('/^(\w+)\xc2\xa0/', $element->textContent, $matches)) {
                        $brand_name = trim($matches[1]);
                    }
                }
            }
            $brand_name = strtoupper($brand_name);
            break;
        case 'drjays':
        case 'asos':
        case 'buckle':
            // selector + regex
            $rules = array(
                'drjays' => array('div#column2-pdp h2', '/^by\s+(.+)$/i'),
                // 'asos' => array('div.brand-description > h2', '/^ABOUT\s+(.+?)(\s+BRAND)?$/i'),
                'asos' => array('title', '/^([^|]+)\|/'),
                'buckle' => array('div#shop-this-brand > a:nth-last-child(2)', '/^All\s+(\S.*)$/')
            );
            $rule = $rules[$brand_lower];
            $element = element_by_selector($doc, $rule[0]);
            if ($element) {
                if (preg_match($rule[1], dom_format_text($element), $matches)) {
                    $brand_name = trim($matches[1]);
                    break;
                }
            }
            $brand_name = '';
            break;
        case 'jcrew':
            $meta = element_by_selector($doc, 'meta[property="og:title"]');
            if ($meta) {
                $title = $meta->getAttribute('content');
                if (preg_match('/^(.+?)([®©™]|\s+for j\.crew)/i', $title, $matches)) {
                    $brand_name = trim($matches[1]);
                    break;
                }
            }
            $brand_name = 'J.CREW';
            break;
        // case 'hugoboss':
        //     $meta = element_by_selector($doc, 'span.productBrand > meta[itemprop=name]');
        //     $brand_name = $meta ? $meta->getAttribute('content') : '';
        //     break;
        case 'bergdorfgoodman':
            $input = element_by_selector($doc, 'input.cmDesignerName');
            if ($input) {
                $brand_name = $input ? $input->getAttribute('value') : '';
            } else {
                $element = element_by_selector($doc, 'div#productDetails h1[itemprop=name]');
                $brand_name = $element && $element->hasChildNodes() ?
                    trim($element->childNodes->item(0)->textContent) : '';
            }
            break;
        case 'ralphlauren':
            $input = element_by_selector($doc, 'div.prod-brand-logo > img');
            $brand_name = $input ? $input->getAttribute('alt') : '';
            if (stripos($brand_name, 'Ralph Lauren') === FALSE) {
                $brand_name = "Ralph Lauren $brand_name";
            }
            break;
        case 'allsaints':
            $meta = element_by_selector($doc, 'meta[itemprop=brand]');
            $brand_name = $meta ? $meta->getAttribute('content') : '';
            if (empty($brand_name)) {
                $brand_name = 'AllSaints';
            }
            break;
        // case 'forever21':
        //     $element = element_by_selector($doc, 'h1.brand_name_p');
        //     $brand_name = dom_format_text($element);
        //     if (empty($brand_name)) {
        //         $brand_name = 'Forever 21';
        //     }
        //     break;
        // meta .attr('content')
        case 'zappos':
        case 'dailylook':
        case 'unionandfifth':
        case 'italist':
        case 'kohls':
        // case 'urbanoutfitters':
        case 'anthropologie':
        case 'alternativeapparel':
        case 'tomford':
        case 'christianlouboutin':
        case 'tradesy':
            $meta = element_by_selector($doc, 'meta[itemprop=brand], meta[itemtype=brand], meta[property="og:brand"]');
            $brand_name = $meta ? $meta->getAttribute('content') : '';
            break;
        // [div, p, span, a] [itemprop=brand]
        case 'farfetch':
        case 'aritzia':
        //case 'yoox':
        case 'designsbystephene':
        case '6pm':
        case 'shopbop':
	//This is added by silonghu
	case 'nordstromrack':
	    $meta = element_by_selector($doc, 'meta[property="og:title"]');
            $brand_name = $meta ? $meta->getAttribute('content') : '';
	    //$span = element_by_selector($doc, 'span[class="product-details__title-name"]');
	    //$brand_name = $brand_name. $span;

//<span class="product-details__title-name" data-reactid="409">Sparkle Cami Dress</span>

	    break;

        case 'vestiairecollective':
        case 'monnierfreres':
        case 'neimanmarcus':
        case 'intermixonline':
        case 'harrods':
        case 'selfridges':
        case 'michaelkors':
        case 'bysymphony':
        case 'lanecrawford':
        case 'target':
        case 'ssense':
        case 'lastcall':
            $element = element_by_selector($doc, '*[itemprop=brand]');
            $brand_name = dom_format_text($element);
            break;
        case 'yoox':
            $element = element_by_selector($doc, '*[itemprop=brand]');
            $brand_name = dom_format_text($element);
            if (empty($brand_name)) {
               $element = element_by_selector($doc, 'a[data-tracking-label=brand]');
               $brand_name = dom_format_text($element);
            }
            break;
        // *[itemprop=brand] > *[itemprop=name]
        case 'saksfifthavenue':
        case 'net-a-porter':
        case 'nordstrom':
        case 'therealreal':
        case 'johnlewis':
        case 'gilt':
            $element = element_by_selector($doc, '*[itemprop=brand] *[itemprop=name]');
            $brand_name = dom_format_text($element);
            break;
        default:
            $selectors = array(
                'mytheresa' => 'div.product-designer',
                'thredup' => 'div.brand-title',
                'sephora' => 'h1.PdpPrimary-title > a > span, h1.pdp-primary__title > a > span',
                'boohoo' => 'p.getBrand',
                'revolve' => 'h2.product-titles__brand[property=brand] > a',
                'solesociety' => 'h2.product_brand',
                'heels' => 'div.product-name h1:first-of-type > a[href*=brand]',
                'theoutnet' => 'div[id$=product-heading] > h1 > a[href]',
                'boutiquetoyou' => 'div#content > h2 > a',
                // 'forever21' => 'h1.brand_name_p',
                'macys' => 'a#brandNameLink, a.brandNameLink',
                'bloomingdales' => 'a#brandNameLink, a.brandNameLink',
                'luisaviaroma' => 'a#sp_a_designer',
                'matchesfashion' => 'h3.pdp-headline > a[href*=designers]',
                'stylebop' => 'div.product_name > h1 > a.caption_designer',
                //'nordstromrack' => 'h1.summary__brand-name > a',
                'barneys' => 'h1.prd-brand > a',
                'blueandcream' => 'div.name-price > h1',
                'needsupply' => 'div.details > h2',
                'fwrd' => 'h2.designer_brand > a',
                'modaoperandi' => 'div#product-info h1.product-title a.designer-link',
                'antonioli' => 'div.product-details h2'
            );
            $brands = array(
                'agacistore' => 'Agaci',
                'katespade' => 'Kate Spade New York',
                'hm' => 'H&M',
                'shein' => 'SheInside',
                'abercrombie' => 'Abercrombie & Fitch',
                'aeo' => 'American Eagle Outfitters',
                'bcbg' => 'BCBGMAXAZRIA',
                'bodenusa' => 'Boden',
                'zimmermannwear' => 'Zimmermann',
                'trade-mark' => 'Trademark',
                'dolcegabbana' => 'Dolce&Gabbana'
            );
            $simple_brand_names = array(
                'River Island',
                'Mango',
                'Baublebar',
                'Nasty Gal',
                'Ann Taylor',
                // 'Gap',
                'Tory Burch',
                'LOFT',
                // 'Ralph Lauren',
                'American Apparel',
                'Chic Wish',
                'Teri Jon',
                'Nike',
                'Henri Bendel',
                'ModCloth',
                'Free People',
                'Forever 21',
                'Express',
                'Nine West',
                'Louis Vuitton',
                // 'Versace',
                'Zara',
                'Fendi',
                'Prada',
                'Valentino',
                'Roberto Cavalli',
                'Vivienne Westwood',
                //'GUESS',
                'Hugo Boss',
                'Burberry',
                'Club Monaco',
                'Romwe',
                'Charlotte Russe',
                'Marc Jacobs',
                'Old Navy',
                'Madewell',
                'Vince',
                'Loeffler Randall',
                'Talbots',
                'Etsy',
                'Calvin Klein',
                'Draper James',
                'Uniqlo',
                'Gucci',
                'Puma',
                'Adidas',
                'Brooks Brothers',
                'Won Hundred',
                'Tobi',
                'Rebecca Taylor',
                'DKNY',
                'Coach',
                'Maykool'
            );
            foreach ($simple_brand_names as $simple_brand_name) {
                $brands[strtolower(str_replace(' ', '', $simple_brand_name))] = $simple_brand_name;
            }
            if (array_key_exists($brand_lower, $selectors)) {
                $element = element_by_selector($doc, $selectors[$brand_lower]);
                $brand_name = $element ? dom_format_text($element) :
                    '-- Invalid selector --';
            } else if (array_key_exists($brand_lower, $brands)) {
                $brand_name = trim($brands[$brand_lower]);
            } else {
                $brand_name = '-- Not implemented --';
            }
    }
    return $brand_name;
}
?>
