const express = require('express');
const mysql = require('mysql');

//connection creation
const db = mysql.createConnection({
    host : 'localhost',
    user : "root",
    password : '',
    database : 'bandydb'
});

db.connect((err)=>{
    if(err){
        throw err;
    }
    console.log('MySql Connected.')
});


const app = express();


app.listen('3030',() =>{
    console.log('Sever started on port 3030')
});

app.get('/employees',(res,req)=>{

    db.query('SELECT COUNT(*) FROM table 1',(err,rows,fields)=>{
        

    })
})