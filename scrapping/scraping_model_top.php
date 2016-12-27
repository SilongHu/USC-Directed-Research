<?php
error_reporting(E_ALL);
function sd() {
    $last_error = error_get_last();
    if ($last_error && ($last_error['type'] <= E_ERROR || $last_error['type'] > E_NOTICE)) {
        print_r($last_error);
    }
}
register_shutdown_function('sd');

function log_message($level, $message) {
    echo "[$level] $message<br/>".PHP_EOL;
}

class Scraping_model {

    public function getDataFromUrl($url = '') {
		$url=str_replace(' ','%20',trim($url));
        if (method_exists($this, 'load')) {
            $this->load->helper('scraping');
            $this->load->helper('color');
        } else {
            define('APPPATH', '../application');
            require_once APPPATH.'/helpers/scraping_helper.php';
            foreach (array('brand', 'category', 'color', 'description', 'img', 'price', 'size', 'material') as $field) {
                require_once APPPATH."/helpers/scrapers/${field}_scrape_helper.php";
            }
        }

        $data_src_sites = array('zara','mango');
        $data_detailurl = array('versace');
        $data_imageSourceMob = array('valentino');
        $banned_strings = array('loader', 'logo', 'facebook', 'twitter', 'tweet', 'instagram', 'google', 'googleplus', 'gplus', 'header', 'footer', 'banner', 'ico', '.gif', 'flag', 'nav');

        $host = parse_url($url,PHP_URL_HOST);
        $url_ar = explode(".", $host);
        $brand = ucfirst($url_ar[count($url_ar) - 2]);
        $brand_lower = strtolower($brand);

        // shopbop.evyy.net redirects to shopbop
        if ($brand_lower === 'evyy') {
            $brand_lower = 'shopbop';
        } else if ($brand_lower === 'ae') {
            $brand_lower = 'aeo';
        }

        $proxies = array(
          array('108.62.150.242:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('108.62.195.50:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('23.19.155.165:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('108.62.187.177:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('108.62.154.149:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('23.19.176.225:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('108.62.195.15:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('23.19.188.58:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('173.208.12.162:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('173.208.48.100:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('108.62.150.111:8080', 'frenzytesting@hmamail.com:96fyq5t2HV'),
          array('23.19.155.253:8080', 'info@frenzy.me:Ru1yup08X9'),
          array('108.62.154.88:8080', 'info@frenzy.me:Ru1yup08X9'),
          array('108.62.150.119:8080', 'info@frenzy.me:Ru1yup08X9'),
          array('173.208.12.135:8080', 'info@frenzy.me:Ru1yup08X9'),
          array('23.19.176.141:8080', 'info@frenzy.me:Ru1yup08X9'),
          array('23.19.188.243:8080', 'info@frenzy.me:Ru1yup08X9'),
          array('173.234.169.152:8080', 'info@frenzy.me:Ru1yup08X9'),
          array('23.19.127.74:8080', 'info@frenzy.me:Ru1yup08X9'),
          array('108.62.151.18:8080', 'info@frenzy.me:Ru1yup08X9'),
          array('108.62.155.25:8080', 'info@frenzy.me:Ru1yup08X9'),
          array('108.62.172.14:8080', 'info@frenzy.me:Ru1yup08X9')
        );

        // Sites that require proxy
        $proxy_sites = array('saksfifthavenue', 'lordandtaylor', /*'nike', *//*'sephora', *//*'bergdorfgoodman', */'michaelkors', 'zara', 'neimanmarcus');
        // Sites that require phantomjs
        $phantomjs_sites = array('saksfifthavenue', 'barneys', 'thredup', 'sephora', 'kohls', 'gap', 'bodenusa', 'heels', 'nike', 'jcrew', 'ninewest', 'prada', 'luisaviaroma', 'bysymphony', 'romwe', 'nordstromrack', 'zara', 'oldnavy', 'armani', 'boohoo', 'anntaylor', 'loft', 'mytheresa', 'americanapparel', 'alternativeapparel', 'neimanmarcus', 'urbanoutfitters', 'mango', 'yoox', 'agacistore', 'baublebar', 'shopbop', 'intermixonline', 'bergdorfgoodman', 'ralphlauren', 'tomford', 'guess', 'robertocavalli', 'clubmonaco', 'lanecrawford', 'charlotterusse', 'target', 'aeo', 'dollskill', 'madewell', 'loefflerrandall', 'talbots', 'calvinklein', 'needsupply', 'draperjames', 'brooksbrothers', 'trade-mark', 'buckle', 'lastcall', 'tobi', 'rebeccataylor', 'pacsun', 'dolcegabbana', 'macys', 'nastygal', 'shein', 'chicos', 'solesociety', 'anthropologie', 'net-a-porter', 'farfetch', 'drjays', 'zimmermannwear', 'modcloth', 'monnierfreres', 'blueandcreaam', 'vince', 'abercrombie', 'matchesfashion', 'christianlouboutin', 'blueandcream', 'louisvuitton', 'selfridges', 'vestiairecollective');
        $export_canvas_sites = array();
        // The mapping of sites and their js variables
        $evals_map = array(
            // 'saksfifthavenue' => array(
            //     'brand' => 'mlrs.response.body.main_products[0].brand_name.label',
            //     'description' => 'mlrs.response.body.main_products[0].description',
            //     'color' => 'mlrs.response.body.main_products[0].colors.colors[0].label'),
            'finishline' => array(
                'brand' => 'utag_data.product_brand[0] || FL.setup.brand'),
            'chicos' => array(
                'brand' => 'window.brand'),
            'lordandtaylor' => array(
                'brand' => 'pageData.products[0].brand'),
            'thredup' => array(
                'color' => 'utag_data.product_colors[0]'),
            'drjays' => array(
                'color' => 'universal_variable.product.color'),
            'viviennewestwood' => array(
                'color' => 'dataLayer[0].entityTaxonomy.colour_filter'),
            'gap' => array(
                'description' => '(gap.pageProductData.infoTabs.overview.copyAttributes || []).concat(gap.pageProductData.infoTabs.overview.bulletAttributes).join("\\n")'),
            'nordstrom' => array(
                'color' => 'digitalData.product.productInfo.color'),
            'urbanoutfitters' => array(
                'brand' => 'utag_data.product_brand[0]'),
            'vanmildert' => array(
                'brand' => 'dataLayer[1].productBrand || dataLayer[0].productBrand || dataLayer[2].productBrand')
        );
        $user_agents = array(
            'nike' => 'Phantomjs',
            'brooksbrothers' => 'Phantomjs'
        );
        $evals = array_key_exists($brand_lower, $evals_map) ?
            $evals_map[$brand_lower] : array();
        $do_export_canvas = in_array($brand_lower, $export_canvas_sites);
        $user_agent = array_key_exists($brand_lower, $user_agents) ?
            $user_agents[$brand_lower] : random_user_agent();

        $use_phantomjs = $do_export_canvas || !empty($evals) ||
            in_array($brand_lower, $phantomjs_sites);

        $proxycounter = 0;
            while($proxycounter < 5){

                $proxycounter += 1;

                $proxy = in_array($brand_lower, $proxy_sites) ? $proxies[array_rand($proxies)] : NULL;
                log_message('debug', 'Proxy='.($proxy ? $proxy[0] : 'no'));

                if ($use_phantomjs) {
                    list($content, $response, $httpCodeStatus) = phantomjs_request($url, $evals, $do_export_canvas, $user_agent, $proxy);
                    $js_evals = $response->getEvalResults();
                    echo 'Use phantomjs '.$response->getStatus().'<br/>';
                } else {
                    list($content, $httpCodeStatus) = curl_request($url, $user_agent, $proxy);
                }

                $page = $html = $content === NULL ? file_get_contents($url) : $content;
                file_put_contents('/tmp/frenzyhtml.html', $page);
                // echo highlight_string($page);
                        //echo '<pre>'.htmlspecialchars($page).'</pre>'; die;
                $doc = new DOMDocument();
                @$doc->loadHTML(mb_convert_encoding($page, 'HTML-ENTITIES', 'UTF-8'));

                $params = array(
                    'brand_lower' => $brand_lower,
                    'js_evals' => $js_evals,
                    'url' => $url
                );
                $data = array();
		$data['Brand'] = scrape_brand($this, $doc, $params);
                $data['Description'] = scrape_description($this, $doc, $params);
//This is added by silonghu
		#$data['Title'] = scrape_title($this,$doc,$params);
                
                $data['Colors'] = scrape_color($this, $doc, $params, $data['Description']);
//This is added by silonghu
		//$data['ColorID'] = scrape_color($this, $doc, $params);
                        $data['ImageUrl'] = scrape_image($page,$url);
                        $data['Category'] = scrape_category($this,$doc,$url,$data['Description'],$data['Brand']);
                        $data['Title'] = scrape_title($doc,$url,$data['Brand']);
                $data['Material'] = scrap_material($doc, $url, $data['Description'], $data['Title']);
                $price_data = scrape_price($page, $url);
                $data['Price'] = $price_data['price'];
                $data['OnSale'] = $price_data['saleFlag'];
                $size_stock_data = scrape_size($page, $url, $httpCodeStatus);
                $data['Sizes'] = $size_stock_data['size'];
                $data['InStock'] = $size_stock_data['inStock']; 
//silonghu
		//$data['Available'] = $size_stock_data['available']; 
                $data['test'] = 345678909876543456789;

                if(in_array($brand_lower, $proxy_sites)){
                    $emptycounter = 0;
                    foreach($data as $k => $value){
                        if (empty($value)){
                            $emptycounter += 1;
                        }
                    }

                    if ($emptycounter < 5){
                        break;
                    }
                }

                else{
                    break;
                }

            }
 
        return $data;
    }
    
    function download($source='',$destination="uploads/item/"){
        $filename = uniqid().'.jpeg';
        //$source = "http://www.google.co.in/intl/en_com/images/srpr/logo1w.png";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_URL, $source);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_SSLVERSION,3);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12');
        $data = curl_exec ($ch);
        $error = curl_error($ch); 
        curl_close ($ch);
        $destination = $destination.$filename;
        $file = fopen($destination, "w+");
        fputs($file, $data);
        fclose($file);
        return $destination;
    }

    /**
     *  Add http or https or baseurl in the image url (to complete the image path)
     * @param string ()
     * @return string
     * @author Sudhir Parmar
     */
    public function makeUrl($ImageUrl, $hst, $doc = NULL){
        if (rawurldecode($ImageUrl) === $ImageUrl) {
            $ImageUrl = encodeURI($ImageUrl);
        }

        //return $url.'<br>';
        $baseUrl = $this->getBaseUrl($hst, $doc);
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
    
    /**
     *  get base url from the given url (for Item Brand/Designer)
     * @param string ()
     * @return string
     * @author Sudhir Parmar
     */
    private function getBaseUrl($hst, $doc = NULL){
        if (isset($doc) && ($base_element = element_by_selector($doc, 'base[href]'))) {
            return $this->makeUrl($base_element->getAttribute('href'), $hst);
        }
        $urlData = parse_url ( $hst);
        $baseurl= $urlData['scheme'].'://'.$urlData['host'].'/';
        return $baseurl;
    }
}
?>
