const express = require("express");
const router = express.Router();
const { body, param } = require("express-validator");
const upload = require("../../middleware/uploadConfig");
const { uploadAudio, getAudioList, uploadKeyword } = require("./audio.controller");
const { checkToken } = require("../../middleware/auth");


router.post(
  "/upload",
  upload.fields([
    { name: "image_path", maxCount: 1 },
    { name: "audio_path", maxCount: 1 },
  ]),
  [
    body("name").notEmpty().withMessage("Name is required"),
    body("category").notEmpty().withMessage("Category is required"),
  ],
  checkToken,
  uploadAudio
);

router.get(
    "/:category",
    [
        param("category").notEmpty().withMessage("Category name is required"),
    ],
    getAudioList

)

router.post(
  "/keyword/:audio_id",
  [
        param("audio_id").notEmpty().withMessage("Audio id required"),
        body("keyword").notEmpty().withMessage("Keyword required"),
  ],
  checkToken,
  uploadKeyword
)


module.exports = router;
