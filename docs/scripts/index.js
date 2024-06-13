function displayTime() //coverletter datetime
        {
            var time = new Date;
                   document.getElementById("time").innerHTML="<span> Date </span> <br>" +time.getDate()+" - "
+ (time.getMonth()+ 1) + " - "
+ time.getFullYear()
+"<br> <br><span> Time </span><br> "
+ time.getHours()+" : "
+ time.getMinutes() +" : "
+ time.getSeconds();
         }
         setInterval(displayTime,1000);

function emails() //contacts hyperlink button
{
console.log("joshmutuse@yahoo.com, joshuamutuse970@gmail.com")
}
//end of code


