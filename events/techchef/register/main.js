function saveData() {
    swal.fire({
        title: 'Validating details',
        allowEscapeKey: false,
        allowOutsideClick: false,
        timer: 7000,
        allowEnterKey: false,// default value

        onOpen: () => {
            swal.showLoading();
        }
    });

    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var college = document.getElementById("college").value;
    var req = new XMLHttpRequest();
    var url = "save-data.php?name=" + name + "&email=" + email + "&phone=" + phone + "&college=" + college;
    req.open("GET", url, true);
    req.onload = function () {

        console.log(this.responseText);

        if (this.responseText == "noname") {
            sleep(600);
            Swal.fire(
                'Enter name!',
                'Please fill all the required details.',
                'warning'
            );

        } else if (this.responseText == "noemail") {
            sleep(600);
            Swal.fire(
                'Enter email!',
                'Don\'t worry, we don\'t spam.',
                'warning'
            );
        }
        else if (this.responseText == "invalidemail") {
            sleep(600);
            Swal.fire(
                'Invalid email!',
                'Please enter a valid email.',
                'warning'
            );
        }
        else if (this.responseText == "emailbounce") {
            // sleep(600); already delayed
            Swal.fire(
                'Invalid email!',
                'Please enter a valid email.',
                'warning'
            );
        }
        else if (this.responseText == "nophone") {
            sleep(600);
            Swal.fire(
                'Enter phone!',
                'Don\' worry, it\'s safe.',
                'warning'
            );
        }
        else if (this.responseText == "invalidphone") {
            sleep(600);
            Swal.fire(
                'Invalid phone!',
                'Please enter a valid phone number.',
                'warning'
            );
        }
        else if (this.responseText == "nocollege") {
            sleep(600);
            Swal.fire(
                'Enter college!',
                'Please enter your college name.',
                'warning'
            );
        }
        else if (this.responseText == "success") {
            Swal.fire(
                'Thanks for registering!',
                'Check your inbox for login details.',
                'success'
            );
            // sendmail();
            let x = document.getElementsByTagName("input");
            for (let e of x) { e.value = ""; }
        }
        else if (this.responseText == "uploadfailed") {
            sleep(600);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: 'Please contact us via&nbsp<a href="mailto:techchefbymicrobird@gmail.com?Subject=Unable%20to%20register&Body=Server%20Response:%20\'uploadfailed\'" target="_top">mail</a>&nbspor&nbsp<a href="tel:+917988992911">call us</a>'
            })
        }
        else {
            sleep(600);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Unknown error occured!',
                footer: 'Please contact us via&nbsp<a href="mailto:techchefbymicrobird@gmail.com?Subject=Unable%20to%20register&Body=Server%20Response:%20\'unknown_error_occured\'" target="_top">mail</a>&nbspor&nbsp<a href="tel:+917988992911">call us</a>'
            })
        }
    };
    req.onerror = function () {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Unable to make request to server!',
            footer: 'Please contact us via&nbsp<a href="mailto:techchefbymicrobird@gmail.com?Subject=Unable%20to%20register&Body=Server%20Response:%20\'unable_to_make_request_to_server\'" target="_top">mail</a>&nbspor&nbsp<a href="tel:+917988992911">call us</a>'
        })
    };
    req.send();
    // sleep(700);
    // a = "hello";
    // swal.fire(a, 'b', c);
}
function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}