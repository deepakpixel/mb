var isstarted = 0;
var totalquestions = 0;


function startTest(total_time, q_max) {
    if (isstarted == 1) {
        console.log("test-already started");
        return 0;
    } else {
        isstarted = 1;
        totalquestions = q_max;

        showQuestion(1);
        // hide start button
        document.getElementById("previous-question1").style.display = "none";
        document.getElementById(`next-question${q_max}`).style.display = "none";


        startTimer(total_time);
    }
}

function startTimer(total_time) {
    console.log("Timer started");
    var t = total_time * 60 * 1000; //total time is in minutes
    var x = setInterval(() => {
        // console.log(t);
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

function timeOver() {
    // upload responses
    window.location.href = "test-summary.php";
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