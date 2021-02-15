let choice=['1','2','3','0','4','5','6','7','8','9'];        
let code=[];  


while(code.length<8)
    { 
        let select=choice[Math.floor(1+(choice.length-1)*Math.random())];
        code.push(select);  
    }
    
    let htmlcode="";    
code.forEach(function(element){
    htmlcode+=element;
});
    

let securityCode=document.getElementById('SecurityCode');   
securityCode.value=htmlcode;         

       
    

let generate=document.getElementById('generate')
generate.addEventListener('click',function(){

let choice=['1','2','3','0','4','5','6','7','8','9'];        
let code=[];  


while(code.length<8)
    { 
        let select=choice[Math.floor(1+(choice.length-1)*Math.random())];
        code.push(select);  
    }
    
    let htmlcode="";    
code.forEach(function(element){
    htmlcode+=element;
});
    

let securityCode=document.getElementById('SecurityCode');   
securityCode.value=htmlcode; 
})