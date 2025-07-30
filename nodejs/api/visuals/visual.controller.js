const { create, visualsByCategory, insertKeywrord } = require("./visual.service");
const { validationResult } = require("express-validator");

module.exports = {
  uploadVisual: (req, res) => {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      return res.status(400).json({ success: 0, errors: errors.array() });
    }

    if (!req.file) {
      return res.status(400).json({
        success: 0,
        message: "Image file is required",
      });
    }

    const body = {
      category: req.body.category,
      img_path: req.file.path, 
    };

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
        message: "Visual asset uploaded successfully",
        data: results,
      });
    });
  },

getVisualList: (req, res) => {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
        return res.status(400).json({ status: "error", message: errors.array() });
    }

    const category = req.params.category;
    const page = parseInt(req.query.page) || 1;       // Changed default to 1
    const limit = parseInt(req.query.limit) || 10;     // default 10 per page
    const offset = (page - 1) * limit;                // Updated offset calculation

    // Get both the list and total count
    visualsByCategory(category, limit, offset, (err, list, totalCount) => {
        if (err) {
            console.log(err);
            return res.status(500).json({
                status: "error",
                message: "Database error"
            });
        }

        if (!list.length) {
            return res.status(404).json({
                status: "error",
                message: "No visuals found"
            });
        }

        const baseUrl = "https://cardinaldailyquotes.com/api/";
        list.forEach(l => {
            l.image_path = baseUrl + l.image_path;
        });

        return res.status(200).json({
            status: "success",
            data: list,
            pagination: {
                total: totalCount,
                page,
                limit,
                pages: Math.ceil(totalCount / limit)
            }
        });
    });
},


            uploadKeyword: (req, res) => {

          const errors = validationResult(req);
            if (!errors.isEmpty()) {
                return res.status(400).json({ success: 0, errors: errors.array() });
            }


        const body = {
            visual_id: req.params.visual_id,
            keyword: req.body.keyword
        }




        insertKeywrord(body, (err, results) => {
            if (err) {
                console.log(err);
                return res.status(500).json({
                    success: 0,
                    message: "Database connection error"
                });
            }

            return res.status(200).json({
                success: 1,
                data: results
            });
        });
    },

    

  
};
