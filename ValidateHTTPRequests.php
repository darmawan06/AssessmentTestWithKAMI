<?php
class ValidateHTTPRequests {
		public function validatePOST($namePOST){
			if (isset($_POST["{$namePOST}"])) {
				return $_POST["{$namePOST}"];
			}
			return null;
		}

		public function validateGET($nameGET){
			if (isset($_GET["{$nameGET}"])) {
				return $_GET["{$nameGET}"];
			}
			return null;
		}
	}
?>