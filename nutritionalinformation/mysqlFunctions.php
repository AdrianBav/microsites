<?php

/*
------------------------------------------------------
php
mysqlFunctions.php - used to access the MySQL database
------------------------------------------------------
*/

// connect to the database
db_connect() or die("Unable to connect to database server!");


/* sub-routines */

// connect to local database
function db_connect()
    {
    global $db_link;
    $db_link = mysqli_connect('localhost', 'homestead', 'secret');
    if ($db_link)
        mysqli_select_db($db_link, 'bavanco_archives_ni');
    return $db_link;
  }

// function to query the database
function db_query($query)
    {
    global $db_link;
    $result = mysqli_query($db_link, $query) or db_error($query, mysqli_errno($db_link), mysqli_error($db_link));
    return $result;
  }

// get a row from the database query
function db_fetch_array($db_query)
    {
  return mysqli_fetch_array($db_query, MYSQLI_ASSOC);
  }

// the the number of rows returned from the query
function db_num_rows($db_query)
    {
  return mysqli_num_rows($db_query);
  }

// get the last auto_increment id
function db_insert_id()
    {
  return mysqli_insert_id();
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
    if (function_exists('mysqli_real_escape_string'))
        {
        return mysqli_real_escape_string($string, $db_link);
        }
    elseif (function_exists('mysqli_escape_string'))
        {
        return mysqli_escape_string($string);
        }
    return addslashes($string);
  }

// function to handle database errors
function db_error($query, $errno, $error)
    {
  die(
          '<font color="#000000"><b>' .
                $errno . ' - ' . $error . '<br /><br />' .
                $query . '<br /><br />
                <small><font color="#ff0000">[STOP]</font></small>
          </b></font>'
      );
  }

// disconnect from database
function db_disconnect()
    {
    global $db_link;
    mysqli_close($db_link);
    }
