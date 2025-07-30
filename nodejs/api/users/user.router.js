const { createUser, loginUser, getUserProfile, saveItems, usersSavedPosts, postNotes, editNotes, getAllNote, fetchByKey,  editViews } = require("./user.controller");
const { checkUser } = require("../../middleware/auth");
const router = require("express").Router();
const { body, param } = require("express-validator");


router.post("/register", createUser);
router.post("/login", loginUser);

// Protected route
router.get("/profile", checkUser, getUserProfile);
router.get("/saved", checkUser, usersSavedPosts);
router.post("/save/:item/:id",
    [
        param('item').notEmpty().withMessage("item name is required"),
        param('id').notEmpty().withMessage("item id is required")
    ],
    checkUser,
    saveItems
);

router.post("/notes/upload",
    [
        body('note').notEmpty().withMessage("Note is required")
    ],
    checkUser,
    postNotes
);
router.put("/notes/update/:note_id",
    [
        param('note_id').notEmpty().withMessage("Note_id is required"),
        body('note').notEmpty().withMessage("Note is required")
    ],
    checkUser,
    editNotes
);

router.get("/notes",
    checkUser,
    getAllNote
);

router.get("/keywords/:keyword",
        [
        param('keyword').notEmpty().withMessage("keyword is required")
    ],
    fetchByKey
);

router.put(
    "/view/:item/:item_id",
    [
        param('item').notEmpty().withMessage("Item is required"),
        param('item_id').notEmpty().withMessage("item_id is required")
    ],
    editViews
);


module.exports = router;
