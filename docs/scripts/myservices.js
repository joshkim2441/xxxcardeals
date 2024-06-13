session_start;
function sumValues() {

        var dropdown = document.getElementById("dropdown");

        var radioButtons = document.getElementsByName("radio");

       var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');

        var sum = 0;

    for (var i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].checked) {
            sum += parseInt(radioButtons[i].value);
        }
     }
     for (var i = 0; i < checkboxes.length; i++) {
        sum += parseInt(checkboxes[i].value);
    }
     if (dropdown.value !== "0") {
        sum += parseInt(dropdown.value);

      sum = Math.round(sum *= 0.85);
      let dcs = sum * 0.85;
      let dst = Math.floor(dcs * 0.6);
      let blc = Math.round(dcs - dst);
      // blc = sum - dst;
       document.getElementById("result").innerHTML = "Total price of discounted products and/or services selected:$ " + sum * 0.85;
       document.getElementById("dst").innerHTML = "Deposit to be paid:$ " + dst;
       document.getElementById("blc").innerHTML = "Balance due:$ " + blc;
   } else {
   let dst = sum * 0.6;
   let blc = sum - dst;
    document.getElementById("result").innerHTML = "Total price of products and/or services selected:$ " + sum;
    document.getElementById("dst").innerHTML = "Deposit to be paid:$ " + dst;
    document.getElementById("blc").innerHTML = "Balance due:$ " + blc;
    }
    }


var today = new Date();
var curHr = today.getHours();
var time = null;

if (curHr < 12) {
   time = "Morning";
} else if (curHr < 18) {
   time = "Afternoon";
} else {
   time = "Evening";
}
window.onload = function(e){
document.getElementById("time").innerHTML=time;
}

function calculate() {
  var num = parseInt(document.getElementById("num").value);
if (num === "" || isNaN(num)) num = 0;

let rate = 5;
let AMT = num * rate;
let dpt = AMT * 0.6;
let bal = AMT - dpt;

document.getElementById("Price").innerHTML=AMT;
document.getElementById("dpt").textContent=dpt;
document.getElementById("bal").textContent=bal;
document.getElementById("num").textContent=num;
parseInt(document.getElementById("num").value).innerHTML=num;
}
window.addEventListener("load", function(){
document.getElementById("calc").addEventListener("click", calculate)
calculate();
})

function redirectTo(url) {
      window.location.href = url;
}


  var viewportwidth = document.documentElement.clientWidth;
  var viewportwidth = document.documentElement.clientheight;
  window.resizeBy(-300,0);
  window.moveTo(0,0);

  window.open("indexcp.php",
  "mywindow",
  "width=300,left="+(viewportwidth-300)+",top=0")


var checkForm = function(e)
  {
    var form = (e.target) ? e.target : e.srcElement;
    if(form.name.value == "") {
      alert("Please enter your Name");
      form.name.focus();
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
      return;
    }
    if(form.email.value == "") {
      alert("Please enter a valid Email address");
      form.email.focus();
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
      return;
    }
    if(form.message.value == "") {
      alert("Please enter your comment or question in the Message box");
      form.message.focus();
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
      return;
    }
  };

document.getElementById("modal_feedback").addEventListener("submit", function(e) {
    var form = this;
    if(form.name.value == "") {
      alert("Please enter your Name");
      form.name.focus();
      e.preventDefault();
    } else if(form.email.value == "") {
      alert("Please enter a valid Email address");
      form.email.focus();
      e.preventDefault();
    } else if(form.message.value == "") {
      alert("Please enter your comment or question in the Message box");
      form.message.focus();
      e.preventDefault();
    }
  }, false);

  window.addEventListener("DOMContentLoaded", function() {
    var modalWrapper = document.getElementById("modal_wrapper");
    var modalWindow  = document.getElementById("modal_window");

    var openModal = function(e)
    {
      modalWrapper.className = "overlay";
      modalWindow.style.marginTop = (-modalWindow.offsetHeight)/2 + "px";
      modalWindow.style.marginLeft = (-modalWindow.offsetWidth)/2 + "px";
      e.preventDefault();
    };

    var closeModal = function(e)
    {
      modalWrapper.className = "";
      e.preventDefault();
    };

    var clickHandler = function(e) {
      if(e.target.tagName == "DIV") {
        if(e.target.id != "modal_window") closeModal(e);
      }
    };

    var keyHandler = function(e) {
      if(e.keyCode == 27) closeModal(e);
    };

    document.getElementById("modal_open").addEventListener("click", openModal, false);
    document.getElementById("modal_close").addEventListener("click", closeModal, false);
    document.addEventListener("click", clickHandler, false);
    document.addEventListener("keydown", keyHandler, false);
  }, false);



  if(document.addEventListener) {
    document.getElementById("modal_feedback").addEventListener("submit", checkForm, false);
    window.addEventListener("DOMContentLoaded", modal_init, false);
  } else {
    document.getElementById("modal_feedback").attachEvent("onsubmit", checkForm);
    window.attachEvent("onload", modal_init);
  }

