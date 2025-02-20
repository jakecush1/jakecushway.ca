//JAVASCRIPT FOR HOURS LOGGING APPLICATION
//JAKE CUSHWAY

firebase.initializeApp({
    apiKey: "AIzaSyDHIqMAe-fJzhx3I_oRiH-0XyazMoAK95s",
    authDomain: "jakehourslogger.firebaseapp.com",
    projectId: "jakehourslogger",
})

const db = firebase.firestore()

//SIGN IN PAGE START//
function registerUser(){ // CREATE A USER 
    
    //stores the users inputted email and password to variables
    let regEmail = document.getElementById("email").value;
    let regPass = document.getElementById("password").value;

    firebase.auth().createUserWithEmailAndPassword(regEmail,regPass)
    .then((user) =>{

    //creates unique user id when register
    let userId = user.user.uid;
    console.log(userId)

    //reload page to login
    alert("Registration successful, You may now Sign in")
    window.location.href = "index.html";

    })
    .catch(()=>{

    alert("registration unsuccessful, try again")
    window.location.href = "index.html";
    })
    }


function signInUser(){

    let logInEmail = document.getElementById("email").value;
    let logInPass = document.getElementById("password").value;

    firebase.auth().signInWithEmailAndPassword(logInEmail,logInPass)
    .then((user)=>{

        console.log("user signed in")
        window.location.href = "menu.html";

    })
    .catch(()=>{

        console.log("Unsuccessful, create an account")
        // window.location.href = "index.html";
    })

}

///////SIGN IN PAGE END//////


////// MENU PAGE START //////

function createNewJob(){

    //get user ID, create new job item
    let newJob = document.getElementById("jobName").value;
    let userID = firebase.auth().currentUser.uid;
    let jobObj = {
        [newJob]: {inputs:[]}
        
    };

    //only set if the input is not empty
    if (newJob != ''){

        //set new item using userID and job name
        db.collection("trackMyHours-App").doc(userID).set(
        jobObj , 
        {merge:true}
        )
        .then(()=>{
            //after Item is set go to viewjobs page
            document.getElementById("jobName").value=''
            console.log("job added")
            window.location.href="viewjobs.html"
        })
        .catch(()=>{
            alert("error")
        })
    }
    else{
        alert("enter a job")
    }
}


function viewJobsButton() {
    //links to viewjobs page
    let userID = firebase.auth().currentUser.uid;  // gets the current user uid that we use to call the document

    db.collection("trackMyHours-App").doc(userID).get().then(()=>{

        window.location.href='viewjobs.html'


})
}

/////END OF MENU PAGE/////

    //window.onload = setTimeout(viewCurrentJobs, 1000);

/////START OF VIEW JOBS PAGE////

function viewCurrentJobs(){


    let userID = firebase.auth().currentUser.uid;  // gets the current user uid that we use to call the document

    db.collection("trackMyHours-App").doc(userID).get().then((doc)=>{
    document.getElementById("removeDiv").innerHTML="";

//jobs is the object containing all jobtitles as //properties, and the data as the value
        let jobs = doc.data();

        Object.entries(jobs).forEach(([key,value]) => {
            //console.log(key);        //key will be jobtitle
            //console.log(value);      //value will be the array with the info


            //console.log(value)

            let sum = 0;
        
            for (const jobInput of value.inputs) {
                sum+=parseFloat(jobInput.hours)
            }
            //console.log(sum)

            allJobDiv = document.getElementsByClassName("allJobs")[0];
            jobDiv = document.createElement("div");
            jobTitle = document.createElement("h2");
            totalHours = document.createElement("p");
            logButton = document.createElement("button");
            showHoursButton = document.createElement("button");
            
            jobDiv.id = key;
            jobTitle.innerText = key;
            totalHours.innerText = "Total Hours: "+ sum; //will add the sum of hours
            logButton.innerText = "Log Hours";
            logButton.className = "btn btn-primary";
            showHoursButton.innerText = "View Hours";
            showHoursButton.className = "btn btn-primary";
            logButton.setAttribute("data-toggle", "modal");
            logButton.setAttribute("data-target", "#exampleModal");
            showHoursButton.setAttribute("data-toggle", "modal")
            showHoursButton.setAttribute("data-target", "#exampleModalCenter")
            logButton.id = key;
            showHoursButton.id = key;

    //send key so the function will know which object to store data to
            logButton.addEventListener("click", (function(){ 
                openInput(key)
                //console.log(key)
            }))

            showHoursButton.addEventListener("click", (function(){
                showHours(key)
                //console.log(key)
            }))

            allJobDiv.appendChild(jobDiv);
            jobDiv.appendChild(jobTitle);
            jobDiv.appendChild(totalHours);
            jobDiv.appendChild(logButton);
            jobDiv.appendChild(showHoursButton);


        })
    
    })
    .catch(()=>{
        alert("No jobs Exist, Add a Job");
        window.location.href = "menu.html";

    })
}

function showHours(job){

    let hoursList = document.createElement("ul");
    hoursList.Id = "hoursList";
    

    let userID = firebase.auth().currentUser.uid;
    //get info to put into the popup box
    db.collection("trackMyHours-App").doc(userID).get().then((doc)=>{
        let inputArray = doc.data()[job].inputs;

        inputArray.forEach(function(i){
            let hourLogs = document.createElement("li");
            let hours = document.createElement("p");
            let note = document.createElement('p');
            hours.innerText=i.date + ": " + i.hours + " Hrs - " + i.note
            note.innerText=i.note;
            hourLogs.append(hours);
            hoursList.appendChild(hourLogs);
        })

    // document.getElementById("exampleModalLongTitle").replaceChildren(hoursList);
    document.querySelector("#exampleModalCenter div.modal-body").replaceChildren(hoursList);


//console.log(hoursList)
        
    })

}

//recieves job name from button that was clicked on
function openInput(job){
//adds event listner to loghours button 
//runs store data when clicked

    logHoursButton = document.getElementById("log-hours");
    logHoursButton.addEventListener("click", (function(){
        storeData(job)
    }))
    document.getElementById("hours-input").value=''
    document.getElementById("hours-note").value=''
}


//receieves jobName which job is stored under
function storeData(jobName){
    let inputHours = document.getElementById("hours-input").value;
    let inputNote = document.getElementById("hours-note").value;  
    let userID = firebase.auth().currentUser.uid;
    const arrayUnion = firebase.firestore.FieldValue.arrayUnion;
    var today = new Date();
    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
    console.log(date)

    //creates a new object with the new input data
    newObj= { hours: inputHours, note: inputNote, date: date }
    
    let myObj = {
        [jobName]: {inputs: arrayUnion(newObj)}
    }

//console.log(jobName); 
//console.log(myObj);

db.collection("trackMyHours-App").doc(userID).set(
    myObj, 
    {merge:true}
    )
    .then(()=>{
        window.location.href="viewjobs.html"
        
    })
    .catch(()=>{
        alert("error")
    })

}


//signs user out and returns to sign in page
function signOutUser(){
    firebase.auth().signOut().then(() => {

      alert("Signed out, goodbye");

      window.location.href = "index.html";
    })
    
  }
  


