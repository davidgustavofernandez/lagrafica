// JavaScript Document
function completo(obj,nombre,tipo){ 
    if(tipo=='int'){ 
        if ((obj.value=='')||(isNaN(obj.value))){ 
            return "\n "+nombre+" requires only numbers."; 
        }else{ 
            return ""; 
        }
        }else if(obj.value=='' ){ 
            return "\n "+nombre+' must be completed.'; 
        }else{ 
            return ""; 
        }
    }
function emailvalido(obj,nombre) { 
    msg=""; 
    if(obj.value!=""){ 
        var reg1 = /(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/; 
        var reg2 = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/; 
        if (reg1.test(obj.value) || !reg2.test(obj.value)) msg= "\n "+ nombre +" is invalid.";
    }else{ 
        msg="\n "+ nombre +" must be completed.";
    } 
    return msg;
}

function igualdad(obj,reobj,nombre){
    if(obj.value!=reobj.value){
        return "\n "+nombre+" they are different.";
    }else{
        return "";
    }
}
function chequeado(obj, nombre){ 
    ok = false;
    for(i=0;i<obj.length;i++){ 
        if(obj[i].checked){
            ok = true;
        }
    }; 
    if(ok){
        return "";
    }else{
        return "\n "+nombre+' must be completed.';
    }
}

function checkvalidate(obj, nombre)
{
    ok = false;
    var chk = document.getElementsByName(obj+'[]');
    for (var i=0 ; i < chk.length ; i++){
        if (chk[i].checked) {
            ok = true;
        }
    }
    if(ok){
        return "";
    }else{
        return "\n "+nombre+' must be completed.';
    }
}

function seleccionado(obj, nombre){ 
    ok = false;
    selec = obj.selectedIndex;
    if (obj.options[selec].value!="")
    { 
        ok = true;
    } 
    if(ok){
        return "";
    }else{
        return "\n "+nombre+' must be completed.';
    }
} 

function fechapartesvalidas(dia, mes, ano, nombre){
    val=dia.value+'-'+mes.value+'-'+ano.value; 
    dr=/^[ ]*[0]?(\d{1,2})[-\/\\](\d{1,2})[-\/\\](\d{4,})[ ]*$/; 
    mc=val.match(dr);
    if (mc){ 
        var td=new Date(mc[3],parseInt(mc[2])-1,mc[1]);    
        if ( td.getDate()==parseInt(mc[1]) && td.getFullYear()==parseInt(mc[3]) && (td.getMonth()+1)==parseInt(mc[2])) 
        return"";
    } 
    return "\n "+nombre+' must be completed.';
}
	
function fechavalida(obj,nombre){
    val= obj.value; 
    dr=/^[ ]*[0]?(\d{1,2})[-\/\\](\d{1,2})[-\/\\](\d{4,})[ ]*$/; 
    mc=val.match(dr);
    if (mc){ 
    var td=new Date(mc[3],parseInt(mc[2])-1,mc[1]); 
    if (td.getDate()==parseInt(mc[1]) && td.getFullYear()==parseInt(mc[3]) && ( td.getMonth()+1)==parseInt(mc[2])) return"";
    } return "\n "+nombre+' must be completed.';
}
function openVentanaFull (dirRoot, ancho, alto) {
    wtop = (screen.height/2) - (alto/2);
    wleft = (screen.width/2) - (ancho/2);
    propiedades = "toolbar=no,status=no,scrollbars=no,location=no,menubar=no,directories=no,resizable=no,width="+ancho+",height="+alto+",top="+wtop+",left="+wleft;
    window.open(dirRoot,'FullScreen',propiedades);
    return;
}

function popUp(url,ancho,alto,id,extras){
    if(navigator.userAgent.indexOf("Mac")>0){ancho=parseInt(ancho)+15;alto=parseInt(alto)+15;}
    var left = (screen.availWidth-ancho)/2;
    var top = (screen.availHeight-alto)/2;
    if(extras!=""){extras=","+extras;};
    var ventana = window.open(url,id,'width='+ancho+',height='+alto+',left='+left+',top='+top+',screenX='+left+',screenY='+top+extras);
    var bloqueado = "WARNING:\n\nIn order to use this functionality, you need\nto deactivate Popup Blocking for this site."
    if(ventana==null || typeof(ventana.document)=="undefined"){ alert(bloqueado) }else{ return ventana; };
}

function popUpUpload(url,ancho,alto,id,ado,extras){
    if(navigator.userAgent.indexOf("Mac")>0){ancho=parseInt(ancho)+15;alto=parseInt(alto)+15;}
    var left = (screen.availWidth-ancho)/2;
    var top = (screen.availHeight-alto)/2;
    if(extras!=""){extras=","+extras;};
    var ventana = window.open(url+'&ado='+ado,id,'width='+ancho+',height='+alto+',left='+left+',top='+top+',screenX='+left+',screenY='+top+extras);
    var bloqueado = "WARNING:\n\nIn order to use this functionality, you need\nto deactivate Popup Blocking for this site."
    if(ventana==null || typeof(ventana.document)=="undefined"){ alert(bloqueado) }else{ return ventana; };
}

function _go(url){
    window.location = url;
}
