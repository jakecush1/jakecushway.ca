const express = require('express');
const session = require('express-session');
const cookies = require('cookie-parser');
const app = express();
const mongoClient = require('mongodb').MongoClient;
const bodyParser = require('body-parser');
const url = "mongodb://localhost:27017";

app.use(bodyParser.urlencoded({extended:true}));
app.use(session({
  secret:'secret',
  name:'uniqueID',
  saveUnitialized:false
}))

app.get('/', function(req,res){
  res.sendFile('login.html', {root : __dirname});
  console.log("connected");
})

app.get('/signup/', function(req,res){
  res.sendFile('signup.html', {root : __dirname});
//   console.log("connected");
})

app.get('/signout/', function(req,res){
  req.session.destroy();
          res.redirect('/');
    //   console.log("connected");
})

app.get('/home/', function(req,res){
  console.log("user: " + req.session.username)
  if (req.session.username){
    //if user logged in, connect to database and render post info
      mongoClient.connect(url,function(err, database){
      let dbo = database.db('blogdb');
      let currentUser = req.session.username;
      dbo.collection('users').find({username: currentUser}).toArray(function(err,result){
        if(err){
          throw err
        }
        else {
          //console.log(result)
          res.render('home.ejs', {object:result})
        }
    })
    
  })
    //res.sendFile('home.html', {root : __dirname});
  }
  else{
    res.redirect('/');
  }
})

// app.get('/posts/', function(req,res){
  
//   mongoClient.connect(url,function(err, database){
//     let dbo = database.db('blogdb');
//     let currentUser = req.session.username;
//     dbo.collection('users').find({username: currentUser}).toArray(function(err,result){
      
//     })
    
//   })
  
// })




// app.set('view engine', 'ejs');
app.post('/login/', function(req,res){
  
  let getUsername = req.body.username;
  let getPassword = req.body.password;
    
  mongoClient.connect(url, function(err,database){
    
    let dbo = database.db('blogdb');
    let myData = {username:getUsername,password:getPassword};
    
    dbo.collection('users').find(myData).toArray(function(err,result){
    if (result.length != 0){
      console.log("user exists");
      req.session.username = getUsername;
      res.redirect('/home');
    }
      else {
        console.log("no user exists")
        res.redirect('/');
      }
  })
      
})        
  
})

//Sign up
app.post('/register/', function(req,res){
  
  let newUsername = req.body.username;
  let newPassword = req.body.password;
  let myData = {username:newUsername,password:newPassword, blogposts:[]};
  console.log(myData)
    
  mongoClient.connect(url, function(err,database){
    
    let dbo = database.db('blogdb');
    
    dbo.collection('users').insertOne(myData, function(err,result){
        if(err){
          
          throw err
          //res.redirect('/signup/');
        } 
      else{
        console.log('User Successfully Added!')
        req.session.username = newUsername;
        res.redirect('/home');
        //res.sendFile('home.html', {root: __dirname});
        //database.close()
         }
      
        })   
}) 
  
})

//Sign up
app.post('/storeBlog/', function(req,res){
  let insertTitle = req.body.title;
  let insertBlog = req.body.blog;
  let insert = insertTitle + ": " + insertBlog;
  //console.log(insert);
    
    mongoClient.connect(url, function(err,database){
    
      let dbo = database.db('blogdb');
      let userQuery = {"username": req.session.username};
      let blogQuery = {'$addToSet': {'blogposts':{"post": insertTitle, "content":insertBlog}}}
      dbo.collection('users').updateOne(userQuery,blogQuery, function(err,res){
        //onsole.log("woohooo")
      })
})
  res.redirect('/home/');
})

app.post('/delete/', function(req,res){
  
      mongoClient.connect(url, function(err,database){
    
//       let dbo = database.db('blogdb');
//       let userQuery = {"username": req.session.username};
//       let blogQuery = {'$addToSet': {'blogposts':{"post": insertTitle, "content":insertBlog}}}
//       dbo.collection('users').updateOne(userQuery,blogQuery, function(err,res){
//         //onsole.log("woohooo")
//       })
})
    res.redirect('/home/');
})



app.listen(3001);
