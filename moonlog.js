
const MongoClient = require('mongodb').MongoClient;
const url = "mongodb+srv://rileynpeterson:shxh4SHh6WNCgU!@moonfacts.zjgm6.mongodb.net/myFirstDatabase?retryWrites=true&w=majority";  // connection string goes here

var fs = require('fs');

function main() 
{
  MongoClient.connect(url, function(err, db) {
  if(err) { return console.log(err); }
  
    var dbo = db.db("assignment14");
	var collection = dbo.collection('companies');
	
	//var newData = {"Company": "Apple Inc.", "Ticker": "APPLE"};
    file='companies.csv';
    var array = fs.readFileSync(file).toString().split("\n"); 

    var company;
    var ticker;
    for (i = 1; i < array.length - 1 ; i++){
        //console.log(array[i]);
        company = array[i].split(",")[0];
        ticker = array[i].split(",")[1];
        collection.insertOne({"company" : company , "ticker": ticker}, function(err, res) {
            if(err) { console.log("query err: " + err); return; }
            console.log("new document inserted");
            }  );
    }

	console.log("Success!");
 
});
}

main();