const { create, getUserByPhone, savePosts, getSavedPosts, createNote, updateNote, getNotes, getBykeyword, updateView } = require("./user.service");
const { genSaltSync, hashSync, compareSync } = require("bcrypt");
const jwt = require("jsonwebtoken");
const { validationResult } = require("express-validator");


module.exports = {
createUser: (req, res) => {
    const body = req.body;

    if (!body.password) {
        return res.status(400).json({
            success: 0,
            message: "Password is required"
        });
    }

    getUserByPhone(body.email, (err, user) => {
        if (err) {
            console.log(err);
            return res.status(500).json({ success: 0, message: "Database error" });
        }

        if (user) {
            return res.status(409).json({ status: "error", message: "User already exists" }); // Use 409 Conflict
        }

        // Only hash and create if user doesn't exist
        const salt = genSaltSync(10);
        body.password = hashSync(body.password, salt);

        create(body, (err, results) => {
            if (err) {
                console.log(err);
                return res.status(500).json({
                    success: 0,
                    message: "Database connection error"
                });
            }

            return res.status(200).json({
                status: "success",
                message: "Registration successful"
            });
        });
    });
},

    loginUser: (req, res) => {
        const body = req.body;
        if (!body.email || !body.password) {
            return res.status(400).json({
                success: 0,
                message: "Email and password required"
            });
        }

        getUserByPhone(body.email, (err, user) => {
            if (err) {
                console.log(err);
                return res.status(500).json({ status: "error", message: "Database error" });
            }

            if (!user) {
                return res.status(404).json({ status: "error", message: "User not found" });
            }

            const isPasswordCorrect = compareSync(body.password, user.password);
            if (!isPasswordCorrect) {
                return res.status(401).json({ status: "error", message: "Invalid password" });
            }

            user.password = undefined; // remove hashed password from response
            const token = jwt.sign({ user }, process.env.JWT_USER, {
                expiresIn: "30d"
            });

            return res.json({
                status: "success",
                message: "Login successful",
                token: token
            });
        });
    },
        getUserProfile: (req, res) => {
        const userData = req.user.user; // because you wrapped it as { user } during jwt.sign()

        getUserByPhone(userData.email, (err, user) => {
            if (err) {
                console.log(err);
                return res.status(500).json({
                    success: 0,
                    message: "Database error"
                });
            }

            if (!user) {
                return res.status(404).json({
                    success: 0,
                    message: "User not found"
                });
            }

            user.password = undefined; // hide password
            return res.status(200).json({
                success: 1,
                data: user
            });
        });
    },


    saveItems: (req, res) => {


          const errors = validationResult(req);
            if (!errors.isEmpty()) {
                return res.status(400).json({ success: 0, errors: errors.array() });
            }

        const body = {
        item: req.params.item,
        item_id: req.params.id,
        user_id: req.user.user.id
        };



        savePosts(body, (err, results) => {
            if (err) {
                console.log(err);
                return res.status(500).json({
               status: "error",
                message: "Database error"
                });
            }

            return res.status(200).json({
               status: "success",
                message: "Post saved"
            });
        });
    },

            usersSavedPosts: (req, res) => {
        const userData = req.user.user; 

        getSavedPosts(userData.id, (err, posts) => {
            if (err) {
                console.log(err);
                return res.status(500).json({
                     status: "error",
                    message: "Database error"
                });
            }

            if (!posts) {
                return res.status(404).json({
                     status: "error",
                    message: "No saved posts found"
                });
            }
            const baseUrl = "https://cardinaldailyquotes.com/api/";

            posts.audios.forEach(audio => {
                audio.img_path = baseUrl + audio.img_path;
                audio.audio_path = baseUrl + audio.audio_path;
            });

            posts.visuals.forEach(visual => {
                visual.image_path = baseUrl + visual.image_path;
            });

            posts.quotes.forEach(q => {
                if(q.is_text == 0){
                    q.quote = baseUrl + q.quote;
                }
            });

            return res.status(200).json({
                status: "success",
                data: posts
            });
        });
    },

    postNotes: (req, res) => {


          const errors = validationResult(req);
            if (!errors.isEmpty()) {
                return res.status(400).json({ success: 0, errors: errors.array() });
            }

        const body = {
        note: req.body.note,
        title: req.body.title,
        user_id: req.user.user.id
        };



        createNote(body, (err, results) => {
            if (err) {
                console.log(err);
                return res.status(500).json({
               status: "error",
                message: "Database error"
                });
            }

            return res.status(200).json({
               status: "success",
                message: "Note saved"
            });
        });
    },




        editNotes: (req, res) => {


          const errors = validationResult(req);
            if (!errors.isEmpty()) {
                return res.status(400).json({ success: 0, errors: errors.array() });
            }

        const body = {
        note: req.body.note,
        note_id: req.params.note_id,
        title: req.body.title,
        user_id: req.user.user.id
        };




        updateNote(body, (err, results) => {
            if (err) {
                console.log(err);
                return res.status(500).json({
               status: "error",
                message: "Database error"
                });
            }

            return res.status(200).json({
               status: "success",
                message: "Note updated"
            });
        });
    },


    getAllNote: (req, res) => {

        getNotes(req.user.user.id, (err, results) => {
            if (err) {
                console.log(err);
                return res.status(500).json({
               status: "error",
                message: "Database error"
                });
            }

            return res.status(200).json({
               status: "success",
                data: results
            });
        });

    },



fetchByKey: (req, res) => {
    const keyword = req.params.keyword;

    const audioPage = parseInt(req.query.audio_page) || 1;
    const audioLimit = parseInt(req.query.audio_limit) || 0;
    const audioOffset = (audioPage - 1) * audioLimit;

    const quotePage = parseInt(req.query.quote_page) || 1;
    const quoteLimit = parseInt(req.query.quote_limit) || 0;
    const quoteOffset = (quotePage - 1) * quoteLimit;

    const visualPage = parseInt(req.query.visual_page) || 1;
    const visualLimit = parseInt(req.query.visual_limit) || 0;
    const visualOffset = (visualPage - 1) * visualLimit;

    getBykeyword(keyword, { 
        audioLimit, audioOffset, 
        quoteLimit, quoteOffset, 
        visualLimit, visualOffset 
    }, (err, posts) => {
        if (err) {
            console.log(err);
            return res.status(500).json({
                status: "error",
                message: "Database error"
            });
        }

        if (!posts) {
            return res.status(404).json({
                status: "error",
                message: "No posts found"
            });
        }

        const baseUrl = "https://cardinaldailyquotes.com/api/";

        posts.audios.forEach(audio => {
            audio.img_path = baseUrl + audio.img_path;
            audio.audio_path = baseUrl + audio.audio_path;
        });

        posts.visuals.forEach(visual => {
            visual.image_path = baseUrl + visual.image_path;
        });

        posts.quotes.forEach(q => {
            if (q.is_text == 0) {
                q.quote = baseUrl + q.quote;
            }
        });

        return res.status(200).json({
            status: "success",
            data: posts
        });
    });
},

    
          editViews: (req, res) => {


          const errors = validationResult(req);
            if (!errors.isEmpty()) {
                return res.status(400).json({ success: 0, errors: errors.array() });
            }

        const body = {
        item: req.params.item,
        item_id: req.params.item_id
        };




        updateView(body, (err, results) => {
            if (err) {
                console.log(err);
                return res.status(500).json({
               status: "error",
                message: "Database error"
                });
            }

            return res.status(200).json({
               status: "success",
                message: "View updated"
            });
        });
    },




};
