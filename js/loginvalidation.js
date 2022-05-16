// jquey validations relavant to login functionalities


$(document).ready(function(){

//// our codes and other function will be inside this;


  $("form").submit(function(){
      
    var  username=$("#username").val();  /// get the value of username text field
    var  password=$("#password").val();  /// get the value of username text field
    
    if(username=="")
    {
        $("#alertdiv").html("Username is Empty !!!");
        $("#username").focus();
        
        /// alert styling
        
        $("#alertdiv").addClass("alert alert-danger");
        
      return false;  
          
    }
    
     if(password=="")
    {
        $("#alertdiv").html("Password is Empty !!!");
        $("#password").focus();
        
        /// alert styling
        
        $("#alertdiv").addClass("alert alert-danger");
        
       return false;  
          
    }
  })
  

});



