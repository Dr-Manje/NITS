/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function showinfo($arrayinfo)
{
    document.getElementById("MoreInformation").innerHTML = $arrayinfo;
    document.getElementById("PolicyDetails").innerHTML = $arrayinfo2;
    document.getElementById("InsurerDetails").innerHTML = $arrayinfo3;
}

function deleteconfirm($arrayinfo)
{
    var response = window.confirm($arrayinfo);
    if(response==true){alert(document.getElementById("MoreInformation").innerHTML = 'Delete em')};
}

$(document).ready(function(){$('#datepicker').datepicker({dateFormat:'yy-mm-dd'});});
$(document).ready(function(){$('#datepicker2').datepicker({dateFormat:'yy-mm-dd'});});
$(document).ready(function(){$('#datepicker3').datepicker({dateFormat:'yy-mm-dd'});});
$(document).ready(function(){$('#datepicker4').datepicker({dateFormat:'yy-mm-dd'});});
//$(document).ready(function(){$('#TransactionMenu').hide();});

//function hideform()
//{
//    $('#classofbusiness').hide(500);
//    var hide = true;
//    $('#TransactionMenu').show(500);
//}