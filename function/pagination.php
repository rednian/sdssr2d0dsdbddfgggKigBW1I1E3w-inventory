<?php

/**
 * Created by PhpStorm.
 * User: RedZ
 * Date: 8/20/2015
 * Time: 11:51 PM
 */
class Pagination {
  public $current_page;
  public $per_page;
  public $total_count;

  /**
   * @param int $page
   * @param int $per_page
   * @param int $total_count
   */
  public function __construct($page = 1, $per_page = 2, $total_count = 0) {
    $this->current_page = (int)$page;
    $this->per_page = (int)$per_page;
    $this->total_count = (int)$total_count;
  }

  /**
   * @return float
   */
  public function total_pages() {
    return ceil($this->total_count / $this->per_page);
  }

  /**
   * @return int
   */
  public function previous_page() {
    return $this->current_page - 1;
  }

  /**
   * @return int
   */
  public function next_page() {
    return $this->current_page + 1;
  }

  /**
   * @return bool
   */
  public function has_previous_page() {
    return $this->previous_page() >= 1 ? true : false;
  }

  /**
   * @return bool
   */
  public function has_next_page() {
    return $this->next_page() >= $this->total_pages() ? true : false;
  }

  /**
   * @return int
   */
  public function offset(){
    return ($this->current_page - 1) * $this->per_page;
  }
}