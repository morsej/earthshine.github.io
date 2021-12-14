const express = require("express");
const app = express();
const mongoose = require("mongoose");
const bodyParser = require("body-parser");
const { Schema } = mongoose;
var path = require('path');
// var facts = require('./moonfacts.js');
// console.log(facts.found_fact);

app.use(bodyParser.urlencoded({extended: true}));
app.use(express.static(path.join(__dirname, 'public')));
mongoose.connect("mongodb+srv://rileynpeterson:shxh4SHh6WNCgU!@log.9yar0.mongodb.net/calendar_log", { useNewURLParser: true, useUnifiedTopology: true}, () => console.log(" Mongoose is connected"));

//create a data schema
const logSchema = {
    date: String,
    time: String,
    //clouds: Number,
    color: String,
    phase: Number
}

const Log = mongoose.model("entries", logSchema);

app.get("/", function(req, res){
    res.sendFile(__dirname + "/app.html");
});

app.post("/", function(req, res){
    let newLog = new Log ({
        date: req.body.date,
        time: req.body.time,
        //clouds: req.body.clouds,
        color: req.body.color,
        phase: req.body.phase
    })
    newLog.save();
    // console.log(facts.found_fact);
    //res.write(facts.found_fact);
    res.redirect('/');
});

app.listen(8080, function(){
    console.log("server is running on 8080");
});
