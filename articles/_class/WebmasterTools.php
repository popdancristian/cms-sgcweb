<?
class WebmasterTools 
{

    function WebmasterTools($username, $password) 
    {
        $this->_Login($username, $password);
    }

    function _Curl($url, $contentType, $content='')
    {
        $ch = curl_init($url);

        $header[] = 'Authorization: GoogleLogin auth='.$this->auth['Auth'];
        $header[] = 'GData-Version: 2';
        $header[] = 'Content-Type: '.$contentType;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        $result = curl_exec($ch);

        if(curl_getinfo($ch, CURLINFO_HTTP_CODE) === 201) $b_success = true;
        else $b_success = false;

        curl_close($ch);

        return $b_success;
    }

    function _Http($method, $url, $contentType, $content='') 
    {
        $method = strtoupper($method);
        $opts = array('http' =>
            array(
                'method'  => $method,
                'protocol_version' => 1.0,
                'header'  => 'Content-type: ' . $contentType .
                             (isset($this->auth) && isset($this->auth['Auth']) ? "\nAuthorization: GoogleLogin auth=" . $this->auth['Auth']  : '' ) .
                             "\nContent-Length: " . strlen($content)."\nGData-Version: 2",
                'content' => $content,
                'timeout' => 5 
            )
        );
        
        $context  = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        return $result;                
        
    }

    function _Login($username, $password, $service='sitemaps') {
        $postdata = http_build_query(
            array('accountType' => 'GOOGLE',
                  'Email'  => $username,
                  'Passwd' => $password,
                  'source' => 'WebmasterTools-Class',
                  'service'=> $service)
            );

        $login = $this->_Http('POST', 'https://www.google.com/accounts/ClientLogin','application/x-www-form-urlencoded', $postdata);
        $lines = explode("\n", $login);

        $data = array();
        foreach ($lines as $line) 
        {
          if (!empty($line))
          {
              list($var,$value) = explode('=', $line);
              $data[$var] = $value;
          }
        }

        $this->auth=$data;
    }

    function _GetText($node) {
        $text = '';
        for ($i=0; $i < $node->childNodes->length; $i++) {
            $child = $node->childNodes->item($i);
            if ($child->nodeType==XML_TEXT_NODE)
                $text .= $child->wholeText;
        }
        return $text;
    }

    // array_elements_in has the set of tags we should use as array b
    // because they may repeat.
    function _ElementToArray($node, $array_elements_in = array()) {
        $row = array();

        $array_elements = array();
        foreach ($array_elements_in as $array_element)
           $array_elements[$array_element] = true;

        for ($i=0; $i < $node->childNodes->length; $i++) {
            $item = $node->childNodes->item($i);
            if (!isset($item->tagName)) continue;
            $children = $this->_ElementToArray($item, $array_elements_in);
            if (count($children) > 0) {
                $value = $children;
            } else {
                $value = $this->_GetText($item);
            }
            if (isset($array_elements[$item->tagName])) {
                if (!isset($row[$item->tagName])) $row[$item->tagName] = array();
                $row[$item->tagName][] = $value;
            } else
                $row[$item->tagName] = $value;
        }
        return $row;
    }


    function submitSitemap($site,$sitemap) 
    {
            
      $url = 'https://www.google.com/webmasters/tools/feeds/{site}/sitemaps/';
      $method = 'post';
      $site = "http://$site/";
      $url = str_replace('{site}', urlencode($site), $url);
      $xml = '';
             
      $doc = new DOMDocument('1.0', 'utf-8');
      $root = $doc->createElementNS("http://www.w3.org/2005/Atom", 'atom:entry' );
      $root->setAttributeNS('http://www.w3.org/2000/xmlns/','xmlns:wt','http://schemas.google.com/webmasters/tools/2007');
      $doc->appendChild($root);

      $element = $doc->createElement('atom:id', $site.$sitemap);
      $root->appendChild($element);

      $element = $doc->createElement('atom:category');
      $element->setAttribute('scheme','http://schemas.google.com/g/2005#kind');
      $element->setAttribute('term','http://schemas.google.com/webmasters/tools/2007#sitemap-regular');
      $root->appendChild($element);

      $element = $doc->createElement("wt:sitemap-type", 'WEB');
      $root->appendChild($element);
      $xml = $doc->saveXML();

      $b_success = $this->_Curl($url, "application/atom+xml", $xml);
        
      return $b_success;
    }

    function _callWMT($method, $url, $site='', $params = array(), $array_elements_in = array()) {

      $method = strtolower($method);
      $site = "http://$site/";
      $url = str_replace('{site}', urlencode($site), $url);
      $xml = '';
        
      if ($method=='post' || $method=='put') {

          $doc = new DOMDocument('1.0', 'utf-8');
          $root = $doc->createElementNS("http://www.w3.org/2005/Atom", 'atom:entry' );

          if (count($params) > 0) {
              $root->setAttributeNS('http://www.w3.org/2000/xmlns/','xmlns:wt','http://schemas.google.com/webmasters/tools/2007');
          }
          $doc->appendChild($root);

          $element = $doc->createElement('atom:id', $site);
          $root->appendChild($element);

          if (count($params) > 0) {
              $element = $doc->createElement('atom:category');
              $element->setAttribute('scheme','http://schemas.google.com/g/2005#kind');
              $element->setAttribute('term','http://schemas.google.com/webmasters/tools/2007#site-info');
              $root->appendChild($element);
          } else {
              $element = $doc->createElement('atom:content');
              $element->setAttribute('src',$site);
              $root->appendChild($element);
          }

          foreach ($params as $tag => $value) {

             if (is_array($value)) {
                 $element = $doc->createElement("wt:$tag", $value['_value']);
                 foreach($value as $att => $value) {
                    if($att=='_value') continue;
                    $element->setAttribute('att','value');
                 }
             } else {
                 $element = $doc->createElement("wt:$tag", $value);
                 $root->appendChild($element);
             }
          }

          $xml = $doc->saveXML();
      }

      $body = $this->_Http($method, $url, "application/atom+xml", $xml);


      if ($body!='') {
          $doc = new DOMDocument();
          $success = $doc->loadXML($body);
          return $this->_ElementToArray($doc, $array_elements_in);
      } else {
          return false;
      }

    }

    function createSite($site) {
      $this->_callWMT('post', 'https://www.google.com/webmasters/tools/feeds/sites/', $site);
      // Google does send Content-Lenght back and get_contents fails so we get the site again !
      return $this->getSite($site);
    }

    function deleteSite($site) {
      return $this->_callWMT('delete', 'https://www.google.com/webmasters/tools/feeds/sites/{site}', $site);
    }

    function setGeoLocation($site, $location) {
      return $this->_callWMT('put',"https://www.google.com/webmasters/tools/feeds/sites/{site}", $site, array('geolocation' => $location));
    }

    function setPreferredDomain($site, $domain='') {
      if ($domain=='') $domain = $site;
      return $this->_callWMT('put',"https://www.google.com/webmasters/tools/feeds/sites/{site}", $site, array('preferred-domain' => $domain));
    }

    function getSite($site) {
      $entries = $this->_callWMT('get','https://www.google.com/webmasters/tools/feeds/sites/{site}', $site);
      return $entries;
    }

    function getSites() {
      $rawSites = $this->_callWMT('get','https://www.google.com/webmasters/tools/feeds/sites','',array(),array('entry'));
      $sites = array();
      foreach ($rawSites['feed']['entry'] as $entry) {
        $site = explode('/', $entry['title']);
        $site = $site[2];
        $sites[$site] = $entry;
      }
      return $sites;
    }

    function verifySite($site, $location = '') {

      $entry = $this->getSite($site);

      $vm = $entry['entry']['wt:verification-method'];

      if ($location!='')
          file_put_contents("$location/$vm", $vm);

      return $this->_callWMT('put',"https://www.google.com/webmasters/tools/feeds/sites/{site}", $site,
                       array('verification-method' =>
                          array('_value' => $vm,
                                'type'   => 'htmlpage',
                                'in-use' => 'true',
                                'file-content' => "goolge-site-verification: $vm"
                               )
                            ));

    }
}

/*
function ut_WebmasterTools ($username, $password, $website) {
    $wt = new WebmasterTools($username, $password);

    echo "Get Site\n";
    print_r($wt->getSite($website));

    echo "Delete Site\n";
    print_r($wt->deleteSite($website));

    echo "Create Site\n";
    print_r($wt->createSite($website));

    echo "Verify Site\n";
    print_r($wt->verifySite($website));

    echo "Set Location\n";
    print_r($wt->setGeoLocation($website,'AU'));
}
*/




?>
