<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//makes so that php is just allowed, which will prevent any Javascript attacks getting the cookie
ini_set('session.cookie_httponly', true);

//start the session 
session_start ();

//if the userip is not set we will store the IP into the session variable "userip". 
if (isset($_SESSION['userip']) === false){
    
    $_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];
}

//check if the userip is true to the remote address. This if statement destroys the session if the the userip is not equal to the remote address of the current user
if ($_SESSION['userip'] !== $_SERVER['REMOTE_ADDR']){
    session_unset();
    session_destroy();
	//if it is not the same, we just remove all session variables, this way the attacker will have no session
    
}