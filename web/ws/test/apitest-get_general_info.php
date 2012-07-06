<?php

function getExperimentsTest($page, $limits, $query, $sort, $action){
    //The target for this test
    $target = "localhost/ws/api.php?method=getExperiments";
    
    //Curl crap that will mostly stay the same
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'page' => $page,
	'limits' => $limits,
	'query' => $query,
	'sort' => $sort,
	'action' => $action,
	'type' => 'experiments'
        )); 
        
        //Run curl to get the response
        $result = curl_exec($ch);
        //Close curl
        curl_close($ch);
        //Parse the response to an associative array
	
        return json_decode($result,true);
}

function getPeopleTest($page, $limits, $query, $sort, $action){
    //The target for this test
    $target = "localhost/ws/api.php?method=getPeople";
    
    //Curl crap that will mostly stay the same
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'page' => $page,
	'limits' => $limits,
	'query' => $query,
	'sort' => $sort,
	'action' => $action,
	'type' => 'people'
        )); 

    //Run curl to get the response
    $result = curl_exec($ch);
    //Close curl
    curl_close($ch);
    //Parse the response to an associative array
    return json_decode($result,true);
}

function getSessionsTest($exp){
    //The target for this test
    $target = "localhost/ws/api.php?method=getSessions";
    
    //Curl crap that will mostly stay the same
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $target);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, array(
        'experiment' => $exp
        )); 
        
        //Run curl to get the response
        $result = curl_exec($ch);
        //Close curl
        curl_close($ch);
        //Parse the response to an associative array
        return json_decode($result,true);
}

//skipped getDataSince for now

//--------------------------------------------------------------------------------------------------------------------

//Get Experiments Test
echo "<h1>Get Experiments Test</h1>";

//Verifies that the first page has different experiments to the ones on the following page
echo "<h2>Verifies that pages are working....</h2>";

$page = 1;
$limits = 4;
$query = "";
$sort = "default";
$action = "browse";

$getExperiments_response = getExperimentsTest($page, $limits, $query, $sort, $action);

$result1= Array();

for($i=0; $i<$limits; $i++){
  $result1[$i] = $getExperiments_response['data'][$i]['meta']['experiment_id']; 
}

$page = 2;
$getExperiments_response = getExperimentsTest($page, $limits, $query, $sort, $action);


for($i=0; $i<$limits; $i++){  
  if(in_array($getExperiments_response['data'][$i]['meta']['experiment_id'],$result1 )) {
      $successflag = 0;
  }else{
      $successflag = 1;
      break;
  }
}

  if($successflag == 0){
      echo "<div class='failure'>FAILURE</div>, Page 1 and 2 are not different.<br>";
  } elseif($successflag == 1){
      echo "<div class='success'>SUCCESS</div>, Page 1 and 2 are different.<br>";
  }

echo "<br>";

//Verifies that the number of experiments on a page does not exceed its limit
echo "<h2>Verifies that limits are working....</h2>";

$page = 1;
$limits = 10;
$query = "";
$sort = "default";
$action = "browse";

$getExperiments_response = getExperimentsTest($page, $limits, $query, $sort, $action);

for($i=0; $i<count($getExperiments_response['data']); $i++);

  if($i > $limits){
      echo "<div class='failure'>FAILURE</div>, Page 1 does not satisfy the limit requirement.<br>";
  } else{
      echo "<div class='success'>SUCCESS</div>, Page 1 satisfies the limit requirement.<br>";
  }

$page = 2;
$limits = 10;
$query = "";
$sort = "default";
$action = "browse";

$getExperiments_response = getExperimentsTest($page, $limits, $query, $sort, $action);

for($i=0; $i<count($getExperiments_response['data']); $i++);

  if($i > $limits){
      echo "<div class='failure'>FAILURE</div>, Page 2 does not satisfy the limit requirement.<br>";
  } else{
      echo "<div class='success'>SUCCESS</div>, Page 2 satisfies the limit requirement.<br>";
  }

echo "<br>";

echo "<hr>";

//--------------------------------------------------------------------------------------------------------------------

//Get People Test
echo "<h1>Get People Test</h1>";

//Verifies that the first page has different experiments to the ones on the following page
echo "<h2>Verifies that pages are working....</h2>";

$page = 1;
$limits = 4;
$query = "";
$sort = "default";
$action = "browse";

$getPeople_response = getPeopleTest($page, $limits, $query, $sort, $action);

$result1= Array();

for($i=0; $i<$limits; $i++){
  $result1[$i] = $getPeople_response['data'][$i]['user_id']; 
}

$page = 2;
$getPeople_response = getPeopleTest($page, $limits, $query, $sort, $action);

for($i=0; $i<$limits; $i++){  
  if(in_array($getPeople_response['data'][$i]['user_id'],$result1 )) {
      $successflag = 0;
  }else{
      $successflag = 1;
      break;
  }
}

  if($successflag == 0){
      echo "<div class='failure'>FAILURE</div>, Page 1 and 2 are not different.<br>";
  } elseif($successflag == 1){
      echo "<div class='success'>SUCCESS</div>, Page 1 and 2 are different.<br>";
  }

echo "<br>";

//Verifies that the number of people on a page does not exceed its limit
echo "<h2>Verifies that limits are working....</h2>";

$page = 1;
$limits = 10;
$query = "";
$sort = "default";
$action = "browse";

$getPeople_response = getPeopleTest($page, $limits, $query, $sort, $action);

for($i=0; $i<count($getPeople_response['data']); $i++);

  if($i > $limits){
      echo "<div class='failure'>FAILURE</div>, Page 1 does not satisfy the limit requirement.<br>";
  } else{
      echo "<div class='success'>SUCCESS</div>, Page 1 satisfies the limit requirement.<br>";
  }

$page = 2;
$limits = 10;
$query = "";
$sort = "default";
$action = "browse";

$getPeople_response = getPeopleTest($page, $limits, $query, $sort, $action);

for($i=0; $i<count($getPeople_response['data']); $i++);

  if($i > $limits){
      echo "<div class='failure'>FAILURE</div>, Page 2 does not satisfy the limit requirement.<br>";
  } else{
      echo "<div class='success'>SUCCESS</div>, Page 2 satisfies the limit requirement.<br>";
  }

echo "<br>";

echo "<hr>";

//--------------------------------------------------------------------------------------------------------------------

//Get Sessions Test
echo "<h1>Get Session Test</h1>";

//Verifies that we correctly got the session(s)
echo "<h2>Tests that we correctly got the session(s)....</h2>";

$exp = 1;
$getSessions_response = getSessionsTest($exp);

if ($getSessions_response['status'] == 200) {
    echo "<div class='success'>SUCCESS</div>, Successfully got session(s).<br>";
} else {
    echo "<div class='failure'>FAILURE</div>, Unable to get session(s). JSON: ";
    print_r($getSessions_response);
    echo "<br>";
}

echo "<br>";

//Verifies that we did not get the session(s).
echo "<h2>Tests that we did not get the session(s) in a non-existent experiment....</h2>";

$exp = 0;
$getSessions_response = getSessionsTest($exp);

if ($getSessions_response['status'] == 600) {
    echo "<div class='success'>SUCCESS</div>, Unable to session(s).<br>";
} elseif ($getSessions_response['status'] == 200) {
    echo "<div class='failure'>FAILURE</div>, Successfully got session(s). JSON: ";
    print_r($getSessions_response);
    echo "<br>";
} else {
    echo "<div class='failure'>FAILURE</div>, Something unexpected happened. JSON:";
    print_r($getSessions_response);
    echo "<br>";
}

// echo "More tests to come!"; What does this mean?
echo "<hr>";

?>