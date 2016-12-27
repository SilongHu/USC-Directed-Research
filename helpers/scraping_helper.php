<?php
require_once APPPATH.'/vendor/autoload.php';
require_once APPPATH.'/third_party/phantomjs/CustomRequest.php';
require_once APPPATH.'/third_party/phantomjs/CustomResponse.php';

define('USER_AGENT_CHROME_41', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');

function random_user_agent($user_agents = NULL) {
    static $default_user_agents = NULL;
    if ($default_user_agents === NULL) {
        $default_user_agents = array(
            // Chrome
            USER_AGENT_CHROME_41,
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.38 Safari/537.36',
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.71 Safari/537.36',
            // Opera
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.60 Safari/537.36 OPR/39.0.2256.30 (Edition beta)',
            'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36 OPR/32.0.1948.25',
            // Firefox
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:47.0) Gecko/20100101 Firefox/47.0',
            'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0'
        );
    }
    if (!is_array($user_agents)) {
        $user_agents = $default_user_agents;
    }
    return $user_agents[array_rand($user_agents)];
}

/**
 * Request a url using curl.
 * 
 * @param  string  $url     A url to be requested
 * @param  string  $user_agent  User-Agent string. If FALSE, it won't be set.
 *                              (Default = Chrome 41's)
 * @return string           The page content
 */
function curl_request($url, $user_agent = USER_AGENT_CHROME_41, $proxy = NULL) {
    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);  # Set curl to return the data instead of printing it to the browser.
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/23.0 (compatible; MSIE 8.0; Windows NT 6.1)"); # Some server may refuse your request if you dont pass user agent
    if ($user_agent !== FALSE) {
        curl_setopt($ch, CURLOPT_USERAGENT, isset($user_agent) ? $user_agent :
            USER_AGENT_CHROME_41);
    }
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
    if (isset($proxy)) {
        if (is_array($proxy)) {
            list($proxy, $proxy_auth) = $proxy;
        }

        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        if (isset($proxy_auth)) {
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_auth);
        }
    }

    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $header = substr($response, 0, $header_size);
    $httpCodeStatus = true;

    // Get the header and determine whether redirection happens
    $headers_end = strpos($response, "\n\n");
    if( $headers_end !== false ) { 
        $out = substr($response, 0, $headers_end);
        $headers = explode("\n", $out);
    } else {
        $headers = array();
    }

    foreach($headers as $header) {
        if( substr($header, 0, 10) == "Location: " ) { 
            $target = substr($header, 10);
            $httpCodeStatus = false;
        }   
    }  

    // Check whether httpCode is valid
    if ( preg_match_all('/^3|^4|^0$|301$/i', trim($httpCode), $matches) ) {
        // echo "httpCode = " . $httpCode . "-------bad entry || 404NotFound || hostNotFound";
        $httpCodeStatus = false;
    }

    return array($httpCode == 200 ? substr($response, $header_size) : NULL, $httpCodeStatus);
}

/**
 * Request a url using phantomjs.
 * 
 * @param  string  $url     A url to be requested
 * @param  array   [$evals] A mapping between a property and its js evaluation
 *                          (e.g. color => window.product_data.color,
 *                          Default = array())
 * @param  boolean [$export_canvas] A boolean indicating whether to export canvas'
 *                                  data url as an attribute (Default = FALSE)
 * @param  string   $user_agent User-Agent string. If FALSE, it won't be set.
 *                              (Default = Chrome 41's)
 * @return array(string, CustomResponse) An array of page content and response object
 */
function phantomjs_request($url, $evals = array(), $export_canvas = FALSE, $user_agent = USER_AGENT_CHROME_41, $proxy = NULL) {
    static $client = NULL;
    if ($client === NULL) {
        $client = JonnyW\PhantomJs\Client::getInstance();
        $engine = $client->getEngine();
        $engine->setPath(APPPATH.'/bin/phantomjs');
        $engine->addOption('--load-images=false');
        $engine->addOption('--ssl-protocol=any');
        $engine->addOption('--ignore-ssl-errors=true');
        $engine->addOption('--web-security=false');
        if (isset($proxy)) {
            if (is_array($proxy)) {
                list($proxy, $proxy_auth) = $proxy;
            }

            $engine->addOption('--proxy='.$proxy);
            if (isset($proxy_auth)) {
                $engine->addOption('--proxy-auth='.$proxy_auth);
            }
        }

        // Use customized procedures
        // $client->getProcedureCompiler()->clearCache();
        $serviceContainer = JonnyW\PhantomJs\DependencyInjection\ServiceContainer::getInstance();
        $proc_location = APPPATH.'/third_party/phantomjs/custom_procedures';
        $procedureLoader = $serviceContainer->get('procedure_loader_factory')->createProcedureLoader($proc_location);
        $client->getProcedureLoader()->addLoader($procedureLoader);
        // $engine->debug(true);
    }
    
    $request = new CustomRequest($url);
    $response = new CustomResponse();
    
    $request->setViewportSize(1440, 900);
    $request->setFollowLocation(TRUE);
    $request->setMaxRedirs(3);
    $request->setEvals($evals);
    $request->setExportCanvasData($export_canvas);
    // $request->addHeader('Host', 'ssl-proxy.my-addr.org');
    if ($user_agent !== FALSE) {
        $request->addHeader('User-Agent', isset($user_agent) ? $user_agent :
            USER_AGENT_CHROME_41);
    }
    $request->addHeader('Referer', $url);
    $request->setTimeout(30000);
    // Some sites e.g. anntaylor require a delay
    $request->setDelay(5);

    $client->send($request, $response);
    $httpCodeStatus = true;

    // Get the header and determine whether redirection happens
    if ($response->isRedirect()) {
        $httpCodeStatus = false;
    }

    // Check whether httpCode is valid
    if ( preg_match_all('/^3|^4|^0$|301$/i', trim($response->status), $matches) ) {
        // echo "httpCode = " . $httpCode . "-------bad entry || 404NotFound || hostNotFound";
        $httpCodeStatus = false;
    }

    $content = $response->getContent();
    
    return array(empty($content) ? NULL : $content, $response, $httpCodeStatus);
}

/**
 * Query elements by css selector.
 * @param  XMLDocument $doc An html document to query from
 * @param  string $selector A css selector    
 * @return DOMNodeList      The list of elements matching the selector
 */
function query_selector($doc, $selector, $context = NULL) {
    static $converter = NULL;
    if ($converter === NULL) {
        $converter = new Symfony\Component\CssSelector\CssSelectorConverter();
    }
    $xpath = new DOMXPath($doc);
    // echo $converter->toXPath($selector).'<br/>';
    $selector = $converter->toXPath($selector);
    $elements = isset($context) ? $xpath->query($selector, $context) :
        $xpath->query($selector);
    return $elements;
}

/**
 * Query elements by css selector.
 * @param  XMLDocument $doc An html document to query from
 * @param  string $selector A css selector    
 * @return DOMNode          The first element matching the selector
 */
function element_by_selector($doc, $selector, $context = NULL) {
    $elements = query_selector($doc, $selector, $context);
    if ($elements->length) {
        return $elements->item(0);
    }
    return NULL;
}

/**
 * Get text content of a dom node and all its descendants recursively.
 * @param  DOMNode $node    The target DOM node
 * @return string           The text content
 */
function dom_format_text($node) {
    if (!$node)
        return '';
    if ($node->hasChildNodes()) {
        $texts = array();
        foreach ($node->childNodes as $child_node) {
            if ($child_node->nodeName === 'style')
                continue;

            $child_text = dom_format_text($child_node);
            if ($child_text) {
                $texts[] = $child_text;
            }
        }
        // print_r($texts);
        return implode(PHP_EOL, $texts);
    }
    return trim($node->textContent);
}

function css_background_image($element) {
    if ($element && preg_match('/background(?:-image)?\s*:[^;]*url\(\s*([^\)]+)\s*\)/i', $element->getAttribute('style'), $matches)) {
        return trim(trim($matches[1]), '"\'');
    }
    return NULL;
}

function css_background_color($element) {
    if ($element && preg_match('/background(?:-color)?\s*:[^;]*(rgb\(\s*([^\)]+)\s*\)|#[0-9a-f]{3,6})/i', $element->getAttribute('style'), $matches)) {
        if ($matches[1][0] == '#') {
            $hex = ltrim(trim($matches[1]), '#');
            if (strlen($hex) === 3) {
                $hex = "${hex[0]}${hex[0]}${hex[1]}${hex[1]}${hex[2]}${hex[2]}";
            }
            $rgb = hexdec($hex);
        } else {
            // TODO: extract hsl and color name
            list($r, $g, $b) = array_map('intval', explode(',', $matches[2]));
            $rgb = hexdec(sprintf('%02x%02x%02x', $r, $g, $b));
        }
        return $rgb;
    }
    return NULL;
}

// http://stackoverflow.com/a/19858404
function encodeURI($uri) {
    return preg_replace_callback("{[^0-9a-z_.!~*'();,/?:@&=+$#-]}i", function ($m) {
        return sprintf('%%%02X', ord($m[0]));
    }, $uri);
}

?>