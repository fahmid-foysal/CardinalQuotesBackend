const express = require("express");
const router = express.Router();
const { body, param } = require("express-validator");
const { uploadQuote, getQuoteList, uploadKeyword } = require("./quote.controller");
const { checkToken } = require("../../middleware/auth");
const multer = require("multer");
const path = require("path");

const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, "uploads/quotes");
  },
  filename: function (req, file, cb) {
    const uniqueSuffix = Date.now() + "-" + Math.round(Math.random() * 1e9);
    cb(null, uniqueSuffix + path.extname(file.originalname));
  },
});
const fileFilter = (req, file, cb) => {
  const allowedTypes = /jpeg|jpg|png|gif/;
  const extname = allowedTypes.test(path.extname(file.originalname).toLowerCase());
  const mimetype = allowedTypes.test(file.mimetype);
  if (extname && mimetype) {
    cb(null, true);
  } else {
    cb(new Error("Only image files are allowed"));
  }
};

const upload = multer({ storage, fileFilter });

router.post(
  "/upload",
  upload.single("quote"),
  [
    body("is_text").notEmpty().isInt().withMessage("is_text must be an integer"),
    body("category").notEmpty().withMessage("Category is required"),
  ],
  checkToken,
  uploadQuote
);

router.get(
    "/:category",
    [
        param("category").notEmpty().withMessage("Category name is required"),
    ],
    getQuoteList

);

router.post(
  "/keyword/:quote_id",
  [
        param("quote_id").notEmpty().withMessage("Audio id required"),
        body("keyword").notEmpty().withMessage("Keyword required"),
  ],
  checkToken,
  uploadKeyword
)

module.exports = router;
