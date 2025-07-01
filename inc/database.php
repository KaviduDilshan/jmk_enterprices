<?php

/*
 * Database
 * 
 * The Database class is meant to simplify the task of accessing
 * information from the website's database.
 *
 * Written by: Sasi
 * Last Updated: 2:06 PM 6/8/2010
 */


// include_once '../conn.php';
// include_once '../../phpmailer/PHPMailerAutoload.php';

class MySQLDB {

    var $connection;         //The MySQL database connection
    var $num_active_users;   //Number of active users viewing site
    var $num_active_guests;  //Number of active guests viewing site
    var $num_members;        //Number of signed-up users

    /* Class constructor */

    function MySQLDB() {
        /* Make connection to database */
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        mysqli_select_db($this->connection, DB_NAME);
    }

    /**
     * confirmUserPass - Checks whether or not the given
     * username is in the database, if so it checks if the
     * given password is the same password in the database
     * for that user. If the user doesn't exist or if the
     * passwords don't match up, it returns an error code
     * (1 or 2). On success it returns 0.
     */
    function confirmUserPass($userid, $password) {
        /* Add slashes if necessary (for query) */
        if (!get_magic_quotes_gpc()) {
            $username = addslashes($userid);
        }

        /* Verify that user is in database */
        $q = "SELECT Pw FROM " . TBL_USERS . " WHERE UsrId = '$userid'";
        $result = mysqli_query($this->connection, $q);
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return 1; //Indicates username failure
        }

        /* Retrieve password from result, strip slashes */
        $dbarray = mysqli_fetch_array($result);
        $dbarray['Pw'] = ($dbarray['Pw']);
        $password = ($password);

        /* Validate that password is correct */
        if ($password == $dbarray['Pw']) {
            return 0; //Success! Username and password confirmed
        } else {
            return 2; //Indicates password failure
        }
    }

    /**
     * confirmUserID - Checks whether or not the given
     * username is in the database, if so it checks if the
     * given userid is the same userid in the database
     * for that user. If the user doesn't exist or if the
     * userids don't match up, it returns an error code
     * (1 or 2). On success it returns 0.
     */
    function confirmUserID($username, $userid) {
        /* Add slashes if necessary (for query) */
        if (!get_magic_quotes_gpc()) {
            $username = addslashes($username);
        }

        /* Verify that user is in database */

        $q = "SELECT Usrid FROM " . TBL_USERS . " WHERE UsrNm = '$username'";
        $result = mysqli_query($this->connection, $q);
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return 1; //Indicates username failure
        }

        /* Retrieve userid from result, strip slashes */
        $dbarray = mysqli_fetch_array($result);
        $dbarray['UsrId'] = $dbarray['UsrId'];
        // $userid = stripslashes($userid);

        /* Validate that userid is correct */
        if ($userid == $dbarray['UsrId']) {
            return 0; //Success! Username and userid confirmed
        } else {
            return 2; //Indicates userid invalid
        }
    }

    /**
     * getUserInfo - Returns the result array from a mysql
     * query asking for all information stored regarding
     * the given username. If query fails, NULL is returned.
     */
    function getUserInfo($userid) {
        $q = "SELECT * FROM " . TBL_USERS . " WHERE UsrId = '$userid'";
        $result = mysqli_query($this->connection, $q);
        /* Error occurred, return given name by default */
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return NULL;
        }
        /* Return result array */
        $dbarray = mysqli_fetch_array($result);
        return $dbarray;
    }

    /**
     * query - Performs the given query on the database and
     * returns the result, which may be false, true or a
     * resource identifier.
     */
    function query($query) {
        return mysqli_query($this->connection, $query);
    }

    function sp_query($query, $para) {

        return sqlsrv_query($query, $this->connection, $para);
    }

    function fetch_row($data) {
        return mysqli_fetch_assoc($data);
    }

    function fetch_set($data) {
        return mysqli_fetch_array($data, MYSQLI_ASSOC);
    }

    function num_rows($data) {
        return mysqli_num_rows($data);
    }

    // FORMAT DATE
    function format($date) {
        date_default_timezone_set("Asia/Colombo");
        return date('y-m-d', strtotime($date)) == "01/01/1970" ? "" : date('y-m-d', strtotime($date));
    }

    // GET RECORD ID
    function getRecID() {
        $arrrecid = $this->query("SELECT @@IDENTITY AS recid");
        $row = $this->fetch_row($arrrecid);
        return $row['recid'];
    }

// all data base function below 10-feb-2012

    function get_mac() {
        ob_start(); // Turn on output buffering
        system('ipconfig /all'); //Execute external program to display output
        $mycom = ob_get_contents(); // Capture the output into a variable
        ob_clean(); // Clean (erase) the output buffer

        $findme = "Physical";
        $pmac = strpos($mycom, $findme); // Find the position of Physical text
        $mac = substr($mycom, ($pmac + 36), 17); // Get Physical Address

        return $mac;
    }

// generate password with random id;
    function generaterandom($ran) {
        //randonly generated;
        return '436A549B53954';
    }

    // CHECK IF SESSION USER KEY ID STORED OR NOT
    function chkLogin() {
        if (!$this->sesUsrKy()) {
            return false;
        }
        if (!$this->sesComKy() || $this->sesComKy() == 0) {
            return false;
        }
        return true;
    }

    // GET SESSION USER KEY
    function sesUsrKy() {
        $userid = $_SESSION['usrky'];
        if (is_numeric($userid)) {
            return $userid;
        }
        return 0;
    }

    // GET SESSION USER KEY
    function sesComKy() {
        $comky = $_SESSION['comky'];
        if (is_numeric($comky)) {
            return $comky;
        }
        return 0;
    }

    // GET company
    function sesUsrNm() {
        return $_SESSION['userNm'];
    }

// SESSION LOGOUT
    function usrLogOut($back) {
        $str = "";
        if (0 < $back) {
            for ($i = 0; $i < $back; $i++) {
                $str .= "../";
            }
        }
        header("Location:" . $str . "destroyee_session");
    }

    // Converting Number to wordsinclude("../include/session");
// Redirect to first page 
    function usrredirect($back) {
        $str = "";
        if (0 < $back) {
            for ($i = 0; $i < $back; $i++) {
                $str .= "../";
            }
        }
        header("Location:" . $str . "firstpage");
    }

    // GET TODAY
    function today() {
        date_default_timezone_set("Asia/Colombo");
        return date('m/d/Y');
    }

    // GET CURRENT TIME (TIMESTAMP)
    function timestamp() {
        date_default_timezone_set("Asia/Colombo");
        return date('Y-m-d H:i:s');
    }

    // FORMAT DATE
    function formatDT($date, $format = 'm/d/Y') {
        date_default_timezone_set("Asia/Colombo");
        return date($format, strtotime($date));
    }

    function convert_number_to_words($number) {
        $hyphen = '-';
        $conjunction = ' and ';
        $separator = '  ';
        $negative = 'negative ';
        $decimal = ' cents ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'fourty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int) ($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                //echo  $number;
                $words1 = $words1 . $number;
            }

            //str_split((string) $fraction) as $number) ;
            // $words1 = $string;



            $string .= $words1 . "/100"; //implode(' ', $words);
        }

        return $string;
    }

    //-----
    // Generating order no
    // generate trnsaction maximum no
    function getmaxtrnno($ptrndt) {
        $q = "SELECT Max(trnno) AS TrnNo From TrnMasTb WHERE trndt='$ptrndt'";

        //$result = mysql_query($q, $this->connection);
        $result = $this->query($q);

        /* Error occurred, return given name by default */
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return 0;
        } else {
            /* Return result array */
            $dbarray = $this->fetch_set($result);
            return $dbarray['TrnNo'];
        }
    }

// Master Running no
    function getmaxmtrnno() {
        $q = "SELECT Max(mtrnno) AS mtrnno From TrnMasTb where mtrnno <> 0 and TrnDt >='01/01/2015'";

        //$result = mysql_query($q, $this->connection);
        $result = $this->query($q);

        /* Error occurred, return given name by default */
        //	if(!$result || (mysql_num_rows($result) < 1)){
        //		 return 0;
        //	  }
        //	  else
        //	  {
        /* Return result array */
        $dbarray = $this->fetch_set($result);
        return $dbarray['mtrnno'];
        //	  }
    }

    // Function to check option permission
    function getusrmenuper($usrky, $field) {
        $q = "SELECT * From userinfotb WHERE usrky=" . $usrky . "";

//    	  $result = mysql_query($q, $this->connection);
        $result = $this->query($q);
        /* Error occurred, return given name by default */
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return 0;
        } else {
            /* Return result array */
            $dbarray = $this->fetch_set($result);
            return $dbarray[$field];
        }
    }

    // fucntion to get the company fields
    function getcomdetails($usrky, $field) {
        $comky = $this->getusrmenuper($this->sesUsrKy(), "comky");
        $q = "SELECT * From companytb WHERE comky=" . $comky . "";

//    	  $result = mysql_query($q, $this->connection);
        $result = $this->query($q);
        /* Error occurred, return given name by default */
        if (!$result || ($this->num_rows($result) < 1)) {
            return 0;
        } else {
            /* Return result array */
            $dbarray = $this->fetch_set($result);
            return $dbarray[$field];
        }
    }

    // fucntion to get the company fields
    function getcusaddressdetails($idky, $field) {

        $q = "SELECT * From delivery_addresses WHERE id=" . $idky . "";

//    	  $result = mysql_query($q, $this->connection);
        $result = $this->query($q);
        /* Error occurred, return given name by default */
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return 0;
        } else {
            /* Return result array */
            $dbarray = $this->fetch_set($result);
            return $dbarray[$field];
        }
    }

    function getprestsatus($ppno, $ptrnky) {
        $q = "SELECT MAX(trnky) AS trnky FROM trnmastb WHERE (trnky <> '$ptrnky') AND (pno = N'$ppno')";

//    	$result = mysql_query($q, $this->connection);
        $result = $this->query($q);
        /* Error occurred, return given name by default */
        if (!$result || (mysqli_num_rows($result) < 1)) {
            return "a";
        } else {

//				$dbarray = mysql_fetch_array($result);
            $dbarray = $this->fetch_set($result);
            $ttrnky = $dbarray['trnky'];
            $q1 = "SELECT trnky,status FROM trnmastb WHERE (trnky ='$ttrnky')";

//	   		   	$result1 = mysqli_query($q1, $this->connection);
            $result1 = $this->query($q1);

            if (!$result1 || (mysqli_num_rows($result1) < 1)) {
                return "";
            } else {
//					  	$dbarray1 = mysql_fetch_array($result1);
                $dbarray1 = $this->fetch_set($result1);
                return $dbarray1['status'];
            }
        }
    }

    function lockuser($pusrky) {
        $sqlusr = "Update UserInfoTb SET flock = 1 where usrky='$pusrky' ";

        $resulusrt = $this->query($sqlusr);
    }

    /* User menu option */

    // funcion loading security tab in user profile
    function loadusesectab($pusrky) {

        $access = $this->getusrmenuper($pusrky, "access");
        if ($access == 0 || $access == -1) {
            echo'<li>
                    <a href="#notifications" data-toggle="tab"><i class="icon-bullhorn"></i> Notifications</a>
                </li>

                <li>
                        <a href="#security" data-toggle="tab"><i class="icon-lock"></i> Security</a>
                </li>    
                <li>
                        <a href="#company" data-toggle="tab"><i class="icon-group"></i> Company</a>
                </li>';
        }
    }

    // funcion loading security tab
    function loadcompanytab($pusrky, $pmode) {

        $access = $this->getusrmenuper($pusrky, "access");
        $comky = $this->getusrmenuper($pusrky, "comky");

        if ($access == 2 || $access == -1 || $access == 1) {
            if ($pmode != "editprofileitem") {
                echo'<li class="tab-current"><a href="#section-1" class="icon-shop"><span>Company</span></a></li>';
            }
            if ($comky != 0) {
                if ($pmode == "editprofileitem") {
                    echo '<li class="tab-current" ><a href="#section-2" class="icon-cup"><span>Items</span></a></li>';
                } else {
                    echo '<li><a href="#section-2" class="icon-cup"><span>Items</span></a></li>';
                }
            }
        }
    }

    // User profile list
    // User Company list
    function viewcompanylist() {
        $sqlstr = 'SELECT comky,comcd,comnm,tp1,email,web  
			FROM  companytb  
			 WHERE finact = 0 and comky <> -07011977  ';

//                $sqlstr = $sqlstr.'and (usrid LIKE("%'.$srch.'%") OR usrnm 
//                LIKE("%'.$srch.'%") ) ' ;
//                

        $viewhead = $this->query($sqlstr);
        while ($row = $this->fetch_set($viewhead)) {
            if ($row['disper'] == 0) {
                $act = "Active";
            } else {
                $act = "Deactive";
            }


            echo "<tr>";
            echo "<td class='with-checkbox'>";
            echo "<input type='checkbox' name='check' value='1'>";
            echo "</td>";
            echo "<td>" . $row['comcd'] . "</td>";
            echo "<td>" . $row['comnm'] . "</td>";
            echo "<td>" . $row['tp1'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['web'] . "</td>";
            echo "<td class='hidden-380'>
                            <a href='form-company?pmode=editprofile&precid=" . $row['comky'] . "' class='btn' rel='tooltip' title='Edit' ><i class='icon-edit'></i></a>
                            <a href='#' onclick='deleteuser(" . $row['comky'] . ")' class='btn' rel='tooltip' title='Delete'><i class='icon-remove'></i></a>
                    </td>";
            echo "</tr>";
        }
    }

    // function load company list
    function loadcomlist($comky) {
        $access = $this->getusrmenuper($this->sesUsrKy(), "access");
        $tcomky = $this->getusrmenuper($this->sesUsrKy(), "comky");
        if ($access == -1) {
            $arrtype = $this->query("SELECT comky,comcd,comnm FROM companytb WHERE (fInAct = 0) ORDER BY comnm");
        } else {
            $arrtype = $this->query("SELECT comky,comcd,comnm FROM companytb WHERE (fInAct = 0) and comky ='$tcomky' ORDER BY comnm");
        }
        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['comky'] . '" ' .
            ($comky == $typ['comky'] ? "selected" : "") . ' >' . $typ['comnm'] . '</option>';
        }
    }

    // function product category list
    function loadprodcat($catky = 0) {
//            echo 'SELECT id,name FROM categories ORDER BY name';
        $arrtype = $this->query("SELECT cat_id,name FROM categories ORDER BY name");

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['name'] . '" ' .
            ($catky == $typ['name'] ? "selected" : "") . ' >' . $typ['name'] . '</option>';
        }
    }

    //function curenncy list 

    function loadCurrency($catky = 0) {
        echo 'SELECT cu_id,cu_name FROM currency ORDER BY cu_name';
        $arrtype = $this->query("SELECT cu_id,cu_name FROM currency ORDER BY cu_name");

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['cu_name'] . '" ' .
            ($catky == $typ['cu_name'] ? "selected" : "") . ' >' . $typ['cu_name'] . '</option>';
        }
    }

    // Load Supllier 

    function loadSupplier($catky = 0) {
        echo 'SELECT user_id,useer_name FROM user where user_type=' . "'manufacturer'" . 'ORDER BY name';
        $arrtype = $this->query("SELECT user_id,user_name FROM user where user_type='manufacturer' ORDER BY user_name");

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['user_name'] . '" ' .
            ($catky == $typ['user_name'] ? "selected" : "") . ' >' . $typ['user_name'] . '</option>';
        }
    }

    // Load collection Set 

    function loadCollection($catky = 0) {
        echo 'SELECT id,name FROM collection ORDER BY name';
        $arrtype = $this->query("SELECT id,name FROM collection ORDER BY name");

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['name'] . '" ' .
            ($catky == $typ['name'] ? "selected" : "") . ' >' . $typ['name'] . '</option>';
        }
    }

    // function product brand list
    function loabrandList($catky = 0) {
        echo 'SELECT id,name FROM brands ORDER BY name';
        $arrtype = $this->query("SELECT id,name FROM brands ORDER BY name");

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['name'] . '" ' .
            ($catky == $typ['name'] ? "selected" : "") . ' >' . $typ['name'] . '</option>';
        }
    }

    // function main Category  name

    function loabrandMainCat($catky = 0) {
        echo 'SELECT cat_id,name FROM categories ORDER BY name';
        $cattype = $this->query("SELECT cat_id,name FROM categories ORDER BY name");

        while ($typ = $this->fetch_set($cattype)) {
            echo '<option value="' . $typ['name'] . '" ' .
            ($catky == $typ['id'] ? "selected" : "") . ' >' . $typ['name'] . '</option>';
        }
    }

    // function load product type list
    function loadprodtype($prodtype) {
        echo '<option value="QUANTITY" ' .
        ($prodtype == "QUANTITY" ? "selected" : "") . ' >QUANTITY</option>';
        echo '<option value="TICKET" ' .
        ($prodtype == "TICKET" ? "selected" : "") . ' >TICKET</option>';
    }

    // function load super permission
    function loaduseraccess($pcat) {
        echo '          ';
    }

    // FUCNTION LOAD COUNTRY SELECT OPTION CONTROL
    function loadcounty($country) {
        // do the validation for country    
    }

    //function load agents
    function loadagent() {
        $grp = "";
        $arrtype = $this->query("SELECT adrky,adrcd,adrnm,email FROM addresstb WHERE (fobs = 0) ORDER BY adrnm");
        while ($typ = $this->fetch_set($arrtype)) {
            $alf = $typ['adrnm'];
            //echo $alf[0];

            if ($grp <> $alf[0]) {
                $grp = $alf[0];
                echo '<tr class="alpha">
                        <td class="alpha-val">
                                <span>' . $grp[0] . '</span>
                        </td>
                        <td colspan="2"></td>
                      </tr>';
            }

            echo '<tr>
                        <td class="img"><img src="img/demo/noimage.png" alt=""></td>
                        <td class="user">' . $typ['adrnm'] . '</td>
                        <td class="icon"><a href="#" class="btn"><i class="icon-search"></i></a></td>
                  </tr>';
        }
    }

    // function to activate the passport
    function rescanpp($ptrnno) {
        if ($ptrnno == 0 || $ptrnno == '') {
            echo 'Transaction No Cannot be Blank';
        } else {
            $access = $this->getusrmenuper($this->sesUsrKy(), "access");
            if ($access == 0 || $access == 5 || $access == -1) {
                echo '<div class="span12">
                                                            <div class="form-actions">
                                                                <button type="Button" class="btn btn-red" onclick="updatepassportscanning()">Activate for Re-Scanning Passport</button>

                                                            </div>
                                                        </div>';
            }
        }
    }

    // get news list 
    function listNews($newsky = 0, $pcatid = 0, $srch, $pnew = 0) {
        $sql = 'SELECT * FROM latest_news where ln_status = 1';

        return $this->query($sql);
        // exit();
    }

    //Filter Product by Categeory

    function listByCat($cat_id) {



        $sql = "SELECT* from product WHERE category_id ='.$cat_id.'";

        // Get the latest news 



        /* if(0 < $pcatid){
          $sql.= ' and catid = '. $pcatid;
          }

          if($pnew==1)
          {
          $sql.= "and  itmmastbl.entdtm  >='".$start_week."' and itmmastbl.entdtm <='".$end_week."' ";
          }
          if($srch!='')
          {
          $sql = $sql.'and (itmnm LIKE("%'.$srch.'%") OR description
          LIKE("%'.$srch.'%") OR shortdesc LIKE("%'.$srch.'%"))';
          } */

        return $this->query($sql);
    }

    function loadAllCurrency($catky) {

        $arrtype = $this->query("SELECT cu_id,cu_name FROM currency where cu_status=1 ORDER BY cu_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['cu_id'] . '" ' .
            ($catky == $typ['cu_id'] ? "selected" : "") . ' >' . $typ['cu_name'] . '</option>';
        }
    }

    function loadAllUsersType($catky) {
        echo 'select  usr_cat_id,cat_name from user_cat ORDER by cat_level';
        $arrtype = $this->query("select  usr_cat_id,cat_name from user_cat ORDER by cat_level");

        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['cat_name'] . '" ' .
            ($catky == $typ['cat_name'] ? "selected" : "") . ' >' . $typ['cat_name'] . '</option>';
        }
    }

//    Nfuel

    function loademp() {

        $arrtype = $this->query("SELECT * FROM employers where company=1 ORDER BY f_name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['emp_id'] . '" ' .
            ($catky == $typ['emp_id'] ? "selected" : "") . ' >' . $typ['f_name'] . " " . $typ['l_name'] . '</option>';
        }
    }

    function loadccbank() {

        $arrtype = $this->query("SELECT * FROM banks where c_card=1");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['ba_id'] . '" ' .
            ($catky == $typ['ba_id'] ? "selected" : "") . ' >' . $typ['ba_name'] . '</option>';
        }
    }

    function loadex_cat() {

        $arrtype = $this->query("SELECT * FROM ex_cat");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['exc_id'] . '" ' .
            ($catky == $typ['exc_id'] ? "selected" : "") . ' >' . $typ['name'] . '</option>';
        }
    }

    function loaddepart($catky) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['login_type'])) {
            $lo_ty = intval($_SESSION['login_type']);
            if (($lo_ty <= 2) || ($lo_ty == 4)) {
                $arrtype = $this->query("SELECT * FROM department where de_status=1 ORDER BY de_name");
                while ($typ = $this->fetch_set($arrtype)) {
                    echo '<option value="' . $typ['de_id'] . '" ' .
            ($catky == $typ['de_id'] ? "selected" : "") . '>' . $typ['de_name'] . '</option>';
                }
            } else {
                if (isset($_SESSION['company'])) {
                    $company = intval($_SESSION['company']);
                    $arrtype = $this->query("SELECT * FROM department where de_id=$company AND de_status=1");
                    while ($typ = $this->fetch_set($arrtype)) {
                        echo '<option value="' . $typ['de_id'] . '" ' .
            ($catky == $typ['de_id'] ? "selected" : "") . '>' . $typ['de_name'] . '</option>';
                    }
                }
            }
        }
    }
    
    function loaddepart2() {
        $arrtype = $this->query("SELECT * FROM department where de_status=1 ORDER BY de_name");
        while ($typ = $this->fetch_set($arrtype)) {
            echo '<option value="' . $typ['de_id'] . '" >' . $typ['de_name'] . '</option>';
        }
    }

    function load_vendor($catky) {

        $arrtype = $this->query("SELECT * FROM vendor");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['v_id'] . '" ' .
            ($catky == $typ['v_id'] ? "selected" : "") . ' >' . $typ['vendor_name'] . '</option>';
        }
    }

    function loadAllCategory($catky) {

        $arrtype = $this->query("SELECT category_id,name FROM category ORDER BY name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['category_id'] . '" ' .
            ($catky == $typ['category_id'] ? "selected" : "") . ' >' . $typ['name'] . '</option>';
        }
    }

    function loadAllrawCategory($catky) {

        $arrtype = $this->query("SELECT cat_id,name FROM raw_category ORDER BY name");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['cat_id'] . '" ' .
            ($catky == $typ['cat_id'] ? "selected" : "") . ' >' . $typ['name'] . '</option>';
        }
    }

    function loadAllUnit($catky) {

        $arrtype = $this->query("SELECT un_id,symbol FROM unit ORDER BY symbol");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['un_id'] . '" ' .
            ($catky == $typ['un_id'] ? "selected" : "") . ' >' . $typ['symbol'] . '</option>';
        }
    }

    function loadAllbank($catky) {

        $arrtype = $this->query("SELECT * FROM banks where c_card=0");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['ba_id'] . '" ' .
            ($catky == $typ['ba_id'] ? "selected" : "") . ' >' . $typ['ba_name'] . " - " . $typ['ba_acc_no'] . '</option>';
        }
    }

    function loadAllCustomers($catky) {

        $arrtype = $this->query("SELECT * FROM customer");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['c_id'] . '" ' .
            ($catky == $typ['c_id'] ? "selected" : "") . ' >' . $typ['customer_name'] . " " . $typ['nic'] .'</option>';
        }
    }

    function loadAllGurantors($catky) {

        $arrtype = $this->query("SELECT * FROM guarantor");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['gu_id'] . '" ' .
            ($catky == $typ['gu_id'] ? "selected" : "") . ' >' . $typ['guarantor_name'] . " " . $typ['nic'] . '</option>';
        }
    }

    function loadAllDuration($catky) {

        $arrtype = $this->query("SELECT * FROM loan_duration");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['ldu_id'] . '" ' .
            ($catky == $typ['ldu_id'] ? "selected" : "") . ' >' . $typ['duration'] . '</option>';
        }
    }

    function loadAllEmplyers($catky) {

        $arrtype = $this->query("SELECT * FROM employers");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['emp_id'] . '" ' .
            ($catky == $typ['emp_id'] ? "selected" : "") . ' >' . $typ['f_name'] . " " . $typ['l_name'] . '</option>';
        }
    }

    function loadAllOwners($catky) {

        $arrtype = $this->query("SELECT * FROM owners where ow_status=1");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['ow_id'] . '" ' .
            ($catky == $typ['ow_id'] ? "selected" : "") . ' >' . $typ['ow_name'] . '</option>';
        }
    }

    function loadAllProducts($pro_id) {

        $arrtype = $this->query("SELECT * FROM `products`");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['pro_id'] . '" ' .
            ($pro_id == $typ['pro_id'] ? "selected" : "") . ' >' . $typ['product_name'] . " | " . $typ['barcode'] . "  " . base64_decode($typ['product_name_sl']) . '</option>';
        }
    }
    
        function loadAllProducts_by($barcode) {

        $arrtype = $this->query("SELECT * FROM `products`");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['barcode'] . '" ' .
            ($barcode == $typ['barcode'] ? "selected" : "") . ' >' . $typ['product_name'] . " | " . $typ['barcode'] . "  " . base64_decode($typ['product_name_sl']) . '</option>';
        }
    }

    function loadAllOtherchargers($pro_id) {

        $arrtype = $this->query("SELECT * FROM `other_charges_type`");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['lother_id'] . '" ' .
            ($pro_id == $typ['lother_id'] ? "selected" : "") . ' >' . $typ['description'] . '</option>';
        }
    }

    function loadAllRmet($catky) {

        $arrtype = $this->query("SELECT * FROM `raw_material`");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['rmet_id'] . '" ' .
            ($pro_id == $typ['rmet_id'] ? "selected" : "") . ' >' . $typ['row_name'] . '</option>';
        }
    }

    function loadAllex_methords($ex_me_id) {

        $arrtype = $this->query("SELECT * FROM `ex_methods`");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['ex_me_id'] . '" ' .
            ($pro_id == $typ['ex_me_id'] ? "selected" : "") . ' >' . $typ['name'] . '</option>';
        }
    }

    function loadAllProProducts($pro_id) {

        $arrtype = $this->query("SELECT * FROM `products`");

        while ($typ = $this->fetch_set($arrtype)) {

            echo '<option value="' . $typ['pro_id'] . '" ' .
            ($pro_id == $typ['pro_id'] ? "selected" : "") . ' >' . $typ['product_name'] . ' ' . $typ['barcode'] . '</option>';
        }
    }

}

/* Create database connection */
$database = new MySQLDB;
?>
