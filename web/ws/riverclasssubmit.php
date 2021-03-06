<!--
 * Copyright (c) 2011, iSENSE Project. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer. Redistributions in binary
 * form must reproduce the above copyright notice, this list of conditions and
 * the following disclaimer in the documentation and/or other materials
 * provided with the distribution. Neither the name of the University of
 * Massachusetts Lowell nor the names of its contributors may be used to
 * endorse or promote products derived from this software without specific
 * prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE REGENTS OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
 * OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
 * DAMAGE.
 -->
<html>
  <head>
    <title> River in the Classroom Easy Submission Review </title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
  </head>
  <body>
  <?php require_once '../includes/config.php' ?>
  <div id="wrapper">
    <div>
      <img src="../html/img/logo.png"/>
    </div>
    <?php 

      // Map variables to posted data
      $school     = $_REQUEST['school']; 
      $testType   = $_REQUEST['testType']; 
      $sessionLoc = $_REQUEST['sessionLoc'];
      $pH         = $_REQUEST['pH']; 
      $temp       = $_REQUEST['temp']; 
      $disox      = $_REQUEST['disox']; 
      $turb       = $_REQUEST['turb']; 
      $airTemp    = $_REQUEST['airTemp']; 
      $copper     = $_REQUEST['copper']; 
      $phosphorus = $_REQUEST['phosphorus'];

      // eid is hardcoded. If this changes, modify it here.
      $eid = 344;

      //Assign sessionLoc a value relative to the pre-existing session selected.    
      switch ($sessionLoc) {
        case "upriver":
          $sid = 2863;
          $lat = 42.6379998;
          $long = -71.3560938;
          break;
        case "downriver":
          $sid = 2864;
          $lat = 42.639705;
          $long = -71.354086;
          break;
        case "dock":
          $sid = 2865;
          $lat = 42.640084;
          $long = -71.352403;
          break;
        case "canals":
          $sid = 2856;
          $lat = 42.6379998;
          $long = -71.3560938;
          break;
      } 
    ?>
      <span class="formLabel">School Name:</span>
        <span class="formData"> <?php print $school; ?> </span><br/>
      <span class="formLabel">Test Type:</span>
        <span class="formData"> <?php print $testType; ?> </span><br/>
      <span class="formLabel">Session Location:</span>
        <span class="formData"> <?php print $sessionLoc; ?> </span><br/>
      <span class="formLabel">pH:</span>
        <span class="formData"> <?php print $pH; ?> </span><br/>
      <span class="formLabel">Water Temperature(Celsius):</span>
        <span class="formData"> <?php print $temp; ?> </span><br/>
      <span class="formLabel">Disolved Oxygen:</span>
        <span class="formData"> <?php print $disox; ?> </span><br/>
      <span class="formLabel">Turbidity:</span>
        <span class="formData"> <?php print $turb; ?> </span><br/>
      <span class="formLabel">Air Temperature(Celsius):</span>
        <span class="formData"> <?php print $airTemp; ?> </span><br/>
      <span class="formLabel">Copper:</span>
        <span class="formData"> <?php print $copper; ?> </span><br/>
      <span class="formLabel">Phosphorus:</span>
        <span class="formData"> <?php print $phosphorus; ?> </span><br/>

      <?php 
        $data = array(array($_SERVER['REQUEST_TIME'],$school, $testType, $lat, $long, $temp, $pH, $turb, $disox, $copper, $phosphorus, $airTemp));
      ?>
      <?php putData($eid, $sid, $data); ?>
      <a href="../vis.php?sessions=<?php print $sid; ?>"?> View this submission </a>
    </div>
  </body>
</html>
