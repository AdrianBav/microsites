<?php


/*
------------------------------
php
database.php - called by *.php
------------------------------
*/


// connect to the database
db_connect() or die("Unable to connect to database server!");





/* sub-routines */


// connect to local database
function db_connect()
    {
    global $db_link;

    $db_link = mysql_connect('localhost', 'homestead', 'secret');

    if ($db_link)
        mysql_select_db('nutritionalinformation');

    return $db_link;
  }


// function to query the database
function db_query($query)
    {
    global $db_link;

    $result = mysql_query($query, $db_link) or db_error($query, mysql_errno(), mysql_error());

    return $result;
  }


// get a row from the database query
function db_fetch_array($db_query)
    {
  return mysql_fetch_array($db_query, MYSQL_ASSOC);
  }


// the the number of rows returned from the query
function db_num_rows($db_query)
    {
  return mysql_num_rows($db_query);
  }


// get the last auto_increment id
function db_insert_id()
    {
  return mysql_insert_id();
  }


// add html character incoding to strings
function db_output($string)
    {
  return htmlspecialchars($string);
  }


// add slashes to incoming data
function db_input($string)
    {
    global $db_link;

    if (function_exists('mysql_real_escape_string'))
        {
        return mysql_real_escape_string($string, $db_link);
        }
    elseif (function_exists('mysql_escape_string'))
        {
        return mysql_escape_string($string);
        }

    return addslashes($string);
  }


// function to handle database errors
function db_error($query, $errno, $error)
    {
  die('<font color="#000000"><b>' . $errno . ' - ' . $error . '<br><br>' . $query . '<br><br><small><font color="#ff0000">[STOP]</font></small><br><br></b></font>');
  }


// disconnect from database
function db_disconnect()
    {
    global $db_link;

    mysql_close($db_link);
    }


?>
