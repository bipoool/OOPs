document.getElementById("addButton").addEventListener("click", addData)

function addData(e){

    e.preventDefault();
    nm = document.getElementById("Name").value;
    pass = document.getElementById("Password").value;
    em = document.getElementById("Email").value;
    ag = document.getElementById("Age").value;

    const myData = {Name:nm, Password:pass, Email: em, Age:ag}
    const data = JSON.stringify(myData)  
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "CreateUsingAJAX.php", true)
    xhr.onload = function(){
        if(xhr.status===200){
            document.getElementById("Name").value = "";
            document.getElementById("Password").value = "";
            document.getElementById("Email").value = "";
            document.getElementById("Age").value = "";
            displayData();
        }
        else{
            window.alert("connectione error");
        }
    }
    xhr.send(data);
}

function displayData(){

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "Display.php", true);
    xhr.onload = function(){
        if(xhr.status===200){
            document.getElementById("table").innerHTML = xhr.response
        }
        else{
            window.alert("connectione error");
        }
    }
    xhr.send()
}


displayData()

