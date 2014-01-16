<?php
	
	class Itunes {
		
		private $id;
		private $data;
		private static $ready = false;
		
		public function __construct( $id ){
			$this->id 	= $id;
			$this->data = self::grab_data( $id );
			
			return (self::$ready)  ? $this->id : false;
		}
		
		public function get_id(){
			return $this->id;
		}
		
		public function get_data(){
			return $this->data;
		}
		
		private static function grab_data( $id ){	
			try{
				if( !$data = file_get_contents( 'http://itunes.apple.com/lookup?id=' . $id ) ){
					throw new Exception('Could not open stream');
				}
				
				if( !$data = json_decode( $data, true ) ){
					throw new Exception('JSON in not valid');		
				}
				
				if( !isset( $data['results'][0] ) ){
					throw new Exception('Result was not found');	
				}
				
				self::$ready = true;
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