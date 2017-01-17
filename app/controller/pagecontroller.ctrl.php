<?php
    
    class PageController extends Controller {
        
        protected $TableofContents = array('research-report', 'rules-of-thumb', 'research-summary');
        
        public function __construct($model, $controller, $action){
            
            parent::__construct($model, $controller, $action);
            $Auth = new Auth($url);
            
            if($Auth->isLoggedIn()){
                $user = $Auth->getProfile();
                $this->set('userRole', $user->role);
               
            }
        }
        
        public function index($url = null){
            $url = (is_null($url) ? 'homepage' : $url);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            
            $page = $this->Page->find(array('url' => $url));
            $contents = '<div id="main" class="col-md-9 col-xs-12 col-sm-8"><div class="content-wrap">' . $page[0]->contents . '</div></div><div id="sidebar" class="col-md-3 col-hidden-xs-12 col-sm-4"></div>';
            
            if(in_array($page[0]->url, $this->TableofContents)){
                // Generate Table of Conte2nts
                $DOM = new DOMDocument;
                $DOM->loadHTML($contents);
                
                // create document fragment
                $frag = $DOM->createDocumentFragment();
                
                // create initial list
                $wrapperElement = $DOM->createElement('ul');
                $wrapperAttribute = $DOM->createAttribute('class');
                $wrapperAttribute->value = 'toc';
                $wrapperElement->appendChild($wrapperAttribute);
                $wrapperAttribute2 = $DOM->createAttribute('data-spy');
                $wrapperAttribute2->value = 'affix';
                $wrapperElement->appendChild($wrapperAttribute2);
                
                
                $frag->appendChild($wrapperElement);
                
                //$frag->lastChild->appendChild($DOM->createElement('ol'));
                $head = &$frag->firstChild;
                $xpath = new DOMXPath($DOM);
                $last = 1;
                
                // Get H1, H2, H3 elements
                foreach ($xpath->query('//*[self::h2 or self::h3 or self::h4]') as $headline) {
                    // get level of current headline
                    sscanf($headline->tagName, 'h%u', $curr);
                
                    // move head reference if necessary
                    if ($curr < $last) {
                        // move upwards
                        for ($i=$curr; $i<$last; $i++) {
                            $head = &$head->parentNode->parentNode;
                        }
                    } else if ($curr > $last && $head->lastChild) {
                        // move downwards and create new lists
                        for ($i=$last; $i<$curr; $i++) {
                            $head->lastChild->appendChild($DOM->createElement('ul'));
                            $head = &$head->lastChild->lastChild;
                        }
                    }
                    $last = $curr;
                
                    // add list item
                    $li = $DOM->createElement('li');
                    $head->appendChild($li);
                    $a = $DOM->createElement('a', $headline->textContent);
                    $head->lastChild->appendChild($a);
                
                    // build ID
                    $levels = array();
                    $tmp = &$head;
                    // walk subtree up to fragment root node of this subtree
                    while (!is_null($tmp) && $tmp != $frag) {
                        $levels[] = $tmp->childNodes->length;
                        $tmp = &$tmp->parentNode->parentNode;
                    }
                    $id = 'sect'.implode('.', array_reverse($levels));
                    // set destination
                    $a->setAttribute('href', '#'.$id);
                    // add anchor to headline
                    $a = $DOM->createElement('a');
                    $a->setAttribute('name', $id);
                    $a->setAttribute('id', $id);
                    $headline->insertBefore($a, $headline->firstChild);
                }
                
                // append fragment to document
                $DOM->getElementById('sidebar')->appendChild($frag);
                
                // Save this
                $contents = $DOM->saveHTML();
            }
            $this->set('page', $contents);
        }
        
        public function home(){
            $url = 'homepage';            
            $page = $this->Page->find(array('url' => $url));
            $this->set('page', $page[0]->contents);
            $this->set('bodyClass', 'homepage');
        }
        
    }