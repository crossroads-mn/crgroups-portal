<?php

include 'auth.php';
session_start();
//Desired MIME types for file format
$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');

function scrub_array($arr, $headers) {
  $headers = explode(',', $headers);
  $obj['data'] = $arr;
  if ($obj['data']['SYS_ID'] == '') {
  //Generate a new SYS_ID
  $obj['data']['SYS_ID'] = md5(uniqid());
  }

  if ($obj['data']['SYS_CREATED_ON'] == '') {
    $obj['data']['SYS_CREATED_ON'] = date("Y-m-d H:i:s");
  }

  if (array_key_exists('PASSWORD', $obj['data'])) {
    $obj['data']['PASSWORD'] = md5($obj['data']['PASSWORD']);
  }

    foreach($headers as $head) {
      if (array_key_exists($head, $obj['data'])) {
        if (is_null($obj['data'][$head])) {

        }
        else {
          
          $obj['data'][$head] = iconv('UTF-8', 'ASCII//TRANSLIT', $obj['data'][$head]);
          $obj['data'][$head] = $DB_CONN->real_escape_string($obj['data'][$head]);
          mysqli_close($DB_CONN);

        }
      }
      else {
        $obj['data'][$head] = '';
      }
    }

  if (array_key_exists('SYS_CREATED_BY', $obj['data'])) {
    if(isset($_SESSION['GUID'])) {
      $obj['data']['SYS_CREATED_BY'] = $_SESSION['GUID'];
    }
  }

  return $obj['data'];
}

//Let's define where we will store the uploaded files for reference
$target = "uploads/";
if(!is_dir($target)) {
  mkdir($target);
}

$target_file = $target . basename($_FILES["fileUpload"]["name"]);
//Here we define the file name in directory thats being uploaded
$uploadOk = 1;
$fileType = strtolower($_FILES["fileUpload"]["type"]);

if(isset($_POST["submit"])) {
  //Check .csv filetype
  if(in_array($_FILES['fileUpload']['type'],$mimes)){
    $uploadOk = 1;
    // $contents = file_get_contents($_FILES['fileUpload']['tmp_name']);
    
    $loc = 0;
    //$upload_array = preg_split('/\r\n|\r|\n/', $contents);
    //$upload_array = str_getcsv($contents, ",", '"');

    $csv = array_map('str_getcsv', file($_FILES['fileUpload']['tmp_name']));
    array_walk($csv, function(&$a) use ($csv) {
      $a = array_combine($csv[0], $a);
    });
     # remove column header

    $upload_array = $csv;
    //echo(var_dump(implode(",", $csv[0])));

    $json_array = array();
    $expected_headers = "GUID,IP_ADDRESS,OWNER,SEMESTER,GROUP_TYPE,CAMPUS,LOCATION,TITLE,DESCRIPTION,TARGET_AUDIENCE,MEET_DAY,IDEAL_SIZE,MEET_TIME_START,MEET_TIME_END,DURATION,LEADER,PHONE_NUMBER,EMAIL,PREVIOUS_LEADERSHIP,CO_LEADER,CO_LEADER_PHONE,CO_LEADER_EMAIL,CO_LEADER_PREVIOUS_LEADERSHIP,COST,CARE_PROVIDED,NOTES,GROUP_LINK,BOOK_LINKS,WHY,SYS_CREATED_ON,AUTHOR,SYS_ID,ACTIVE";

    $large_insert_statement = 'INSERT INTO `SMALL_GROUPS` (' . $expected_headers . ') VALUES ';

    foreach ( $upload_array as $csvline) {
      if ($loc == 0) {
        if (implode(",",$csvline) != $expected_headers) {
          echo "Something bad happened with the upload. Please make sure you have downloaded the correct template file.";
        }
      }

      else {
        //Now that we've verified the CSV headers, we can go ahead and start running MYSQL Insert statements
        //OK we are going to create a list of items to push into the "push_to_db.php" file.. appropriately named!
        //Here we are going to craft the json array.
        $counter = 0;
        $exploded_line = $csvline;
        $tmparray = array();
        foreach(explode(",", $expected_headers) as $headerlines) {

          //We must append the $tmparray to the json_array
          $counter += 1;
          if($headerlines == "SYS_ID") {
            if (strlen($exploded_line[$counter] != 32)) {
              $tmparray += array($headerlines => md5(uniqid()));
            }
            else {
              $tmparray[$headerlines] = $csvline[$headerlines];
            }
          } else {
            $tmparray[$headerlines] = $csvline[$headerlines];
          }
        }

        $tmparray = scrub_array($tmparray, $expected_headers);
        unset($counter);
        $counter = 0;
        $large_insert_statement .= '("' . implode('","', $tmparray) . '")' ;
        if ($loc != sizeOf($upload_array) - 1) {
          $large_insert_statement .= ', ';
        }
      }

      $loc += 1;

    }

    // Insert data into database here
     $result = mysqli_query($DB_CONN, $large_insert_statement) or die('{"records": [{"error": "' . mysqli_error($DB_CONN) . '"}]}');
    // echo $large_insert_statement;

  } else {
    $uploadOk = 0;
  }
}

else {
  $uploadOk = 0;
}

//Now that we've verified the upload, we will do what we gotta do ;)
/*$query = <<<eof
    LOAD DATA INFILE '$fileName'
     INTO TABLE tableName
     FIELDS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '"'
     LINES TERMINATED BY '\n'
    (field1,field2,field3,etc)
eof;

$db->query($query);
*/ 

//Do something like this where you just upload the file that way


?>

<script>
  var active_upload = <?php echo $uploadOk;?>;
  var target_file = "<?php echo $target_file;?>";
  var json_array = "<?php echo $json_array;?>";

  //alert(datafile);
  //alert(active_upload);
  //alert(target_file);
</script>

<div style="width: 100%" layout="column" >
  <md-content class="md-padding">
    <md-nav-bar ng-init="asset_selector" 
      md-no-ink-bar="disableInkBar"
      md-selected-nav-item="currentNavItem"
      nav-bar-aria-label="navigation links">
      <md-nav-item ng-if="groups_sub_selected=='new' || groups_sub_selected=='edit'" md-nav-click="previous()" name="previous"><i class="fa fa-chevron-left" aria-hidden="true"></i>Back</md-nav-item>
      <md-nav-item md-nav-click="goto_page('/index.php?table=Groups')" name="view">
        Browse Groups
      </md-nav-item>
      <md-nav-item md-nav-click="goto_page('https://doc-0o-7k-docs.googleusercontent.com/docs/securesc/h7ov77qf03hcl14n6ck8nbf0ttenncu3/k0cr0nhpt8772g809t6gnf09u228sqcv/1537984800000/08509202125740856560/08509202125740856560/1hTj6JQyd6ZAZsTrwoJGXH-ePw6iLmUGB?e=download&h=13396321440024111003&nonce=9fjbpq47si684&user=08509202125740856560&hash=')" name="new">
        <!-- Leads to a download link of the .csv file -->
        Download Template
      </md-nav-item>
      <md-nav-item md-nav-click="copy_to_clipboard()" aria-label="Shareable Link" class="md-fab md-raised md-mini">
        <i class="fa fa-share-square-o" aria-hidden="true"></i>Share
      </md-nav-item>
    </md-nav-bar>
</md-content>
</div>

  <div class='archived'>
    <p>Uploading currently only works with Small Groups.</p>
  </div>
<div ng-if="!active_upload">
  <form action="index.php?table=Upload" method="post" enctype="multipart/form-data">
    Please upload import file (.csv only)
    <input type="file" name="fileUpload" id="fileUpload">
    <input type="submit" value="Upload File", name="submit">
  </form>
</div>

  <div ng-if="active_upload" class="container" ng-class="{'visible' : !vm.activated}">
    <md-progress-linear md-mode="query"></md-progress-linear>
    <div class="bottom-block">
      <span>Uploading imported records...</span>
    </div>
  </div>


