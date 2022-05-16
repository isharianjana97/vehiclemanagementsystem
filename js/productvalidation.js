$(document).ready(function(){
    
    
  $("#generatebtn").click(function(){
      
      var barcode=$("#barcode").val();
      if(barcode!=""){
          
          
          var url="../controller/product_controller.php?status=generate_barcode";
          $.post(url,{barcode:barcode},function(data){
              
              $("#displaybarcode").html(data);
              
          });
      }
      else{
          
          alert("Please Enter A Barcode Number !");
          
          
          
          
      }
      
      
      
  });
  $("#barcode").blur(function(){
        
       var barcode=$("#barcode").val();
       if(barcode!="")
       {
             var url="../controller/product_controller.php?status=validate_barcode";
     
              $.post(url,{barcode:barcode},function(data){

                    $("#displayvalidate").html(data);

                });
       }
       else{
           $("#displayvalidate").html("");
       }
        
        
    });
   $("form").submit(function (){
        
        var price=$("#price").val();
        
        if(!price.isNumeric())
        {
            
        }
        else{
          if(price<0)
          {
                
                
          }            
        }

    })
    
    
});

