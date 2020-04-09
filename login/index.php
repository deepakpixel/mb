<?php
            $settings=file_get_contents("../events/techchef/config/settings.json");
            $settings= json_decode($settings,true); //converts json to array

            date_default_timezone_set('Asia/Kolkata');

            $settings["test-start-time"]="9april2020 11:00am";
            $settings['test-end-time']="9april2020 12:10pm";
            if(time()>strtotime($settings['test-start-time'])&&time()<strtotime($settings['test-end-time']))
            {
                header("location: ../events/techchef/login");
            }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Techchef</title>
</head>
<body>
    <div class="hover_bkgr_fricc" style="display: block;">
        <span class="helper"></span>
        <div>
            <!-- <div class="popupCloseButton">×</div> -->
        <?php
            // echo date('d/m/y h:i:sa',time()); 
            if(time()>strtotime($settings['test-start-time']))
             echo "<p><strong>Test is over<hr></strong><br>Looks like you are late.<br>Test expired at 12:00pm on April 9,2020</p>";
             else
             echo "<p><strong>Test hasn't started yet<hr></strong><br>Looks like you are early.<br>Test will start at 11:00am on April 9,2020</p>";
             ?>              

             
            </div>
    </div>
</body>
</html>


<style>
    html,body{
        font-family:arial;
        margin:0px;
        padding:0px;
    }
    .hover_bkgr_fricc{
    background:rgba(0,0,0,.4);
    /* cursor:pointer; */
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
}
.hover_bkgr_fricc .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc > div {
    background-color: #fff;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 551px;
    min-height: 100px;
    vertical-align: middle;
    width: 60%;
    position: relative;
    border-radius: 8px;
    padding: 15px 5%;
}
.popupCloseButton {
    background-color: #fff;
    border: 3px solid #999;
    border-radius: 50px;
    /* cursor: pointer; */
    display: inline-block;
    font-family: arial;
    font-weight: bold;
    position: absolute;
    top: -20px;
    right: -20px;
    font-size: 25px;
    line-height: 30px;
    width: 30px;
    height: 30px;
    text-align: center;
}
.popupCloseButton:hover {
    background-color: #ccc;
}
.trigger_popup_fricc {
    /* cursor: pointer; */
    font-size: 20px;
    margin: 20px;
    display: inline-block;
    font-weight: bold;
}
</style>