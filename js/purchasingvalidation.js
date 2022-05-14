$(document).ready(function(){
    
    $("#addnotebtn").click(function(){  //when add note buttin clicked function function occurs
        
       var reqdate=$("#reqdate").val(); //from requision note
       
       
      var url="../controller/purchasing_controller.php?status=add_note";
     
     $.post(url,{req_date:reqdate},function(data){
         
         $("#notedescription").html(data);

     });
     
     $("#btnaddnoteitem").click(function (){
         
         var productid=$("#prid").val();
         var qty=$("#qty").val();
         
          var url="../controller/purchasing_controller.php?status=add_note_item";
     
        $.post(url,{req_date:reqdate},function(data){

            $("#notedescription").html(data);

        });
         
         
     })
       
       
       
        
    });
 
    
});




