<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Common Model
 * Model contains all method used in entire app
 * @author Rejoanul Alam
 */
class Prime_model extends CI_Model {

    /**
     * insert data to any table
     * @param string $table table name where to insert data
     * @param array $data data to insert
     * @param bool $last_id is retrun last inserted id or not
     * @param bool $filter whether filter data
     */
    public function insert_data($table, $data, $last_id = FALSE, $filter = TRUE) {
        if ($filter) {
            $data = preg_replace('%[<>\/"\%$\^\'!]%', '', $data);
        }
        $this->db->insert($table, $data);
        if ($last_id) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }

    /**
     * update data to any table
     * @param string $col_name name of the column use to update
     * @param mixed $col_val value of the column use to update
     * @param string $table table to update
     * @param array $data 
     * @param bool $filter
     */
    public function updater($col_name, $col_val, $table, $data, $filter = TRUE) {
        if ($filter) {
            $data = preg_replace('%[<>\/"\%$\^\'!]%', '', $data);
        }
        $this->db->where($col_name, $col_val)->update($table, $data);
    }

    public function generate_barcode($packageId, $type = 'import') {
        $p_id = (string) $packageId;
        $total_digit = strlen($p_id);
        $dig = (int) $total_digit;
        $remaining_digit = (13 - $dig);
        $min = str_repeat('1', $remaining_digit);
        $max = str_repeat('5', $remaining_digit);
        if ($type == 'request') {
            $min = str_repeat('6', $remaining_digit);
            $max = str_repeat('9', $remaining_digit);
        }
        $min = (int) $min;
        $max = (int) $max;
        $b = rand($min, $max);
        $barcode = $b . $packageId;
        return $barcode;
    }

    /**
     * update through where in
     * @param string $col_name name of the coulmn
     * @param array $col_val array of values
     * @param string $table
     * @param array $data data to update
     * @param bool $filter whether filter
     */
    public function wherein_updater($col_name, $col_val, $table, $data, $filter = TRUE) {
        if ($filter) {
            $data = preg_replace('%[<>\/"\%$\^\'!]%', '', $data);
        }
        $this->db->where_in($col_name, $col_val)->update($table, $data);
    }

    /**
     * get data by where in clause
     * @param string $columns comma separted column name
     * @param string $col_name name of the column for WHERE IN clause
     * @param array $col_val array of the coulmn value
     * @param string $table table name
     * @return array
     */
    public function wherein_extractor($columns, $col_name, $col_val, $table) {
        $query = $this->db->select($columns)->where_in($col_name, $col_val)->get($table);
        return $query->result_array();
    }

    /**
     * delete table
     * @param string $col_name
     * @param mixed $col_val
     * @param string $table
     */
    public function deleter($col_name, $col_val, $table) {
        $this->db->where($col_name, $col_val)->delete($table);
    }

    /**
     * delete by where in
     * @param string $col_name
     * @param array $col_val
     * @param string $table
     */
    public function wherein_deleter($col_name, $col_val, $table) {
        $this->db->where_in($col_name, $col_val)->delete($table);
    }

    /**
     * get data form table based on one/two where conditon
     * @param string $table table to select
     * @param stirng $selected_col column name to select
     * @param mixed $col_name first column name for where
     * @param mixed $col_val first column value used in where
     * @param mixed $second_col second column name used in where cond
     * @param mixed $second_val second column value used in where
     * @param string $logical if 2 where cond then use it for "and/or"
     * @param string $order_by name of the column for ordering
     * @param string $sorter use ASC/DESC for sorting
     * @param int $start limit start froms 
     * @param int $how_many limit offset
     * @return array
     */
    public function get_data($table, $selected_col = FALSE, $col_name = FALSE, $col_val = FALSE, $second_col = FALSE, $second_val = FALSE, $logical = FALSE, $order_by = FALSE, $sorter = FALSE, $start = FALSE, $how_many = FALSE) {
        if ($selected_col) {
            $this->db->select($selected_col);
        }

        if ($col_name) {
            $this->db->where($col_name, $col_val);
        }

        if ($second_col && $logical == 'or') {
            $this->db->or_where($second_col, $second_val);
        } else if ($second_col && $logical == 'and') {
            $this->db->where($second_col, $second_val);
        }

        if ($order_by) {
            $this->db->order_by($order_by, $sorter);
        }
        if ($start) {
            $this->db->limit($start, $how_many);
        }

        $query = $this->db->get($table);
        return $query->result_array();
    }

    /**
     * 
     * @param type $col_name
     * @param type $col_id
     * @param type $table
     * @param type $is_obect
     * @return type
     */
    public function get_row($col_name, $col_id, $table, $is_obect = FALSE) {
        $query = $this->db->where($col_name, $col_id)->get($table);
        if ($is_obect) {
            return $query->row();
        }
        return $query->row_array();
    }

    /**
     * 
     * @param type $table
     * @param type $col
     * @param type $val
     * @return type
     */
    public function total_item($table, $col = FALSE, $val = FALSE) {
        if ($col && $val) {
            $this->db->where($col, $val);
        }
        $total = $this->db->get($table)->num_rows();
        return $total;
    }

    function get_city_by_country($country_id) {
        $this->db->where("country_id", $country_id);
        $this->db->where("city_status", 1);
        $this->db->order_by("city_name");
        $q = $this->db->get("city");
        if ($q->num_rows()) {
            return $q->result_array();
        } else {
            return false;
        }
    }

    function get_plate_by_carrier($carrier_id) {
        $this->db->where("carrier_id", $carrier_id);
        //$this->db->where("city_status",1);
        $this->db->order_by("truck_name");
        $q = $this->db->get("trucks");
        if ($q->num_rows()) {
            return $q->result_array();
        } else {
            return false;
        }
    }

    /**
     * save package history
     * @param int|array $package_id
     * @param string $package_from
     * @param string $action event name what is taken
     * @param int $user_id
     */
    public function save_history($package_id, $action, $user_id) {
        if (is_array($package_id)) {
            foreach ($package_id as $p) {
                $history[] = array(
                    'package_id' => $p,
                    'action' => $action,
                    'taken_by' => $user_id,
                    'taken_at' => date('Y-m-d H:i:s')
                );
            }
            $this->db->insert_batch('package_history', $history);
            return;
        }
        $history = array(
            'package_id' => $package_id,
            'action' => $action,
            'taken_by' => $user_id,
            'taken_at' => date('Y-m-d H:i:s')
        );
        $this->insert_data('package_history', $history);
    }

}
