<?php
	
	class itunes {
		
		private $id;
		private $data;
		private static $ready = false;
		
		public function __construct( $id ){
			$this->id 	= $id;
			if( $this->data = self::grab_data( $id ) ){
				self::$ready = true;

			}
		}
		
		public function get_id(){
			return (self::$ready)  ? $this->id : false;
		}
		
		public function get_data(){
			return (self::$ready)  ? $this->data : false;
		}
		
		private static function grab_data( $id ){	
			try{
				if( !$data = file_get_contents( 'http://itunes.apple.com/lookup?id=' . $id ) ){
					throw new Exception('There was an error downloading from Apple\'s servers!');
				}
				
				if( !$data = json_decode( $data, true ) ){
					throw new Exception('The response we got from Apple is invalid');		
				}
				
				if( !isset( $data['results'][0] ) ){
					throw new Exception('Could not find app id ' . $id);	
				}
				
				return $data['results'][0];
					
			} catch( Exception $e ){
				echo $e->getMessage();
				return false;
			}
		}
		
		public function output_to_html(){
			$table = "";
			
			if( !is_array( $this->data ) )
				return;
			
			foreach ( $this->data as $field => $value ){
				( is_array( $value ) ) ? $value = implode( ', ', $value ) : $value;
				
				$table .= '<tr><td><strong>' . $field . ':</strong></td><td>' . $value . '</td></tr>';
			}
			
			return '<table>' . $table . '</table>';
		}
	}
?>
