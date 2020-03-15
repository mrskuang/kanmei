
$(document).ready(function(e) {
    sheng();
    shi();
    qu();
    
    $("#sheng").change(function(){                
            shi();
            qu();
        })
    $("#shi").change(function(){
            qu();
        })
});


function sheng(){
    var dq = "100000";
    $.ajax({
        async:true,
        url:"../../include/region.php",
        data:{pcode:dq},
        type:"POST",
        dataType:"json",
        success:function(data){
          
                //var hang = data.split("|");
                var str = "";
                for(var i=0;i<data.length;i++){
                     
                    str += "<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";
                    }
                $("#sheng").html(str);
            }
        });
    }
            

function shi(){
    var dq = $("#sheng").val();
    $.ajax({
        async:true,
        url:"../../include/region.php",
        data:{pcode:dq},
        type:"POST",
        dataType:"json",
        success:function(data){
           
                  var str = "";
                for(var i=0;i<data.length;i++){
                 
                    str += "<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";
                    }
                $("#shi").html(str);
                }
        });
}

function qu()
{
    var dq = $("#shi").val();
    $.ajax({
        async:true,
        url:"../../include/region.php",
        data:{pcode:dq},
        type:"POST",
        dataType:"json",
        success:function(data){
           
                  var str = "";
                for(var i=0;i<data.length;i++){
                     
                    str += "<option value='"+data[i]['id']+"'>"+data[i]['name']+"</option>";
                    }
             
                $("#qu").html(str);
                 }
        });
}
