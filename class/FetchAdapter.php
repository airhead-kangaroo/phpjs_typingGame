<?php

interface FetchAdapter{
  public function getAllData();
  public function getColumnById(int $id);
}
