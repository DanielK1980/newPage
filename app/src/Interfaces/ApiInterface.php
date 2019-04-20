<?php

namespace src\Interfaces;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Daniel
 */
interface ApiInterface {
   public function getGrafik();
   public function getEvents();
   public function SavePreferences($param = array());
}
