session_start;
function sumValues() {
  var dropdown = document.getElementById("dropdown");
  var radioButtons = document.getElementsByName("radio");
  var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
  var sum = 0;

  // Calculate the total price of the product
  for (var i = 0; i < radioButtons.length; i++) {
    if (radioButtons[i].checked) {
      sum += parseInt(radioButtons[i].value);
    }
  }

  // Calculate the transport cost
  var transportCost = 0;
  for (var i = 0; i < checkboxes.length; i++) {
    transportCost += parseInt(checkboxes[i].value);
  }
  sum += transportCost;

  // Calculate the insurance cost
  var insuranceCost = 0;
  if (dropdown.value != "0") {
    insuranceCost = sum * parseFloat(dropdown.value);
  }
  sum += insuranceCost;

  // Display the results
  document.getElementById("result").innerHTML = "Total price of product(s) and/or services selected:$ " + sum.toFixed(2);
  document.getElementById("dst").innerHTML = "Transport costs to be paid:$ " + transportCost.toFixed(2);
  document.getElementById("blc").innerHTML = "Insurance costs:$ " + insuranceCost.toFixed(2);
  sendCostsToPHP(transportCost.toFixed(2), insuranceCost.toFixed(2));

  localStorage.setItem('insuranceCost', insuranceCost.toFixed(2));
  localStorage.setItem('transportCost', transportCost.toFixed(2));

  $.ajax({
    url: 'ppindex.php',
    type: 'post',
    data: {
      'insuranceCost': insuranceCost,
      'transportCost': transportCost
    },
    success: function (response) {
      // handle response from your PHP script
    }
  });
}

function sendCostsToPHP(transportCost, insuranceCost)
{
  var xhr = new HMLHttpRequest();
  xhr.open("POST", "ppindex.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      console.log("Costs sent to php successfully: ", xhr.responseText);
    } else {
      console.log("Error sending data to PHP: ", xhr.statusText);
    }
  };
  xhr.send("transportCost=" + transportCost + "$insuranceCost=" + insuranceCost);
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



  var checkForm = function (e) {
  var form = (e.target) ? e.target : e.srcElement;
  if (form.name.value == "") {
    alert("Please enter your Name");
    form.name.focus();
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    return;
  }
  if (form.email.value == "") {
    alert("Please enter a valid Email address");
    form.email.focus();
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    return;
  }
  if (form.message.value == "") {
    alert("Please enter your comment or question in the Message box");
    form.message.focus();
    e.preventDefault ? e.preventDefault() : e.returnValue = false;
    return;
  }
};

  // Original JavaScript code by Chirp Internet: chirpinternet.eu
// Please acknowledge use of this code by including this header.

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
    var form = document.getElementById("modal_feedback");
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
    document.getElementById("modal_feedback").addEventListener("submit", function(e) {
    closeModal(e);
    form.reset();
    },);
  }, false);
  if(document.addEventListener) {
    document.getElementById("modal_feedback").addEventListener("submit", checkForm, false);
    document.getElementById("modal_feedback").reset();
    window.addEventListener("DOMContentLoaded", modal_init, false);
  } else {
    document.getElementById("modal_feedback").attachEvent("onsubmit", checkForm);
    window.attachEvent("onload", modal_init);
  }
