function pwordval(){
    var l = document.getElementById("less");
    var m = document.getElementById("more");
    var lColor = "red";
    var mColor = "green";
        
        if (document.getElementById('a_password').value.length < 8) {         
            l.setAttribute('style', 'display: block');
            l.style.color = lColor;
            m.setAttribute('style', 'display: none');
        } 
        
        else {          
            l.setAttribute('style', 'display: none');       
            m.setAttribute('style', 'display: block');
            m.style.color = mColor;
        }     
}


function unameval(){
    var letters = /^[A-Za-z]+$/;
    var doc = document.getElementById("a_username").value;
    var msg = document.getElementById("icon");
    var uColor = "red";
    
        if(doc.match(letters)){
            msg.setAttribute('style', 'display: none');    
            return true;
        }
        
        else{
            msg.setAttribute('style', 'display: block');
            msg.style.color = uColor;
            return false;
        }          
}

function phoneval(){
    var p = document.getElementById("a_phone").value;
    var pAlert = document.getElementById("phone");
    var pColor = "red";
        
        if (isNaN(p)){         
            pAlert.setAttribute('style', 'display: block');
            pAlert.style.color = pColor;
            
        } 
        else{
            pAlert.setAttribute('style', 'display: none'); 
        }
}

    

        