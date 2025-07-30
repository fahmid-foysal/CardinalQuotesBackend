const { create, quotesByCategory, insertKeywrord } = require("./quote.service");
const { validationResult } = require("express-validator");

module.exports = {
  uploadQuote: (req, res) => {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
      return res.status(400).json({ success: 0, errors: errors.array() });
    }

    const body = req.body;

    if (body.is_text == 0) {
      if (!req.file) {
        return res.status(400).json({
          status: "error",
          message: "Image file (quote) is required when is_text is 0",
        });
      }

      body.quote = req.file.path; 
    }

    if (!body.quote) {
      return res.status(400).json({
        status: "error",
        message: "Quote text is required when is_text is 1",
      });
    }

    create(body, (err, results) => {
      if (err) {
        console.log(err);
        return res.status(500).json({
          success: 0,
          message: "Database connection error",
        });
      }

      return res.status(200).json({
        success: 1,
        data: results,
      });
    });
  },
  

getQuoteList: (req, res) => {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
        return res.status(400).json({ status: "error", message: errors.array() });
    }

    const category = req.params.category;
    const page = parseInt(req.query.page) || 1;
    const limit = parseInt(req.query.limit) || 10;
    const offset = (page - 1) * limit;

    quotesByCategory(category, limit, offset, (err, list, totalCount) => {
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
                message: "No quotes found"
            });
        }

        const baseUrl = "https://cardinaldailyquotes.com/api/";
        list.forEach(l => {
            if (l.is_text == 0) {
                l.quote = baseUrl + l.quote;
            }
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
            quote_id: req.params.quote_id,
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
