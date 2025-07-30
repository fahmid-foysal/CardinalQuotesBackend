const { create, allFeatureds } = require("./featured.service");
const { validationResult } = require("express-validator");

module.exports = {
  uploadFeatured: (req, res) => {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      return res.status(400).json({ success: 0, errors: errors.array() });
    }

    const body = req.body;


    create(body, (err, results) => {
      if (err) {
        console.error("DB Insert Error:", err);
        return res.status(500).json({
          success: 0,
          message: "Database error",
        });
      }

      return res.status(201).json({
        success: 1,
        message: "Featured uploaded successfully",
        data: results,
      });
    });
  },

      getFeaturedList: (req, res) => {

        allFeatureds( (err, list) => {
            if (err) {
                console.log(err);
                return res.status(500).json({
                    status: "error",
                    message: "Database error"
                });
            }

            if (!list) {
                return res.status(404).json({
                    status: "error",
                    message: "No audio found"
                });
            }
            const baseUrl = "https://cardinaldailyquotes.com/api/";

            list.quoteList.forEach(l => {
                if(l.is_text == 0){
                    l.quote = baseUrl + l.quote;
                }
                
            });
            list.visualList.forEach(l => {
                    l.image_path = baseUrl + l.image_path;
            });

            return res.status(200).json({
                status: "success",
                data: list
            });
        });
    }
    
    
};
