//  First off we require some modules that we will be using to make this CRUD application work: express is a node.js framwork for building web apps.  body-parser is used o parse HTTP requests, ejs renders HTML data and is used to retrieve data from HTML, 

const express = require('express');
const app = express();
const mongoose = require('mongoose');
const articleRouter = require('./routes/articles');
const Article = require('./models/article');
const methodOverride = require('method-override');
const bodyParser = require('body-parser');
const ejs = require('ejs');

//next we need to choose our database and connect to it, which is done in the following lines
var db ='mongodb://localhost/blogapp';
mongoose.connect(db);

//tells the server to convert ejs code to html to print on the page
app.set('view engine','ejs');
app.use(express.urlencoded({ extended: false }));
app.use(methodOverride('_method'));


//INDEX PAGE
// this function refers to the home index page
app.get('/', async (req,res) => {
  
  const articles = await Article.find().sort({
    createdAt:'desc'})
  res.render('articles/index', { articles: articles });  //res.render will render the index page
  
  console.log("page load");
});

//everything created in the article router will be after url/articles 
app.use('/articles', articleRouter)

//here the app listens to requests sent to port 3001, then console logs "app listening"
app.listen(3001,function(){
  console.log('app listening');
});

