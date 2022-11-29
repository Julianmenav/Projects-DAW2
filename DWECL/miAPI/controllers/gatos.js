const {catPhotos} = require("../data/catPhotos")


const getPhotos = async (req, res) => {
  try {
    const { random } = req.query; //Undefined or value

    //If undefined, return all photos.
    if(random === undefined) return res.json(catPhotos);
    
    //If not (api/gatos?random)
    const rndNumber = Math.ceil(Math.random() * 23) ; //Random from 1 to 23
    

    res.json(catPhotos[rndNumber]);
  } catch (error) {
    console.error(error);
    return res.status(400).json({ Error: "El tweet no contiene un video." });
  }
};

module.exports = { getPhotos };
