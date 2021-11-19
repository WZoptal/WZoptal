function dis_fun(itemname)
{
	if(confirm("Are you sure you want to disbale this "+itemname))
	{
		return true;
	}
	else
	{
		return false;	
	}	
}

function enb_fun(itemname)
{
	
	if(confirm("Are you sure you want to enable this "+itemname))
	{
		return true;
	}
	else
	{
		return false;	
	}	
}

function getSubCategoryFromCategory(categoryid,embedid)
{
	$.ajax({
		url:BASEURL+'products/getSubCategoryFromCategory/',
		data:'type=json&categoryid='+categoryid,
		success:function(result)
		{
			var data="<select name='subcategory'>";
			var result=eval("("+result+")");
			data+="<option value=''>-All subcategories-</option>";
			for(var i=0;i<result.length;i++)
			{
				data+="<option value='"+result[i]['id']+"'>"+result[i]['category_name']+"</option>";	
			}
			data+="</select>";
			$("#"+embedid).html(data);	
		}	
	});	
}




function archive_fun(itemname)
{
	if(confirm("Are you sure you want to archive this "+itemname))
	{
		return true;
	}
	else
	{
		return false;	
	}		
}

function featured_fun(itemname)
{
	if(confirm("Are you sure you want to featured this "+itemname))
	{
		return true;
	}
	else
	{
		return false;	
	}		
}

function unfeatured_fun(itemname)
{
	if(confirm("Are you sure you want to remove this "+itemname+" from featured list"))
	{
		return true;
	}
	else
	{
		return false;	
	}		
}

function getSubCategoryFromCategory(categoryid,embedid)
{
	$.ajax({
		url:BASEURL+'products/getSubCategoryFromCategory/',
		data:'type=json&categoryid='+categoryid,
		success:function(result)
		{
			var data="<select name='subcategory'>";
			var result=eval("("+result+")");
			data+="<option value=''>-All subcategories-</option>";
			for(var i=0;i<result.length;i++)
			{
				data+="<option value='"+result[i]['id']+"'>"+result[i]['category_name']+"</option>";	
			}
			data+="</select>";
			$("#"+embedid).html(data);	
		}	
	});	
}

function confirmdefault()
{
	if(confirm("Are you sure you want to make this image as default image"))
	{
		return true;	
	}	
	else 
	{
		return false;	
	}
}

function confirmcancellation()
{
	if(confirm("Are you sure you want to cancel this withdrawl"))
	{
		return true;	
	}	
	else 
	{
		return false;	
	}	
}

var i=0;

function hideDiv()
{
	if(i==2)
	{
		$("#message").fadeOut('slow');	
	}	
	else
	{
		i++;	
	}
	setTimeout("hideDiv()",1000);
}

$(document).ready(function(){
	
	hideDiv();
	});