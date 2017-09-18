<?php 
 /*
     * Script:    DataTables server-side script for PHP and Oracle 10g (via OCI8)
     * Copyright: 2011 - Allan Jardine (base version) & big-deal (Redeveloping for Oracle 10g using OCI8) && 2015 - Bled (Redeveloping for Oracle 11G and DataTables 1.10 new parameters)
     * License:   GPL v2 or BSD (3-point)
     */
 
    //Comment this line to have the php error
    //If this line is not commented, the json response is not correct
    error_reporting(0);
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Easy set variables
     */
   
    /* Array of database columns which should be read and sent back to DataTables. Use a space where
     * you want to insert a non-database field (for example a counter or static image)
     */
    $aColumns = array( 'UNIT', 'PARTNUMBER', 'SERIALNUMBER', 'DATERCD', 'DATERMVD');
     
    /* Indexed column (used for fast and accurate table cardinality) */
    $sIndexColumn = "ID";
     
    /* DB table to use */
    $sTable = "ITEMS";
   
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * If you just want to use the basic configuration for DataTables with PHP server-side, there is
     * no need to edit below this line
     */
     
    /*
     * Oracle connection
     */
     
    $conn = oci_connect('warrantytracker','warranty#tracker','10.2.2.50:1521/dwhdev');
    if (!$conn)
    {
        $e = oci_error();
        //echo $e['code'];
        trigger_error(htmlentities($e['message'],ENT_QUOTES), E_USER_ERROR);
    }
     
 
    /*
     * Paging
     */
    $sLimit = "";
    if ( isset( $_GET['start'] ) && $_GET['length'] != '-1')
    {
        //Ff binding error, it's because :iDisplayStart is probably not in the request
        $sLimit = "WHERE  rowsNumerator BETWEEN :iDisplayStart AND :iDisplayEnd";
    }
     
 
    /*
     * Ordering
     */
    //Put the array in another variable because you can't get them with the $_GET method
    $sOrderArr = $_GET['order'];
    $sColumnArr = $_GET['columns'];
    $sOrder = '';
    if (isset($sOrderArr[0]['column']))
    {
        $sOrder = "ORDER BY ";
        //Go over all sorting cols
        for ( $i=0 ; $i<count($sColumnArr); $i++ )
        {
            //Check if the current col can be orderable
            if ( $sColumnArr[$i]['orderable'] == "true" )
            {
                //Add the name of the column in the ORDER BY
                $sOrder .= $aColumns[$sOrderArr[$i]['column']];
                 
                //Determine if it is sorted asc or desc
                if ((strcasecmp($sOrderArr[$i]['dir'],"asc") == 0))
                {
                    $sOrder .=" asc, ";
                }
                else if ((strcasecmp($sOrderArr[$i]['dir'],"desc") == 0))
                {
                    $sOrder .=" desc, ";
                }
            }
        }
         
        //Remove the last space / comma
        $sOrder = substr_replace( $sOrder, "", -2 );
         
        //Check if there is an order by clause
        if ( $sOrder == "ORDER BY" )
        {
            /*
            * If there is no order by clause - ORDER BY INDEX COLUMN!!! DON'T DELETE IT!
            * If there is no order by clause there might be bugs in table display.
            * No order by clause means that the db is not responsible for the data ordering,
            * which means that the same row can be displayed in two pages - while
            * another row will not be displayed at all.
            */
            $sOrder = "ORDER BY ".$sIndexColumn;
             
        }
    }
 
     
     
    /*
     * Filtering
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here, but concerned about efficiency
     * on very large tables.
     */
    $sWhere = "";
    $nWhereGenearalCount = 0;
    $sSearchArr = $_GET['search'];
 
    if (isset($sSearchArr['value']))
    {
        $sWhereGenearal = $_GET['search'];
    }
    else
    {
        $sWhereGenearal = '';
    }
    if ($sSearchArr['value'] != null)
    {
        //Set a default where clause in order for the where clause not to fail
        //in cases where there are no searchable cols at all.
        $sWhere = "WHERE (";
        for ( $i=0 ; $i<count($aColumns)+1 ; $i++ )
        {
            //If current col has a search param
            if ( $sColumnArr[$i]['searchable'] == "true" )
            {
                //Add the search to the where clause
                // $sWhere .= $aColumns[$i]." LIKE '%".$sSearchArr['value']."%' OR ";
                //Add the search to the where clause without the case sensitive
                $sWhere .= "regexp_like(".$aColumns[$i].", '".$sSearchArr['value']."', 'i') OR ";
                $nWhereGenearalCount += 1;
            }
        }
 
        $sWhere = substr_replace( $sWhere, "", -3 );
        $sWhere .= ' )';
    }
   
    /* Individual column filtering */
    $sWhereSpecificArray = array();
    $sWhereSpecificArrayCount = 0;
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        if ( $sColumnArr[$i]['search']['regex'] == "true"&& $sColumnArr[$i]['search']['value'] != '' )
        {
            //If there was no where clause
            if ( $sWhere == "" )
            {
                $sWhere = "WHERE";
            }
            else
            {
                $sWhere .= " AND ";
            }
             
            //Add the clause of the specific col to the where clause
            $sWhere .= $aColumns[$i]." LIKE '%' || :whereSpecificParam".$sWhereSpecificArrayCount." || '%' ";
             
            //Inc sWhereSpecificArrayCount. It is needed for the bind var.
            //We could just do count($sWhereSpecificArray) - but that would be less efficient.
            $sWhereSpecificArrayCount++;
             
            //Add current search param to the array for later use (binding).
            $sWhereSpecificArray[] =  $sColumnArr[$i]['search']['value'];  
        }
    }
   
    //If there is still no where clause - set a general - always true where clause
    if ( $sWhere == "" )
    {
        $sWhere = "WHERE 1=1  ";
    }
     
     
    /*
     * SQL queries
     * Get data to display
     */
     //Inner sql - not being fetched by itself.
 
    $sQueryInner = "SELECT ".implode(', ', $aColumns).", row_number() over (".$sOrder.") as rowsNumerator FROM   ".$sTable." ".$sWhere;
    $sQueryFinal = "SELECT ".implode(', ', $aColumns)." FROM (".$sQueryInner.") qry ".$sLimit." ORDER BY rowsNumerator";
     
    /* Data set length after filtering */
    $sQueryFinalCount = "SELECT COUNT(*) as \"totalRowsCount\" FROM (".$sQueryInner.") qry";
     
    $iFilteredTotal = 0;
     
    /* Total data set length */
    $sQueryTotalCount = "SELECT COUNT(".$sIndexColumn.") as \"totalRowsCount\" FROM  ".$sTable;
 
    //Create Statments
    $statmntFinal = oci_parse($conn, $sQueryFinal);
    $statmntFinalCount = oci_parse($conn,$sQueryFinalCount);
    $statmntTotalCount = oci_parse($conn,$sQueryTotalCount);
 
    //Bind variables.
     
    if ( isset( $_GET['start'] ))
    {
        $dsplyStart = $_GET['start'];
    }
    else{
        $dsplyStart = 0;
    }
     
    if ( isset( $_GET['length'] ) && $_GET['length'] !='-1' )
    {
        $dsplyRange = $_GET['length'];
        if ($dsplyRange > (2147483645 -intval($dsplyStart)))
        {
            $dsplyRange = 2147483645;
        }
        else
        {
            $dsplyRange = intval($dsplyStart) + intval($dsplyRange);
        }
    }
    else
    {
        $dsplyRange = 2147483645;
    }
     
   
   
    //Bind variables of number of rows to fetch.
    oci_bind_by_name($statmntFinal, ':iDisplayStart',$dsplyStart);
    oci_bind_by_name($statmntFinal, ':iDisplayEnd',$dsplyRange);
 
   
    // Bind all variables of general search
    for ( $i = 0 ; $i < $nWhereGenearalCount ; $i++ )
    {
        oci_bind_by_name($statmntFinal, ':whereParam'.$i ,$sWhereGenearal);
        oci_bind_by_name($statmntFinalCount,':whereParam'.$i , $sWhereGenearal);
    }
     
    //Bind all variables of specific search
    for ( $i = 0 ; $i < count($sWhereSpecificArray) ; $i++)
    {
        oci_bind_by_name($statmntFinal,':whereSpecificParam '.$i , $sWhereSpecificArray[$i]);
        oci_bind_by_name($statmntFinalCount,':whereSpecificParam '.$i , $sWhereSpecificArray[$i]);
    }
     
     
    //Execute selects
    oci_execute($statmntTotalCount);
    $iTotal = 0;
    while ($row = oci_fetch_array($statmntTotalCount,OCI_ASSOC))
    {
        $iTotal = $row['totalRowsCount'];
    }
    oci_free_statement($statmntTotalCount);
             
    oci_execute($statmntFinalCount);
    $iFilteredTotal = 0;
    while ($row = oci_fetch_array($statmntFinalCount,OCI_ASSOC))
    {
        $iFilteredTotal = $row['totalRowsCount'];
    }
    oci_free_statement($statmntFinalCount);
     
     
     
    /*
     * Output
     */
    $output = array(
        "sEcho" => intval($_GET['sEcho']),
        "iTotalRecords" => $iTotal,
        "iTotalDisplayRecords" => $iFilteredTotal,
        "aaData" => array()
    );
     
     
    oci_execute($statmntFinal);
     
     
    while ( $aRow = oci_fetch_array($statmntFinal,OCI_ASSOC) )
    {
        $row = array();
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( $aColumns[$i] == "version" )
            {
                /* Special output formatting for 'version' column */
                $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
            }
            else if ( $aColumns[$i] != ' ' )
            {
                /* General output */
                $row[] = $aRow[$aColumns[$i]];
            }
        }
        $output['aaData'][] = $row;
    }
 
 
 
    oci_free_statement($statmntFinal);
     
    oci_close($conn);
 
    echo json_encode( $output );
?>