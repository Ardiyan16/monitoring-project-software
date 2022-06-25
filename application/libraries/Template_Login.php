<?php
 class Template_Login {
 	protected $_ci;
	function __construct() {
		$this->_ci =& get_instance(); 
	}

 	function views($template = NULL, $data = NULL) {
		if ($template != NULL) {
				// Bagian $data['head'] untuk memanggil file head.php dari folder 
				// ['head'] data yang kita panggil dari file template.php dari folder 
				$data['head'] = $this->_ci->load->view('header', $data, TRUE);

				// ['konten'] data yang kita panggil dari file content.php dari folder
				$data['konten'] = $this->_ci->load->view($template, $data, TRUE);
		
				// Bagian $data['content'] untuk memanggil file content.php dari folder 
				// ['content'] data yang kita panggil dari file template.php dari folder 
				$data['content'] = $this->_ci->load->view('content', $data, TRUE);
				
				// Bagian $data['footer'] untuk memanggil file footer.php dari folder 
				// ['footer'] data yang kita panggil dari file template.php dari folder 
				$data['footer'] = $this->_ci->load->view('footer', $data, TRUE);

				// Bagian $data['template'] untuk menampilkan file template.php dari folder 
				// view('Template', $data, TRUE); untuk memanggil $data diatas seperti $data['head'], dll
				echo $data['Template']= $this->_ci->load->view('Template_Login', $data, TRUE);
        }
    }
 }
?>