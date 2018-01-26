<?php
class Db 
{
    /* Connection type */
    var $Persistent = false;

    /* Link and Query handles */
    var $i_Link     = 0;
    var $i_Query    = 0;

    /* Error handler */
    var  $i_Halt     = 1;            ## 0 - DEVELOPMENT; 1 - PRODUCTION;
    var  $i_Errno    = 0;
    var  $str_Error  = "";
    var  $affected   = 0;
    var  $b_debug    = false;

    /*
    ** Class constructor
    */
    function Db() 
    {
        /* establish connection, select database */
        if ( 0 == $this->i_Link ) 
        {
            //-- connect to database
            $this->i_Link = $this->Persistent ? @mysql_pconnect(DB_HOST, DB_USER, DB_PASS) : @mysql_connect(DB_HOST, DB_USER, DB_PASS);

            //-- error encountered?
            if (!$this->i_Link) 
            {
                $this->Halt('Unable to connect to database server');
                return 0;
            }

            //-- select database
            if (!@mysql_select_db(DB_NAME, $this->i_Link)) 
            {
                $this->Halt("Unable to use application's database");
                return 0;
            }
        }
    }
    
    /*
    ** Exexute a sql statement
    */
    function execute($Query_String) { return $this->Query($Query_String); }
    function query($Query_String) 
    {
        if ($this->b_debug) echo $Query_String."<br/><br/>";

        //-- New query, discard previous result.
        if ($this->i_Query)
        {
            $this->Free(); 
        }

        //--execute the query
        $this->i_Query      = @mysql_query($Query_String,$this->i_Link);

        //-- get the affected rows
        $this->affected     = @mysql_affected_rows($this->i_Link);

        //-- get errors, if any
        $this->i_Errno      = mysql_errno();
        $this->str_Error    = mysql_error();

        if (!$this->i_Query) 
        {
            $this->Halt("Invalid SQL: ".$Query_String);
        }

        return $this->i_Query;
    }
    
    /*
    ** check afected
    */

    function isAffected() 
    {
        return $this->affected ? true : false;
    }    

    /*
    ** Extract the last insert id
    **  @return integer
    */
    function insertId() 
    {
        return @mysql_insert_id($this->i_Link);
    }    

    /*
    ** Extract the element (first) value from result
    **  @return mixed 
    */
    function GetOne($Query_String) 
    {
        //-- execute the statement
        $this->query($Query_String);

        //-- return the values
        $a_row = @mysql_fetch_array($this->i_Query);

        //--return the value
        return isset($a_row[0]) ? $a_row[0] : NULL;
    }

    /*
    ** Extract the row (first) value from result
    **  @return mixed 
    */
    function GetRow($Query_String) 
    {
        //-- execute the statement
        $this->query($Query_String);

        //-- return the values
        return @mysql_fetch_assoc($this->i_Query);
    }

    /*
    ** Extract the col (first) value from result
    **  @return mixed 
    */
    function GetCol($Query_String) 
    {
        //-- build the array
        $a_result = array();

        //-- execute the statement
        $this->query($Query_String);

        while ($a_row = @mysql_fetch_array($this->i_Query))
        {
            //-- get the first column in each row
            $a_result[] = $a_row[0];
        }

        //-- return the values
        return $a_result;
    }

    /*
    ** Extract the col (first) value from result
    **  @return mixed 
    */
    function GetAll($Query_String) 
    {
        //-- build the array
        $a_result = array();

        //-- execute the statement
        $this->query($Query_String);

        while ($a_row = @mysql_fetch_assoc($this->i_Query))
        {
            //-- get the first column in each row
            $a_result[] = $a_row;
        }

        //-- return the values
        return $a_result;
    }

    function GetAssoc($Query_String, $field) 
    {
     $res    = $this->GetAll($Query_String);

     $result = array();
     for ($i=0;$i<count($res);$i++) { $result[$res[$i][$field]]=$res[$i]; }
     return $result;
    }

    /*
    ** Error management
    */
    function Halt($msg) 
    {
        $this->str_Error    = @mysql_error($this->i_Link);
        $this->i_Errno      = @mysql_errno($this->i_Link);

        if (B_DEV OR (0 == $this->i_Halt))
        {
           echo "
            <TABLE height='50%' cellSpacing=0 cellPadding=0 width='55%' align=center border=0>
             <TR>
              <TD vAlign=center>
                <P><STRONG><FONT face=Arial color='#ff0000' size=2>Error!</FONT></STRONG></P>
                <P align=left><FONT face=Arial size=2>$msg<br><br>". $this->str_Error ." (". $this->i_Errno .")</FONT></P>
              </TD>
             </TR>
            </TABLE>";
        }
        else
        {
           @mail('cms2you@yahoo.com', '[DBERROR]', $msg.' ['.$this->i_Errno.']'.$this->str_Error, 'From: ErrorHandler <error@onliney8games.com>');

           echo "
            <TABLE height='50%' cellSpacing=0 cellPadding=0 width='55%' align=center border=0>
             <TR>
              <TD vAlign=center>
                <P><STRONG><FONT face=Arial color='#ff0000' size=2>Error!</FONT></STRONG></P>
                <P align=left><FONT face=Arial size=2>There was an error while attempting to provide the requested page. <br>Our team was informed, and the problem will be fixed shortly.</P>
              </TD>
             </TR>
            </TABLE>";
        }

        die();
    }

    /*
    ** Free mysql resources
    */
    function Free()
    {
       //if (!empty($this->i_Query)) @mysql_free_result($this->i_Query);
       $this->i_Query = 0;
    }

    /*
    ** Close database connection
    */
    function Close()
    {
        if ($this->i_Link != 0 && !$this->Persistent) 
        {
            mysql_close($this->i_Link);
            $this->i_Link = 0;
        }
    }
}

?>