<?php

  class Templatiny {
    protected $template;
    protected $variables = array();
    public function __get($key) {
    	return($this->variables[$key]);
    }
    public function __set($key, $value) {
    	$this->variables[$key] = $value;
    }
    public function render($template = NULL, $vars = array()) {
        $this->variables = array_merge($this->variables, $vars);
        if(isset($template))
        	$this->template = (file_exists($template) ? file_get_contents($template) : $template);
        foreach($this->variables as $key => $value) {
        	$this->template = preg_replace('/\{{3}\s*'.$key.'\s*\}{3}/', htmlentities($value), $this->template);
        }
        foreach($this->variables as $key => $value) {
        	$this->template = preg_replace('/\{{2}\s*'.$key.'\s*\}{2}/', $value, $this->template);
        }
        return($this->template);
    }
  }
