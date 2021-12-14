const MongoClient = require('mongodb').MongoClient;
const url = "mongodb+srv://rileynpeterson:shxh4SHh6WNCgU!@moonfacts.zjgm6.mongodb.net/myFirstDatabase?retryWrites=true&w=majority";  // connection string goes here

var found = "";


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
	console.log("after close");
	});  //end find		
});  //end connect

var http = require('http');
var fs = require('fs');
http.createServer(function (req, res) {
  file="app.html";
  fs.readFile(file, function(err, txt) {
    res.writeHead(200, {'Content-Type': 'text/html'});
    res.write(found);
    res.end();
  });
}).listen(8080);
//**************************************************************** */