<?php
$host = "localhost";
$username = "test";
$password = "test";
$database = "dblab_project";
$mysqli = mysqli_connect($host, $username, $password, $database);

$avg_ctc = mysqli_query($mysqli, "SELECT avg(ctc) as avg_ctc FROM Student where ctc > 0");

$batch_ctc = mysqli_query($mysqli, "SELECT Batch, avg(ctc) as batch_avg FROM Student where ctc > 0 group by batch ORDER BY batch");
$max_batch_ctc = mysqli_query($mysqli, "SELECT max(ctc) as max_ctc FROM Student where ctc > 0 group by batch ORDER BY batch");

$total_cnt_batch = mysqli_query($mysqli, "SELECT count(ctc) as cnt_ctc FROM Student group by batch");
$cnt_batch = mysqli_query($mysqli, "SELECT count(ctc) as cnt_ctc FROM Student where ctc > 0 group by batch");

$branch_ctc = mysqli_query($mysqli, "SELECT branch, avg(ctc) as branch_avg FROM Student where ctc > 0 group by branch");
$max_branch_ctc = mysqli_query($mysqli, "SELECT max(ctc) as max_ctc FROM Student where ctc > 0 group by branch");

$company_ctc = mysqli_query($mysqli, "SELECT company_name, avg(ctc) as avg_ctc from Roles natural join Company group by company_username ORDER BY company_username;");
$max_company_ctc = mysqli_query($mysqli, "SELECT max(ctc) as max_ctc from Roles group by company_username ORDER BY company_username");

$company_selected = mysqli_query($mysqli, "SELECT company_username, count(selected) as selected from Offers natural join Roles where selected = '1' group by company_username");
$company_names = mysqli_query($mysqli, "SELECT company_username, company_name from Company");

$roles_sector = mysqli_query($mysqli, "SELECT sector, count(role_id) as cnt from Roles group by sector");
?>

<script>
var myData_6=[<?php
while($info=mysqli_fetch_array($company_selected))
    echo $info[ 'selected' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];

<?php
$company_selected = mysqli_query($mysqli, "SELECT company_username, count(selected) as selected from offers natural join Roles where selected = '1' group by company_username");
?>

var myLabels_6=[<?php
while($info=mysqli_fetch_array($company_selected))
    echo '"'.$info[ 'company_username' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];

var comp_usernames = [<?php
while($info=mysqli_fetch_array($company_names))
    echo '"'.$info[ 'company_username' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];

<?php
$company_names = mysqli_query($mysqli, "SELECT company_username, company_name from Company");
?>

var comp_names = [<?php
while($info=mysqli_fetch_array($company_names))
    echo '"'.$info[ 'company_name' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];

const comp = [];
for(let i=0;i<comp_names.length;i++){
    var obj1={};
    obj1[comp_usernames[i]] =comp_names[i];
    comp.push(obj1);
}
debugger;
var labels6 = [];
for(let i=0;i<myLabels_6.length;i++){
    labels6.push(comp[myLabels_6[i]]);
}

var myData_4_1=[<?php
while($info=mysqli_fetch_array($cnt_batch))
    echo $info[ 'cnt_ctc' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];

var myData_4_2=[<?php
while($info=mysqli_fetch_array($total_cnt_batch))
    echo $info[ 'cnt_ctc' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];

<?php
$total_cnt_batch = mysqli_query($mysqli, "SELECT Batch, count(ctc) as cnt_ctc FROM Student group by batch");
?>

var myLabels_4=[<?php
while($info=mysqli_fetch_array($total_cnt_batch))
    echo '"'.$info[ 'Batch' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];

for(let i=0;i<myLabels_4.length;i++){
    myData_4_1[i] = (myData_4_1[i]/myData_4_2[i])*100;
}

var myData_1_1=[<?php
while($info=mysqli_fetch_array($batch_ctc))
    echo $info[ 'batch_avg' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
    $info = mysqli_fetch_array($avg_ctc);
    echo $info[ 'avg_ctc' ].',';
?>];

var myData_1_2=[<?php
while($info=mysqli_fetch_array($max_batch_ctc))
    echo $info[ 'max_ctc' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];

<?php
$batch_ctc = mysqli_query($mysqli, "SELECT Batch, avg(ctc) as batch_avg FROM Student where ctc > 0 group by batch");
?>

var myLabels_1=[<?php
while($info=mysqli_fetch_array($batch_ctc))
    echo '"'.$info[ 'Batch' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
    echo '"Overall Average", ';
?>];

var myData_5_1=[<?php
while($info=mysqli_fetch_array($company_ctc))
    echo $info[ 'avg_ctc' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];

var myData_5_2=[<?php
while($info=mysqli_fetch_array($max_company_ctc))
    echo $info[ 'max_ctc' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];

<?php
$company_ctc = mysqli_query($mysqli, "SELECT company_name, avg(ctc) as avg_ctc from Roles natural join Company group by company_username ORDER BY company_username");
?>

var myLabels_5=[<?php
while($info=mysqli_fetch_array($company_ctc))
    echo '"'.$info[ 'company_name' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];

</script>

<script>
var myData_3=[<?php
while($info=mysqli_fetch_array($roles_sector))
    echo $info[ 'cnt' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];

<?php
$roles_sector = mysqli_query($mysqli, "SELECT sector, count(role_id) as cnt from Roles group by sector");
?>

var myLabels_3=[<?php
while($info=mysqli_fetch_array($roles_sector))
    echo '"'.$info[ 'sector' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];

const seriesObj = [];  
const months = ["blue purple", "orange red", "yellow red", "yellow green", "blue black"];
const t_f = ['true', 'false'];
for(let i=0;i<myLabels_3.length;i++){
    var obj1={};
    obj1["values"]=[myData_3[i]];
    obj1["text"]=myLabels_3[i];
    obj1["backgroundColor"]= months[i%months.length];
    // obj1["detached"] = t_f[Math.floor(Math.random() * t_f.length)];
    seriesObj.push(obj1);
}
</script>

<script>
<?php
$avg_ctc = mysqli_query($mysqli, "SELECT avg(ctc) as avg_ctc FROM Student where ctc > 0");
?>

var myData_2_1=[<?php
while($info=mysqli_fetch_array($branch_ctc))
    echo $info[ 'branch_avg' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
    $info = mysqli_fetch_array($avg_ctc);
    echo $info[ 'avg_ctc' ].',';
?>];

var myData_2_2=[<?php
while($info=mysqli_fetch_array($max_branch_ctc))
    echo $info[ 'max_ctc' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];

<?php
$branch_ctc = mysqli_query($mysqli, "SELECT branch, avg(ctc) as branch_avg FROM Student where ctc > 0 group by branch");
?>

var myLabels_2=[<?php
while($info=mysqli_fetch_array($branch_ctc))
    echo '"'.$info[ 'branch' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
    echo '"Overall Average", ';
?>];

function toggleFirst(){
  toggleId("myChart1"); 
  hideId('myChart2');
  hideId('myChart3');
  hideId('myChart4');
  hideId('myChart5');
  hideId('myChart6');
}

function toggleSecond(){
  toggleId("myChart2");
  hideId('myChart1');
  hideId('myChart3');
  hideId('myChart4');
  hideId('myChart5');
  hideId('myChart6');
}

function toggleThird(){
  toggleId("myChart3");
  hideId('myChart1');
  hideId('myChart2');
  hideId('myChart4');
  hideId('myChart5');
  hideId('myChart6');
}

function toggleFourth(){
  toggleId("myChart4");
  hideId('myChart1');
  hideId('myChart2');
  hideId('myChart3');
  hideId('myChart5');
  hideId('myChart6');
}
function toggleFifth(){
  toggleId("myChart5");
  hideId('myChart1');
  hideId('myChart2');
  hideId('myChart3');
  hideId('myChart4');
  hideId('myChart6');
}
function toggleSixth(){
  toggleId("myChart6");
  hideId('myChart1');
  hideId('myChart2');
  hideId('myChart3');
  hideId('myChart4');
  hideId('myChart5');
}

function hideId(id){
  var div = document.getElementById(id);
    div.style.display = "none";
}

function toggleId(id){
  var div = document.getElementById(id);
//   if(div.style.display == "none")
    div.style.display = "block";
//   else
    // div.style.display = "none";
}
</script>

<html>
<head>
  <!--Script Reference[1] -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="bootstrap-5.3.0-alpha2-dist/css/bootstrap.min.css" rel="stylesheet">    
  <script src="bootstrap-5.3.0-alpha2-dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
</head>
<body style="background-color:#fbfbe4;">
    <div class="chart--main">
    <br>
    <div class="d-flex justify-content-center">
        <button onclick= "toggleFirst()" class='btn btn-info'> Show CTC per Batch</button> &emsp;
        <button onclick= "toggleSecond()" class='btn btn-info'> Show CTC Per Branch</button> &emsp;
        <button onclick= "toggleThird();" class='btn btn-info'> Show Roles Offered by Sector</button> &emsp;
        <button onclick= "toggleFourth()" class='btn btn-info'> Placement Percentage</button> &emsp;
        <button onclick= "toggleFifth()" class='btn btn-info'> Company-Wise CTC</button> &emsp;
        <button onclick= "toggleSixth()" class='btn btn-info'> Company Selection Stats</button> &emsp;<br>
    </div>
      <br><br>
      <div class="d-flex justify-content-center">
        <div id="myChart1" class="chart--container"></div>
      </div>
      <div class="d-flex justify-content-center">
        <div id="myChart2" class="chart--container"></div>
      </div>
      <div class="d-flex justify-content-center">
        <div id="myChart3" class="chart--container"></div>
      </div>
      <div class="d-flex justify-content-center">
        <div id="myChart4" class="chart--container"></div>
      </div>
      <div class="d-flex justify-content-center">
        <div id="myChart5" class="chart--container"></div>
      </div>
      <div class="d-flex justify-content-center">
        <div id="myChart6" class="chart--container"></div>
      </div>
    </div>
    <script>
    let chart1_config = {
        type: 'bar',
        backgroundColor:'transparent', // This is in the root
        plotarea:{
            backgroundColor:'transparent'
        },
        title: {
            "text": "CTC Per Batch",
            "font-color": "#7E7E7E",
            "backgroundColor": "none",
            "font-size": "22px",
            "alpha": 1,
            "adjust-layout": true,
        },
        legend: {
            "layout": "x3",
            "overflow": "page",
            "alpha": 0.05,
            "shadow": false,
            "align": "right",
            "adjust-layout": true,
            "marker": {
                "type": "circle",
                "border-color": "none",
                "size": "10px"
            },
            "maxItems": 3,
            "toggle-action": "hide",
            "pageOn": {
                "backgroundColor": "#000",
                "size": "10px",
                "alpha": 0.65
            },
            "pageOff": {
                "backgroundColor": "#7E7E7E",
                "size": "10px",
                "alpha": 0.65
            }
        },
        plot: {
            "bars-space-left": 0.15,
            "bars-space-right": 0.15,
            'border-radius': "2px", /* Rounded Corners */
            "animation": {
                "effect": "ANIMATION_SLIDE_BOTTOM",
                "sequence": 0,
                "speed": 800,
                "delay": 800
            }
        },
        animation:{
            effect: 2, 
            method: 5,
            speed: 900,
            sequence: 1,
            delay: 1000
        },
        'scale-y': {
            "line-color": "#7E7E7E",
            "item": {
                "font-color": "#7e7e7e"
            },
            "label": {
                "text": "₹ (in Lakhs)",
                "font-family": "arial",
                "bold": true,
                "font-size": "14px",
                "font-color": "#7E7E7E",
            },
        },
        'scale-x': {
            labels: myLabels_1
        },
        series: [{
            values:myData_1_1,
            text: "Average",
            backgroundColor: "#6666FF",
            alpha: 1
        },
        {
            values: myData_1_2,
            text:"Max",
            backgroundColor: "#6666FF #FF0066",
            alpha: 0.3
        }
        ]
    }
        zingchart.render({
            id: "myChart1",
            width: "50%",
            align: "centre",
            height: 400,
            backgroundColor: 'transparent',
            data: chart1_config
        });

        let chart2_config = {
        type: 'bar',
        backgroundColor:'transparent', // This is in the root
        plotarea:{
            backgroundColor:'transparent'
        },
        title: {
            "text": "CTC Per Branch",
            "font-color": "#7E7E7E",
            "backgroundColor": "none",
            "font-size": "22px",
            "alpha": 1,
            "adjust-layout": true,
        },
        legend: {
            "layout": "x3",
            "overflow": "page",
            "alpha": 0.05,
            "shadow": false,
            "align": "right",
            "adjust-layout": true,
            "marker": {
                "type": "circle",
                "border-color": "none",
                "size": "10px"
            },
            "maxItems": 3,
            "toggle-action": "hide",
            "pageOn": {
                "backgroundColor": "#000",
                "size": "10px",
                "alpha": 0.65
            },
            "pageOff": {
                "backgroundColor": "#7E7E7E",
                "size": "10px",
                "alpha": 0.65
            }
        },
        plot: {
            "bars-space-left": 0.15,
            "bars-space-right": 0.15,
            'border-radius': "2px", /* Rounded Corners */
            "animation": {
                "effect": "ANIMATION_SLIDE_BOTTOM",
                "sequence": 0,
                "speed": 800,
                "delay": 800
            }
        },
        animation:{
            effect: 2, 
            method: 5,
            speed: 900,
            sequence: 1,
            delay: 1000
        },
        'scale-y': {
            "line-color": "#7E7E7E",
            "item": {
                "font-color": "#7e7e7e"
            },
            "label": {
                "text": "₹ (in Lakhs)",
                "font-family": "arial",
                "bold": true,
                "font-size": "14px",
                "font-color": "#7E7E7E",
            },
        },
        'scale-x': {
            labels: myLabels_2
        },
        series: [{
            values:myData_2_1,
            text: "Average",
            backgroundColor: "#FCE77D",
            alpha: 1
        },
        {
            values: myData_2_2,
            text:"Max",
            backgroundColor: " #F96167",
        }
        ]
    }
        zingchart.render({
            id: "myChart2",
            width: "50%",
            height: 400,
            data: chart2_config
        });
    let chart3_config = {
        type: 'pie',
        backgroundColor:'transparent', // This is in the root
        plotarea:{
            backgroundColor:'transparent'
        },
        title: {
            "text": "Roles Offered by Sector",
            "font-color": "#7E7E7E",
            "backgroundColor": "none",
            "font-size": "22px",
            "alpha": 1,
            "adjust-layout": true,
        },
        plot: {
            borderColor: "#2B313B",
            borderWidth: 5,
            // slice: 90,
            valueBox: {
                placement: 'out',
                text: '%t\n%npv%',
                fontFamily: "Open Sans"
            },
            tooltip:{
                fontSize: '18',
                fontFamily: "Open Sans",
                padding: "5 10",
                text: "%npv%"
            },
            animation:{
            effect: 2, 
            method: 5,
            speed: 900,
            sequence: 1,
            delay: 1000
            }
        },
        series: seriesObj
    };
        zingchart.render({
            id: "myChart3",
            width: "90%",
            height: 400,
            data: chart3_config
        });

    let chart4_config = {
        type: 'bar',
        backgroundColor:'transparent', // This is in the root
        plotarea:{
            backgroundColor:'transparent'
        },
        title: {
            "text": "Placement Percentage",
            "font-color": "#7E7E7E",
            "backgroundColor": "none",
            "font-size": "22px",
            "alpha": 1,
            "adjust-layout": true,
        },
        plot: {
            "bars-space-left": 0.15,
            "bars-space-right": 0.15,
            'border-radius': "2px", /* Rounded Corners */
            "animation": {
                "effect": "ANIMATION_SLIDE_BOTTOM",
                "sequence": 0,
                "speed": 800,
                "delay": 800
            }
        },
        animation:{
            effect: 2, 
            method: 5,
            speed: 900,
            sequence: 1,
            delay: 1000
        },
        'scale-y': {
            "line-color": "#7E7E7E",
            "item": {
                "font-color": "#7e7e7e"
            },
            "label": {
                "text": "Percentage",
                "font-family": "arial",
                "bold": true,
                "font-size": "14px",
                "font-color": "#7E7E7E",
            },
        },
        'scale-x': {
            labels: myLabels_4
        },
        series: [{
            values:myData_4_1,
            text: "Average",
            backgroundColor: "#8a2387 #e94057 #f27121",
            alpha: 1
        }
        ]
    }
        zingchart.render({
            id: "myChart4",
            width: "50%",
            height: 400,
            data: chart4_config
        });
    let chart5_config = {
        type: 'bar',
        backgroundColor:'transparent', // This is in the root
        plotarea:{
            backgroundColor:'transparent'
        },
        title: {
            "text": "Company-Wise CTC",
            "font-color": "#7E7E7E",
            "backgroundColor": "none",
            "font-size": "22px",
            "alpha": 1,
            "adjust-layout": true,
        },
        legend: {
            "layout": "x3",
            "overflow": "page",
            "alpha": 0.05,
            "shadow": false,
            "align": "right",
            "adjust-layout": true,
            "marker": {
                "type": "circle",
                "border-color": "none",
                "size": "10px"
            },
            "maxItems": 3,
            "toggle-action": "hide",
            "pageOn": {
                "backgroundColor": "#000",
                "size": "10px",
                "alpha": 0.65
            },
            "pageOff": {
                "backgroundColor": "#7E7E7E",
                "size": "10px",
                "alpha": 0.65
            }
        },
        plot: {
            "bars-space-left": 0.15,
            "bars-space-right": 0.15,
            'border-radius': "2px", /* Rounded Corners */
            "animation": {
                "effect": "ANIMATION_SLIDE_BOTTOM",
                "sequence": 0,
                "speed": 800,
                "delay": 800
            }
        },
        animation:{
            effect: 2, 
            method: 5,
            speed: 900,
            sequence: 1,
            delay: 1000
        },
        'scale-y': {
            "line-color": "#7E7E7E",
            "item": {
                "font-color": "#7e7e7e"
            },
            "label": {
                "text": "₹ (in Lakhs)",
                "font-family": "arial",
                "bold": true,
                "font-size": "14px",
                "font-color": "#7E7E7E",
            },
        },
        'scale-x': {
            labels: myLabels_5
        },
        series: [{
            values:myData_5_1,
            text: "Average",
            backgroundColor: "#343148",
            alpha: 1
        },
        {
            values: myData_5_2,
            text:"Max",
            backgroundColor: "#D7C49E",
        }
        ]
    }
        zingchart.render({
            id: "myChart5",
            width: "50%",
            height: 400,
            data: chart5_config
        });
    let chart6_config = {
        type: 'bar',
        backgroundColor:'transparent', // This is in the root
        plotarea:{
            backgroundColor:'transparent'
        },
        title: {
            "text": "Company Selection Stats",
            "font-color": "#7E7E7E",
            "backgroundColor": "none",
            "font-size": "22px",
            "alpha": 1,
            "adjust-layout": true,
        },
        plot: {
            "bars-space-left": 0.15,
            "bars-space-right": 0.15,
            'border-radius': "2px", /* Rounded Corners */
            "animation": {
                "effect": "ANIMATION_SLIDE_BOTTOM",
                "sequence": 0,
                "speed": 800,
                "delay": 800
            }
        },
        animation:{
            effect: 2, 
            method: 5,
            speed: 900,
            sequence: 1,
            delay: 1000
        },
        'scale-y': {
            "line-color": "#7E7E7E",
            "item": {
                "font-color": "#7e7e7e"
            },
            "label": {
                "text": "Number of Students",
                "font-family": "arial",
                "bold": true,
                "font-size": "14px",
                "font-color": "#7E7E7E",
            },
        },
        'scale-x': {
            labels: myLabels_6
        },
        series: [{
            values:myData_6,
            text: "Selected",
            backgroundColor: "#fbb040 #f9ed32",
            alpha: 1
        }
        ]
    }
        zingchart.render({
            id: "myChart6",
            width: "50%",
            height: 400,
            data: chart6_config
        });
    </script>
</body>
</html>