
        var fullname=true;
        var Email=true;
        var Username=true;
        var Num=true;
        var SSN=true;
        var password=true;

        function check(){

            if(fullname == false ||   Email==false ||  Username==false || Num==false || SSN==false || password==false ){

                return false;
                
            }

            else return true;
        }

        function validateFName(text){
              var regex=/^[0-9]+$/;
           
            if(text.value==""){

                text.style.backgroundColor="red";
                document.getElementById("name").innerHTML="full name can't be empty";
                fullname= false;



            }
            
             else if(text.value.match(regex)){
                
                text.style.backgroundColor="red";
                document.getElementById("name").innerHTML="name must be letters only";
                fullname= false;
            }
            else
            { document.getElementById("name").innerHTML="";
             fullname= true;
             text.style.backgroundColor="#1c1c1c";
            }
        }

        function validateEmail(text){

            if(text.value==""){
                text.style.backgroundColor="red";
                document.getElementById("mail").innerHTML=" email can't be empty";
                Email= false;

            } else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(text.value))){
                document.getElementById("mail").innerHTML=" email wrong format";
                text.style.backgroundColor="red";
                Email= false;
            }
            else{
                document.getElementById("mail").innerHTML="";
                Email= true;
                text.style.backgroundColor="#1c1c1c";

            } 
        } 

        function validateUsername(text){
            if (text.value==""){
            
                document.getElementById("username").innerHTML="user name can't be empty";
                Username= false;
                text.style.backgroundColor="red";
            }
            else if(text.value.length<4){

                document.getElementById("username").innerHTML="user name must be more than 3 letters";
                Username= false;
                text.style.backgroundColor="red";
            }
            else {

                document.getElementById("username").innerHTML="";
                Username= true;
                text.style.backgroundColor="#1c1c1c";
            }

        }
        function validateNumber(text){
            if (text.value==""){

                document.getElementById("number").innerHTML="number can't be empty";
                Num= false;
                text.style.backgroundColor="red";
            }
            
             else if(text.value.charAt(0)!=0){
                document.getElementById("number").innerHTML="must begin with zero";
                Num= false;
                text.style.backgroundColor="red";
                
            }
            
            else if(text.value.length!=11 ){
                document.getElementById("number").innerHTML="number must be 11 digits begin with zero";
                Num= false;
                text.style.backgroundColor="red";
            }
           else  if (isNaN(text.value)){
                 document.getElementById("number").innerHTML="number can't contain letters";
                Num= false;
                text.style.backgroundColor="red";
                
            }
                else {

                    document.getElementById("number").innerHTML="";
                    Num= true;
                    text.style.backgroundColor="#1c1c1c";
                }

        }

        function validateSSN(text){
            if (text.value==""){

                document.getElementById("ssn").innerHTML="SSN can't be empty";
                SSN= false;
                text.style.backgroundColor="red";
            }
           
            else if(text.value.length!=14 ){
                document.getElementById("ssn").innerHTML="SSN must be 14 digits";
                SSN= false;
                text.style.backgroundColor="red";
            }
            else 
                
                 if (isNaN(text.value)){
                 document.getElementById("ssn").innerHTML="ssn can't contain letters";
                Num= false;
                text.style.backgroundColor="red";
                
            }
                
            
            else {

                document.getElementById("ssn").innerHTML="";
                SSN= true;
                text.style.backgroundColor="#1c1c1c";
            }

        }
        function validatepassword(text){
            if (text.value==""){

                document.getElementById("password").innerHTML="password can't be empty";
                password= false;
                text.style.backgroundColor="red";
            }

            else if(text.value.length<6){
                document.getElementById("password").innerHTML="password must be at least 6 digits";
                password= false;
                text.style.backgroundColor="red";
            }
            else {

                document.getElementById("password").innerHTML="";
                password= true;
                text.style.backgroundColor="#1c1c1c";
            }

        }


