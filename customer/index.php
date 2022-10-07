<?php
session_start();
if (isset($_SESSION['currentuser'])){
?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="css/indexstyle.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <meta charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
</head>
<script type="text/javascript">
$(document).ready(function()
		{
    $('#login').click(function(){
    $('.infopopupBox').fadeIn('slow');   
});
$('#sub_map').click(function(){
        $email=document.getElementById("mail").value;
        $password=document.getElementById("pass").value;
        $.ajax({    
        type: "POST",
        data: {
           email:$email,
           password:$password
       },
       url: "/php/login.php",  
       success: function(response){  
         console.log(response); 
        location.href =  "/index.php";                
     }
 });
    });
$('.close').click(function(){
   $('.infopopupBox').fadeOut('slow');
});
$('#logout').click(function(){
    $.ajax({    
				type: "POST",
				url: "php/logout.php",  
				success: function(response){                    
					location.href =  "index.php";
				}
				});
});
$('#logout1').click(function(){
    $.ajax({    
				type: "POST",
				url: "php/logout.php",  
				success: function(response){                    
					location.href =  "index.php";
				}
				});
});
$('#menu_but').click(function(){
    $('#menu').slideToggle('slow');
});
$('#order').click(function(){
    location.href =  "php/customermain.php";   
});
});

    </script>
<body>
<div id="cloak"></div>
<div id="header">
<li id="menu_but"><a >Μενού</a></li>

<ul id="menu">
    <li><a href="#login" >Αρχική</a></li>
    <li><a href="#login" >Καταστήματα</a></li>
    <li><a href="#map" >Χάρτης</a></li>
   
       <li id="logout"><a id="pop" href="#">Έξοδος</a></li>
  

</ul>

    <ul id="bar">
        
        <img src="images/logo2.jpg" height="120" width="120"  >
        <li><a href="#login" >Αρχική</a></li>
        <li><a href="#login" >Καταστήματα</a></li>  
        <li><a href="#map" >Χάρτης</a></li>
        <li id="logout1"><a id="pop" href="#">Έξοδος</a></li>
        
    </ul>
</div>


<div id=sign_up>
 

    <div>
    <h1 style="font-size:300%;color:gold;margin-left:0;float:none;">Καλώς Ήρθες <?php echo $_SESSION['currentuser']?></h1>
    <button id="order">Παραγγείλτε Τώρα</button>
   </div>

</div>

</body>
</html>


<?php
}else{
?>



<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet"> 
  <link rel="stylesheet" type="text/css" href="css/indexstyle.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <meta charset=utf-8>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
</head>
<script type="text/javascript">
$(document).ready(function()
		{
$('#login').click(function(){
    $('.infopopupBox').fadeIn('slow');   
});
$('#login1').click(function(){
    $('.infopopupBox').fadeIn('slow');   
});
$('#sub_map').click(function(){
        var emaill=document.getElementById("mail").value;
        var passwordd=document.getElementById("pass").value;
        $.ajax({    
        type: "POST",
        data: {
           email:emaill,
           password:passwordd
       },
       url: "php/login.php",  
       success: function(response){  
       console.log(response); 
    //    var response=JSON.parse(response);
        if (response['status']==0)
             $('#message').html(response['message']);
        else
             location.href =  "index.php";   
        console.log(response); 
                     
     }
     
 });
    });
    $('#sub_map1').click(function(){
        var emaill=document.getElementById("mail1").value;
        var passwordd=document.getElementById("pass1").value;
        $.ajax({    
        type: "POST",
        data: {
           email:emaill,
           password:passwordd
       },
       url: "php/login.php",  
       success: function(response){ 
        // alert(response);  
        // var response=JSON.parse(response);
        // if (response['status']==0)
        //      $('#message1').html(response['message']);
        // else
             location.href =  "index.php";   
         console.log(response); 
              
     }
 });
    });
$('.close').click(function(){
   $('.infopopupBox').fadeOut('slow');
});
$('#logout').click(function(){
    $.ajax({    
				type: "POST",
				url: "php/logout.php",  
				success: function(response){                    
					location.href =  "index.php";
				}
				});
});
$('#menu_but').click(function(){
    $('#menu').slideToggle('slow');
});

$('#enter').click(function(){
    $('#response').empty();
    var isempty=0;
    var inputs = document.getElementsByClassName('in');
    
    for (var i=0;i<inputs.length;i++){
        if(inputs[i].value=='')
        {
            inputs[i].placeholder='Fill out this field';
            isempty = 1;
        }
    }
    console.log(inputs);
    if(isempty==0)
    {
     var   email=document.getElementById("mail_in").value;
     var   password=document.getElementById("pass_in").value;
      var  phone=document.getElementById("phone_in").value;
    console.log(email);
    console.log(password);
    console.log(phone);
    $.ajax({    
                type: "POST",
                data:{
                    password:password,
                    email:email,
                    phone:phone
                },
				url: "php/signup.php",  
				success: function(response){                    
                    alert(response);
                    location.href =  "index.php";
				}
        });
    }    
});

});

    </script>
<body>
<div id="cloak"></div>
<div id="header">
<li id="menu_but"><a >Μενού</a></li>
<ul id="menu">
    <li><a href="#login" >Αρχική</a></li>
    <li><a href="#login" >Καταστήματα</a></li>
    <li><a href="#map" >Χάρτης</a></li>
    <li id="login"><a id="pop" href="javascript:void(0)">Σύνδεση</a></li>
    <div class="infopopupBox">
            <div class="infopopupBoxWrapper">   
                <div id="infopopupBoxContent">
                        <span class="close">&times;</span><br><br>
                    <h2>Είσοδος</h2>
                    <p style="color:red;" id="message"></p>
                    <input class="pac-input" class="controls" type="text" placeholder="Email" id="mail"><br>
                    <input class="pac-input" class="controls" type="password" placeholder="Password" id="pass"><br>
                    <input id='sub_map' value="Confirm" type='submit'>
                </div>
            </div>	
        </div>
</ul>

    <ul id="bar">
        
        <a href="" ><img src="images/logo2.jpg" height="120" width="120" id="logo1"></a>
        <li><a href="#login" >Αρχική</a></li>
        <li><a href="#login" >Καταστήματα</a></li>  
        <li><a href="#map" >Χάρτης</a></li>
        <li id="login1"><a id="pop" href="javascript:void(0)">Σύνδεση</a></li>
        <div class="infopopupBox">
            <div class="infopopupBoxWrapper">   
                <div id="infopopupBoxContent">
                        <span class="close">&times;</span><br><br>
                    <h2>Είσοδος</h2>
                    <p style="color:red;" id="message1"></p>
                    <input class="pac-input" class="controls" type="text" placeholder="Email" id="mail1"><br>
                    <input class="pac-input" class="controls" type="password" placeholder="Password" id="pass1"><br>
                    <input id='sub_map1' value="Confirm" type='submit'>
                </div>
            </div>	
        </div>
    </ul>
</div>


<div id=sign_up>
<div id="head_text">
    <h1>Delivery<br> Καφέ Και Snack</h1>
</div>
            <div id="sign">
            <h2>Εγγραφή</h2>
        <table>
        <tr>
        <td id="response" ></td>
        </tr>
            <tr>
            
                <th><strong><p>Email</p></strong></th>  
                <td><input type="email" placeholder="email" id="mail_in" class='in'/></td> 
                </tr>
                <tr>
                <th><strong><p>Τηλέφωνο</p></strong></th>
                <td><input type="text" placeholder="Τηλέφωνο" id="phone_in" class='in'/></td> 
                </tr>
                <tr>
                <th><strong><p>Κωδικός</p></strong></th>
                <td><input type="password" placeholder="Κωδικός" id="pass_in" class='in'/></td>  
                </tr>
            
        </table>
        <input type="button"value="submit" id="enter"/>
    </div>
</div>
 

</body>

</html>
<?php
}
?>