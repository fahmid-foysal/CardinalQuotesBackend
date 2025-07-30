const { createUser, loginUser, getUserProfile, deleteData, keywordDelete } = require("./admin.controller");
const { checkToken } = require("../../middleware/auth");
const router = require("express").Router();
const { param } = require("express-validator");


router.post("/register", createUser);
router.post("/login", loginUser);

// Protected route
router.get("/profile", checkToken, getUserProfile);

router.delete(
  "/delete/:table/:id",
  [
        param("table").notEmpty().withMessage("Table Name required"),
        param("id").notEmpty().withMessage("Item id is required"),
  ],
  checkToken,
  deleteData
)


router.delete(
  "/delete/keyword/:table/:key_word/:item_id",
  [
        param("table").notEmpty().withMessage("Table Name required"),
        param("key_word").notEmpty().withMessage("Keyword is required"),
        param("item_id").notEmpty().withMessage("Item id is required"),
  ],
  checkToken,
  keywordDelete
)

module.exports = router;
