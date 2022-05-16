$(document).ready(function(){
    
     $("#user_role").change(function(){
    
          var role_id=$("#user_role").val();
          
          var url="../controller/user_controller.php?status=get_functions";
          $.post(url,{role_id:role_id},function(data){
              
              $("#cont").html(data);
              
          });
 
     });
    $("form").submit(function(){
         
                var fname=$("#fname").val();
                var lname=$("#lname").val();
                var email=$("#email").val();
                var nic=$("#nic").val();
                var cno1=$("#cno1").val();
                var cno2=$("#cno2").val();
                var user_role=$("#user_role").val();
                
                
                
             if(fname=="")
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b><p align='center'>First Name Cannot Be Empty!!</p></b>");
          $("#fname").focus();   <!-- focus is given to first name text box -->
          
          return false;
             
         }
         if(lname=="")
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b><p align='center'>Last Name Cannot Be Empty!!</p></b>");
          $("#lname").focus();
          
          return false;
             
         }
         if(email=="")
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b><p align='center'>Email Cannot Be Empty!!</p></b>");
          $("#email").focus();
          
          return false;
             
         }
         if(nic=="")
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b><p align='center'>NIC Cannot Be Empty!!</p></b>");
          $("#nic").focus();
          
          return false;
             
         }
         if(cno1=="")
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b>Contact Number 1 Cannot Be Empty!!</b>");
          $("#cno1").focus();
          
          return false;
      }
         if(cno2=="")
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b>Contact Number 2 Cannot Be Empty!!</b>");
          $("#cno2").focus();
          
          return false;
      }
         if(user_role=="")
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b><p align='center'>User Role Cannot Be Empty!!</p></b>");
          $("#user_role").focus();
          
          return false;
             
         }
         
         var patternnicold = /^[0-9]{9}[vVxX]$/;
         var patternnicnew = /^[0-9]{12}$/;
         var patemail=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;
         var patcnoland =/^\+94[0-9]{9}$/;
         var patcnomobile= /^\+947[0-9]{8}$/;

          
        if((!nic.match(patternnicold)) &&(!nic.match(patternnicnew)))
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b>NIC is Invalid</b>");
          $("#nic").focus();
          
          return false;
             
           
         }
         if(!email.match(patemail))
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b>Email is Invalid</b>");
          $("#email").focus();
          return false;
      }
       if(!cno1.match(patcnoland))
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b>Contact Number 1 is Invalid</b>");
          $("#cno1").focus(); 
          
          return false;
      }
        if(!cno2.match(patcnomobile))
      {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b>Contact Number 2 is Invalid</b>");
          $("#cno2").focus();
          
          return false;
      }
      
      <!-- loop through all the check boxes-->
      <!-- to identify check-boxes individually -index-->
      var selectedcounter=0;
      
      $(".userfunctions").each(function (index){ 
         
          if($(this).is(":checked")){
              
              selectedcounter++;
              
          }
      
      });
      
      if(selectedcounter==0)
        {
          $("#alertdiv").addClass("alert alert-danger");
          $("#alertdiv").html("<b>At least one function should be selected</b>");
         
      
          
          return false;
            
            
        }
      
       
      

            
     })
     
    
    
 });


