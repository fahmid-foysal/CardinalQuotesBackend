const { create, audiosByCategory, insertKeywrord } = require("./audio.service");
const { validationResult } = require("express-validator");
const path = require("path");

module.exports = {
    uploadAudio: (req, res) => {

          const errors = validationResult(req);
            if (!errors.isEmpty()) {
                return res.status(400).json({ success: 0, errors: errors.array() });
            }


        const body = req.body;
        const imageFile = req.files['image_path']?.[0];
        const audioFile = req.files['audio_path']?.[0];

        if (!imageFile || !audioFile) {
            return res.status(400).json({
                success: 0,
                message: "Both image and audio files are required",
            });
        }

          body.img_path = imageFile.path;
          body.audio_path = audioFile.path;



        create(body, (err, results) => {
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
getAudioList: (req, res) => {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
        return res.status(400).json({ status: "error", message: errors.array() });
    }

    const category = req.params.category;
    const page = parseInt(req.query.page) || 1;
    const limit = parseInt(req.query.limit) || 10;
    const offset = (page - 1) * limit;

    audiosByCategory(category, limit, offset, (err, list, totalCount) => {
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
                message: "No audio found"
            });
        }

        const baseUrl = "https://cardinaldailyquotes.com/api/";
        list.forEach(l => {
            l.img_path = baseUrl + l.img_path;
            l.audio_path = baseUrl + l.audio_path;
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
            audio_id: req.params.audio_id,
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
