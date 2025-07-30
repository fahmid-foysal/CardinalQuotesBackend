require("dotenv").config(); // ✅ Load this first
const express = require("express");
const app = express();
const path = require('path');


// app.get("/api", (req, res) => {
//     res.json({
//         success: 1,
//         message: "This is rest apis working"
//     });
// });




const adminRouter = require("./api/admin/admin.router");
const userRouter = require("./api/users/user.router");
const audioRouter = require("./api/audios/audio.router");
const quoteRouter = require("./api/quotes/quote.router");
const visualRouter = require("./api/visuals/visual.router");
const featuredRouter = require("./api/featureds/featured.router");



app.use(express.json());

app.use("/api/admin", adminRouter);
app.use("/api/audios", audioRouter);
app.use("/api/quotes", quoteRouter);
app.use("/api/visuals", visualRouter);
app.use("/api/featureds", featuredRouter);
app.use("/api/users", userRouter);

app.use('/api/uploads', express.static(path.join(__dirname, 'uploads')));





app.listen();
