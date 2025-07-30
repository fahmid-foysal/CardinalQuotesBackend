const jwt = require("jsonwebtoken");

module.exports = {
    checkToken: (req, res, next) => {
        let token = req.get("authorization");
        if (token) {
            token = token.slice(7); // Remove "Bearer " prefix
            jwt.verify(token, process.env.JWT_SECRET, (err, decoded) => {
                if (err) {
                    return res.status(401).json({
                        success: 0,
                        message: "Invalid Token"
                    });
                } else {
                    req.user = decoded;
                    next();
                }
            });
        } else {
            return res.status(403).json({
                success: 0,
                message: "Access Denied! Unauthorized user"
            });
        }
    },

        checkUser: (req, res, next) => {
        let token = req.get("authorization");
        if (token) {
            token = token.slice(7); // Remove "Bearer " prefix
            jwt.verify(token, process.env.JWT_USER, (err, decoded) => {
                if (err) {
                    return res.status(401).json({
                        success: 0,
                        message: "Invalid Token"
                    });
                } else {
                    req.user = decoded;
                    next();
                }
            });
        } else {
            return res.status(403).json({
                success: 0,
                message: "Access Denied! Unauthorized user"
            });
        }
    }


};
