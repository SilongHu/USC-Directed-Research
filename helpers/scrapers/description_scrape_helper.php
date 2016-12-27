<?php

function format_meta_content($meta) {
    if ($meta) {
        $doc = new DomDocument();
        $doc->loadHTML($meta->getAttribute('content'));
        return dom_format_text($doc);
    }
    return '';
}

function scrape_description($scraping_model, $doc, $params) {
    if (is_subclass_of($scraping_model, 'Common_Model')) {
        $scraping_model->load->helper('scraping');
    }

    extract($params);
    switch ($brand_lower) {
        case 'gap':
            $desc = trim($js_evals['description']) . PHP_EOL;
            $element = element_by_selector($doc, 'div[class="product-information--details accordion--content"] ul');
            $desc .= dom_format_text($element);
            break;
        case 'modcloth':
            $meta = element_by_selector($doc, 'meta[name=description]');
            $desc = format_meta_content($meta);
            if (!$desc) {
                $desc = dom_format_text(
                    element_by_selector($doc, 'div[itemprop=description]'));
            }
            break;
        case 'theoutnet':
            $elements = query_selector($doc, 'li#details-section div.tab-details > *:not(#customer-care-link)');
            $desc = '';
            foreach ($elements as $element) {
                $desc .= dom_format_text($element).PHP_EOL;
            }
            $desc = $desc;
            break;
        case 'boohoo':
            $element = element_by_selector($doc, 'div#infotab div[itemprop="description"]');
            $desc = dom_format_text($element).PHP_EOL;
            $element = element_by_selector($doc, 'div#infotab div.content > p');
            $desc .= dom_format_text($element);
            break;
        case 'selfridges':
            // 'selfridges' => array('p[itemprop="description"]', 'div.productDetails ul'),
            $element = element_by_selector($doc, 'p[itemprop="description"]');
            $desc = dom_format_text($element).PHP_EOL;
            $element = element_by_selector($doc, 'div.productDetails ul');
            $desc .= dom_format_text($element);
            $desc = strip_tags($desc);
            break;
        // meta itemprop=description
        case 'italist':
        case 'viviennewestwood':
            $meta = element_by_selector($doc, 'meta[itemprop=description]');
            $desc = format_meta_content($meta);
            break;
        // meta name=description
        case 'mango':
            $meta = element_by_selector($doc, 'meta[name=description]');
            $desc = format_meta_content($meta);
            $element = element_by_selector($doc, 'div[class="composicion_texto productExtra__text"]');
            $desc = $desc . ' ' . dom_format_text($element);
            break;
        case 'uniqlo':
            if (strpos($url, 'uk')) {
                $meta = element_by_selector($doc, 'meta[property="og:description"]');
                $desc = format_meta_content($meta);
                $elements = query_selector($doc, 'dl[class="spec clearfix"] dd');
                foreach ($elements as $element) {
                    $desc .= ' ' . dom_format_text($element);
                }
            
                break;
            }
        case 'agacistore':
        case 'baublebar':
        case 'kohls':
        case 'urbanoutfitters':
        case 'nastygal':
        // case 'katespade':
        case 'anntaylor':
        case 'loft':
        case 'americanapparel':
        case 'allsaints':
        case 'michaelkors':
        case 'versace':
        case 'hm':
        case 'prada':
        case 'robertocavalli':
        case 'charlotterusse':
        case 'loefflerrandall':
        case 'dkny':
            $meta = element_by_selector($doc, 'meta[name=description]');
            $desc = format_meta_content($meta);
            break;
        // meta property=og:description
        case 'chicos':
        case 'jcrew':
        case 'henribendel':
        // case 'forever21':
        case 'tomford':
        case 'christianlouboutin':
        case 'burberry':
        case 'stylebop':
        case 'marcjacobs':
        case 'madewell':
        case 'tradesy':
        case 'adidas':
        case 'pacsun':
        case 'antonioli':
        case 'coach':
            $meta = element_by_selector($doc, 'meta[property="og:description"]');
            $desc = format_meta_content($meta);
            break;
        // div|p|span itemprop=description
        case 'zappos':
        // case 'farfetch':
        // case 'aritzia':
        case 'designsbystephene':
        case 'nordstrom':
        case '6pm':
        // case 'boohoo':
        case 'shopbop':
        case 'toryburch':
        case 'anthropologie':
        case 'alternativeapparel':
        case 'bodenusa':
        case 'chicwish':
        // case 'monnierfreres':
        case 'terijon':
        case 'intermixonline':
        case 'freepeople':
        case 'neimanmarcus':
        // case 'bergdorfgoodman':
        // case 'harrods':
        // case 'selfridges':
        // case 'macys':
        // case 'bloomingdales':
        // case 'louisvuitton':
        case 'ralphlauren':
        case 'valentino':
        case 'bysymphony':
        // case 'lanecrawford':
        case 'vince':
        case 'therealreal':
        case 'bcbg':
        case 'vanmildert':
        case 'ssense':
        case 'puma':
        case 'brooksbrothers':
        case 'lastcall':
        case 'rebeccataylor':
        case 'johnlewis':
        case 'gilt':
            $element = element_by_selector($doc, 'div[itemprop=description], p[itemprop=description], span[itemprop=description], section[itemprop=description]');
            $desc = dom_format_text($element);
            break;
//Here is added by silonghu
	case 'nordstromrack':
	    $elements = query_selector($doc, 'dd[class=product-details-section__definition]');
                foreach ($elements as $element) {
                    $desc .= ' ' . dom_format_text($element);
                }
	    #$element = element_by_selector($doc, );
	    #$element2 = element_by_selector($doc, 'dt[class=product-details-section__term]');
            #$desc1 = dom_format_text($element);
	    #$desc2 = dom_format_text($element2);
	    #$desc = $desc . $desc2;
	    break;


        default:
            $selectors = array(
                'saksfifthavenue' => 'section.product-description',
                'riverisland' => '.product__description ul',
                'mytheresa' => array('p.product-description', 'ul.featurepoints'),
                'farfetch' => array('div[data-tstid=Content_Description] > p[itemprop=description]', 'div[data-tstid="Content_Composition&Care"]'),
                // 'mango' => 'div.panel_descripcion', // not a typo
                // 'aritzia' => 'div.pdp-tabs > div#pdp-tab1 > p',
                'aritzia' => array('div.pdp-tab-content > p', 'div.pdp-tab-content ul', 'div#pdp-details[itemprop=description] > div.pdp-tab-content ul'),
                'yoox' => array('ul.item-info-content > li#Composition', 'ul.item-info-content > li#ItemDescription' ),
                'thredup' => 'div.item-detail-expander ul:first-of-type, div.description-text ul',
                'dailylook' => array('div[itemprop=description], ul.product-details', 'ul[class="product-details"]'),
                'sephora' => 'div.long-description',
                'drjays' => 'div#product-description',
                'unionandfifth' => 'div.desc',
                'net-a-porter' => 'widget-show-hide[name="Editor\'s Notes"] > div.show-hide-content',
                'revolve' => 'ul.product-details__list',
                'katespade' => 'div.description-details',
                // 'gap' => 'div.product-information--details',
                'asos' => array('div.product-description', 'div.about-me'),
                // 'anthropologie' => 'div.product-details > div.details-box',
                // 'ralphlauren' => 'div#longDescDiv',
                'vestiairecollective' => 'li#productDescription > div.details',
                'finishline' => 'div#productDescription',
                'solesociety' => 'div#description > div.std',
                'heels' => 'div.product-description',
                'monnierfreres' => array('p[itemprop=description]', 'div#pdp_tabs_desc'),
                'nike' => 'div.pi-pdpmainbody',
                'lordandtaylor' => 'div#detial_main_content', // their typo
                'boutiquetoyou' => 'div.productdescription',
                'forever21' => 'div.description_wrapper article',
                'bergdorfgoodman' => array('div.product-details-info > div.productTop', 'div[itemprop=description]'),
                'harrods' => array('p[itemprop=description]', 'dl#details ul'),
                'express' => 'div.product-description',
                'ninewest' => array('div#descContentDesc', 'div#descDetailItems'),
                'macys' => array('div[itemprop=description]', 'div[itemprop=description] ~ ul'),
                'bloomingdales' => array('div[itemprop=description]', 'div[itemprop=description] ~ ul'),
                'louisvuitton' => 'div#productDescription div.functional-text',
                'zara' => 'div#description > p.description',
                'fendi' => 'p.fd-pp-intro',
                'guess' => 'div.productDescription',
                'hugoboss' => 'div.accordion__description__item > div.accordion__item__text > div.accordionToggle',
                'luisaviaroma' => 'ul#sp_details',
                'topshop' => 'div#productInfo > p',
                'matchesfashion' => array('div.scroller-content > p:first-of-type', 'ul.pdp-accordion__body__details-list'),
                'clubmonaco' => 'div#tab-details',
                'lanecrawford' => array('div[itemprop=description]', 'div#product-details div.tab2'),
                'romwe' => 'div.ItemSpecificationCenter',
                //'nordstromrack' => 'div.description__details',
                'barneys' => 'div#collapseOne > div.panel-body',
                'shein' => 'div.goods_description_con',
                'target' => 'div#product-attributes div.title+div',
                'amazon' => 'div#feature-bullets',
                'armani' => 'div.descriptionContent',
                'dollskill' => array('div#desk-text', 'p.deets'),
                'abercrombie' => 'div.product-description h2.copy',
                'aeo' => array('div.pdp-about-copy-specifics', 'ul.pdp-about-bullets', 'aside.aeo-pdp-productdetails'),
                'blueandcream' => 'div.prod-desc h1 ~ div',
                'talbots' => 'div.prodLongDesc div.pdpViewbullets',
                'etsy' => 'div#description-text',//'div#item-overview ul.properties',
                'calvinklein' => array('div.description div.collapsable', 'div.productBullets'),
                'needsupply' => 'p.description',
                'fwrd' => 'div#details',
                'draperjames' => array('div#description div.tab-entry', 'div#details div.tab-entry'),
                'gucci' => 'div.product-detail',
                'zimmermannwear' => 'p.itemDesc',
                'wonhundred' => 'div[property="content:encoded"]',
                'trade-mark' => array('div#product-pane-description', 'div#product-pane-details'),
                'buckle' => 'div#product-details',
                'tobi' => 'div#description',
                'dolcegabbana' => 'div.tabsPanel.active div.scrollCnt',
                'modaoperandi' => array('div.product-desc', 'div.product-desc + div.product-desc'),
                'maykool' => array('div#product_tabs_quickview_contents')
            );
            if (array_key_exists($brand_lower, $selectors)) {
                $selector = $selectors[$brand_lower];
                if (is_string($selector)) {
                    $selector = array($selector);
                }
                $desc_paragraphs = array();
                foreach ($selector as $selector_string) {
                    $element = element_by_selector($doc, $selector_string);
                    $desc_paragraphs[] = dom_format_text($element);
                }
                $desc = implode(PHP_EOL, $desc_paragraphs);
            } else {
                $desc = '-- Not implemented --';
            }
        }

    // TODO: strip tags
    return $desc;
}
?>
