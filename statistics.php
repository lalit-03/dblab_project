<?php
$host = "localhost";
$username = "test";
$password = "test";
$database = "dblab_project";
$mysqli = mysqli_connect($host, $username, $password, $database);

$avg_ctc = mysqli_query($mysqli, "SELECT avg(ctc) as avg_ctc FROM student where ctc > 0");

$batch_ctc = mysqli_query($mysqli, "SELECT Batch, avg(ctc) as batch_avg FROM student where ctc > 0 group by batch");
$max_batch_ctc = mysqli_query($mysqli, "SELECT max(ctc) as max_ctc FROM student where ctc > 0 group by batch");

$branch_ctc = mysqli_query($mysqli, "SELECT branch, avg(ctc) as branch_avg FROM student where ctc > 0 group by branch");
$max_branch_ctc = mysqli_query($mysqli, "SELECT max(ctc) as max_ctc FROM student where ctc > 0 group by branch");

$roles_sector = mysqli_query($mysqli, "SELECT sector, count(role_id) as cnt from roles group by sector");
?>

<script>
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
$batch_ctc = mysqli_query($mysqli, "SELECT Batch, avg(ctc) as batch_avg FROM student where ctc > 0 group by batch");
?>

var myLabels_1=[<?php
while($info=mysqli_fetch_array($batch_ctc))
    echo '"'.$info[ 'Batch' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
    echo '"Overall Average", ';
?>];
</script>

<script>
var myData_3=[<?php
while($info=mysqli_fetch_array($roles_sector))
    echo $info[ 'cnt' ].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];

<?php
$roles_sector = mysqli_query($mysqli, "SELECT sector, count(role_id) as cnt from roles group by sector");
?>

var myLabels_3=[<?php
while($info=mysqli_fetch_array($roles_sector))
    echo '"'.$info[ 'sector' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];

const seriesObj = [];  
const months = ["blue black", "orange red", "yellow red", "yellow green", "blue purple"];
const t_f = ['true', 'false'];
for(let i=0;i<myLabels_3.length;i++){
    var obj1={};
    obj1["values"]=[myData_3[i]];
    obj1["text"]=myLabels_3[i];
    obj1["backgroundColor"]= months[Math.floor(Math.random() * months.length)];
    // obj1["detached"] = t_f[Math.floor(Math.random() * t_f.length)];
    seriesObj.push(obj1);
}
</script>

<script>
<?php
$avg_ctc = mysqli_query($mysqli, "SELECT avg(ctc) as avg_ctc FROM student where ctc > 0");
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
$branch_ctc = mysqli_query($mysqli, "SELECT branch, avg(ctc) as branch_avg FROM student where ctc > 0 group by branch");
?>

var myLabels_2=[<?php
while($info=mysqli_fetch_array($branch_ctc))
    echo '"'.$info[ 'branch' ].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
    echo '"Overall Average", ';
?>];

function toggleFirst(){
  toggleId("myChart1"); 
}

function toggleSecond(){
  toggleId("myChart2");
}

function toggleThird(){
  toggleId("myChart3");
}

function toggleId(id){
  var div = document.getElementById(id);
  if(div.style.display == "none")
    div.style.display = "block";
  else
    div.style.display = "none";
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
<body>
    <div class="chart--main">
    <br>
    <div class="d-flex justify-content-center">
        <button onclick= "toggleFirst()" class='btn btn-info'> Show CTC per Batch</button> &emsp;
        <button onclick= "toggleSecond()" class='btn btn-info'> Show CTC Per Branch</button> &emsp;
        <button onclick= "toggleThird();" class='btn btn-info'> Show Roles Offered by Sector</button> &emsp;<br>
    </div>
      <div class="d-flex justify-content-center">
        <div id="myChart1" class="chart--container"></div>
      </div> <br>
      <div class="d-flex justify-content-center">
        <div id="myChart2" class="chart--container"></div>
      </div> <br>
      <div class="d-flex justify-content-center">
        <div id="myChart3" class="chart--container"></div>
      </div>
    </div>
    <script>
    let chart1_config = {
        type: 'bar',
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
            "values": "0:60:10",
            "guide": {
                "visible": true
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
            height: 300,
            data: chart1_config
        });

        let chart2_config = {
        type: 'bar',
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
            "values": "0:60:10",
            "guide": {
                "visible": true
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
            height: 300,
            data: chart2_config
        });
    let chart3_config = {
        type: 'pie',
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
            width: "50%",
            height: 300,
            data: chart3_config
        });
    </script>
</body>
</html>