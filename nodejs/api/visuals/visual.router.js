const express = require("express");
const router = express.Router();
const { body, param } = require("express-validator");
const { uploadVisual, getVisualList, uploadKeyword } = require("./visual.controller");
const { checkToken } = require("../../middleware/auth");
const multer = require("multer");
const path = require("path");

// Multer Config
const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, "uploads/visuals");
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
    cb(new Error("Only image files (jpeg, jpg, png, gif) are allowed"));
  }
};

const upload = multer({ storage, fileFilter });

// POST /api/visuals/upload
router.post(
  "/upload",
  checkToken,
  upload.single("img_path"),
  [
    body("category").notEmpty().withMessage("Category is required"),
  ],
  uploadVisual
);

router.get(
    "/:category",
    [
        param("category").notEmpty().withMessage("Category name is required"),
    ],
    getVisualList

)

router.post(
  "/keyword/:visual_id",
  [
        param("visual_id").notEmpty().withMessage("visual id required"),
        body("keyword").notEmpty().withMessage("Keyword required"),
  ],
  checkToken,
  uploadKeyword
)

module.exports = router;
