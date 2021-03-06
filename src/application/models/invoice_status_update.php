<?php

class Invoice_status_update extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	 
    }

	function get_invoice_status_update_statuses(){
	
		return array(
			"0"=>"unpaid",
			"1"=>"paid"
		);
	
	}
	
	# Index #
	
    function index($invoice_id){

		# Security clauses goes here #
	
		$this->db->where('invoice_status_update_invoice_id', $invoice_id);
	
		# Joins #
	
		# Filters #

		if($this->input->get('invoice_status_update_id')){

			$this->db->where('invoice_status_update_id', $this->input->get('invoice_status_update_id'));

		}

		if($this->input->get('invoice_status_update_invoice_id_min')){

			$this->db->where('invoice_status_update_invoice_id >=', $this->input->get('invoice_status_update_invoice_id_min'));

		}

		if($this->input->get('invoice_status_update_invoice_id_max')){

			$this->db->where('invoice_status_update_invoice_id <=', $this->input->get('invoice_status_update_invoice_id_max'));
		}

		if($this->input->get('invoice_status_update_datetime_min')>0){

			$this->db->where('invoice_status_update_datetime >=', $this->input->get('invoice_status_update_datetime_min'));

		}

		if($this->input->get('invoice_status_update_datetime_max')>0){

			$this->db->where('invoice_status_update_datetime <=', $this->input->get('invoice_status_update_datetime_max'));

		}

		if($this->input->get('invoice_status_update_gateway')){

			$this->db->like('invoice_status_update_gateway', $this->input->get('invoice_status_update_gateway'));

		}

		if($this->input->get('invoice_status_update_transaction')){

			$this->db->like('invoice_status_update_transaction', $this->input->get('invoice_status_update_transaction'));

		}

		if($this->input->get('invoice_status_update_status_code')){

			$this->db->like('invoice_status_update_status_code', $this->input->get('invoice_status_update_status_code'));

		}

		#Orderby

		if($this->input->get('order_by')){

			$this->db->order_by($this->input->get('order_by'));

		}else{
		
			$this->db->order_by('invoice_status_update_datetime desc');
		
		}

		#Limit & Offset
		
		$this->db->limit(get_limit());

		$this->db->offset($this->input->get('offset'));

		#Performs query
		
		$query = $this->db->get('invoice_status_updates');
		
		#Return
		
		# echo $this->db->_error_message().$this->db->last_query(); # Debug assist

		return $query->result();

    } 	


	# Create #

	function create($item){

		$insert = $this->db->insert('invoice_status_updates', $item);

		if($id = $this->db->insert_id()){

			return $id;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

	}


	# Update #

	function update($invoice_status_update_id, $item){

		$this->db->where('invoice_status_update_id', $invoice_status_update_id);

		$this->db->update('invoice_status_updates', $item);

		if($this->db->affected_rows()>0){

			return $item;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

	}


	# Get item #

	function get_item($invoice_status_update_id){

		$query = $this->db->get_where('invoice_status_updates', array('invoice_status_update_id' => $invoice_status_update_id), 1);

		if($query->num_rows()>0){

			$result = $query->row_object();

			return $result;	

		}

	}

	# Remove #

    function remove($invoice_status_update_id){

		$this->db->where('invoice_status_update_id', $invoice_status_update_id);

		$this->db->delete('invoice_status_updates'); 

		if($this->db->affected_rows()>0){

			return $invoice_status_update_id;

		}else if($this->db->_error_message()){

			throw new Exception($this->db->_error_message());

		}

    }

}


/* End of file invoice_status_update.php */
/* Location: ./application/models/invoice_status_update.php */