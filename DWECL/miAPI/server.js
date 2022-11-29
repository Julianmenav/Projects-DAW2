require('dotenv').config()
const express = require('express')
const cors = require('cors')

const { getPhotos } = require('./controllers/gatos')

const app = express();

const port = process.env.PORT || 3000

app.use(cors())
app.use(express.urlencoded({ extended: false }))
app.use(express.static('public'))

app.get('/', function (req, res) {
  res.sendFile(process.cwd() + '/index.html');
});


app.get("/api/gatos", getPhotos)

//Not Found Middleware

app.use((req, res) => res.status(404).json({ "Error": "Esta ruta no existe." }))


app.listen(port, function () {
  console.log(`Listening on port ${port}`);
});