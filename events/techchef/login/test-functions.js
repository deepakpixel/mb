var isstarted = 0;
var issubmitted = 1;
var totalquestions = 0;
var warning = 0;
var id;
var submit_message = "Thanks for taking the test";
var submit_title = "Test submitted!"
var cheated = 0;
var option_bg_color = "#457094"; //non selscted
var option_bg_color_selected = "#093555";

function startTest(total_time, q_max, u) {

    id = u;
    document.getElementById("previous-question1").style.display = "none";
    document.getElementById(`next-question${q_max}`).style.display = "none";
    if (isstarted == 1) {
        console.log("test-already started");
        return 0;
    } else {
        // hide start button
        var req = new XMLHttpRequest();
        var url = "test-process.php?id=" + id + "&action=start";
        req.open("GET", url, true);
        req.onload = function () {
            if (this.response == "started") {
                isstarted = 1;
            }
            // if (this.responseText == "timeover") {
            // timeOver("cheating");
            // }
        }
        req.onerror = function () {
            console.log("Error while starting test");

        }

        req.send();
        totalquestions = q_max;

        showQuestion(1);
        // hide start button
        // document.getElementById("previous-question1").style.display = "none";
        // document.getElementById(`next-question${q_max}`).style.display = "none";


        startTimer(total_time);

    }

}

function startTimer(total_time) {

    total_time = (Math.round(total_time * 10)) / 10;
    console.log("Timer started");
    var t = total_time * 60 * 1000; //total time is in minutes
    var x = setInterval(() => {
        // console.log(t);
        if (document.hasFocus()) {

            if (warning == 1) {
                console.log("You came back after googling");
                warning = 2;
            }

            if (warning == 3 || cheated == 1) {
                // submit_message = "Reason: Unauthorised action";
                // submit_title = "Test ended!";
                timeOver("cheating");
                clearInterval(x);

            }

        }
        else {
            if (warning == 0) {
                warning = 1;

                var warn = new XMLHttpRequest();
                warn.open("GET", "test-process.php?message=warn&id=" + id, true);
                warn.onload = function () {
                    if (this.responseText == "warn2") {
                        warning = 3;
                        cheated = 1;
                    }
                    else {
                        swal.fire({
                            title: "Seriously dude!",
                            text: "Trust me you dont want to google again!",
                            icon: "warning",
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            allowEnterKey: false,
                            focusConfirm: false,
                            confirmButtonText: "Okay, I won't"
                        });
                    }
                };
                warn.send();

            }
            else if (warning == 2) {
                console.log("time to exit");
                // timeOver
                warning = 3;
                console.log("warning updated to 3");

                // timeOver("cheating");
            }
        }
        var minutes = Math.floor(t / (60 * 1000));
        var seconds = (t - (minutes * 60 * 1000)) / 1000;
        if (seconds < 10)
            document.getElementById("time-left").innerHTML = "Time left: " + minutes + ':0' + seconds;
        else
            document.getElementById("time-left").innerHTML = "Time left: " + minutes + ':' + seconds;
        t -= 1000;
        if (t < 0) {
            clearInterval(x);
            timeOver();
            //call function time over()
        }
    }, 1000);
}




function assignQuestions(temp) {

    var temp = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    var final = [1];
    // hello(t, f);

    var text = "";

    for (let i = 0; i < 8; i++) {
        n = temp.length;
        x = Math.floor((Math.random() * n));
        final[i] = temp[x];
        temp.splice(x, 1);
    }
    for (i = 0; i < (final.length); i++) {
        text += final[i] + "<br>";
    }
    // document.getElementById("demo").innerHTML = text;
    console.log("final: " + final);
    console.log(temp);

}

function timeOver(action = "ok") {
    console.log(action);
    var req = new XMLHttpRequest();
    var url = "test-process.php?id=" + id + "&action=end";
    if (action == "cheating")
        url = "test-process.php?id=" + id + "&action=cheating";
    req.open("GET", url, true);
    req.onload = function () {
        if (this.responseText == "submitted") {



            let timerInterval
            Swal.fire({
                title: submit_title,
                html: submit_message,
                icon: "success",
                timer: 4000,
                timerProgressBar: true,
                onClose: () => {
                    clearInterval(timerInterval);
                }
            }).then((result) => {
                window.location.href = "test-summary.php";
            })





        }
        else if (this.responseText == "cheated") {
            // console.log(this.responseText + `new response is ${newans} for question ${qno}`);
            // console.log("Answer changed");
            // submit_message = "Reason: Unauthorised action";
            // submit_title = "Test ended!";

            let timerInterval2
            Swal.fire({
                title: "Test Ended",
                html: "Reason: Unauthorised action",
                icon: "success",
                timer: 4000,
                timerProgressBar: true,
                onClose: () => {
                    clearInterval(timerInterval2);
                }
            }).then((result) => {
                window.location.href = "test-summary.php?m=um";
            })

        }
        // else if (this.responseText == "timeover") {
        //     timeOver();
        // }

    }
    req.onerror = function () {
        console.log("Error while updating response");

    }

    req.send();



    // upload responses
}


function showQuestion(x, dir = 0) {
    console.log(`showing question ${x}`);

    document.getElementById(`question-container${x}`).style.display = "block";
    // hide all question
    // show x
    if (dir == 1) {
        // let t = x - 1;
        document.getElementById(`question-container${x - 1}`).style.display = "none";
    }
    if (dir == -1) {
        // let t = x + 1;
        document.getElementById(`question-container${x + 1}`).style.display = "none";
    }
}

function responseChanged(qno, newans) {
    // console.log(qno);
    // alert("answer changed");

    document.getElementById(`option-container${qno + 'a'}`).style.backgroundColor = option_bg_color;
    document.getElementById(`option-container${qno + 'b'}`).style.backgroundColor = option_bg_color;
    document.getElementById(`option-container${qno + 'c'}`).style.backgroundColor = option_bg_color;
    document.getElementById(`option-container${qno + 'd'}`).style.backgroundColor = option_bg_color;

    document.getElementById(`option-container${qno + newans}`).style.backgroundColor = option_bg_color_selected;

    var req = new XMLHttpRequest();
    var url = "test-process.php?id=" + id + "&qno=" + qno + "&newans=" + newans;
    req.open("GET", url, true);
    req.onload = function () {
        console.log(this.responseText + `new response is ${newans} for question ${qno}`);
        // console.log("Answer changed");
        if (this.responseText == "timeover") {

        }
    }
    req.onerror = function () {
        console.log("Error while updating response");

    }

    req.send();
}

function continueTest(total_time, q_max, u) {


    document.getElementById("rules-container").style.display = "none";
    document.getElementById("end-button-wrap").style.display = "block";


    id = u;
    document.getElementById("previous-question1").style.display = "none";
    document.getElementById(`next-question${q_max}`).style.display = "none";
    // hide start button
    // hide instructions
    // showQuestion(1);
    document.getElementById(`question-container1`).style.display = "block";

    startTimer(total_time);


    var t = (Math.round(total_time * 10) / 10);
    var m = Math.floor(t);
    var s = Math.floor((t - m) * 60);
    swal.fire({
        title: "Test Started!",
        text: "Time remaining: " + m + " Minutes " + s + " Seconds",
        // text: "Don't leave test window",
        icon: "info",
        allowEscapeKey: false,
        allowOutsideClick: false,
        allowEnterKey: false,
        focusConfirm: false,
        confirmButtonText: "Continue"
    });




}