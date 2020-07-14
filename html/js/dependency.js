							
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

      $("#upd").click(function(e){

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
         		$.post("../update.php",{"data":upddata},function(data){
         			$("#opupd").append(data);
         			});
               	
               	$("#parentopupd").append("<button class='btn btn-primary' id='btnopupd' type='submit'>Update</button>");
         }
         $("#updchk").prop("checked",false);
      	 $("#delchk").prop("checked",false);
      	 $(".childdel").prop('checked',false);
      	 $(".childupd").prop('checked',false);
      	 $("#srchres").empty();
      	$("#btnopupd").click(function(){
      		var dat = new Array();
      		var c=0;
      		var d=0;
      		dat[c]=[]
      		$(".updfrm1").each(function(){
      			if(d==15)
      			{
      				c+=1;
      				d=0;
      				dat[c]=[];
      			}
      		dat[c].push($(this).val());
      		d+=1;
      		});
      	//alert(final);
      	//alert(dat[1]);
		      	$.post("../update.php",{"type":"update","data":dat},function(data){
		      		alert(data);
		      		});
      		});
      });
       $("#del").click(function(){
      	$("http://localhost/librarymgmt/html/dashboard.html#delete").tab("show");
      });

     }