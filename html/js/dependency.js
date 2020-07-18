							
function check()
	{
							$("input.childdel").click(function()
                                             {
                                             	
                                                //$(".childupd[value="+$(this).val()+"]").prop("checked",false);
                                                $("#updchk").prop("checked",false);	
                                                
                            					if($(this).prop("checked")==true)
                            					{
                            						$("#del").css("visibility","");
                            						$("#upd").css("visibility","hidden");
                            						$(".childupd").prop('checked',false);
                            					}
                            					else
                            					{
                            						var c=0;
                            						$("input.childdel").each(function(){
                            							
                            							if($(this).prop("checked")==true)
                            							{

                            								c=1;
                            							}

                            						   	});
                            						if(c==0)
                            						{
                            							
                            							$("#del").css("visibility","hidden");
                            						
                            						}
                            					}
                                            
                                             });


							$("input.childupd").click(function()
                                             { 	

                                             	
                                             	$("#delchk").prop("checked",false);
                                                //$(".childdel[value="+$(this).val()+"]").prop("checked",false);
                                            	if($(this).prop("checked")==true)
                            					{
                            						$("#upd").css("visibility","");
                            						$("#del").css("visibility","hidden");
                            						$(".childdel").prop('checked',false);
                            					}
                            					else
                            					{
                            						var c=0;
                            						$("input.childupd").each(function(){
                            							
                            							if($(this).prop("checked")==true)
                            							{

                            								c=1;
                            							}

                            						   	});
                            						if(c==0)
                            						{
                            							
                            							$("#upd").css("visibility","hidden");
                            						
                            						}
                            						//$("#upd").css("visibility","hidden");
                            					}
                                             });




                 	
               $("#updchk").click(function()
                  {
                            if($(this).prop('checked')==false)
                            {
                              $(".childupd").each(function(){
                                $(this).prop('checked',false);
                              });
                              $("#upd").css("visibility","hidden");
                            }
                            else
                            {   
                              $(".childupd").each(function(){
                                $(this).prop('checked',true);
                              });
                              $("#upd").css("visibility","");
                              $("#del").css("visibility","hidden");
                              $(".childdel").each(function(){
                                $(this).prop('checked',false);
                              });
                               $("#delchk").prop('checked',false);
                            }
                  });
               $("#delchk").click(function()
                  {
                            if($("#delchk").prop('checked')==false)
                            {
                              $(".childdel").each(function(){
                                $(this).prop('checked',false);
                              });
                              $("#del").css("visibility","hidden");
                            }
                            else
                            {
                              $(".childdel").each(function(){
                                $(this).prop('checked',true);
                              });
                              $("#del").css("visibility","");
                              $("#upd").css("visibility","hidden");
                              $(".childupd").each(function(){
                                $(this).prop('checked',false);
                              });
                              $("#updchk").prop('checked',false);
                            }

                  });

      $("#upd").click(function(){
      	$("#opupd").empty();
      	var upddata = new Array();
      	$('input.childupd').each(function(){
      		console.log("in");
          if($(this).prop("checked")==true)
          {
          upddata.push($(this).val());     
      	  }

        });
        
         if(upddata.length>0)
         {		
         		$("li#tabdata>a").click();
               	$("li#tabupdate>a").click();
               	$("#parentopupd").css("visibility","");
               	$("#parentopupd2").css("visibility","hidden");

         		$.post("../update.php",{"data":upddata},function(data){
         			
         			$("#parentopupd").empty();
         			$("#opupd").append(data);
         			console.log("visited");
         			});
               	
               	$("#parentopupd").append("<button class='btn btn-primary' id='btn1' type='submit'>Update</button>");
         }
         $("#updchk").prop("checked",false);
      	 $("#delchk").prop("checked",false);
      	 $(".childdel").prop('checked',false);
      	 $(".childupd").prop('checked',false);
      	 $("#srchres").empty();
      	

      	 $("#btn1").click(function(){
      	 	
      		var dat = new Array();
      		var c=0;
      		var d=0;
      		dat[c]=[];

      		$(".updfrm1").each(function(){
      			if(d==16)
      			{
      				c+=1;
      				d=0;
      				dat[c]=[];
      				//dat[c].length = 0;
      			}
      		dat[c].push($(this).val());
      		d+=1;
      		});
      		alert(dat[1]);
      	//alert(final);
      	
		      	$.post("../update.php",{"type":"update","data":dat},function(data){
		      		alert(data);
		      		
		      		});  																		
      		});

     });
       $("#del").click(function(){
      	$("http://localhost/librarymgmt/html/dashboard.html#delete").tab("show");
      });

     }


// code for uploading sheet for updating data
   $(document).ready(function()
   {
   	$("form#frmupdUpload").submit(function() {
    //Image validation start
    $("#tbbody2").empty();
    var file_name=$('#inputFile2').val();
    var index_dot=file_name.lastIndexOf(".")+1;
    var ext=file_name.substr(index_dot);
    if(file_name=='') {
      alert('Please upload file');
    }
    else if(0) {
      alert('Please upload file');
    } //Image validation end
    else {
      //formdata object to send file upload data

      var formData = new FormData();
      formData.append('fileupload',$( '#inputFile2' )[0].files[0], file_name);
      formData.append('type',"fileupd");
      $.ajax({
        url: '../update.php',
         data: formData,
         processData: false,
         contentType: false,
         type: 'POST',
         success: function(data){
          $("#dtBasicExample3").css("visibility","");
          $("#tbbody2").append(data);
          tableload("#dtBasicExample3");
         }
          
      });

    }

    $('#frmupdUpload')[0].reset();
    return false;
  });
  

          });                           

  