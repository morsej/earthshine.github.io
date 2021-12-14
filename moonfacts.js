const MongoClient = require('mongodb').MongoClient;
const url = "mongodb+srv://rileynpeterson:shxh4SHh6WNCgU!@moonfacts.zjgm6.mongodb.net/moonfacts";  // connection string goes here




///MAIN ONE FOR NOW *****************************************
MongoClient.connect(url, { useUnifiedTopology: true }, function(err, db) {
    if(err) { 
		console.log("Connection err: " + err); return; 
	}
  
    var dbo = db.db("earthshine1");
	var coll = dbo.collection('moonfacts');
	console.log("before find");
	//theQuery = {author:"Bob Smith"};
	theQuery="";
    var random = Math.floor(Math.random() * 24 + 1);
    console.log(random);
    var found = "";
	coll.find(theQuery).toArray(function(err, items) {
	  if (err) {
		console.log("Error: " + err);
	  } 
	  else 
	  {
		console.log("Items: ");
		for (i=1; i<items.length + 1; i++){
			console.log(i + " : " + items[i-1]._id + " fact: " + items[i-1].fact);
            if (items[i-1]._id == random) {
                found = items[i-1].fact;
            }	
        }			
	  }   
	  db.close();
      console.log("FOUND: " + found);
	  module.exports = {
		found_fact: found
		};
	console.log("after close");
	});  //end find		
	//console.log("found");
});  //end connect
//**************************************************************** */

// const express = require("express");
// const app = express();
// const mongoose = require("mongoose");
// const bodyParser = require("body-parser");
// const { Schema } = mongoose;
// var path = require('path');

// app.use(bodyParser.urlencoded({extended: true}));
// app.use(express.static(path.join(__dirname, 'public')));
// mongoose.connect("mongodb+srv://rileynpeterson:shxh4SHh6WNCgU!@log.9yar0.mongodb.net/calendar_log", { useNewURLParser: true, useUnifiedTopology: true}, () => console.log(" Mongoose is connected"));

// app.get("/", function(req, res){
//     res.sendFile(__dirname + "/app.html");
// });
// app.post("/", function(req, res){
//     res.send(found);
//     res.redirect('/');
// });

// app.listen(8080, function(){
//     console.log("server is running on 8080");
// });