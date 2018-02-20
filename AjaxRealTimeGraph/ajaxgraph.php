<?php
/*
// Program       : Real Time Plot of Values
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2018-02-20
// Example Usage : http://DOMAIN.TLD/PATH/display_paged.php
// Ajax GET var  : max, srcid
// Reference     : JSXGraph <https://jsxgraph.uni-bayreuth.de/wp/download/index.html>
// Usage Notes   : $sensor_script should be the actual URL of your sensor value acquirer
//                 $srcid is the unique source identifier of the sensor values acquired
//                 fakesensor.php provides random numbers as sensor values for testing the script
*/

$linecolor  = '#447777'; // default line colour
$line1color  = 'yellow'; // line 1 colour
$linepoints = 40;
$lineymax   = 40;
$ymarker    = 5;
$updatems   = 750;
$srcid      = "";
$sensor_script = "fakesensor.php?max=$lineymax&srcid=$sensorid";

?>
<html>
    <head>
        <title>Ajax Real Time Graph</title>
	    <meta charset="UTF-8">
<!--
        <style>
            #jxgbox {
                background-color:black;
            }
        </style>
-->
        <link rel='stylesheet' type='text/css' href='jsxgraph.css' />
        <script src='jsxgraphcore.js' type='text/javascript' charset="UTF-8"></script>
        <script type="text/javascript" src="prototype.js"></script>
    </head>
    <body>
        <div id='jxgbox' class='jxgbox' style='width:647px; height:400px;'></div>

        <script type='text/javascript'>
var brd, g, xdata = [], ydata = [], turt,i;
brd = JXG.JSXGraph.initBoard('jxgbox', {axis:true, boundingbox:[
   -2
  ,<?php echo $lineymax; ?>
  ,<?php echo $linepoints; ?>
  ,-2
]});

// Draw the additional lines
turt = brd.create('turtle',[],{strokecolor:'<?php echo $linecolor; ?>'});
turt.hideTurtle().right(90);
for (i=<?php echo $ymarker; ?>;i<=<?php echo $lineymax-$ymarker; ?>;i+=<?php echo $ymarker; ?>) {
    turt.penUp().moveTo([0,i]).penDown().forward(<?php echo $linepoints; ?>);
}

fetchData = function() {
    new Ajax.Request('<?php echo $sensor_script; ?>', {
        onComplete: function(transport) {
            var t, a;
            if (200 == transport.status) {
                t = transport.responseText;
                a = parseFloat(t);
                if (xdata.length<<?php echo $linepoints; ?>) {
                    xdata.push(xdata.length);
                } else {
                    ydata.splice(0,1);
                }
                ydata.push(a);
                if (!g) {
					// If the curve does not exist yet, create it.
                    g = brd.create('curve', [xdata,ydata], {strokeWidth:3, strokeColor:'<?php echo $line1color; ?>'/*, dash:2*/}); 
                } 
                brd.update();
            };
    }});
};
setInterval(fetchData,<?php echo $updatems; ?>);  // Start the periodical update
        </script>

    </body>
</html>
