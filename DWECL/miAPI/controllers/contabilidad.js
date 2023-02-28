const path = require('path');

const getNationalAccountingData = async (req, res) => {
  try {
    const routeJson = path.join(__dirname, '..', 'data', 'economicData.json')
    res.sendFile(routeJson);
  } catch (error) {
    console.error(error);
    return res.status(400).json({ Error: "Error" });
  }
};

module.exports = { getNationalAccountingData };
