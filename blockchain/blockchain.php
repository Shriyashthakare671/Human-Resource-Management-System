<?php 
	Class Block_chain {

		public function read_data($file)
		{
			$filedata = file_get_contents($file);
			$data = json_decode($filedata);
			return $data;
		}

		public function read_row_data($file,$id)
		{
			$filedata = file_get_contents($file);

			$row = [];
			$result = json_decode($filedata);
			if($result)
			{
				foreach($result as $key => $val)
				{
					if($val->id == $id)
						$row = $val;
				}
			}
			return $row;
		}

		public function add_data($file,$new_data)
		{
			$filedata = file_get_contents($file);
			$old_data = json_decode($filedata);
			if($old_data) {
				array_push($old_data,$new_data);
				$data = json_encode($old_data);
			} else {
				$data = json_encode(array($new_data));
			}
			file_put_contents($file,$data);
		}	

		public function update_data($file,$data)
		{
			file_put_contents($file,json_encode($data));
		}

		public function remove_data($file,$data)
		{
			file_put_contents($file,json_encode($data));
		}

		public function data_encryption($string) 
		{
			// Store the cipher method
			$ciphering = "AES-128-CTR";

			// Use OpenSSl Encryption method
			$iv_length = openssl_cipher_iv_length($ciphering);
			$options = 0;
			$encryption_iv = '9876543210123456';
			
			// Store the encryption key
			$encryption_key = "anpjsttkpcch";
			$encrypted_string = openssl_encrypt($string, $ciphering,$encryption_key, $options, $encryption_iv);
			return $encrypted_string;
		}

		public function data_decryption($encrypted_string) 
		{
			// Store the cipher method
			$ciphering = "AES-128-CTR";

			// Use OpenSSl Encryption method
			$iv_length = openssl_cipher_iv_length($ciphering);
			$options = 0;
			$decryption_iv = '9876543210123456';
			
			// Store the encryption key
			$decryption_key = "anpjsttkpcch";
			$decrypted_string = openssl_decrypt($encrypted_string, $ciphering,$decryption_key, $options, $decryption_iv);
			return $decrypted_string;
		}
	}