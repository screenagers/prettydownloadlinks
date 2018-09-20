<?php

class directoryFiles {
 
  // set defaults in __construct
  var $settings = array(
    'path' => '',
    'absurl' => '',
    'recursive' => '',
  );
 
	function __construct($path = './', $absurl = '', $recursive = TRUE) {
		$this->settings['path'] = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
		$this->settings['absurl'] = rtrim($absurl, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
		$this->settings['recursive'] = $recursive;
	}
 
	function display($files = '') {
	  if(empty($files)) { $files = $this->scan($this->settings['path']); }
	  
  	$list = '';
  	  	
  	foreach($files as $key => $f) {
  	  $filepath = $this->settings['path'] . $f;
  		$fileurl = $this->settings['absurl'].$f;

  		if(!is_array($fileurl)) {
  		  // modified today?
  		  $filedate = date("Y-m-d", strtotime($key));
  		  $today = date("Y-m-d");
    		$list .= '    		
						<div class="row '.($filedate == $today ? ' today' : '').'">
							<div class="cell" data-title="Filename">
								<a href="'.$fileurl.'" title="'.$fileurl.'">'.$f.'</a>
							</div>
							<div class="cell" data-title="Size">
								'.$this->human_filesize(filesize($filepath)).'
							</div>
							<div class="cell" data-title="URL">
								<a href="'.$fileurl.'" title="'.$fileurl.'" onClick="javascript:copyTextToClipboard(this.title, this, event);" class="copytoclipboard">&raquo; Copy URL</a>
							</div>
							<div class="cell" data-title="Date">
								'.date("Y-m-d H:i:s", strtotime($key)).'
							</div>
						</div>
						';    		
    	}
    }
    
  	return $list;
  }
 
  function scan($path = '', $subdir = '') {
    if(empty($path)) { $path = $this->settings['path']; }
    $result = array();
    $subdirlist = array();

    $cdir = scandir($path);
    foreach ($cdir as $key => $value) {
      if (!in_array($value,array(".",".."))) {
        if (is_dir($path . DIRECTORY_SEPARATOR . $value)) {
            if($this->settings['recursive'] == TRUE) {
              $subdirlist = $this->scan($path.DIRECTORY_SEPARATOR.$value, $value.DIRECTORY_SEPARATOR);
            }
        } else {
          $dat = date("YmdHis", filemtime($path.DIRECTORY_SEPARATOR .$value));
          $result[$dat] = $subdir . $value;
         }
      }
    }

    return ($result + $subdirlist);
  } 
  
	private function human_filesize($bytes, $decimals = 2) {
    $sz = 'BKMGTP';
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
  }
 
}