const express = require("express");
const router = express.Router();
const { body, param } = require("express-validator");
const { uploadFeatured, getFeaturedList } = require("./featured.controller");
const { checkToken } = require("../../middleware/auth");
const path = require("path");



// POST /api/visuals/upload
router.post(
  "/upload",
  checkToken,
  [
    body("item_table").notEmpty().withMessage("item_table is required"),
    body("item_id").notEmpty().withMessage("item_id is required")
  ],
  uploadFeatured
);

router.get(
    "/",
    getFeaturedList

)

module.exports = router;
