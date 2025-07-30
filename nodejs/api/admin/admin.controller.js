const { create, getUserByPhone, deleteItem, deleteKeyword } = require("./admin.service");
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
                success: 1,
                data: results
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
                return res.status(500).json({ success: 0, message: "Database error" });
            }

            if (!user) {
                return res.status(404).json({ success: 0, message: "User not found" });
            }

            const isPasswordCorrect = compareSync(body.password, user.password);
            if (!isPasswordCorrect) {
                return res.status(401).json({ success: 0, message: "Invalid password" });
            }

            user.password = undefined; // remove hashed password from response
            const token = jwt.sign({ user }, process.env.JWT_SECRET, {
                expiresIn: "1h"
            });

            return res.json({
                success: 1,
                message: "Login successful",
                token: token
            });
        });
    },
        getUserProfile: (req, res) => {
        const userData = req.user.user; // because you wrapped it as { user } during jwt.sign()

        getUserByPhone(userData.phone, (err, user) => {
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

            deleteData: (req, res) => {

          const errors = validationResult(req);
            if (!errors.isEmpty()) {
                return res.status(400).json({ success: 0, errors: errors.array() });
            }


        const body = {
            table: req.params.table,
            id: req.params.id
        }


        deleteItem(body, (err, results) => {
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


keywordDelete: (req, res) => {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
        return res.status(400).json({ success: 0, errors: errors.array() });
    }

    const body = {
        table: req.params.table,
        keyword: req.params.key_word,  // Changed from key_word to match service
        item_id: req.params.item_id    // Changed from id to item_id to match service
    };

    deleteKeyword(body, (err, results) => {
        if (err) {
            console.log(err);
            return res.status(500).json({
                success: 0,
                message: "Database connection error"
            });
        }

        // Check if anything was actually deleted
        if (results.affectedRows === 0) {
            return res.status(404).json({
                success: 0,
                message: "No keyword found to delete"
            });
        }

        return res.status(200).json({
            success: 1,
            data: results
        });
    });
},


};
