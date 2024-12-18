//partie 1





function  validerFormulaire() {
    var N=document.getElementById("test_name").value;
    var description=document.getElementById("description").value;
    var nbQ=document.getElementById("num_questions").value;
    var message="";
    if(N.length<3)
    {message+="* Le nom du test doit contenir au moins 3 caractères.\n";
     
    }
    if(description.length<3 )
    {
       
        message+="* La description doit contenir au moins 3 caractères.\n";
      
    }
   
   
     if (nbQ<=0)
    {
        message+= "* Le nombre de questions doit être un nombre positif.\n";
        
    }

    if (message !== "") {
        alert(message); 
        return false;
    } else {
        return true; 
    }
}


    function  validertestName(event) {
        event.preventDefault();
        var t=document.getElementById("test_name").value;
        var messageTitre=document.getElementById("m1");
        var valide=true;
        
    
        if(t.length<3){
            messageTitre.innerText="* Le nom doit contenir au moins 3 caractères";
            messageTitre.style.color="red";
            valide=false;
        }
        else{
            messageTitre.innerText="* correct";
            messageTitre.style.color="green";
        }


    }

    function  validerDescription(event) {
        event.preventDefault();
        var description=document.getElementById("description").value;
        var messageDescription=document.getElementById("m2");
       
        if(description.length<3 ){
            messageDescription.innerText="* La description doit contenir au moins 3 caractères";
            messageDescription.style.color="red";
            valide=false;
        }
        else{
            messageDescription.innerText="* correct";
            messageDescription.style.color="green";
        }
    }
    

    function  validernbQuestion(event) {
        event.preventDefault();
        var nbQ=document.getElementById("num_questions").value;
        var messagenbQ=document.getElementById("m3");
        if (nbQ<=0)
        {
            messagenbQ.innerText="* Le prix doit être un nombre positif";
            messagenbQ.style.color="red";
         
        }
        else{
            messagenbQ.innerText="* correct.";
            messagenbQ.style.color="green";
        }
    

    }










document.querySelector("#test_name").addEventListener("keyup", validertestName);

document.querySelector("#description").addEventListener("keyup", validerDescription);



 document.querySelector("#num_questions").addEventListener("keyup", validernbQuestion);


 