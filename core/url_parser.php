<?php
// http://www.lornajane.net/posts/2012/building-a-restful-php-server-understanding-the-request
class Request {

    public $url_elements;
    public $verb;
    public $parameters;
    public $script_name;
    public $format;

    public function __construct() {
        // Split URL - get parameters
        $this->verb = $_SERVER['REQUEST_METHOD'];
        $this->url_elements = explode('/', $_SERVER['REQUEST_URI']);
        $this->script_name = explode('/', $_SERVER['SCRIPT_NAME']);
        $this->url_elements;
        $this->cleanUrlElements();
        $this->parseIncomingParameters();
        $this->format = 'json';
        if (isset($this->parameters['format'])) {
            $this->format = $this->parameters['format'];
        }
        return true;
    }

    public function cleanUrlElements() {
        for ($i = 0; $i < sizeof($this->script_name); $i++) {
            if ($this->url_elements[$i] == $this->script_name[$i]) {
                unset($this->url_elements[$i]);
            }
        }
    }

    public function parseIncomingParameters() {
        $parameters = array();

        //Noudetaan urlista parametrit
        if (isset($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $parameters);
        }

        $this->parameters = $parameters;
    }

}

?>
